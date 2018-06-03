<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$title;?></title>
<link href="<?=ADMIN_STATIC_URL?>css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?=STATIC_URL?>js/jquery-1.7.1.min.js" ></script>
<?php /*?><script type="text/javascript" src="<?=STATIC_URL?>js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script><?php */?>
<script src="<?=ADMIN_STATIC_URL?>ckeditor/ckeditor.js"></script>
<script src="<?=ADMIN_STATIC_URL?>ckeditor/samples/js/sample.js"></script>

<?php /*?><script src="<?=STATIC_URL?>datepicker/jquery.ui.core.js"></script><?php */?>
<script src="<?=STATIC_URL?>datepicker/JS/jquery.ui.core.js"></script>
<script src="<?=STATIC_URL?>datepicker/JS/jquery.ui.datepicker.js"></script>
  
  
  <link rel="stylesheet" href="<?=STATIC_URL?>datepicker/JS/jquery.ui.all.css" />

<link rel="stylesheet" href="<?=ADMIN_STATIC_URL?>ckeditor/samples/css/samples.css">
<link rel="stylesheet" href="<?=ADMIN_STATIC_URL?>ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css">

<script type="text/javascript">
	window.profile_index = 0;
	if($(".Leftbar ul li").length > 0){
		cpage = document.URL.split('/'),
		cpage_name = cpage[cpage.length-1];
		//alert(cpage_name);
		$("#left_pannel li a").each(function(index){
			var c_href = $(this).attr('href').split('/');
			c_href = c_href[c_href.length-1];
			if(cpage_name == c_href)
				window.profile_index = index+1;
		});
		if(window.profile_index)
			$('.left_pannel li:nth-child('+window.profile_index+')').addClass('selected');
		else
			$('.left_pannel li:first').addClass('selected');
	}
	
	$(document).ready(function(){
		$( ".start_date" ).datepicker({
			changeMonth: true,
			dateFormat: "dd-mm-yy",
			numberOfMonths: 1,
			onClose: function(selectedDate) {
				$( ".end_date" ).datepicker("option", "minDate", selectedDate );
			}
		});
		$( ".end_date" ).datepicker({
			defaultDate: "+1",
			changeMonth: true,
			dateFormat: "dd-mm-yy",
			numberOfMonths: 1,
			onClose: function( selectedDate ) {
				$( ".start_date" ).datepicker("option", "maxDate", selectedDate );
			}
		});
	});
		
	/*tinyMCE.init({
		mode : "textareas",
		theme : "advanced",
		plugins : "fullpage",
		theme_advanced_buttons3_add : "fullpage",
		theme_advanced_toolbar_location : "top",
		editor_selector :"mceEditor"  
	});*/
	/*tinyMCE.init({				
			
		theme : "advanced",
		mode : "textareas",
		plugins : "fullpage",
		theme_advanced_buttons3_add : "fullpage",
		theme_advanced_toolbar_location : "top",
		editor_selector :"mceEditor"  				
		
	});*/
</script>
</head>

<body>
<div id="main"><!--main open-->
	<div id="header"><!--header open-->
    	<h1>Admin</h1>

	</div><!--header close-->
<div class="clear"></div>