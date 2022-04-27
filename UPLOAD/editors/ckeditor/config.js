/**
 * @license Copyright (c) 2003-2022, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 * modified for Zen Cart German
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	// we want to allow custom classes
	config.extraAllowedContent = '*(*)';
	// we want utf-8
	config.entities_latin = false;
	config.entities = false;
};
