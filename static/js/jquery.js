$(document).ready(function(){
	
	$(".detail").live("click" ,function(event){
			var parent_id = $(event.target).attr('rel');
			/*$(".show_detail").hide('slow');*/
			$('#show_detail_'+parent_id+'' ).slideToggle("slow");
			});
	
	// add multiple select / deselect functionality
    $("#selectall").click(function () {
									
          $('.case').attr('checked', this.checked);
    });
    $(".case").click(function(){
 
        if($(".case").length == $(".case:checked").length) {
            $("#selectall").attr("checked", "checked");
        } else {
            $("#selectall").removeAttr("checked");
        }
 
    });
});
	
	
	
	