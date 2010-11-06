<?php
//
//  FPDF_TPL - Version 1.1.1
//
//    Copyright 2004-2007 Setasign - Jan Slabon
//
//  Licensed under the Apache License, Version 2.0 (the "License");
//  you may not use this file except in compliance with the License.
//  You may obtain a copy of the License at
//
//      http://www.apache.org/licenses/LICENSE-2.0
//
//  Unless required by applicable law or agreed to in writing, software
//  distributed under the License is distributed on an "AS IS" BASIS,
//  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
//  See the License for the specific language governing permissions and
//  limitations under the License.
//

require_once("fpdf.php");

class FPDF_TPL extends FPDF {
    /**
     * Array of Tpl-Data
     * @var array
     */
    var $tpls = array();

    /**
     * Current Template-ID
     * @var int
     */
    var $tpl = 0;
    
    /**
     * "In Template"-Flag
     * @var boolean
     */
    var $_intpl = false;
    
    /**
     * Nameprefix of Templates used in Resources-Dictonary
     * @var string A String defining the Prefix used as Template-Object-Names. Have to beginn with an /
     */
    var $tplprefix = "/TPL";

    /**
     * Resources used By Templates and Pages
     * @var array
     */
    var $_res = array();
    
    /**
     * Constructor
     * See FPDF-Documentation
     * @param string $orientation
     * @param string $unit
     * @param mixed $format
     */
    function fpdf_tpl($orientation='P',$unit='mm',$format='A4') {
        parent::fpdf($orientation,$unit,$format);    
    }
    
    /**
     * Start a Template
     *
     * This method starts a template. You can give own coordinates to build an own sized
     * Template. Pay attention, that the margins are adapted to the new templatesize.
     * If you want to write outside the template, for example to build a clipped Template,
     * you have to set the Margins and "Cursor"-Position manual after beginTemplate-Call.
     *
     * If no parameter is given, the template uses the current page-size.
     * The Method returns an ID of the current Template. This ID is used later for using this template.
     * Warning: A created Template is used in PDF at all events. Still if you don't use it after creation!
     *
     * @param int $x The x-coordinate given in user-unit
     * @param int $y The y-coordinate given in user-unit
     * @param int $w The width given in user-unit
     * @param int $h The height given in user-unit
     * @return int The ID of new created Template
     */
    function beginTemplate($x=null,$y=null,$w=null,$h=null) {
        if ($this->page <= 0)
            $this->error("You have to add a page to fpdf first!");

        if ($x == null)
            $x = 0;
        if ($y == null)
            $y = 0;
        if ($w == null)
            $w = $this->w;
        if ($h == null)
            $h = $this->h;

        // Save settings
        $this->tpl++;
        $tpl =& $this->tpls[$this->tpl];
        $tpl = array(
            'o_x' => $this->x,
            'o_y' => $this->y,
            'o_AutoPageBreak' => $this->AutoPageBreak,
            'o_bMargin' => $this->bMargin,
            'o_tMargin' => $this->tMargin,
            'o_lMargin' => $this->lMargin,
            'o_rMargin' => $this->rMargin,
            'o_h' => $this->h,
            'o_w' => $this->w,
            'buffer' => '',
            'x' => $x,
            'y' => $y,
            'w' => $w,
            'h' => $h
        );

        $this->SetAutoPageBreak(false);
        
        // Define own high and width to calculate possitions correct
        $this->h = $h;
        $this->w = $w;

        $this->_intpl = true;
        $this->SetXY($x+$this->lMargin,$y+$this->tMargin);
        $this->SetRightMargin($this->w-$w+$this->rMargin);

        return $this->tpl;
    }
    
    /**
     * End Template
     *
     * This method ends a template and reset initiated variables on beginTemplate.
     *
     * @return mixed If a template is opened, the ID is returned. If not a false is returned.
     */
    function endTemplate() {
        if ($this->_intpl) {
            $this->_intpl = false; 
            $tpl =& $this->tpls[$this->tpl];
            $this->SetXY($tpl['o_x'], $tpl['o_y']);
            $this->tMargin = $tpl['o_tMargin'];
            $this->lMargin = $tpl['o_lMargin'];
            $this->rMargin = $tpl['o_rMargin'];
            $this->h = $tpl['o_h'];
            $this->w = $tpl['o_w'];
            $this->SetAutoPageBreak($tpl['o_AutoPageBreak'], $tpl['o_bMargin']);
            
            return $this->tpl;
        } else {
            return false;
        }
    }
    
    /**
     * Use a Template in current Page or other Template
     *
     * You can use a template in a page or in another template.
     * You can give the used template a new size like you use the Image()-method.
     * All parameters are optional. The width or height is calculated automaticaly
     * if one is given. If no parameter is given the origin size as defined in
     * beginTemplate() is used.
     * The calculated or used width and height are returned as an array.
     *
     * @param int $tplidx A valid template-Id
     * @param int $_x The x-position
     * @param int $_y The y-position
     * @param int $_w The new width of the template
     * @param int $_h The new height of the template
     * @retrun array The height and width of the template
     */
    function useTemplate($tplidx, $_x=null, $_y=null, $_w=0, $_h=0) {
        if ($this->page <= 0)
            $this->error("You have to add a page to fpdf first!");

        if (!isset($this->tpls[$tplidx]))
            $this->error("Template does not exist!");
            
        if ($this->_intpl) {
            $this->_res['tpl'][$this->tpl]['tpls'][$tplidx] =& $this->tpls[$tplidx];
        }
        
        $tpl =& $this->tpls[$tplidx];
        $x = $tpl['x'];
        $y = $tpl['y'];
        $w = $tpl['w'];
        $h = $tpl['h'];
        
        if ($_x == null)
            $_x = $x;
        if ($_y == null)
            $_y = $y;
        $wh = $this->getTemplateSize($tplidx,$_w,$_h);
        $_w = $wh['w'];
        $_h = $wh['h'];
    
        $this->_out(sprintf("q %.4f 0 0 %.4f %.2f %.2f cm", ($_w/$w), ($_h/$h), $_x*$this->k, ($this->h-($_y+$_h))*$this->k)); // Translate 
        $this->_out($this->tplprefix.$tplidx." Do Q");

        return array("w" => $_w, "h" => $_h);
    }
    
    /**
     * Get The calculated Size of a Template
     *
     * If one size is given, this method calculates the other one.
     *
     * @param int $tplidx A valid template-Id
     * @param int $_w The width of the template
     * @param int $_h The height of the template
     * @return array The height and width of the template
     */
    function getTemplateSize($tplidx, $_w=0, $_h=0) {
        if (!$this->tpls[$tplidx])
            return false;

        $tpl =& $this->tpls[$tplidx];
        $w = $tpl['w'];
        $h = $tpl['h'];
        
        if ($_w == 0 and $_h == 0) {
            $_w = $w;
            $_h = $h;
        }

    	if($_w==0)
    		$_w=$_h*$w/$h;
    	if($_h==0)
    		$_h=$_w*$h/$w;
    		
        return array("w" => $_w, "h" => $_h);
    }
    
    /**
     * See FPDF-Documentation ;-)
     */
    function SetFont($family,$style='',$size=0) {
        /**
         * force the resetting of font changes in a template
         */
        if ($this->_intpl)
            $this->FontFamily = '';
            
        parent::SetFont($family, $style, $size);
       
        $fontkey = $this->FontFamily.$this->FontStyle;
        
        if ($this->_intpl) {
            $this->_res['tpl'][$this->tpl]['fonts'][$fontkey] =& $this->fonts[$fontkey];
        } else {
            $this->_res['page'][$this->page]['fonts'][$fontkey] =& $this->fonts[$fontkey];
        }
    }
    
    /**
     * See FPDF-Documentation ;-)
     */
    function Image($file,$x,$y,$w=0,$h=0,$type='',$link='') {
        parent::Image($file,$x,$y,$w,$h,$type,$link);
        if ($this->_intpl) {
            $this->_res['tpl'][$this->tpl]['images'][$file] =& $this->images[$file];
        } else {
            $this->_res['page'][$this->page]['images'][$file] =& $this->images[$file];
        }
    }
    
    /**
     * See FPDF-Documentation ;-)
     *
     * AddPage is not available when you're "in" a template.
     */
    function AddPage($orientation='') {
        if ($this->_intpl)
            $this->Error('Adding pages in templates isn\'t possible!');
        parent::AddPage($orientation);
    }

    /**
     * Preserve adding Links in Templates ...won't work
     */
    function Link($x,$y,$w,$h,$link) {
        if ($this->_intpl)
            $this->Error('Using links in templates aren\'t possible!');
        parent::Link($x,$y,$w,$h,$link);
    }
    
    function AddLink() {
        if ($this->_intpl)
            $this->Error('Adding links in templates aren\'t possible!');
        return parent::AddLink();
    }
    
    function SetLink($link,$y=0,$page=-1) {
        if ($this->_intpl)
            $this->Error('Setting links in templates aren\'t possible!');
        parent::SetLink($link,$y,$page);
    }
    
    /**
     * Private Method that writes the form xobjects
     */
    function _putformxobjects() {
        $filter=($this->compress) ? '/Filter /FlateDecode ' : '';
	    reset($this->tpls);
        foreach($this->tpls AS $tplidx => $tpl) {

            $p=($this->compress) ? gzcompress($tpl['buffer']) : $tpl['buffer'];
    		$this->_newobj();
    		$this->tpls[$tplidx]['n'] = $this->n;
    		$this->_out('<<'.$filter.'/Type /XObject');
            $this->_out('/Subtype /Form');
            $this->_out('/FormType 1');
            $this->_out(sprintf('/BBox [%.2f %.2f %.2f %.2f]',$tpl['x']*$this->k, ($tpl['h']-$tpl['y'])*$this->k, $tpl['w']*$this->k, ($tpl['h']-$tpl['y']-$tpl['h'])*$this->k));
            $this->_out('/Resources ');

            $this->_out('<</ProcSet [/PDF /Text /ImageB /ImageC /ImageI]');
        	if (isset($this->_res['tpl'][$tplidx]['fonts']) && count($this->_res['tpl'][$tplidx]['fonts'])) {
            	$this->_out('/Font <<');
                foreach($this->_res['tpl'][$tplidx]['fonts'] as $font)
            		$this->_out('/F'.$font['i'].' '.$font['n'].' 0 R');
            	$this->_out('>>');
            }
        	if(isset($this->_res['tpl'][$tplidx]['images']) && count($this->_res['tpl'][$tplidx]['images']) || 
        	   isset($this->_res['tpl'][$tplidx]['tpls']) && count($this->_res['tpl'][$tplidx]['tpls']))
        	{
                $this->_out('/XObject <<');
                if (isset($this->_res['tpl'][$tplidx]['images']) && count($this->_res['tpl'][$tplidx]['images'])) {
                    foreach($this->_res['tpl'][$tplidx]['images'] as $image)
              			$this->_out('/I'.$image['i'].' '.$image['n'].' 0 R');
                }
                if (isset($this->_res['tpl'][$tplidx]['tpls']) && count($this->_res['tpl'][$tplidx]['tpls'])) {
                    foreach($this->_res['tpl'][$tplidx]['tpls'] as $i => $tpl)
                        $this->_out($this->tplprefix.$i.' '.$tpl['n'].' 0 R');
                }
                $this->_out('>>');
        	}
        	$this->_out('>>');
        	
        	$this->_out('/Length '.strlen($p).' >>');
    		$this->_putstream($p);
    		$this->_out('endobj');
        }
    }
    
    /**
     * Private Method
     */
    function _putresources() {
        $this->_putfonts();
    	$this->_putimages();
    	$this->_putformxobjects();
        //Resource dictionary
    	$this->offsets[2]=strlen($this->buffer);
    	$this->_out('2 0 obj');
    	$this->_out('<<');
    	$this->_putresourcedict();
    	$this->_out('>>');
    	$this->_out('endobj');
    }
    
    function _putxobjectdict() {
        parent::_putxobjectdict();
        
        if (count($this->tpls)) {
            foreach($this->tpls as $tplidx => $tpl) {
                $this->_out($this->tplprefix.$tplidx.' '.$tpl['n'].' 0 R');
            }
        }
    }

    /**
     * Private Method
     */
    function _out($s) {
	   //Add a line to the document
	   if ($this->state==2) {
           if (!$this->_intpl)
	           $this->pages[$this->page].=$s."\n";
           else
               $this->tpls[$this->tpl]['buffer'] .= $s."\n";
       } else {
		   $this->buffer.=$s."\n";
       }
    }
    
######## UFPDF 
    function GetStringWidth($s)
    {
      //Get width of a string in the current font
      $s = (string)$s;
      $codepoints=$this->utf8_to_codepoints($s);
      $cw=&$this->CurrentFont['cw'];
      $w=0;
      foreach($codepoints as $cp)
        $w+=$cw[$cp];
      return $w*$this->FontSize/1000;
    }

    function AddFont($family,$style='',$file='')
    {
      //Add a TrueType or Type1 font
      $family=strtolower($family);
      if($family=='arial')
        $family='helvetica';
      $style=strtoupper($style);
      if($style=='IB')
        $style='BI';
      if(isset($this->fonts[$family.$style]))
        $this->Error('Font already added: '.$family.' '.$style);
      if($file=='')
        $file=str_replace(' ','',$family).strtolower($style).'.php';
      if(defined('FPDF_FONTPATH'))
        $file=FPDF_FONTPATH.$file;
      include($file);
      if(!isset($name))
        $this->Error('Could not include font definition file 3 ' . $file);
      $i=count($this->fonts)+1;
      $this->fonts[$family.$style]=array('i'=>$i,'type'=>$type,'name'=>$name,'desc'=>$desc,'up'=>$up,'ut'=>$ut,'cw'=>$cw,'file'=>$file,'ctg'=>$ctg);
      if($file)
      {
        if($type=='TrueTypeUnicode')
          $this->FontFiles[$file]=array('length1'=>$originalsize);
        else
          $this->FontFiles[$file]=array('length1'=>$size1,'length2'=>$size2);
      }
    }

    function Text($x,$y,$txt)
    {
      //Output a string
      $s=sprintf('BT %.2f %.2f Td %s Tj ET',$x*$this->k,($this->h-$y)*$this->k,$this->_escapetext($txt));
      if($this->underline and $txt!='')
        $s.=' '.$this->_dounderline($x,$y,$this->GetStringWidth($txt),$txt);
      if($this->ColorFlag)
        $s='q '.$this->TextColor.' '.$s.' Q';
      $this->_out($s);
    }

    function AcceptPageBreak()
    {
      //Accept automatic page break or not
      return $this->AutoPageBreak;
    }

    function Cell($w,$h=0,$txt='',$border=0,$ln=0,$align='',$fill=0,$link='')
    {
      //Output a cell
      $k=$this->k;
      if($this->y+$h>$this->PageBreakTrigger and !$this->InFooter and $this->AcceptPageBreak())
      {
        //Automatic page break
        $x=$this->x;
        $ws=$this->ws;
        if($ws>0)
        {
          $this->ws=0;
          $this->_out('0 Tw');
        }
        $this->AddPage($this->CurOrientation);
        $this->x=$x;
        if($ws>0)
        {
          $this->ws=$ws;
          $this->_out(sprintf('%.3f Tw',$ws*$k));
        }
      }
      if($w==0)
        $w=$this->w-$this->rMargin-$this->x;
      $s='';
      if($fill==1 or $border==1)
      {
        if($fill==1)
          $op=($border==1) ? 'B' : 'f';
        else
          $op='S';
        $s=sprintf('%.2f %.2f %.2f %.2f re %s ',$this->x*$k,($this->h-$this->y)*$k,$w*$k,-$h*$k,$op);
      }
      if(is_string($border))
      {
        $x=$this->x;
        $y=$this->y;
        if(is_int(strpos($border,'L')))
          $s.=sprintf('%.2f %.2f m %.2f %.2f l S ',$x*$k,($this->h-$y)*$k,$x*$k,($this->h-($y+$h))*$k);
        if(is_int(strpos($border,'T')))
          $s.=sprintf('%.2f %.2f m %.2f %.2f l S ',$x*$k,($this->h-$y)*$k,($x+$w)*$k,($this->h-$y)*$k);
        if(is_int(strpos($border,'R')))
          $s.=sprintf('%.2f %.2f m %.2f %.2f l S ',($x+$w)*$k,($this->h-$y)*$k,($x+$w)*$k,($this->h-($y+$h))*$k);
        if(is_int(strpos($border,'B')))
          $s.=sprintf('%.2f %.2f m %.2f %.2f l S ',$x*$k,($this->h-($y+$h))*$k,($x+$w)*$k,($this->h-($y+$h))*$k);
      }
      if($txt!='')
      {
        $width = $this->GetStringWidth($txt);
        if($align=='R')
          $dx=$w-$this->cMargin-$width;
        elseif($align=='C')
          $dx=($w-$width)/2;
        else
          $dx=$this->cMargin;
        if($this->ColorFlag)
          $s.='q '.$this->TextColor.' ';
        $txtstring=$this->_escapetext($txt);
        $s.=sprintf('BT %.2f %.2f Td %s Tj ET',($this->x+$dx)*$k,($this->h-($this->y+.5*$h+.3*$this->FontSize))*$k,$txtstring);
        if($this->underline)
          $s.=' '.$this->_dounderline($this->x+$dx,$this->y+.5*$h+.3*$this->FontSize,$width,$txt);
        if($this->ColorFlag)
          $s.=' Q';
        if($link)
          $this->Link($this->x+$dx,$this->y+.5*$h-.5*$this->FontSize,$width,$this->FontSize,$link);
      }
      if($s)
        $this->_out($s);
      $this->lasth=$h;
      if($ln>0)
      {
        //Go to next line
        $this->y+=$h;
        if($ln==1)
          $this->x=$this->lMargin;
      }
      else
        $this->x+=$w;
    }

    /*******************************************************************************
    *                                                                              *
    *                              Protected methods                               *
    *                                                                              *
    *******************************************************************************/

    function _puttruetypeunicode($font) {
      //Type0 Font
      $this->_newobj();
      $this->_out('<</Type /Font');
      $this->_out('/Subtype /Type0');
      $this->_out('/BaseFont /'. $font['name'] .'-UCS');
      $this->_out('/Encoding /Identity-H');
      $this->_out('/DescendantFonts ['. ($this->n + 1) .' 0 R]');
      $this->_out('>>');
      $this->_out('endobj');

      //CIDFont
      $this->_newobj();
      $this->_out('<</Type /Font');
      $this->_out('/Subtype /CIDFontType2');
      $this->_out('/BaseFont /'. $font['name']);
      $this->_out('/CIDSystemInfo <</Registry (Adobe) /Ordering (UCS) /Supplement 0>>');
      $this->_out('/FontDescriptor '. ($this->n + 1) .' 0 R');
      $c = 0;
      foreach ($font['cw'] as $i => $w) {
        $widths .= $i .' ['. $w.'] ';
      }
      $this->_out('/W ['. $widths .']');
      $this->_out('/CIDToGIDMap '. ($this->n + 2) .' 0 R');
      $this->_out('>>');
      $this->_out('endobj');

      //Font descriptor
      $this->_newobj();
      $this->_out('<</Type /FontDescriptor');
      $this->_out('/FontName /'.$font['name']);
      foreach ($font['desc'] as $k => $v) {
        $s .= ' /'. $k .' '. $v;
      }
      if ($font['file']) {
            $s .= ' /FontFile2 '. $this->FontFiles[$font['file']]['n'] .' 0 R';
      }
      $this->_out($s);
      $this->_out('>>');
      $this->_out('endobj');

      //Embed CIDToGIDMap
      $this->_newobj();
      if(defined('FPDF_FONTPATH'))
        $file=FPDF_FONTPATH.$font['ctg'];
      else
        $file=$font['ctg'];
      $size=filesize($file);
      if(!$size)
        $this->Error('Font file not found');
      $this->_out('<</Length '.$size);
        if(substr($file,-2) == '.z')
        $this->_out('/Filter /FlateDecode');
      $this->_out('>>');
      $f = fopen($file,'rb');
      $this->_putstream(fread($f,$size));
      fclose($f);
      $this->_out('endobj');
    }

    function _dounderline($x,$y,$width,$txt)
    {
      //Underline text
      $up=$this->CurrentFont['up'];
      $ut=$this->CurrentFont['ut'];
      $w=$width+$this->ws*substr_count($txt,' ');
      return sprintf('%.2f %.2f %.2f %.2f re f',$x*$this->k,($this->h-($y-$up/1000*$this->FontSize))*$this->k,$w*$this->k,-$ut/1000*$this->FontSizePt);
    }

    function _textstring($s)
    {
      //Convert to UTF-16BE
      $s = $this->utf8_to_utf16be($s);
      //Escape necessary characters
      return '('. strtr($s, array(')' => '\\)', '(' => '\\(', '\\' => '\\\\')) .')';
    }

    function _escapetext($s)
    {
      //Convert to UTF-16BE
      $s = $this->utf8_to_utf16be($s, false);
      //Escape necessary characters
      return '('. strtr($s, array(')' => '\\)', '(' => '\\(', '\\' => '\\\\')) .')';
    }

    function _putinfo()
    {
        $this->_out('/Producer '.$this->_textstring('UFPDF '. UFPDF_VERSION));
        if(!empty($this->title))
            $this->_out('/Title '.$this->_textstring($this->title));
        if(!empty($this->subject))
            $this->_out('/Subject '.$this->_textstring($this->subject));
        if(!empty($this->author))
            $this->_out('/Author '.$this->_textstring($this->author));
        if(!empty($this->keywords))
            $this->_out('/Keywords '.$this->_textstring($this->keywords));
        if(!empty($this->creator))
            $this->_out('/Creator '.$this->_textstring($this->creator));
        $this->_out('/CreationDate '.$this->_textstring('D:'.date('YmdHis')));
    }

    // UTF-8 to UTF-16BE conversion.
    // Correctly handles all illegal UTF-8 sequences.
    function utf8_to_utf16be(&$txt, $bom = true) {
      $l = strlen($txt);
      $out = $bom ? "\xFE\xFF" : '';
      for ($i = 0; $i < $l; ++$i) {
        $c = ord($txt{$i});
        // ASCII
        if ($c < 0x80) {
          $out .= "\x00". $txt{$i};
        }
        // Lost continuation byte
        else if ($c < 0xC0) {
          $out .= "\xFF\xFD";
          continue;
        }
        // Multibyte sequence leading byte
        else {
          if ($c < 0xE0) {
            $s = 2;
          }
          else if ($c < 0xF0) {
            $s = 3;
          }
          else if ($c < 0xF8) {
            $s = 4;
          }
          // 5/6 byte sequences not possible for Unicode.
          else {
            $out .= "\xFF\xFD";
            while (ord($txt{$i + 1}) >= 0x80 && ord($txt{$i + 1}) < 0xC0) { ++$i; }
            continue;
          }
          
          $q = array($c);
          // Fetch rest of sequence
          while (ord($txt{$i + 1}) >= 0x80 && ord($txt{$i + 1}) < 0xC0) { ++$i; $q[] = ord($txt{$i}); }
          
          // Check length
          if (count($q) != $s) {
            $out .= "\xFF\xFD";        
            continue;
          }
          
          switch ($s) {
            case 2:
              $cp = (($q[0] ^ 0xC0) << 6) | ($q[1] ^ 0x80);
              // Overlong sequence
              if ($cp < 0x80) {
                $out .= "\xFF\xFD";        
              }
              else {
                $out .= chr($cp >> 8);
                $out .= chr($cp & 0xFF);
              }
              continue;

            case 3:
              $cp = (($q[0] ^ 0xE0) << 12) | (($q[1] ^ 0x80) << 6) | ($q[2] ^ 0x80);
              // Overlong sequence
              if ($cp < 0x800) {
                $out .= "\xFF\xFD";        
              }
              // Check for UTF-8 encoded surrogates (caused by a bad UTF-8 encoder)
              else if ($c > 0xD800 && $c < 0xDFFF) {
                $out .= "\xFF\xFD";
              }
              else {
                $out .= chr($cp >> 8);
                $out .= chr($cp & 0xFF);
              }
              continue;

            case 4:
              $cp = (($q[0] ^ 0xF0) << 18) | (($q[1] ^ 0x80) << 12) | (($q[2] ^ 0x80) << 6) | ($q[3] ^ 0x80);
              // Overlong sequence
              if ($cp < 0x10000) {
                $out .= "\xFF\xFD";
              }
              // Outside of the Unicode range
              else if ($cp >= 0x10FFFF) {
                $out .= "\xFF\xFD";            
              }
              else {
                // Use surrogates
                $cp -= 0x10000;
                $s1 = 0xD800 | ($cp >> 10);
                $s2 = 0xDC00 | ($cp & 0x3FF);
                
                $out .= chr($s1 >> 8);
                $out .= chr($s1 & 0xFF);
                $out .= chr($s2 >> 8);
                $out .= chr($s2 & 0xFF);
              }
              continue;
          }
        }
      }
      return $out;
    }

    // UTF-8 to codepoint array conversion.
    // Correctly handles all illegal UTF-8 sequences.
    function utf8_to_codepoints(&$txt) {
      $l = strlen($txt);
      $out = array();
      for ($i = 0; $i < $l; ++$i) {
        $c = ord($txt{$i});
        // ASCII
        if ($c < 0x80) {
          $out[] = ord($txt{$i});
        }
        // Lost continuation byte
        else if ($c < 0xC0) {
          $out[] = 0xFFFD;
          continue;
        }
        // Multibyte sequence leading byte
        else {
          if ($c < 0xE0) {
            $s = 2;
          }
          else if ($c < 0xF0) {
            $s = 3;
          }
          else if ($c < 0xF8) {
            $s = 4;
          }
          // 5/6 byte sequences not possible for Unicode.
          else {
            $out[] = 0xFFFD;
            while (ord($txt{$i + 1}) >= 0x80 && ord($txt{$i + 1}) < 0xC0) { ++$i; }
            continue;
          }
          
          $q = array($c);
          // Fetch rest of sequence
          while (ord($txt{$i + 1}) >= 0x80 && ord($txt{$i + 1}) < 0xC0) { ++$i; $q[] = ord($txt{$i}); }
          
          // Check length
          if (count($q) != $s) {
            $out[] = 0xFFFD;
            continue;
          }
          
          switch ($s) {
            case 2:
              $cp = (($q[0] ^ 0xC0) << 6) | ($q[1] ^ 0x80);
              // Overlong sequence
              if ($cp < 0x80) {
                $out[] = 0xFFFD;
              }
              else {
                $out[] = $cp;
              }
              continue;

            case 3:
              $cp = (($q[0] ^ 0xE0) << 12) | (($q[1] ^ 0x80) << 6) | ($q[2] ^ 0x80);
              // Overlong sequence
              if ($cp < 0x800) {
                $out[] = 0xFFFD;
              }
              // Check for UTF-8 encoded surrogates (caused by a bad UTF-8 encoder)
              else if ($c > 0xD800 && $c < 0xDFFF) {
                $out[] = 0xFFFD;
              }
              else {
                $out[] = $cp;
              }
              continue;

            case 4:
              $cp = (($q[0] ^ 0xF0) << 18) | (($q[1] ^ 0x80) << 12) | (($q[2] ^ 0x80) << 6) | ($q[3] ^ 0x80);
              // Overlong sequence
              if ($cp < 0x10000) {
                $out[] = 0xFFFD;
              }
              // Outside of the Unicode range
              else if ($cp >= 0x10FFFF) {
                $out[] = 0xFFFD;
              }
              else {
                $out[] = $cp;
              }
              continue;
          }
        }
      }
      return $out;
    }
    
    
}

?>