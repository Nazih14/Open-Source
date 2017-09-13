 
      
      <!-- **********************************************************************************************************************************************************
     Ultra CV By Verly ananda
     Donate me for keep spirit : 139 249 6984 an Elita BCA
     Contact me :verlyananda@gmail.com
      *********************************************************************************************************************************************************** -->
<section id="main-content">
<section class="wrapper site-min-height">
<h3><i class="fa fa-angle-right"></i> Ultraviolet CV </h3>
<div class="row mt">
<div class="col-lg-12">
<p>Create your awesome CV</p>
            <!-- BASIC FORM ELELEMNTS -->

<?php echo form_open_multipart('index.php/upload_porto/upload/'); ?>

<div class="row mt">
<div class="col-lg-12">
<div class="form-panel">
<h4 class="mb"><i class="fa fa-angle-right"></i>Kelola Portofolio  </h4>
<div class="form-horizontal style-form" >
<div class="form-group">
<label class="col-sm-2 col-sm-2 control-label">Judul Portofolio</label>
<div class="col-sm-10">
<input type="text" name="judul_porto" class="form-control" >
</div>
<label class="col-sm-2 col-sm-2 control-label">Completed</label>
<div class="col-sm-10">
<input type="text" name="completed_porto" class="form-control" >
</div>
<label class="col-sm-2 col-sm-2 control-label">From Client</label>
<div class="col-sm-10">
<input type="text" name="from_porto" class="form-control" >
</div>
<label class="col-sm-2 col-sm-2 control-label">Desc</label>
<div class="col-sm-10">
<textarea name="desc_porto" class="form-control"></textarea>
</div>
<label class="col-sm-2 col-sm-2 control-label">Upload Gambar</label>
<div class="col-sm-10">
<input type="file"  name="userfile"  class="form-control">
<br>
<input  class="btn btn-round btn-default" type="submit" name="upload" value="Save">  
</form>     
</div>                      
</div> 
</div>
</div>

          	<hr>

				<div class="row mt">
				<?php foreach ($query_porto->result() as $x) { ?>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 desc">
					<a href="<?php echo base_url('admin_area/delete_portofolio/'.$x->id_porto.'');?>" type="button" class="btn btn-theme04">Delete</a>
						<div class="project-wrapper">
		                    <div class="project">
		                        <div class="photo-wrapper">
		                            <div class="photo">
		                            	<a class="fancybox" href="<?php echo base_url('assets/img_porto/'.$x->img_porto.'');?>"><img class="img-responsive" src="<?php echo base_url('assets/img_porto/'.$x->img_porto.'');?>" alt=""></a>
		                            </div>
		                            <div class="overlay"></div>
		                        </div>
		                    </div>
		                </div>
					</div><!-- col-lg-4 -->
					<?php } ?>
					
			
				
           

</div>
</div>
 
</section>
</section>

  