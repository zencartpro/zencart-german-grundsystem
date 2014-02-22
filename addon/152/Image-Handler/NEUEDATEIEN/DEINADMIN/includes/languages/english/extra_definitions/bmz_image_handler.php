<?php
/**
 * bmz_image_handler.php
 * english language definitions for image handler
 *
 * @author  Tim Kroeger (original author)
 * @copyright Copyright 2005-2006
 * @license http://www.gnu.org/licenses/gpl.txt GNU General Public License V2.0
 * @version $Id: bmz_image_handler.php,v 2.0 Rev 8 2010-05-31 23:46:5 DerManoMann Exp $
 * Last modified by webchills 2014-02-22 17:46:50 
 */

define('BOX_TOOLS_IMAGE_HANDLER', 'Image Handler<sup>4</sup>');
define('ICON_IMAGE_HANDLER','Image Handler 4.3.3');
define('IH_VERSION_VERSION', 'Version');
define('IH_VERSION_NOT_FOUND', 'No Image Handler information found.');
define('IH_REMOVE', 'Uninstall Image Handler.  (Please backup your site and database first)');
define('IH_CONFIRM_REMOVE', 'Are you sure? ');
define('IH_REMOVED', 'Image Handler successfully removed.');
define('IH_UPDATE', 'Update Image Handler');
define('IH_UPDATED', 'Image Handler successfully updated.');
define('IH_INSTALL', 'Install Image Handler');
define('IH_INSTALLED', 'Image Handler successfully installed.');
define('IH_SCAN_FOR_ORIGINALS', 'Scan for old IH 0.x and 1.x <em>original</em> images');
define('IH_CONFIRM_IMPORT', 'Do you really want to import the listed images?<br /><strong>Backup your Database and images folder first!</strong>');
define('IH_NO_ORIGINALS', 'No old IH 0.x or 1.x original images found');
define('IH_IMAGES_IMPORTED', 'Successfully imported images.');
define('IH_CLEAR_CACHE', 'Clear image cache');
define('IH_CACHE_CLEARED', 'Image cache cleared.');

define('IH_SOURCE_TYPE', 'Source imagetype');
define('IH_SOURCE_IMAGE', 'Source image');
define('IH_SMALL_IMAGE', 'Default image');
define('IH_MEDIUM_IMAGE', 'Products image');

define('IH_ADD_NEW_IMAGE', 'Add a new image');
define('IH_NEW_NAME_DISCARD_IMAGES', 'Use new name, discard additional images');
define('IH_NEW_NAME_COPY_IMAGES', 'Use new name, copy additional images');
define('IH_KEEP_NAME', 'Keep old name and additional images');
define('IH_DELETE_FROM_DB_ONLY', 'Delete image reference from database only');

define('IH_HEADING_TITLE', 'Image Handler<sup>4</sup>');
define('IH_HEADING_TITLE_PRODUCT_SELECT','Please select a product to manage the images.');

define('TABLE_HEADING_PHOTO_NAME', 'Image name');
define('TABLE_HEADING_DEFAULT_SIZE','Default size');
define('TABLE_HEADING_MEDIUM_SIZE', 'Medium size');
define('TABLE_HEADING_LARGE_SIZE','Large size');
define('TABLE_HEADING_ACTION', 'Action');
define('TABLE_HEADING_FILETYPE', 'File Type');

define('TEXT_PRODUCT_INFO', 'Product');
define('TEXT_PRODUCTS_MODEL', 'Model');
define('TEXT_IMAGE_BASE_DIR', 'Base directory');
define('TEXT_NO_PRODUCT_IMAGES', 'There are no images for this product');
define('TEXT_CLICK_TO_ENLARGE', 'Click to enlarge');
define('TEXT_PRICED_BY_ATTRIBUTES', 'Priced by attributes');
 
define('TEXT_INFO_IMAGE_INFO', 'Image information');
define('TEXT_INFO_NAME', 'Name');
define('TEXT_INFO_FILE_TYPE', 'File type');
define('TEXT_INFO_EDIT_PHOTO', 'Edit image');
define('TEXT_INFO_NEW_PHOTO', 'New image');
define('TEXT_INFO_IMAGE_BASE_NAME', 'Image base name (optional)');
define('TEXT_INFO_AUTOMATIC_FROM_DEFAULT', ' Automatic (from default image name)');
define('TEXT_INFO_MAIN_DIR', 'Main directory');
define('TEXT_INFO_BASE_DIR', 'Base image directory');
define('TEXT_INFO_NEW_DIR', 'Select or define a new directory for the images.');
define('TEXT_INFO_IMAGE_DIR', 'Image directory');
define('TEXT_INFO_OR', 'or');
define('TEXT_INFO_AUTOMATIC', 'Automatic');
define('TEXT_INFO_IMAGE_SUFFIX', 'Image suffix (optional)');
define('TEXT_INFO_USE_AUTO_SUFFIX','Enter a specific suffix or leave empty for automatic suffix generation.');
define('TEXT_INFO_DEFAULT_IMAGE', 'Default image file');
define('TEXT_INFO_DEFAULT_IMAGE_HELP', 'A default image must be defined. The default image is assumed to be the smallest when medium or large images are entered.');
define('TEXT_INFO_CONFIRM_DELETE', "Confirm delete");
define('TEXT_INFO_CONFIRM_DELETE_SURE', 'Are you sure you want to delete this image and all its sizes?');
define('TEXT_INFO_SELECT_ACTION', 'Select action');
define('TEXT_INFO_CLICK_TO_ADD', 'Click to add a new image to this product');

define('TEXT_MSG_AUTO_BASE_ERROR', 'Automatic base select without default file.');
define('TEXT_MSG_INVALID_BASE_ERROR', 'Invalid image base name, or unable to find default image.');
define('TEXT_MSG_AUTO_REPLACE',  'Automatically replacing bad characters in base name, new name: ');
define('TEXT_MSG_INVALID_SUFFIX', 'Invalid image suffix.');
define('TEXT_MSG_IMAGE_TYPES_NOT_SAME_ERROR', 'Image types are not the same.');
define('TEXT_MSG_DEFAULT_REQUIRED_FOR_RESIZE', 'A default image is required for automatic resizing.');
define('TEXT_MSG_NO_DEFAULT', 'No default image has been specified.');
define('TEXT_MSG_FILE_EXISTS', 'File exists! Please alter the base name or suffix.');
define('TEXT_MSG_INVALID_SQL', "Unable to complete SQL query.");
define('TEXT_MSG_NOCREATE_IMAGE_DIR', "Unable to create image directory.");
define('TEXT_MSG_NOCREATE_MEDIUM_IMAGE_DIR', "Unable to create medium image directory.");
define('TEXT_MSG_NOCREATE_LARGE_IMAGE_DIR', "Unable to create large image directory.");
define('TEXT_MSG_NOPERMS_IMAGE_DIR', "Unable to set the permissions of the image directory.");
define('TEXT_MSG_NOPERMS_MEDIUM_IMAGE_DIR', "Unable to set the permissions of the medium image directory.");
define('TEXT_MSG_NOPERMS_LARGE_IMAGE_DIR', "Unable to set the permissions of the large image directory.");

define('TEXT_MSG_NOUPLOAD_DEFAULT', "Unable to upload default image file.");
define('TEXT_MSG_NORESIZE', "Unable to resize image");
define('TEXT_MSG_NOCOPY_LARGE', "Unable to copy large image file.");
define('TEXT_MSG_NOCOPY_MEDIUM', "Unable to copy medium image file.");
define('TEXT_MSG_NOCOPY_DEFAULT', "Unable to copy default image file.");
define('TEXT_MSG_NOPERMS_LARGE', "Unable to set permissions of large image file.");
define('TEXT_MSG_NOPERMS_MEDIUM', "Unable to set permissions of medium image file.");
define('TEXT_MSG_NOPERMS_DEFAULT', "Unable to set permissions of default image file.");
define('TEXT_MSG_IMAGE_SAVED', 'Image successfully saved.');
define('TEXT_MSG_LARGE_DELETED', 'Large image deleted.');
define('TEXT_MSG_NO_DELETE_LARGE', 'Unable to delete large image.');
define('TEXT_MSG_MEDIUM_DELETED', 'Medium image deleted.');
define('TEXT_MSG_NO_DELETE_MEDIUM', 'Unable to delete medium image.');
define('TEXT_MSG_DEFAULT_DELETED', 'Default image deleted.');
define('TEXT_MSG_NO_DELETE_DEFAULT', 'Unable to delete default image.');
define('TEXT_MSG_NO_DEFAULT_FILE_FOUND', "No default image found for delete.");

define('TEXT_MSG_IMAGE_DELETED', 'Image successfully deleted.');
define('TEXT_MSG_IMAGE_NOT_FOUND', 'Unable to locate image.');
define('TEXT_MSG_IMAGE_NOT_DELETED', 'Unable to delete image.');

define('TEXT_MSG_IMPORT_SUCCESS', 'Import successful: ');
define('TEXT_MSG_IMPORT_FAILURE', 'Import failure: ');

// image manager
define('IH_IMAGE_NEW_FILE', 'Click to add a new image to this product');
define('IH_IMAGE_EDIT', 'Click to edit this image');
define('TEXT_MEDIUM_FILE_IMAGE', 'Medium image file (optional)');
define('TEXT_LARGE_FILE_IMAGE', 'Large image file (optional)');

// ih menu

define('IH_MENU_MANAGER', 'Image Manager');
define('IH_MENU_ADMIN', 'Admin Tools');
define('IH_MENU_ABOUT', 'About/Help');
define('IH_MENU_PREVIEW', 'Preview');

// message stack messages

define('IH_MS_ALL_EXIST','Image Handler files all exist in correct positions in the directory structure.');
define('IH_MS_ABORTED','********** Installation has been aborted. **********');
define('IH_MS_SOME_FILES_MISSING','Some Image Handler files do not exist. Perhaps you have uploaded them incorrectly? Or the permissions are set incorrectly?');
define('IH_MS_TEMPLATE_NOTFOUND','Image Handler is having some problems finding your current template.');
define('IH_MS_MISSING_OR_UNREADABLE','Missing or unreadable file:');
define('IH_MS_OVERWRITTEN','was overwritten. A back up copy was saved.');
define('IH_MS_NOT_OVERWRITTEN','was NOT overwritten.');
define('IH_MS_CREATED','was created. A back up copy of any overwritten file was saved.');
define('IH_MS_NOT_CREATED','was NOT created.');
define('IH_MS_SUCCESS','Image Handler has been successfully installed');
define('IH_MS_ROLLBACK_OK','was returned to default version.');
define('IH_MS_ROLLBACK_NOT_OK','was NOT rolled back.');
define('IH_MS_UNINSTALL_OK','Image Handler has been uninstalled.');
define('IH_MS_BACKUP_INFO','Image Handler creates back up versions of certain files when it is installed before overwriting them. These files have been left in position for reference. They may be deleted but will not effect the functioning of the shop if you leave them in place.');
define('IH_MS_AUTOLOADER_NOTDELETED','The auto-loader YOURADMIN/includes/auto_loaders/config.image_handler.php has not been deleted. For Image Handler to work you must delete this file manually.');

// documentation

define('IH_ABOUT_DOKU','<h2>Image Handler<sup>4</sup> v4.3.2 for v1.5.1</h2>

<p>
Image Handler<sup>4</sup> v4.3.2 for v1.5.1 is based on an original contribution by Tim Kr&#246;ger.<br /></p>
<fieldset>
<legend>Purpose &amp; Aim</legend>
<p>Image Handler<sup>4</sup> at the heart of it\'s code is really meant to ease the management of product images (particularly the management of additional product images), and to help improve page performance by
  optimizing the product images.</p>
<p>Image Handler<sup>4</sup> generates product images (based on your image settings) in the Image Handler<sup>4</sup> bmz_cache folder. It <strong>DOES NOT</strong> replace or modify the original images. So it\'s PERFECTLY safe to use on an existing store.</p>
<p> Image Handler<sup>4</sup> enables you to use GD libraries or ImageMagick (if   installed on your server) to generate and resize small, medium and large   images on the fly on page request. You can simply upload just one image   or you can have different sources for medium and large images. Image Handler<sup>4</sup> further enables you to watermark your images (overlay a second   specific translucent image) and have medium or large images pop up when you move   your mouse over a small image (fancy hover).</p>
<p> This contribution includes a powerful admin interface to browse your   products just like you would with the Attribute Manager and upload /   delete / add additional images without having to do this manually via <acronym title="File Transfer Protocol">FTP</acronym>. Image Handler<sup>4</sup> works fine with mass update utilities like EzPopulate. </p>
</fieldset>
<hr>
<fieldset>
<legend>Features</legend>
<ul>
  <li>Improve site performance (faster loading, faster display)</li>
  <li>Professional looking images (no stair-effects, smooth edges)</li>
  <li>Choose preferred image-types for each image size</li>
  <li>Uploading one image automatically creates small, medium and large images on page request</li>
  <li>Drops in and out seamlessly. No need to redo your images. All images are kept.</li>
  <li>Easy install. One-click-database-upgrade.</li>
  <li>Works with mass-update/-upload tools like EzPopulate.</li>
  <li>Watermark images to prevent competitors from stealing them.</li>
  <li>Fancy image hover functionality lets a larger image pop up whenever you move your mouse above a small image (switchable).</li>
  <li>Choose an image background color matching to match you site\'s color or select a transparent background for your images.</li>
  <li>Manage your multiple images for products easily from one page just like you do with attributes in the Products Attribute Manager.</li>
</ul>
<p>Image Handler<sup>4</sup> is meant to ease the work required to setup images for your store.   It works WITH default Zen Cart functionality, it does not replace it. </p>
<p>It is very strongly recommend you read through the ENTIRE "<strong>Configuration</strong>" &amp; "<strong>Usage</strong>" sections of the Image Handler<sup>4</sup> readme file. There you will find out exactly what <strong>Image Handler<sup>4</sup></strong> can do.</p>
</fieldset>

<hr>

<fieldset>
<legend>Troubleshooting Basics</legend>
<p>Make sure your custom template is active. (Admin &gt; Tools &gt; Template Selection)</p>
<p>Make sure Image Handler<sup>4</sup> is installed. <strong>Admin
&gt; Tools &gt; Image Handler<sup>4</sup> &gt; Admin</strong>.
Set permissions in both your <strong>images</strong> and <strong>bmz_cache</strong> folders to 755 (eg: <strong>both </strong>of these folders need
to have  the same permissions. For some webhosts you may have to set these permissions
to 777).</p>
<p>If Image Handler<sup>4</sup> does not work or gives you errors:</p>
<ul>
  <li>Make sure all files are in correct location</li>
  <li>Make sure you uploaded ALL the Image Handler<sup>4</sup> files
  </li>
  <li>Make sure the files are not corrupt from bad FTP transfers</li>
  <li>Make sure your file merge edits are correct</li>
  <li>MAKE SURE YOU RE-READ THE CONFIGURATION AND USAGE SECTIONS!!!</li>
  <li>Make sure that there are no javascript conflicts (this last point has been largely addressed since Rev 7)</li>
  <li>Make sure that your main product image files names DO NOT contain any special characters (<font>non-alphanumeric characters such as / \ :
! @ # $ % ^ &lt; &gt; , [ ] { } &amp; * ( ) + = </font>). Always use
proper filenaming practices when naming your images - See this document as a reference: <small><a href="http://www.records.ncdcr.gov/erecords/filenaming_20080508_final.pdf" target="_blank">http://www.records.ncdcr.gov/erecords/filenaming_20080508_final.pdf\</a></small></li>
</ul>
</fieldset>

<hr>

<fieldset>
<legend>Zen Cart and Image Management</legend>
<p>Image Handler<sup>4</sup> is meant to ease the work required to setup images for your store..   It works WITH default Zen Cart functionality, it does not replace it..   Here\'s some additional FAQs which discuss how product images work in Zen   Cart.</p>
<ul>
  <li><a href="http://tutorials.zen-cart.com/index.php?article=224" target="_blank">Image Preparation - How-to</a></li>
  <li><a href="http://tutorials.zen-cart.com/index.php?article=30" target="_blank">My images are distorted/fuzzy/squished, help?</a><br>
  </li>
</ul>
<p>Information on how Zen Cart   identifies/manages additional product images can be found on these Zen Cart FAQs:</p>
<ul>
  <li><a href="http://tutorials.zen-cart.com/index.php?article=315" target="_blank">Why am I seeing images for other products on my product pages?</a></li>
  <li><a href="http://tutorials.zen-cart.com/index.php?article=58" target="_blank">How do I add multiple images to a product?</a></li>
  <li><a href="http://tutorials.zen-cart.com/index.php?article=202" target="_blank">How   do I add more than one image of a product?  I want to have a main image   and also one or two other images that show more parts of a particular   product. How/where do I add additional images to a product page?    Thanks!</a></li>
</ul>
<p>Check out these FAQs and see if they help clarify how Zen Cart works with product images.</p>
</fieldset>

<hr>

<fieldset>
<legend> Prepare Your Site for Growth</legend>
<p>Not many users are aware that Image Handler<sup>4</sup> can manage the needs of a very large site as easily as it does a small one. When first building a site, the owner of a small site needs only to load images to the images folder. But when the site gets bigger and images multiply like rabbits, this can cause file naming confusions for Zen Cart and slow down the site. Preparing for your business to grow from the beginning will save you hours of work later on!</p>
<p>Without Image Handler<sup>4</sup> installed, Zen Cart requires you to create, optimize, and upload three different size images for each image you want to use. You must name these images using naming suffixes, and place them in corresponding folders inside your main image folder. For example: A product called &quot;Widget&quot; requires images/widget.jpg (small image) images/medium/widget_MED.jpg (medium image) and images/large/widget_LRG.jpg. This is such a hassle, especially if many of your products have multiple images. And as your site grows, it becomes an impossible task!</p>
<p>With Image Handler<sup>4</sup>, you no longer have to make three sizes of the same images and place them in different folders (unless you want to)! Instead, you need upload only one image in one folder and Image Handler<sup>4</sup> will do the rest! Simply upload your largest highest quality image and Image Handler<sup>4</sup> will resize and optimize your image as needed, and serve up small, medium, or large image sizes appropriate to the page loaded - all automatically and all without actually modifying your original image file in any way! Check out the Configuration Tab of this ReadMe for more info about this awesome functionality!</p>
<p>Prepare your site for growth by simply creating sub-folders in your main images folder. For example, you may want to put all your &quot;widget&quot; images in a folder called &quot;widgets&quot; and all your doodad images in a folder called &quot;doodads&quot; , like this:<br>
</p>
<p>Product: Blue Widget with 3 images<br>
  ---------------------------------- <br>
  /images/widgets/blue_widget1.jpg (main product image for a blue widget, i.e. front view)<br>
  /images/widgets/blue_widget2.jpg (additional product image for a blue widget, i.e. side view)<br>
  /images/widgets/blue_widget3.jpg (additional product image for a blue widdget, i.e. rear view)</p>
<p>&nbsp;</p>
<p>Product: Red Widget with 1 image<br>
  --------------------------------<br>
  /images/widgets/red_widget.jpg (main product image for a red widget)</p>
<p>&nbsp;</p>
<p>Product: Gold Doodad with 2 images<br>
  ----------------------------------<br>
  /images/doodads/gold_doodad1.jpg (main product image for a gold doodad, i.e. view from above)<br>
  /images/doodads/gold_doodad2.jpg (additional product image for a gold doodad, i.e. view from side)</p>
<p>&nbsp;</p>
<p>Product: Silver Doodad with 3 images<br>
  ------------------------------------<br>
  /images/doodads/silver_doodad1.jpg (main product image for a silver doodad, i.e. product)<br>
  /images/doodads/silver_doodad2.jpg (additional product image for a silver doodad, i.e. product detail)<br>
  /images/doodads/silver_doodad3.jpg (additional product image for a silver doodad, i.e. product\'s silver stamp)<br>
</p>
<p>Using Image Handler<sup>4</sup>, you can easily sort and manage thousands of images without confusion or hassle! When selecting the main image for a product in the Image Handler<sup>4</sup> interface, Image Handler<sup>4</sup> lets you pick the location for this image. This prompt disappears afterwards because Image Handler<sup>4</sup> knows that additional images need to be in the same folder as their main product image and handles that automatically!</p>
</fieldset>

</div>');
















