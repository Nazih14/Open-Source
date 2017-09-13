 
      
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
$username= $this->session->userdata('username');?>
<?php echo form_open_multipart('index.php/upload_img/upload/'); ?>

<div class="row mt">
<div class="col-lg-12">
<div class="form-panel">
<h4 class="mb"><i class="fa fa-angle-right"></i>Kelola Blog  </h4>
<div class="form-horizontal style-form" >
<div class="form-group">
<label class="col-sm-2 col-sm-2 control-label">Title Hi</label>
<div class="col-sm-10">
<input type="text"  name="title" class="form-control" placeholder="Judul Blog" required>
</div>
<label class="col-sm-2 col-sm-2 control-label">Kategori</label>
<div class="col-sm-10">
<select name="kategoris"  class="form-control">
<?php 
echo "<option value=not_kategori>---- Pilih Kategori ----</option>";
foreach ($kategori->result() as $g)
{
echo " <option value=$g->id_category>$g->name_category </option>";
}
?>
</select>
</div>
<label class="col-sm-2 col-sm-2 control-label">Pengirim</label>
<div class="col-sm-10">
<input type="text" name="pengirim" class="form-control" value="<?php echo $username;?>">
</div>
<label class="col-sm-2 col-sm-2 control-label">Isi Blog</label>
<div class="col-sm-10">
<textarea name="isi" class="form-control">Isi Blog</textarea>
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

                      <!--LIST BLOG-->
<div class="row mt">
                  <div class="col-md-12">
                      <div class="content-panel">
                          <table class="table table-striped table-advance table-hover">
	                  	  	  <h4><i class="fa fa-angle-right"></i> List Posted Blog</h4>
	                  	  	  <hr>
                              <thead>
                               <tr>
                              <th></i> No</th>
                                  <th><i class="fa fa-bullhorn"></i> Judul</th>
                                  <th>Category</th>
                                  <th class="hidden-phone"><i class="fa fa-question-circle"></i> Pengirim</th>
                                  <th><i class="fa fa-bookmark"></i> Desc</th>
                                  <th><i class=" fa fa-edit"></i> Image</th>
                                   <th><i class=" fa fa-date"></i>Tgl Posting</th>
                                  <th></th>
                              </tr>
                              </thead>
                                       <?php echo $this->pagination->create_links();?>            
                              <?php 
                              $verli=1;
                            foreach ($blog as $x) { ?>
                              <tbody>
                              <tr>
                              <td><?php echo $verli++;?>
                                  <td><a href="basic_table.html#"><?php echo $x->judul;?></a></td>
                                  <td><?php echo $x->name_category;?></td>
                                  <td class="hidden-phone"><?php echo $x->pengirim;?></td>
                                  <td><?php echo $x->isi_blog;?></td>
                                  <td><img src="<?php echo base_url('assets/img_blog/'.$x->img_blog.'');?>"width="50px"></td>
                                  <td><?php echo $x->date;?>
                                  <td>
                                      <a href="<?php echo base_url('admin_area/delete_blog/'.$x->id_blog.' ');?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
                                  </td>
                              </tr>
                                 <?php }?>

                
                              </tbody>
                          </table>
                      </div><!-- /content-panel -->
                  </div><!-- /col-md-12 -->
              </div><!-- /row -->
</div><!-- col-lg-12-->       
</div><!-- /row -->
            
           

</div>
</div>
 
</section>
</section>

  