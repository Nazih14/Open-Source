 
      
      <!-- **********************************************************************************************************************************************************
     Ultra CV By Verly ananda
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
echo form_open('index.php/admin_area/update_front_profile/'.$x->id_profile.'');
?>
<div class="row mt">
<div class="col-lg-12">
<div class="form-panel">
<h4 class="mb"><i class="fa fa-angle-right"></i>Settings Front Profile </h4>
<div class="form-horizontal style-form" >
<div class="form-group">
<label class="col-sm-2 col-sm-2 control-label">Title Hi</label>
<div class="col-sm-10">
<input type="text"  name="title_hi" class="form-control" value="<?php echo $x->pengenalan;?>">
</div>
<label class="col-sm-2 col-sm-2 control-label">About Me</label>
<div class="col-sm-10">
<textarea name="aboutme" class="form-control"><?php echo $x->about;?></textarea> 
</div>
<label class="col-sm-2 col-sm-2 control-label">Name</label>
<div class="col-sm-10">
<input type="text"name="name"  class="form-control" value="<?php echo $x->nama;?>">
</div>
<label class="col-sm-2 col-sm-2 control-label">Date Of Birth</label>
<div class="col-sm-10">
<input type="text"  name="date" class="form-control" value="<?php echo $x->date;?>">
</div>
<label class="col-sm-2 col-sm-2 control-label">Email</label>
<div class="col-sm-10">
<input type="text"  name="email" class="form-control" value="<?php echo $x->email;?>">
</div>
<label class="col-sm-2 col-sm-2 control-label">Address</label>
<div class="col-sm-10">
<input type="text"  name="address" class="form-control" value="<?php echo $x->alamat;?>">
</div>
<label class="col-sm-2 col-sm-2 control-label">Phone</label>
<div class="col-sm-10">
<input type="text"  name="phone" class="form-control" value="<?php echo $x->phone;?>">
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

  