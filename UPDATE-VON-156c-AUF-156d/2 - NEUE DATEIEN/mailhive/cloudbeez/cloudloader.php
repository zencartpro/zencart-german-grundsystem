<?php

// add version information for deployment
class mailbeez_installer_dummy
{
    function __construct()
    {
        $this->version = 4.01; // float value
        
    }
}
$version = new mailbeez_installer_dummy();

// Version
define('CLOUDBEEZ_MAILBEEZ_INSTALLER_VERSION', $version->version);