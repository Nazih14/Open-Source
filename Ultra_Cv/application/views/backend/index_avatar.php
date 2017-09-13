 
      
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
foreach ($avatar->result() as $x);
echo form_open_multipart('index.php/upload_avatar/upload/'.$x->id_user.'');
?>
<div class="row mt">
<div class="col-lg-12">
<div class="form-panel">
<h4 class="mb"><i class="fa fa-angle-right"></i>(*If Success Change Ur Account Please Relogin For Sync data)</h4>
<div class="form-horizontal style-form" >
<div class="form-group">
<label class="col-sm-2 col-sm-2 control-label">Change Avatar</label><br>
<div class="col-sm-10">
<input type="hidden"name="gambar_lama" value="<?php echo $x->avatar;?>"><!--gambar nu hebeul//gambar lama-->
<img src="<?php echo base_url('gui/assets/ultraviolet_avatar/'.$x->avatar.'');?>"class="img-circle"  width="80px">
<input type="file"  name="userfile"  class="form-control"></div>
<label class="col-sm-2 col-sm-2 control-label">Change username</label>
<div class="col-sm-10"> 
<input type="text"  name="username" class="form-control" value="<?php echo $x->username;?>">
</div>
<label class="col-sm-2 col-sm-2 control-label">Change password</label>
<div class="col-sm-10">
<input type="text"  name="password" class="form-control" value="<?php echo $x->password;?>">
</div>
</div>
<br>
<input  class="btn btn-round btn-default" type="submit" name="upload" value="Save">       
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

  