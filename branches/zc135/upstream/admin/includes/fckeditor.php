<?php
/**
 * @package htmleditors
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: fckeditor.php 4245 2006-08-24 14:07:50Z drbyte $
 */

/**
 * Customizations for Zen Cart based on FCKeditor v2.3.1
 */

class FCKeditor
{
	var $InstanceName ;
	var $BasePath ;
	var $Width ;
	var $Height ;
	var $ToolbarSet ;
	var $Value ;
	var $Config ;

	// PHP 5 Constructor (by Marcus Bointon <coolbru@users.sourceforge.net>)
	function __construct( $instanceName )
	{
		$this->InstanceName	= $instanceName ;
		$this->BasePath = DIR_WS_CATALOG.'editors/fckeditor/' ;
		$this->Width		= '100%' ;
		$this->Height		= '250' ;
		$this->ToolbarSet	= 'Default' ;  // 'Default'/blank or "Basic"
		$this->Value = '' ;           // default text
    $this->EditorAreaCSS = DIR_WS_CATALOG . 'includes/templates/template_default/css/stylesheet.css';
    $this->AutoDetectLanguage = true ;
    $this->DefaultLanguage    = strtolower($_SESSION['languages_code']);

//		$this->CanUpload = 'true' ;   // true or none
//		$this->CanBrowse = 'true' ;   // true or none

		$this->Config		= array() ;
	}
	
	// PHP 4 Contructor
	function FCKeditor( $instanceName )
	{
		$this->__construct( $instanceName ) ;
	}
	
	function Create()
	{
		echo $this->CreateHtml() ;
	}

	function CreateHtml()
	{
		$HtmlValue = htmlspecialchars( $this->Value ) ;

		$Html = '<div>' ;
		
		if ( $this->IsCompatible() )
		{
			if ( isset( $_GET['fcksource'] ) && $_GET['fcksource'] == "true" )
				$File = 'fckeditor.original.html' ;
			else
				$File = 'fckeditor.html' ;

			$Link = "{$this->BasePath}editor/{$File}?InstanceName={$this->InstanceName}" ;

			if ( $this->ToolbarSet != '' )
				$Link .= "&amp;Toolbar={$this->ToolbarSet}" ;

			// Render the linked hidden field.
			$Html .= "<input type=\"hidden\" id=\"{$this->InstanceName}\" name=\"{$this->InstanceName}\" value=\"{$HtmlValue}\" style=\"display:none\" />" ;

			// Render the configurations hidden field.
			$Html .= "<input type=\"hidden\" id=\"{$this->InstanceName}___Config\" value=\"" . $this->GetConfigFieldString() . "\" style=\"display:none\" />" ;

			// Render the editor IFRAME.
			$Html .= "<iframe id=\"{$this->InstanceName}___Frame\" src=\"{$Link}\" width=\"{$this->Width}\" height=\"{$this->Height}\" frameborder=\"0\" scrolling=\"no\"></iframe>" ;
		}
		else
			{
			if ( strpos( $this->Width, '%' ) === false )
				$WidthCSS = $this->Width . 'px' ;
				else
				$WidthCSS = $this->Width ;

			if ( strpos( $this->Height, '%' ) === false )
				$HeightCSS = $this->Height . 'px' ;
				else
				$HeightCSS = $this->Height ;

			$Html .= "<textarea name=\"{$this->InstanceName}\" rows=\"4\" cols=\"40\" style=\"width: {$WidthCSS}; height: {$HeightCSS}\">{$HtmlValue}</textarea>" ;
			}

		$Html .= '</div>' ;
		
		return $Html ;
		}

	function IsCompatible()
	{
		global $HTTP_USER_AGENT ;

		if ( isset( $HTTP_USER_AGENT ) )
			$sAgent = $HTTP_USER_AGENT ;
		else
			$sAgent = $_SERVER['HTTP_USER_AGENT'] ;

		if ( strpos($sAgent, 'MSIE') !== false && strpos($sAgent, 'mac') === false && strpos($sAgent, 'Opera') === false )
		{
			$iVersion = (float)substr($sAgent, strpos($sAgent, 'MSIE') + 5, 3) ;
			return ($iVersion >= 5.5) ;
		}
		else if ( strpos($sAgent, 'Gecko/') !== false )
		{
			$iVersion = (int)substr($sAgent, strpos($sAgent, 'Gecko/') + 6, 8) ;
			return ($iVersion >= 20030210) ;
		}
		else
			return false ;
	}
	
	function GetConfigFieldString()
	{
		$sParams = '' ;
		$bFirst = true ;

		foreach ( $this->Config as $sKey => $sValue )
		{
			if ( $bFirst == false )
				$sParams .= '&amp;' ;
			else
				$bFirst = false ;
			
			if ( $sValue === true )
				$sParams .= $this->EncodeConfig( $sKey ) . '=true' ;
			else if ( $sValue === false )
				$sParams .= $this->EncodeConfig( $sKey ) . '=false' ;
			else
				$sParams .= $this->EncodeConfig( $sKey ) . '=' . $this->EncodeConfig( $sValue ) ;
		}
		
		return $sParams ;
		}

	function EncodeConfig( $valueToEncode )
	{
		$chars = array( 
			'&' => '%26', 
			'=' => '%3D', 
			'"' => '%22' ) ;

		return strtr( $valueToEncode,  $chars ) ;
	}
}
?>