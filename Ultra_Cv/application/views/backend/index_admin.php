 
      
      <!-- **********************************************************************************************************************************************************
     Ultra CV By Verly ananda
      *********************************************************************************************************************************************************** -->
   
<section id="main-content">
<section class="wrapper site-min-height">
<h3><i class="fa fa-angle-right"></i> Ultraviolet CV </h3>
<div class="row mt">
<div class="col-lg-12">
<p>Create your awesome CV</p>
</div>
</div>
  <?php $avatar= $this->session->userdata('avatar');?>
  <?php $user= $this->session->userdata('username');?>
    <div class="col-lg-4 col-md-4 col-sm-4 mb">
              <!-- WHITE PANEL - TOP USER -->
              <div class="white-panel pn">
                <div class="white-header">
                <h5>People Watch Your CV</h5>
                </div>
                <p><img src="<?php echo base_url('gui/assets/ultraviolet_avatar/'.$avatar.'   ');?>" class="img-circle" width="50"></p>
                <p><b><?php echo $user;?></b></p>
                  <div class="row">
                    <div class="col-md-3">
                   
                    </div>
                    <div class="col-md-6">
                      <p class="small mt">TOTAL Visitor</p>
                      <p>300 People</p>
                    </div>
                  </div>
              </div>
            </div><!-- /col-md-4 -->
</section>
</section>

  