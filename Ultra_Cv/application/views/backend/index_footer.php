 
      
      <!-- **********************************************************************************************************************************************************
     Ultra CV By Verly ananda
     donate me : 139 249 6984 an elita BCA
      *********************************************************************************************************************************************************** -->

<section id="main-content">
<section class="wrapper site-min-height">
<h3><i class="fa fa-angle-right"></i> Ultraviolet CV </h3>
<div class="row mt">
<div class="col-lg-12">
<p>Create your awesome CV</p>
            <!-- BASIC FORM ELELEMNTS -->
<?php
$x = $data_footer->row();
echo form_open('admin_area/update_footer/'.$x->id_footer.'');
?>
<div class="row mt">
<div class="col-lg-12">
<div class="form-panel">
<h4 class="mb"><i class="fa fa-angle-right"></i>Settings Footer Frontend </h4>
<div class="form-horizontal style-form" >
<div class="form-group">
<label class="col-sm-2 col-sm-2 control-label">No Telp</label>
<div class="col-sm-10">
<input type="text"  name="footer_notelp" class="form-control" value="<?php echo $x->notelp;?>">
</div>
<label class="col-sm-2 col-sm-2 control-label">Email</label>
<div class="col-sm-10">
<input type="text" name="footer_email" value="<?php echo $x->email;?>" class="form-control">
</div>
<label class="col-sm-2 col-sm-2 control-label">Lokasi</label>
<div class="col-sm-10">
<input type="text"name="footer_lokasi"  value="<?php echo $x->lokasi;?>" class="form-control">
</div>
<label class="col-sm-2 col-sm-2 control-label">Copyright</label>
<div class="col-sm-10">
<input type="text"  name="footer_copyright" class="form-control" value="<?php echo $x->copyright;?>">
</div>
<br>
</div>
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

  