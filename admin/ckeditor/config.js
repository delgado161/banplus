/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	
	config.enterMode = CKEDITOR.ENTER_BR;
	config.shiftEnterMode = CKEDITOR.ENTER_P;
	
	var urr, dirr;
	urr = document.URL;
	
	if (urr.indexOf("atenasnew")>=0){
		dirr = "/banplus/admin";
	}else if (urr.indexOf("banplus.com")>=0){
		dirr = "/admin";
	}else {
		dirr = "/calidad/banplus/admin";
	}
	
	//banplus/admin
	
	config.filebrowserBrowseUrl = dirr+'/ckfinder/ckfinder.html';
	config.filebrowserImageBrowseUrl = dirr+'/ckfinder/ckfinder.html?Type=Images';
	config.filebrowserFlashBrowseUrl = dirr+'/ckfinder/ckfinder.html?Type=Flash';
	config.filebrowserUploadUrl = dirr+'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&currentFolder=../../uploads/';
	config.filebrowserImageUploadUrl = dirr+'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
	config.filebrowserFlashUploadUrl = dirr+'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';	
	
};
