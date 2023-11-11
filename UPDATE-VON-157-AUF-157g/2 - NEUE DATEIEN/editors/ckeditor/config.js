/**
 * @license Copyright (c) 2003-2023, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 * modified for Zen Cart German - 2023-10-31 webchills
 */

CKEDITOR.editorConfig = function( config ) {
	// For complete reference see:
	// https://docs.ckeditor.com/#!/api/CKEDITOR.config

	// By default, the editor width equals the width of its container element in the page, while its height is set to 200 pixels.
	//config.width = '100%';
	config.height = 200;
	// if you prefer 400px set to 400 instead
	//config.height = 400;


	config.uiColor = '#D8D6CD';

	// The toolbar button arrangement, optimized for two toolbar rows.
	config.toolbar = [
		{ name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
		{ name: 'editing', items: [ 'Scayt' ] },
		{ name: 'links', items: [ 'Link', 'Unlink' ] },
		{ name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'SpecialChar', 'Iframe', 'Youtube' ] },
		{ name: 'others', items: [ 'Source' ] },
		{ name: 'about', items: [ 'Maximize', '-', 'About' ] },
		'/',
		{ name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', '-', 'RemoveFormat' ] },
		{ name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
		{ name: 'colors' , items: ['TextColor', 'BGColor']},
		{ name: 'styles', items: [ 'Styles', 'Format', 'FontSize' ] }
	];

	config.toolbarCanCollapse = true;

	// Remove some buttons provided by the standard plugins, which are not needed in the Standard toolbar.
	config.removeButtons = 'Subscript,Superscript,Font,Flash';

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';

	// List of font-sizes to appear in the font combo box
	config.fontSize_sizes =  '8/8px;9/9px;10/10px;11/11px;12/12px;13/13px;14/14px;15/15px;16/16px;17/17px;18/18px;19/19px;20/20px;22/22px;24/24px;26/26px;28/28px;36/36px;48/48px;72/72px';



  config.allowedContent = true;
	config.extraAllowedContent = '*(*)';
	// we want utf-8
	config.entities_latin = false;
	config.entities = false;  

};
CKEDITOR.on( 'instanceReady', function( ev ) {
    ev.editor.dataProcessor.writer.selfClosingEnd = '>';
});
