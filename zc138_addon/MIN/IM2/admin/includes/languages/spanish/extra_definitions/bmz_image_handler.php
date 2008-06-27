<?php

define('BOX_TOOLS_IMAGE_HANDLER', 'Image Handler<sup>2</sup>');
define('ICON_IMAGE_HANDLER','Image Handler 2');
define('IH_VERSION_VERSION', 'Versión');
define('IH_VERSION_NOT_FOUND', 'No se halla información de Image Handler.');
define('IH_REMOVE', 'Remover Image Handler desde base de datos');
define('IH_CONFIRM_REMOVE', 'Estás seguro?');
define('IH_REMOVED', 'Image Handler removido correctamente.');
define('IH_UPDATE', 'Actualizar Image Handler');
define('IH_UPDATED', 'Image Handler actualizado correctamente.');
define('IH_INSTALL', 'Instalar Image Handler');
define('IH_INSTALLED', 'Image Handler instalado correctamente.');
define('IH_SCAN_FOR_ORIGINALS', 'Buscando imagen original anteriores IH 0.x y 1.x ');
define('IH_CONFIRM_IMPORT', 'Necesitas realmente importar el listado de imágenes?Realiza copia de seguridad de tu base de datos e imágenes primero!');
define('IH_NO_ORIGINALS', 'No se hallan imágenes originales anteriores IH 0.x o 1.x ');
define('IH_IMAGES_IMPORTED', 'Imágenes importadas.');
define('IH_CLEAR_CACHE', 'Limpiar el cache de imagen');
define('IH_CACHE_CLEARED', 'Cache de imagen limpio.');

define('IH_SOURCE_TYPE', 'Buscando tipo de imagen');
define('IH_SOURCE_IMAGE', 'Buscando imagen');
define('IH_SMALL_IMAGE', 'Imagen por defecto');
define('IH_MEDIUM_IMAGE', 'Imagen de producto');

define('IH_ADD_NEW_IMAGE', 'Agregar nueva imagen');
define('IH_NEW_NAME_DISCARD_IMAGES', 'Usar nuevo nombre, descartar imágenes adicionales');
define('IH_NEW_NAME_COPY_IMAGES', 'Usar nuevo nombre, copiar imágenes adicionales');
define('IH_KEEP_NAME', 'Mantener viejo nombre e imágenes adicionales');
define('IH_DELETE_FROM_DB_ONLY', 'Borrar referencia de imagen solo desde la base de datos');

define('IH_HEADING_TITLE', 'Image Handler2');
define('IH_HEADING_TITLE_PRODUCT_SELECT','Por favor seleccione un producto para modificar las imágenes.');

define('TABLE_HEADING_PHOTO_NAME', 'Nombre imagen');
define('TABLE_HEADING_DEFAULT_SIZE','Tamaño por defecto');
define('TABLE_HEADING_MEDIUM_SIZE', 'Tamaño medio');
define('TABLE_HEADING_LARGE_SIZE','Tamaño grande');
define('TABLE_HEADING_ACTION', 'Acción');

define('TEXT_PRODUCT_INFO', 'Producto');
define('TEXT_PRODUCTS_MODEL', 'Modelo');
define('TEXT_IMAGE_BASE_DIR', 'Directorio base');
define('TEXT_NO_PRODUCT_IMAGES', 'Estas no son imágenes para este producto');
define('TEXT_CLICK_TO_ENLARGE', 'Click para agrandar');
define('TEXT_PRICED_BY_ATTRIBUTES', 'Precio por atributos');

define('TEXT_INFO_IMAGE_INFO', 'Información de imagen');
define('TEXT_INFO_NAME', 'Nombre');
define('TEXT_INFO_FILE_TYPE', 'Tipo de archivo');
define('TEXT_INFO_EDIT_PHOTO', 'Editar imagen');
define('TEXT_INFO_NEW_PHOTO', 'Nueva imagen');
define('TEXT_INFO_IMAGE_BASE_NAME', 'Nombre base de imagen (opcional)');
define('TEXT_INFO_AUTOMATIC_FROM_DEFAULT', ' Automatico (desde nombre de imagen por defecto)');
define('TEXT_INFO_MAIN_DIR', 'Directorio principal');
define('TEXT_INFO_BASE_DIR', 'Directorio base de imágenes');
define('TEXT_INFO_NEW_DIR', 'Seleccione o defina un nuevo directorio para imágenes.');
define('TEXT_INFO_IMAGE_DIR', 'Directorio de imágenes');
define('TEXT_INFO_OR', 'o');
define('TEXT_INFO_AUTOMATIC', 'Automatico');
define('TEXT_INFO_IMAGE_SUFFIX', 'Sufijo de imagen (opcional)');
define('TEXT_INFO_USE_AUTO_SUFFIX','Ingrese un sufijo específico o deje en blanco para generar uno automaticamente.');
define('TEXT_INFO_DEFAULT_IMAGE', 'Archivo de imagen por defecto');
define('TEXT_INFO_DEFAULT_IMAGE_HELP', 'La imagen por defecto no está definida. La imagen por defecto se asume que es pequeña cuando media y grande son ingresadas.');
define('TEXT_INFO_CONFIRM_DELETE', 'Confirmar borrado');
define('TEXT_INFO_CONFIRM_DELETE_SURE', 'Estás seguro que necesitas borrar esta imagen y todas sus medidas?');
define('TEXT_INFO_SELECT_ACTION', 'Seleccione acción');
define('TEXT_INFO_CLICK_TO_ADD', 'Click para agregar una nueva imagen a este producto');

define('TEXT_MSG_AUTO_BASE_ERROR', 'Selección automatica de imagen base descartando archivo por defecto.');
define('TEXT_MSG_INVALID_BASE_ERROR', 'Nombre de imagen base inválido, o imposible hallar la imagen por defecto.');
define('TEXT_MSG_AUTO_REPLACE', 'Reemplazando automaticamente caracteres no permitidos en el nombre de imagen base, nuevo nombre: ');
define('TEXT_MSG_INVALID_SUFFIX', 'Sufijo de imagen inválido.');
define('TEXT_MSG_IMAGE_TYPES_NOT_SAME_ERROR', 'Image types are not the same.');
define('TEXT_MSG_DEFAULT_REQUIRED_FOR_RESIZE', 'La imagen por defecto es requerida para redimensión automática.');
define('TEXT_MSG_NO_DEFAULT', 'No has especificado la imagen por defecto.');
define('TEXT_MSG_FILE_EXISTS', 'Archivo existente! Por favor cambie el nombre base o el sufijo.');
define('TEXT_MSG_INVALID_SQL', 'Imposible completar la consulta SQL.');
define('TEXT_MSG_NOCREATE_IMAGE_DIR', 'Imposible crear el directorio de imágenes.');
define('TEXT_MSG_NOCREATE_MEDIUM_IMAGE_DIR', 'Imposible crear el directorio de imágenes medias.');
define('TEXT_MSG_NOCREATE_LARGE_IMAGE_DIR', 'Imposible crear el directorio de imágenes grandes.');
define('TEXT_MSG_NOPERMS_IMAGE_DIR', 'Imposible establecer los permisos al directorio de imagenes.');
define('TEXT_MSG_NOPERMS_MEDIUM_IMAGE_DIR', 'Imposible establecer los permisos al directorio de imagenes medias.');
define('TEXT_MSG_NOPERMS_LARGE_IMAGE_DIR', 'Imposible establecer los permisos al directorio de imagenes grandes.');

define('TEXT_MSG_NOUPLOAD_DEFAULT', 'Imposible subir archivo de imagen por defecto.');
define('TEXT_MSG_NORESIZE', 'Imposible redimensionar imagen');
define('TEXT_MSG_NOCOPY_LARGE', 'Imposible copiar el archivo de imagen grande.');
define('TEXT_MSG_NOCOPY_MEDIUM', 'Imposible copiar el archivo de imagen medio.');
define('TEXT_MSG_NOCOPY_DEFAULT', 'Imposible copiar el archivo de imagen por defecto.');
define('TEXT_MSG_NOPERMS_LARGE', 'Imposible establecer permisos al archivo de imagen grande.');
define('TEXT_MSG_NOPERMS_MEDIUM', 'Imposible establecer permisos al archivo de imagen medio.');
define('TEXT_MSG_NOPERMS_DEFAULT', 'Imposible establecer permisos al archivo de imagen por defecto.');
define('TEXT_MSG_IMAGE_SAVED', 'Imagen correctamente guardada.');
define('TEXT_MSG_LARGE_DELETED', 'Imagen grande borrada.');
define('TEXT_MSG_NO_DELETE_LARGE', 'Imposible borrar la imagen grande.');
define('TEXT_MSG_MEDIUM_DELETED', 'Imagen media borrada.');
define('TEXT_MSG_NO_DELETE_MEDIUM', 'Imposible borrar la imagen media.');
define('TEXT_MSG_DEFAULT_DELETED', 'Imagen por defecto borrada.');
define('TEXT_MSG_NO_DELETE_DEFAULT', 'Imposible borrar la imagen por defecto.');
define('TEXT_MSG_NO_DEFAULT_FILE_FOUND', 'No se halla la imagen por defecto para borrar');

define('TEXT_MSG_IMAGE_DELETED', 'Imagen correctamente borrada.');
define('TEXT_MSG_IMAGE_NOT_FOUND', 'Imposible localizar la imagen.');
define('TEXT_MSG_IMAGE_NOT_DELETED', 'Imposible borrar la imagen.');

define('TEXT_MSG_IMPORT_SUCCESS', 'Importación correcta: ');
define('TEXT_MSG_IMPORT_FAILURE', 'Fallo la importación: '); 


?>