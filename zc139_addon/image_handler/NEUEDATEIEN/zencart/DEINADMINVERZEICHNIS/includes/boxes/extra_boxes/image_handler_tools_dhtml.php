<?php
/**
 * image_handler_tools_dhtml.php
 * call to include IH2 link in admin->tools
 *
 * @author  Tim Kroeger (original author)
 * @copyright Copyright 2005-2006
 * @license http://www.gnu.org/licenses/gpl.txt GNU General Public License V2.0
 * @version $Id: image_handler_tools_dhtml.php,v 2.0 Rev 8 2010-05-31 23:46:5 DerManoMann Exp $
 * Last modified by DerManoMann 2010-05-31 23:46:50 
 */

  $za_contents[] = array('text' => BOX_TOOLS_IMAGE_HANDLER, 'link' => zen_href_link(FILENAME_IMAGE_HANDLER, '', 'NONSSL'));
