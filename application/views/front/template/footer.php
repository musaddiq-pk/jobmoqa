<? 	
	$about_us = $menu['about-us'];
	//$sub_error = '';
	$sub_error = $this->session->flashdata('subscription_error');
	//$this->session->flashdata('subscription_error');
?>
<footer>
    <div class="container">
      <div class="col-md-3">
        <h3 class="footer-title">Useful Links</h3>
        <ul class="useful-links">
          <li><a href="<?=BASE_URL?>about-us">About Us</a></li>
          <li><a href="<?=BASE_URL?>services">Services</a></li>
          <li><a href="<?=BASE_URL?>interview-tips">Interview Tips</a></li>
          <li><a href="<?=BASE_URL?>cv-formats">CV Formats</a></li>
        </ul>
      </div>
      <div class="col-md-6">
        <h3 class="footer-title"><?=$about_us['name']?></h3>
        <div class="about-text"><?=$about_us['desc']?></div>
      </div>
      <div class="col-md-3" id="sub_form">
        <h3 class="footer-title">News Letter</h3>
        <?=$this->general_lib->show_flash_message('subscription_error');?>
        <form action="<?=BASE_URL?>subscribe" method="post">
        	<input type="hidden" name="cust_id" value="0" />
          <input type="email" id="email" name="email" class="form-control" placeholder="Your Email" >
          <button type="submit" class="btn btn-block submit-btn">submit</button>
        </form>
      </div>
    </div>
  </footer>

  <div class="container-fluid">
    <div class="row">
      <div class="footer-bottom">
        <div class="container text-center">
          <p>Copyright &copy; 2017. <a href="<?=BASE_URL?>"><?=SITE_NAME?></a> . All Rights Reserved.</p>
        </div>
      </div>
    </div>
  </div>
 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="<?=FRONT_STATIC_URL?>js/bootstrap.min.js"></script>
  <script src="<?=FRONT_STATIC_URL?>js/owl.carousel.min.js"></script>
  <script>
	  /* Set the width of the side navigation to 250px and the left margin of the page content to 250px and add a black background color to body */
	  function openNav() {
		document.getElementById("mySidenav").style.width = "250px";
		document.getElementById("main").style.marginLeft = "250px";
		document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
	  }
	
	  /* Set the width of the side navigation to 0 and the left margin of the page content to 0, and the background color of body to white */
	  function closeNav() {
		document.getElementById("mySidenav").style.width = "0";
		document.getElementById("main").style.marginLeft = "0";
		document.body.style.backgroundColor = "white";
	  }
	  
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
	  
	  $("#cat-drop").click(function () {
		$("#cat-drop-list").slideToggle();
		icon = $(this);
		icon.toggleClass("glyphicon-chevron-up glyphicon-chevron-down");
	  });
	   $("#sub_link").click(function () {
		  	//$("#sub_form").css('background','#574545');
		  	var sub_offset = $('#sub_form').offset().top;
			$('html, body').animate({scrollTop: sub_offset}, 1100);
			setTimeout(function(){ $("#sub_form").css('background','#574545');} , 1000);
			
			setTimeout(function(){ $("#sub_form").css('background','none');} , 3000);
	  });
	  $("#city-drop").click(function () {
		$("#city-drop-list").slideToggle();
		icon = $(this);
		icon.toggleClass("glyphicon-chevron-up glyphicon-chevron-down");
	  });
	  
	  <? if(isset($sub_error) && $sub_error !='') : ?>
	  $("#sub_link").click();
	  <? endif; ?>
	
	  $(document).ready(function () {
		var owl = $("#latestjobs");
		owl.owlCarousel({
		  autoPlay: 3000, //Set AutoPlay to 3 seconds
		  items: 2,
		  itemsDesktop: [1199, 2],
		  itemsDesktopSmall: [979, 2]
	
		});
		$(".new-next").click(function () {
		  owl.trigger('owl.next');
		})
		$(".new-prev").click(function () {
		  owl.trigger('owl.prev');
		})
	
	  });
  </script>
  
  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-116750742-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-116750742-1');
</script>

</body>

</html>