############################################################################
# Image Handler Cleaner - 2011-06-10 - webchills
# ENTFERNT ALLE DATENBANKEINTRÄGE VON IMAGE HANDLER VERSIONEN 3.0 UND ÄLTER
############################################################################


DELETE FROM configuration WHERE configuration_key = 'IH_VERSION';
DELETE FROM configuration WHERE configuration_key = 'IH_RESIZE';
DELETE FROM configuration WHERE configuration_key = 'SMALL_IMAGE_FILETYPE';
DELETE FROM configuration WHERE configuration_key = 'SMALL_IMAGE_BACKGROUND';
DELETE FROM configuration WHERE configuration_key = 'SMALL_IMAGE_QUALITY';
DELETE FROM configuration WHERE configuration_key = 'WATERMARK_SMALL_IMAGES';
DELETE FROM configuration WHERE configuration_key = 'ZOOM_SMALL_IMAGES';
DELETE FROM configuration WHERE configuration_key = 'ZOOM_IMAGE_SIZE';
DELETE FROM configuration WHERE configuration_key = 'MEDIUM_IMAGE_FILETYPE';
DELETE FROM configuration WHERE configuration_key = 'MEDIUM_IMAGE_BACKGROUND';
DELETE FROM configuration WHERE configuration_key = 'MEDIUM_IMAGE_QUALITY';
DELETE FROM configuration WHERE configuration_key = 'WATERMARK_MEDIUM_IMAGES';
DELETE FROM configuration WHERE configuration_key = 'LARGE_IMAGE_FILETYPE';
DELETE FROM configuration WHERE configuration_key = 'LARGE_IMAGE_BACKGROUND';
DELETE FROM configuration WHERE configuration_key = 'LARGE_IMAGE_QUALITY';
DELETE FROM configuration WHERE configuration_key = 'WATERMARK_LARGE_IMAGES';
DELETE FROM configuration WHERE configuration_key = 'LARGE_IMAGE_MAX_WIDTH';
DELETE FROM configuration WHERE configuration_key = 'LARGE_IMAGE_MAX_HEIGHT';
DELETE FROM configuration WHERE configuration_key = 'WATERMARK_GRAVITY';
DELETE FROM configuration WHERE configuration_key = 'ADDITIONAL_IMAGE_FILETYPE';
DELETE FROM configuration WHERE configuration_key = 'ADDITIONAL_IMAGE_BACKGROUND';
DELETE FROM configuration WHERE configuration_key = 'ZOOM_MEDIUM_IMAGES';
DELETE FROM configuration WHERE configuration_key = 'SMALL_IMAGE_HOTZONE';
DELETE FROM configuration WHERE configuration_key = 'MEDIUM_IMAGE_HOTZONE';
DELETE FROM configuration WHERE configuration_key = 'SHOW_UPLOADED_IMAGES';
DELETE FROM configuration WHERE configuration_key = 'ZOOM_GRAVITY';
DELETE FROM configuration WHERE configuration_key = 'IMAGE_MANAGER_HANDLER';

DELETE FROM configuration_language WHERE configuration_key = 'IH_VERSION';
DELETE FROM configuration_language WHERE configuration_key = 'IH_RESIZE';
DELETE FROM configuration_language WHERE configuration_key = 'SMALL_IMAGE_FILETYPE';
DELETE FROM configuration_language WHERE configuration_key = 'SMALL_IMAGE_BACKGROUND';
DELETE FROM configuration_language WHERE configuration_key = 'SMALL_IMAGE_QUALITY';
DELETE FROM configuration_language WHERE configuration_key = 'WATERMARK_SMALL_IMAGES';
DELETE FROM configuration_language WHERE configuration_key = 'ZOOM_SMALL_IMAGES';
DELETE FROM configuration_language WHERE configuration_key = 'ZOOM_IMAGE_SIZE';
DELETE FROM configuration_language WHERE configuration_key = 'MEDIUM_IMAGE_FILETYPE';
DELETE FROM configuration_language WHERE configuration_key = 'MEDIUM_IMAGE_BACKGROUND';
DELETE FROM configuration_language WHERE configuration_key = 'MEDIUM_IMAGE_QUALITY';
DELETE FROM configuration_language WHERE configuration_key = 'WATERMARK_MEDIUM_IMAGES';
DELETE FROM configuration_language WHERE configuration_key = 'LARGE_IMAGE_FILETYPE';
DELETE FROM configuration_language WHERE configuration_key = 'LARGE_IMAGE_BACKGROUND';
DELETE FROM configuration_language WHERE configuration_key = 'LARGE_IMAGE_QUALITY';
DELETE FROM configuration_language WHERE configuration_key = 'WATERMARK_LARGE_IMAGES';
DELETE FROM configuration_language WHERE configuration_key = 'LARGE_IMAGE_MAX_WIDTH';
DELETE FROM configuration_language WHERE configuration_key = 'LARGE_IMAGE_MAX_HEIGHT';
DELETE FROM configuration_language WHERE configuration_key = 'WATERMARK_GRAVITY';
DELETE FROM configuration_language WHERE configuration_key = 'ADDITIONAL_IMAGE_FILETYPE';
DELETE FROM configuration_language WHERE configuration_key = 'ADDITIONAL_IMAGE_BACKGROUND';
DELETE FROM configuration_language WHERE configuration_key = 'ZOOM_MEDIUM_IMAGES';
DELETE FROM configuration_language WHERE configuration_key = 'SMALL_IMAGE_HOTZONE';
DELETE FROM configuration_language WHERE configuration_key = 'MEDIUM_IMAGE_HOTZONE';
DELETE FROM configuration_language WHERE configuration_key = 'SHOW_UPLOADED_IMAGES';
DELETE FROM configuration_language WHERE configuration_key = 'ZOOM_GRAVITY';
DELETE FROM configuration_language WHERE configuration_key = 'IMAGE_MANAGER_HANDLER';