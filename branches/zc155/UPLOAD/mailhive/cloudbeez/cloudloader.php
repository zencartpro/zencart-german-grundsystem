<?php

// add version information for deployment
class mailbeez_installer_dummy
{
    function mailbeez_installer_dummy()
    {
        $this->version = 3.50; // float value
    }
}
$version = new mailbeez_installer_dummy();

// Version
define('CLOUDBEEZ_MAILBEEZ_INSTALLER_VERSION', $version->version);