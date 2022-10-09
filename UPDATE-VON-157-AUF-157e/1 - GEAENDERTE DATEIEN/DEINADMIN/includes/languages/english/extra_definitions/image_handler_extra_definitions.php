<?php
define('BOX_TOOLS_IMAGE_HANDLER', 'Image Handler<sup>5</sup>');
define('BOX_TOOLS_IMAGE_HANDLER_VIEW_CONFIG', 'View Image Handler<sup>5</sup> Configuration');
// -----
// Messages issued by /admin/includes/init_includes/init_image_handler.php
//
define('IH_TEXT_MESSAGE_INSTALLED', 'Image Handler<sup>5</sup>, v%s was successfully installed.');
define('IH_TEXT_MESSAGE_UPDATED', 'Image Handler<sup>5</sup> was successfully updated from v%1$s to v%2$s.');

// -----
// The image-title text for the button in the Categories->Products listing.  Also used by /admin/image_handler.php
//
define('ICON_IMAGE_HANDLER', 'Image Handler ' . (defined('IH_VERSION') ? IH_VERSION : ''));