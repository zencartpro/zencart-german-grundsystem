<?php
/**
 * @package Image Handler 5.3.6
 * @copyright Copyright 2005-2006 Tim Kroeger (original author)
 * @copyright Copyright 2018-2026 lat 9 - Vinos de Frutas Tropicales
 * @copyright Copyright 2003-2026 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: ImageHandlerAdmin.php 2026-05-16 09:30:51Z webchills $
 */
if (!defined('IH_DEBUG_ADMIN')) {
    define('IH_DEBUG_ADMIN', 'true'); //-Either 'true' or 'false'
}
class ImageHandlerAdmin
{
    public bool $debug;
    public string $debugLogfile;
    public array $validFiletypes;
    public array $validFileExtensions;

    public function __construct()
    {
        $this->debug = (IH_DEBUG_ADMIN === 'true');
        $this->debugLogfile = DIR_FS_LOGS . '/ih_debug_admin.log';
        $this->validFiletypes = ['gif', 'jpg', 'png', 'webp', 'no_change'];
        $this->validFileExtensions = ['.gif', '.jpg', '.jpeg', '.png', '.webp'];
    }

    public function getImageDetailsString(string $filename): string
    {
        if (!file_exists($filename)) {
            return 'no info';
        }
        // find out some details about the file
        $image_size = @getimagesize($filename);
        $image_fs_size = filesize($filename);

        $str = $image_size[0] . "x" . $image_size[1];
        $str .= "<br><strong>" . round($image_fs_size/1024, 2) . "Kb</strong>";

        return $str;
    }

    // -----
    // Search the directory specified for matching additional images, presumed to be a sub-directory
    // off the images root directory.
    //
    // Note that Zen Cart's additional-images "matching" depends on whether the images are present
    // in the image-root ($directory is '') or in an actual subdirectory (non-blank $directory).
    //
    // When in the root, **any** matching suffix for the main-image's name results in a matching
    // additional image (e.g. my_image.jpg matches my_images.jpg, my_images-1.jpg) while the
    // matching suffix for sub-directory images **must** have an underscore (_) separating the names,
    // e.g. my_image.jpg matches my_image_01.jpg, my_image_01_02_03.jpg ... but does not match
    // my_images.jpg or my_images-1.jpg).
    //
    // The function returns a simple, sorted array containing the matching filenames (without the
    // directory information).
    //
    public function findAdditionalImages(&$array, string $directory, string $base): int
    {
        // -----
        // Set up the to-be-matched image name, depending on whether the search is being
        // performed in the root or a sub-directory. For the root, any matching characters after the
        // main-image name; for a sub-directory, 0 (for the main-image) or 1 (for any additional)
        // matches on _{something}.
        //
        $image_match = ($directory === '') ? '.*' : '(?:_.*)?';

        // -----
        // Determine whether the directory specified is, in fact, an images sub-directory.  If
        // not, no files will be returned.
        //
        $error = false;
        try {
            $image_dir = new DirectoryIterator(DIR_FS_CATALOG . DIR_WS_IMAGES . $directory);
        } catch(Exception $e) {
            $error = true;
            $this->debugLog("findAdditionalImages(array, $directory, $base), could not iterate directory." . $e->getMessage());
        }

        // -----
        // If the requested directory was accessed without error, find those images!
        //
        if ($error === false) {
            // -----
            // The quotemeta function properly escapes any "regex" special characters that
            // might be present in the image's base name, e.g. any intervening '.'s will be
            // converted to '\.'.
            //
            $filename_match = quotemeta($base) . $image_match . '\.(jpg|jpeg|png|gif|webp)';

            // -----
            // Now, do a regex search of the specified directory, looking for matches on the
            // base-image's name with the additional-image modifier.
            //
            $img_files = new RegexIterator($image_dir, '/^' . $filename_match . '$/i', RegexIterator::GET_MATCH);
            foreach ($img_files as $i => $image_array) {
                $array[] = $image_array[0];
            }

            // -----
            // If there are elements in the array of images, sort them!
            //
            if (count($array) > 1) {
                sort($array);
            }
        }
        return ($error === true) ? 0 : 1;
    }

    public function validatePositiveInteger($value): bool
    {
        return (((int)$value) != $value || $value <= 0);
    }

    public function validateQuality($value): bool
    {
        return (((int)$value) != $value || $value < 0 || $value > 85);
    }

    public function validateBackground(string $value): bool
    {
        $entry_error = false;
        $background = trim(str_replace('transparent', '', $value));
        $rgb_values = preg_split('/[, :]/', $background);

        if (!is_array($rgb_values) || count($rgb_values) !== 3) {
            $entry_error = true;
        } else {
            foreach ($rgb_values as $rgb_value) {
                if (preg_match('/^[0-9]{1,3}$/', $rgb_value) === 0 || $rgb_value > 255) {
                    $entry_error = true;
                }
            }
        }
        return $entry_error;
    }

    public function validateFiletype(string $value): bool
    {
        return !in_array(strtolower($value), $this->validFiletypes, true);
    }

    public function validateBoolean($value): bool
    {
        return !($value === true || $value === false);
    }

    public function validateFileExtension(string $value): bool
    {
        return in_array(strtolower($value), $this->validFileExtensions, true);
    }

    public function getSupportedFileExtensions(): string
    {
        return implode(', ', $this->validFileExtensions);
    }

    public function imageHandlerHrefLink(string $image_name, $products_filter, string $action = '', string $more = ''): string
    {
        $imgName = ($image_name === '') ? '' : "&amp;imgName=$image_name";
        $action = ($action === '') ? '' : "&amp;action=$action";

        return zen_href_link(FILENAME_IMAGE_HANDLER, "products_filter=$products_filter$action$imgName$more");
    }

    public function debugLog(string $message): void
    {
        if ($this->debug) {
            error_log(PHP_EOL . date('Y-m-d H:i:s: ') . $message . PHP_EOL, 3, $this->debugLogfile);
        }
    }
}
