<style type="text/css">
	#activation_overlay_cal { visibility: hidden; position: absolute; left: 0px; top: 0px; width:100%; z-index: 9998; background: url('<?=FRONT_STATIC_URL?>images/trans_bg.png'); }
	#activation_overlay {top: 0px;	left: 0;z-index: 9999; padding:0px; margin:0 auto;height:570px;width:400px;} 	
	#activation_overlay .green_btn:link,
	#activation_overlay .green_btn:visited{width:174px;}
</style>

<div id="activation_overlay_cal" class="popupWindow">
	<div id="activation_overlay">
			
		<div class="modal_wapper">
				<div class="inner_wrapper">
                	<a href="javascript:;" class="close_signup close_gallery" onclick='activation_overlay_cal()'><img src="<?=FRONT_STATIC_URL?>images/icon_cancel.png" alt="Close" id="close_icon" class="iefix" /></a>
					<h4><?=$this->session->flashdata('msg_title')?></h4>
					<div class="pop_form user_form" style="padding:10px;"> 
                   <?=$this->session->flashdata('msg_body')?>
                     </div>
                	<div class="clear"></div>
				</div>
               
				<?php /*?><img src="<?=FRONT_STATIC_URL?>images/box-bottom.png" alt="" class="f_left iefix" /><?php */?>
				<div class="clear"></div>
		  </div>
	</div>
</div>
<script type="text/javascript">
	function activation_overlay_cal(elem) {
		$("#activation_overlay_cal").css("height",$("body").height());
		if($("#activation_overlay_cal").css("visibility") == "visible"){
			$("#activation_overlay_cal").css("visibility","hidden");
			
		}else{
			$("#activation_overlay_cal").css("visibility","visible");
		}
		if(elem){
			var top = $('#' + elem).offset().top-100;
			var left = $('#' + elem).offset().left-20; 
			$('#activation_overlay').css({'position' : 'absolute', 'top' : top, 'left' : left});
		}
	}
</script>