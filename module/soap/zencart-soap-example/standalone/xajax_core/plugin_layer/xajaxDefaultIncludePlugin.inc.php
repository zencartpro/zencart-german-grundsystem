<?php
/**
 * xajaxDefaultIncludePlugin.inc.php :: xajax default script include plugin
 * class
 *
 * xajax version 0.5 (Beta 2)
 * copyright (c) 2006 by Jared White & J. Max Wilson
 * http://www.xajaxproject.org
 *
 * xajax is an open source PHP class library for easily creating powerful
 * PHP-driven, web-based Ajax Applications. Using xajax, you can asynchronously
 * call PHP functions and update the content of your your webpage without
 * reloading the page.
 *
 * xajax is released under the terms of the BSD license
 * http://www.xajaxproject.org/bsd_license.txt
 * 
 * @package xajax
 * @version $Id$
 * @copyright Copyright (c) 2005-2006 by Jared White & J. Max Wilson
 * @license http://www.xajaxproject.org/bsd_license.txt BSD License
 */
 
 class xajaxDefaultIncludePlugin extends xajaxIncludePlugin
 {
 	function getJavascript($sJsURI='', $aJsFiles=array())
 	{
		$html = $this->getJavascriptConfig();
		$html .= $this->getJavascriptInclude($sJsURI, $aJsFiles);
 		
		return $html;
 	}
 	
 	function getJavascriptConfig()
 	{
		$html  = "\n\t\t<script type=\"text/javascript\">\n";
		$html .= "\t\t/* <![CDATA[ */\n";
		$html .= "\t\txajax = {};\n";
		$html .= "\t\txajax.config = {};\n";
		$html .= "\t\txajax.config.requestURI = '".$this->_objXajax->getRequestURI()."';\n";
		$html .= "\t\txajax.config.statusMessages =  ".($this->_objXajax->getFlag('statusMessages')?'true':'false').";\n";
		$html .= "\t\txajax.config.waitCursor = ".($this->_objXajax->getFlag('waitCursor')?'true':'false').";\n";
		$html .= "\t\txajax.config.version = '".$this->_objXajax->getVersion()."';\n";
		$html .= "\t\txajax.config.legacy = ".(is_a($this->_objXajax, 'legacyXajax')?'true':'false').";\n";
		$html .= "\n";

		foreach(array_keys($this->_aFunctions) as $sFunction) {
			$html .= $this->_wrap($sFunction);
		}

		$html .= "\t\t/* ]]> */\n";
		$html .= "\t\t</script>\n";
		return $html;		
 	}
 	
 	function getJavascriptInclude($sJsURI="", $aJsFiles=array())
 	{
 		if (0 == count($aJsFiles)) {
 			$aJsFiles[] = array($this->_getScriptFilename('xajax_js/xajax_core.js'), 'xajax');
			
			if (is_a($this->_objXajax, 'legacyXajax'))
				$aJsFiles[] = array($this->_getScriptFilename('xajax_js/xajax_legacy.js'), 'xajax.legacy');
			// NOTE: add optional components here
			// load plugins here as well?
 			
			// NOTE: debug should always be last, because it needs
			// to hook all other functions (to catch exceptions)
			if (true === $this->_objXajax->getFlag('debug'))
 				$aJsFiles[] = array($this->_getScriptFilename('xajax_js/xajax_debug.js'), 'xajax.debug');
 		}
		
		if ($sJsURI != '' && substr($sJsURI, -1) != '/') 
			$sJsURI .= '/';
		
		$html = '';
		foreach ($aJsFiles as $aJsFile) {
			$html .= "\t\t<script type=\"text/javascript\" src=\"" . $sJsURI . $aJsFile[0] . "\"></script>\n";
			if ($this->_objXajax->getTimeout())
			{
				$html .= "\t\t<script type=\"text/javascript\">\n";
				$html .= "\t\t/* <![CDATA[ */\n";
				$html .= "\t\twindow.setTimeout(\n";
				$html .= "\t\t function () {\n";
				$html .= "\t\t  var scriptExists = false;\n";
				$html .= "\t\t  try { if (".$aJsFile[1].".isLoaded) scriptExists = true; }\n";
				$html .= "\t\t  catch (e) {}\n";
				$html .= "\t\t  if (!scriptExists) {\n";
				$html .= "\t\t   alert('Error: the ".$aJsFile[1]." Javascript component could not be included. Perhaps the URL is incorrect?\\nURL: {$sJsURI}{$aJsFile[0]}');\n";
				$html .= "\t\t  }\n";
				$html .= "\t\t },\n\t\t";
				$html .= $this->_objXajax->getTimeout();
				$html .= "\n\t\t);\n";
				$html .= "\t\t/* ]]> */\n";
				$html .= "\t\t</script>\n";
			}
		}
		return $html;
 	}
 	
 	function _wrap($sFunction)
	{
		$js = 'function ';
		$js .= $this->_objXajax->getWrapperPrefix();
		$js .= $sFunction;
		$js .= '(){return xajax.call("';
		$js .= $sFunction;
		if (is_a($this->_objXajax, 'legacyXajax'))
			$js .= '", arguments);}';
		else
			$js .= '", {parameters: arguments});}';
		$js .= "\n";
		return $js;
	}
	
	function _getScriptFilename($sFilename)
	{
		if ($this->_objXajax->getFlag('useUncompressedScripts')) {
			return str_replace('.js', '_uncompressed.js', $sFilename);	
		}
		return $sFilename;
	}
}