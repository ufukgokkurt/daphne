/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */
url='http://bilge.app';

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
    config.removePlugins = 'forms';
    config.allowedContent = true;
    config.filebrowserBrowseUrl = url+'/backend/vendors/kcfinder/browse.php?opener=ckeditor&type=files';
    config.filebrowserImageBrowseUrl = url+'/backend/vendors/kcfinder/browse.php?opener=ckeditor&type=images';
    config.filebrowserFlashBrowseUrl = url+'/backend/vendors/kcfinder/browse.php?opener=ckeditor&type=flash';
    config.filebrowserUploadUrl = url+'/backend/vendors/kcfinder/upload.php?opener=ckeditor&type=files';
    config.filebrowserImageUploadUrl = url+'/backend/vendors/kcfinder/upload.php?opener=ckeditor&type=images';
    config.filebrowserFlashUploadUrl = url+'/backend/vendors/kcfinder/upload.php?opener=ckeditor&type=flash';
};
