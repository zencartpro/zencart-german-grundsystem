<?php
/**
 * Zen Cart German Specific (zencartpro adaptations)
 * Note: Since MobileDetect 3.74 the namespace is $detect = new \Detection\MobileDetect;
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: zca_responsive_functions.php 2022-12-04 18:14:39Z webchills $
 */

function layoutTypes()
{
    return array('default', 'mobile', 'tablet', 'full');
}

function initLayoutType()
{
    // Safety check.
    if (!class_exists('MobileDetect')) { return 'default'; }

    $detect = new \Detection\MobileDetect;
    $isMobile = $detect->isMobile();
    $isTablet = $detect->isTablet();

    $layoutTypes = layoutTypes();

    if ( isset($_GET['layoutType']) ) {
        $layoutType = $_GET['layoutType'];
    } else {
        if (empty($_SESSION['layoutType'])) {
            $layoutType = ($isMobile ? ($isTablet ? 'tablet' : 'mobile') : 'default');
        } else {
            $layoutType =  $_SESSION['layoutType'];
        }
    }

    if ( !in_array($layoutType, $layoutTypes) ) { 
        $layoutType = 'default'; 
    }

    $_SESSION['layoutType'] = $layoutType;

    return $layoutType;
}

$layoutType = initLayoutType();
