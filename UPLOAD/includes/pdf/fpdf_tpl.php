<?php
/**
 * This file is part of FPDI
 *
 * @package   FPDI
 * @copyright Copyright (c) 2017 Setasign - Jan Slabon (http://www.setasign.com)
 * @license   http://opensource.org/licenses/mit-license The MIT License
 * @version   1.6.2
 * modified for PHP 7.4 and pdf Rechnung for Zen Cart 2021-10-24 webchills
 */

if (!class_exists('fpdi_bridge')) {
    require_once('fpdi_bridge.php');
}

/**
 * Class FPDF_TPL
 */
class FPDF_TPL extends fpdi_bridge
{
    /**
     * Array of template data
     *
     * @var array
     */
    protected $_tpls = array();

    /**
     * Current Template-Id
     *
     * @var int
     */
    public $tpl = 0;

    /**
     * "In Template"-Flag
     *
     * @var boolean
     */
    protected $_inTpl = false;

    /**
     * Name prefix of templates used in Resources dictionary
     *
     * @var string A String defining the Prefix used as Template-Object-Names. Have to begin with an /
     */
    public $tplPrefix = "/TPL";

    /**
     * Resources used by templates and pages
     *
     * @var array
     */
    protected  $_res = array();

    /**
     * Last used template data
     *
     * @var array
     */
    public $lastUsedTemplateData = array();

    /**
     * Start a template.
     *
     * This method starts a template. You can give own coordinates to build an own sized
     * template. Pay attention, that the margins are adapted to the new template size.
     * If you want to write outside the template, for example to build a clipped template,
     * you have to set the margins and "cursor"-position manual after beginTemplate()-call.
     *
     * If no parameter is given, the template uses the current page-size.
     * The method returns an id of the current template. This id is used later for using this template.
     * Warning: A created template is saved in the resulting PDF at all events. Also if you don't use it after creation!
     *
     * @param int $x The x-coordinate given in user-unit
     * @param int $y The y-coordinate given in user-unit
     * @param int $w The width given in user-unit
     * @param int $h The height given in user-unit
     * @return int The id of new created template
     * @throws LogicException
     */
    public function beginTemplate($x = null, $y = null, $w = null, $h = null)
    {
        if (is_subclass_of($this, 'TCPDF')) {
            throw new LogicException('This method is only usable with FPDF. Use TCPDF methods startTemplate() instead.');
        }

        if ($this->page <= 0) {
            throw new LogicException("You have to add at least a page first!");
        }

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
        $tpl =& $this->_tpls[$this->tpl];
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
            'o_FontFamily' => $this->FontFamily,
            'o_FontStyle' => $this->FontStyle,
            'o_FontSizePt' => $this->FontSizePt,
            'o_FontSize' => $this->FontSize,
            'buffer' => '',
            'x' => $x,
            'y' => $y,
            'w' => $w,
            'h' => $h
        );

        $this->SetAutoPageBreak(false);

        // Define own high and width to calculate correct positions
        $this->h = $h;
        $this->w = $w;

        $this->_inTpl = true;
        $this->SetXY($x + $this->lMargin, $y + $this->tMargin);
        $this->SetRightMargin($this->w - $w + $this->rMargin);

        if ($this->CurrentFont) {
            $fontKey = $this->FontFamily . $this->FontStyle;
            if ($fontKey) {
                $this->_res['tpl'][$this->tpl]['fonts'][$fontKey] =& $this->fonts[$fontKey];
                $this->_out(sprintf('BT /F%d %.2F Tf ET', $this->CurrentFont['i'], $this->FontSizePt));
            }
        }

        return $this->tpl;
    }

    /**
     * End template.
     *
     * This method ends a template and reset initiated variables collected in {@link beginTemplate()}.
     *
     * @return int|boolean If a template is opened, the id is returned. If not a false is returned.
     */
    public function endTemplate()
    {
        if (is_subclass_of($this, 'TCPDF')) {
            $args = func_get_args();
            return call_user_func_array(array($this, 'TCPDF::endTemplate'), $args);
        }

        if ($this->_inTpl) {
            $this->_inTpl = false;
            $tpl = $this->_tpls[$this->tpl];
            $this->SetXY($tpl['o_x'], $tpl['o_y']);
            $this->tMargin = $tpl['o_tMargin'];
            $this->lMargin = $tpl['o_lMargin'];
            $this->rMargin = $tpl['o_rMargin'];
            $this->h = $tpl['o_h'];
            $this->w = $tpl['o_w'];
            $this->SetAutoPageBreak($tpl['o_AutoPageBreak'], $tpl['o_bMargin']);

            $this->FontFamily = $tpl['o_FontFamily'];
            $this->FontStyle = $tpl['o_FontStyle'];
            $this->FontSizePt = $tpl['o_FontSizePt'];
            $this->FontSize = $tpl['o_FontSize'];

            $fontKey = $this->FontFamily . $this->FontStyle;
            if ($fontKey)
                $this->CurrentFont =& $this->fonts[$fontKey];

            return $this->tpl;
        } else {
            return false;
        }
    }

    /**
     * Use a template in current page or other template.
     *
     * You can use a template in a page or in another template.
     * You can give the used template a new size.
     * All parameters are optional. The width or height is calculated automatically
     * if one is given. If no parameter is given the origin size as defined in
     * {@link beginTemplate()} method is used.
     *
     * The calculated or used width and height are returned as an array.
     *
     * @param int $tplIdx A valid template-id
     * @param int $x The x-position
     * @param int $y The y-position
     * @param int $w The new width of the template
     * @param int $h The new height of the template
     * @return array The height and width of the template (array('w' => ..., 'h' => ...))
     * @throws LogicException|InvalidArgumentException
     */
    public function useTemplate($tplIdx, $x = null, $y = null, $w = 0, $h = 0)
    {
        if ($this->page <= 0) {
            throw new LogicException('You have to add at least a page first!');
        }

        if (!isset($this->_tpls[$tplIdx])) {
            throw new InvalidArgumentException('Template does not exist!');
        }

        if ($this->_inTpl) {
            $this->_res['tpl'][$this->tpl]['tpls'][$tplIdx] =& $this->_tpls[$tplIdx];
        }

        $tpl = $this->_tpls[$tplIdx];
        $_w = $tpl['w'];
        $_h = $tpl['h'];

        if ($x == null) {
            $x = 0;
        }

        if ($y == null) {
            $y = 0;
        }

        $x += $tpl['x'];
        $y += $tpl['y'];

        $wh = $this->getTemplateSize($tplIdx, $w, $h);
        $w = $wh['w'];
        $h = $wh['h'];

        $tplData = array(
            'x' => $this->x,
            'y' => $this->y,
            'w' => $w,
            'h' => $h,
            'scaleX' => ($w / $_w),
            'scaleY' => ($h / $_h),
            'tx' => $x,
            'ty' =>  ($this->h - $y - $h),
            'lty' => ($this->h - $y - $h) - ($this->h - $_h) * ($h / $_h)
        );

        $this->_out(sprintf('q %.4F 0 0 %.4F %.4F %.4F cm',
            $tplData['scaleX'], $tplData['scaleY'], $tplData['tx'] * $this->k, $tplData['ty'] * $this->k)
        ); // Translate
        $this->_out(sprintf('%s%d Do Q', $this->tplPrefix, $tplIdx));

        $this->lastUsedTemplateData = $tplData;

        return array('w' => $w, 'h' => $h);
    }

    /**
     * Get the calculated size of a template.
     *
     * If one size is given, this method calculates the other one.
     *
     * @param int $tplIdx A valid template-id
     * @param int $w The width of the template
     * @param int $h The height of the template
     * @return array The height and width of the template (array('w' => ..., 'h' => ...))
     */
    public function getTemplateSize($tplIdx, $w = 0, $h = 0)
    {
        if (!isset($this->_tpls[$tplIdx]))
            return false;

        $tpl = $this->_tpls[$tplIdx];
        $_w = $tpl['w'];
        $_h = $tpl['h'];

        if ($w == 0 && $h == 0) {
            $w = $_w;
            $h = $_h;
        }

        if ($w == 0)
            $w = $h * $_w / $_h;
        if($h == 0)
            $h = $w * $_h / $_w;

        return array("w" => $w, "h" => $h);
    }

    /**
     * Sets the font used to print character strings.
     *
     * See FPDF/TCPDF documentation.
     *
     * @see http://fpdf.org/en/doc/setfont.htm
     * @see http://www.tcpdf.org/doc/code/classTCPDF.html#afd56e360c43553830d543323e81bc045
     */
    public function SetFont($family, $style = '', $size = null, $fontfile = '', $subset = 'default', $out = true)
    {
        if (is_subclass_of($this, 'TCPDF')) {
            $args = func_get_args();
            return call_user_func_array(array($this, 'TCPDF::SetFont'), $args);
        }

        parent::SetFont($family, $style, $size);

        $fontkey = $this->FontFamily . $this->FontStyle;

        if ($this->_inTpl) {
            $this->_res['tpl'][$this->tpl]['fonts'][$fontkey] =& $this->fonts[$fontkey];
        } else {
            $this->_res['page'][$this->page]['fonts'][$fontkey] =& $this->fonts[$fontkey];
        }
    }

    /**
     * Puts an image.
     *
     * See FPDF/TCPDF documentation.
     *
     * @see http://fpdf.org/en/doc/image.htm
     * @see http://www.tcpdf.org/doc/code/classTCPDF.html#a714c2bee7d6b39d4d6d304540c761352
     */
    public function Image(
        $file, $x = '', $y = '', $w = 0, $h = 0, $type = '', $link = '', $align = '', $resize = false,
        $dpi = 300, $palign = '', $ismask = false, $imgmask = false, $border = 0, $fitbox = false,
        $hidden = false, $fitonpage = false, $alt = false, $altimgs = array()
    )
    {
        if (is_subclass_of($this, 'TCPDF')) {
            $args = func_get_args();
            return call_user_func_array(array($this, 'TCPDF::Image'), $args);
        }

        $ret = parent::Image($file, $x, $y, $w, $h, $type, $link);
        if ($this->_inTpl) {
            $this->_res['tpl'][$this->tpl]['images'][$file] =& $this->images[$file];
        } else {
            $this->_res['page'][$this->page]['images'][$file] =& $this->images[$file];
        }

        return $ret;
    }

    /**
     * Adds a new page to the document.
     *
     * See FPDF/TCPDF documentation.
     *
     * This method cannot be used if you'd started a template.
     *
     * @see http://fpdf.org/en/doc/addpage.htm
     * @see http://www.tcpdf.org/doc/code/classTCPDF.html#a5171e20b366b74523709d84c349c1ced
     */
    public function AddPage($orientation = '', $format = '', $rotationOrKeepmargins = false, $tocpage = false)
    {
        if (is_subclass_of($this, 'TCPDF')) {
            $args = func_get_args();
            return call_user_func_array(array($this, 'TCPDF::AddPage'), $args);
        }

        if ($this->_inTpl) {
            throw new LogicException('Adding pages in templates is not possible!');
        }

        parent::AddPage($orientation, $format, $rotationOrKeepmargins);
    }

    /**
     * Puts a link on a rectangular area of the page.
     *
     * Overwritten because adding links in a template will not work.
     *
     * @see http://fpdf.org/en/doc/link.htm
     * @see http://www.tcpdf.org/doc/code/classTCPDF.html#ab87bf1826384fbfe30eb499d42f1d994
     */
    public function Link($x, $y, $w, $h, $link, $spaces = 0)
    {
        if (is_subclass_of($this, 'TCPDF')) {
            $args = func_get_args();
            return call_user_func_array(array($this, 'TCPDF::Link'), $args);
        }

        if ($this->_inTpl) {
            throw new LogicException('Using links in templates is not posible!');
        }

        parent::Link($x, $y, $w, $h, $link);
    }

    /**
     * Creates a new internal link and returns its identifier.
     *
     * Overwritten because adding links in a template will not work.
     *
     * @see http://fpdf.org/en/doc/addlink.htm
     * @see http://www.tcpdf.org/doc/code/classTCPDF.html#a749522038ed7786c3e1701435dcb891e
     */
    public function AddLink()
    {
        if (is_subclass_of($this, 'TCPDF')) {
            $args = func_get_args();
            return call_user_func_array(array($this, 'TCPDF::AddLink'), $args);
        }

        if ($this->_inTpl) {
            throw new LogicException('Adding links in templates is not possible!');
        }

        return parent::AddLink();
    }

    /**
     * Defines the page and position a link points to.
     *
     * Overwritten because adding links in a template will not work.
     *
     * @see http://fpdf.org/en/doc/setlink.htm
     * @see http://www.tcpdf.org/doc/code/classTCPDF.html#ace5be60e7857953ea5e2b89cb90df0ae
     */
    public function SetLink($link, $y = 0, $page = -1)
    {
        if (is_subclass_of($this, 'TCPDF')) {
            $args = func_get_args();
            return call_user_func_array(array($this, 'TCPDF::SetLink'), $args);
        }

        if ($this->_inTpl) {
            throw new LogicException('Setting links in templates is not possible!');
        }

        parent::SetLink($link, $y, $page);
    }

    /**
     * Writes the form XObjects to the PDF document.
     */
    protected function _putformxobjects()
    {
        $filter=($this->compress) ? '/Filter /FlateDecode ' : '';
        reset($this->_tpls);

        foreach($this->_tpls AS $tplIdx => $tpl) {
            $this->_newobj();
            $this->_tpls[$tplIdx]['n'] = $this->n;
            $this->_out('<<'.$filter.'/Type /XObject');
            $this->_out('/Subtype /Form');
            $this->_out('/FormType 1');
            $this->_out(sprintf('/BBox [%.2F %.2F %.2F %.2F]',
                // llx
                $tpl['x'] * $this->k,
                // lly
                -$tpl['y'] * $this->k,
                // urx
                ($tpl['w'] + $tpl['x']) * $this->k,
                // ury
                ($tpl['h'] - $tpl['y']) * $this->k
            ));

            if ($tpl['x'] != 0 || $tpl['y'] != 0) {
                $this->_out(sprintf('/Matrix [1 0 0 1 %.5F %.5F]',
                    -$tpl['x'] * $this->k * 2, $tpl['y'] * $this->k * 2
                ));
            }

            $this->_out('/Resources ');
            $this->_out('<</ProcSet [/PDF /Text /ImageB /ImageC /ImageI]');

            if (isset($this->_res['tpl'][$tplIdx])) {
                $res = $this->_res['tpl'][$tplIdx];
                if (isset($res['fonts']) && count($res['fonts'])) {
                    $this->_out('/Font <<');

                    foreach($res['fonts'] as $font) {
                        $this->_out('/F' . $font['i'] . ' ' . $font['n'] . ' 0 R');
                    }

                    $this->_out('>>');
                }

                if(isset($res['images']) || isset($res['tpls'])) {
                    $this->_out('/XObject <<');

                    if (isset($res['images'])) {
                        foreach($res['images'] as $image)
                            $this->_out('/I' . $image['i'] . ' ' . $image['n'] . ' 0 R');
                    }

                    if (isset($res['tpls'])) {
                        foreach($res['tpls'] as $i => $_tpl)
                            $this->_out($this->tplPrefix . $i . ' ' . $_tpl['n'] . ' 0 R');
                    }

                    $this->_out('>>');
                }
            }

            $this->_out('>>');

            $buffer = ($this->compress) ? gzcompress($tpl['buffer']) : $tpl['buffer'];
            $this->_out('/Length ' . strlen($buffer) . ' >>');
            $this->_putstream($buffer);
            $this->_out('endobj');
        }
    }

    /**
     * Output images.
     *
     * Overwritten to add {@link _putformxobjects()} after _putimages().
     */
    public function _putimages()
    {
        parent::_putimages();
        $this->_putformxobjects();
    }

    /**
     * Writes the references of XObject resources to the document.
     *
     * Overwritten to add the the templates to the XObject resource dictionary.
     */
    public function _putxobjectdict()
    {
        parent::_putxobjectdict();

        foreach($this->_tpls as $tplIdx => $tpl) {
            $this->_out(sprintf('%s%d %d 0 R', $this->tplPrefix, $tplIdx, $tpl['n']));
        }
    }

    /**
     * Writes bytes to the resulting document.
     *
     * Overwritten to delegate the data to the template buffer.
     *
     * @param string $s
     */
    public function _out($s)
    {
        if ($this->state == 2 && $this->_inTpl) {
            $this->_tpls[$this->tpl]['buffer'] .= $s . "\n";
        } else {
            parent::_out($s);
        }
    }
    
    
    ######## UFPDF 
    public function GetStringWidth($s)
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

    public function AddFont($family,$style='',$file='')
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

    public function Text($x,$y,$txt)
    {
      //Output a string
      $s=sprintf('BT %.2f %.2f Td %s Tj ET',$x*$this->k,($this->h-$y)*$this->k,$this->_escapetext($txt));
      if($this->underline and $txt!='')
        $s.=' '.$this->_dounderline($x,$y,$this->GetStringWidth($txt),$txt);
      if($this->ColorFlag)
        $s='q '.$this->TextColor.' '.$s.' Q';
      $this->_out($s);
    }

    public function AcceptPageBreak()
    {
      //Accept automatic page break or not
      return $this->AutoPageBreak;
    }

    public function Cell($w,$h=0,$txt='',$border=0,$ln=0,$align='',$fill=0,$link='')
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

    public function _puttruetypeunicode($font) {
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

public function _dounderline($x, $y, $txt)
{
	// Underline text
	$up = $this->CurrentFont['up'];
	$ut = $this->CurrentFont['ut'];
	$w = $this->GetStringWidth($txt)+$this->ws*substr_count($txt,' ');
	return sprintf('%.2F %.2F %.2F %.2F re f',$x*$this->k,($this->h-($y-$up/1000*$this->FontSize))*$this->k,$w*$this->k,-$ut/1000*$this->FontSizePt);
}

   public function _textstring($s)
    {
      //Convert to UTF-16BE
      $s = $this->utf8_to_utf16be($s);
      //Escape necessary characters
      return '('. strtr($s, array(')' => '\\)', '(' => '\\(', '\\' => '\\\\')) .')';
    }

   public function _escapetext($s)
    {
      //Convert to UTF-16BE
      $s = $this->utf8_to_utf16be($s, false);
      //Escape necessary characters
      return '('. strtr($s, array(')' => '\\)', '(' => '\\(', '\\' => '\\\\')) .')';
    }

   public function _putinfo()
    {
        $this->_out('/Producer '.$this->_textstring('UFPDF '. 'UFPDF_VERSION'));
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
   public function utf8_to_utf16be(&$txt, $bom = true) {
      $l = strlen($txt);
      $out = $bom ? "\xFE\xFF" : '';
      for ($i = 0; $i < $l; ++$i) {
        $c = ord($txt[$i]);
        // ASCII
        if ($c < 0x80) {
          $out .= "\x00". $txt[$i];
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
            while (ord($txt[$i + 1]) >= 0x80 && ord($txt[$i + 1]) < 0xC0) { ++$i; }
            continue;
          }
          
          $q = array($c);
          // Fetch rest of sequence
          while (ord($txt[$i + 1]) >= 0x80 && ord($txt[$i + 1]) < 0xC0) { ++$i; $q[] = ord($txt[$i]); }
          
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
                continue 2;

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
                continue 2;

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
                continue 2;
          }
        }
      }
      return $out;
    }

    // UTF-8 to codepoint array conversion.
    // Correctly handles all illegal UTF-8 sequences.
    public function utf8_to_codepoints(&$txt) {
      $l = strlen($txt);
      $out = array();
      for ($i = 0; $i < $l; ++$i) {
        $c = ord($txt[$i]);
        // ASCII
        if ($c < 0x80) {
          $out[] = ord($txt[$i]);
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
            while (ord($txt[$i + 1]) >= 0x80 && ord($txt[$i + 1]) < 0xC0) { ++$i; }
            continue;
          }
          
          $q = array($c);
          // Fetch rest of sequence
          while (ord($txt[$i + 1]) >= 0x80 && ord($txt[$i + 1]) < 0xC0) { ++$i; $q[] = ord($txt[$i]); }
          
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
                continue 2;

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
                continue 2;

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
                continue 2;
          }
        }
      }
      return $out;
    }
    
}
