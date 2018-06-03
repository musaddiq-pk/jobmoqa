
 <?php $this->load->view(FRONT_TEMPLATE_URL."header");?>
 <?php $this->load->view(FRONT_TEMPLATE_URL."search_inner");?>
 
  <div class="container">
    <div class="row">
      <?php $this->load->view(FRONT_TEMPLATE_URL."category_list");?>
      <div class="col-md-6">
       
          

              
	   <?=$contents?>

      </div>
      <?php $this->load->view(FRONT_TEMPLATE_URL."right_pannel");?>
      
          <!--_________________________________________ Main Content Ends __________________________________________________________-->
        </div>
      </div>
    </div>
    <!--_________________________________________ Container-fluid Ends __________________________________________________________-->


  </div>
 	<?php  $this->load->view(FRONT_TEMPLATE_URL."footer"); ?>