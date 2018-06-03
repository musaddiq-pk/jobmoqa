
 <?php $this->load->view(FRONT_TEMPLATE_URL."header");?>
 <?php $this->load->view(FRONT_TEMPLATE_URL."search_inner");?>
 
  <div class="container">
    <div class="row">
      <?php $this->load->view(FRONT_TEMPLATE_URL."category_list");?>
      <div class="col-md-9">
        <!--_________________________________________ Latest Jobs Starts __________________________________________________________-->
        <?php $this->load->view(FRONT_TEMPLATE_URL."banner");?>

           <?=$contents?>
              
            <!--_________________________________________ All Jobs Ends __________________________________________________________-->

          </div>
          <!--_________________________________________ Main Content Ends __________________________________________________________-->
        </div>
      </div>
    </div>
    <!--_________________________________________ Container-fluid Ends __________________________________________________________-->


  </div>
 	<?php  $this->load->view(FRONT_TEMPLATE_URL."footer"); ?>