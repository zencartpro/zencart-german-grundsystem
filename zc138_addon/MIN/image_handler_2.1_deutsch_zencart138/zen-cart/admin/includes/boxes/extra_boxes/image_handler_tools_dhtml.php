<?php
/**
 * image_handler_tools_dhtml.php
 * call to include IH2 link in admin->tools
 *
 * @author  Tim Kroeger <tim@breakmyzencart.com>
 * @copyright Copyright 2005-2006 breakmyzencart.com
 * @license http://www.gnu.org/licenses/gpl.txt GNU General Public License V2.0
 * @version $Id: image_handler_tools_dhtml.php,v 1.1 2006/04/11 22:00:55 tim Exp $
 */

  $za_contents[] = array('text' => BOX_TOOLS_IMAGE_HANDLER, 'link' => zen_href_link(FILENAME_IMAGE_HANDLER, '', 'NONSSL'));
