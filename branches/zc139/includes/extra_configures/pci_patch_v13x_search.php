<?php
/** 
 * PCI Scan patch for search issues showing database error messages
 * 
 * @package initSystem
 * @copyright Copyright 2003-2009 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id$
 */

if (isset($_GET['keyword']) && $_GET['keyword'] != '')
{
  $count =  substr_count($_GET['keyword'], '"');
  if ($count == 1)
  {
    if(substr(stripslashes(trim($_GET['keyword'])), 0, 1) == '"')
    {
      $_GET['keyword'] .= '"';
    }
  }
  $_GET['keyword'] = stripslashes($_GET['keyword']);
}

if (isset($_GET['sort']) && strlen($_GET['sort']) > 3) {
  $_GET['sort'] = substr($_GET['sort'], 0, 3);
}