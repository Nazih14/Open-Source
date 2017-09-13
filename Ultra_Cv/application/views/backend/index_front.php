 
      
     
      <!-- **********************************************************************************************************************************************************
     Ultra CV By Verly ananda
     Donate me for keep me spirit : 139 249 6984 an Elita BCA
     Contact me :verlyananda@gmail.com
      *********************************************************************************************************************************************************** -->

<section id="main-content">
<section class="wrapper site-min-height">
<h3><i class="fa fa-angle-right"></i> Ultraviolet CV </h3>
<div class="row mt">
<div class="col-lg-12">
<p>Create your awesome CV</p>
            <!-- BASIC FORM ELELEMNTS -->
<?php
$x = $data_front->row();
echo form_open('index.php/admin_area/update_front/'.$x->id_frontend.'');
?>
<div class="row mt">
<div class="col-lg-12">
<div class="form-panel">
<h4 class="mb"><i class="fa fa-angle-right"></i>Settings Front </h4>
<div class="form-horizontal style-form" >
<div class="form-group">
<label class="col-sm-2 col-sm-2 control-label">Title Front</label>
<div class="col-sm-10">
<input type="text"  name="title_front" class="form-control" value="<?php echo $x->title_skill;?>">
</div>
<label class="col-sm-2 col-sm-2 control-label">Link Facebook</label>
<div class="col-sm-10">
<input type="text"  name="link_fb" class="form-control" value="<?php echo $x->link_fb;?>">
</div>
<label class="col-sm-2 col-sm-2 control-label">Link Twitter</label>
<div class="col-sm-10">
<input type="text"name="link_twit"  class="form-control" value="<?php echo $x->link_twit;?>">
</div>
<label class="col-sm-2 col-sm-2 control-label">Link Google</label>
<div class="col-sm-10">
<input type="text"  name="link_google" class="form-control" value="<?php echo $x->link_google;?>">
<br>
<input  class="btn btn-round btn-default" type="submit" value="Save">       
</div>                      
</div> 
</div>
</div>
</div><!-- col-lg-12-->       
</div><!-- /row -->
            
           

</div>
</div>
 
</section>
</section>

  