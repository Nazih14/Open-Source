 
      
      <!-- **********************************************************************************************************************************************************
     Ultra CV By Verly ananda
      *********************************************************************************************************************************************************** -->

<section id="main-content">
<section class="wrapper site-min-height">
<h3><i class="fa fa-angle-right"></i> Ultraviolet CV </h3>
<div class="row mt">
<div class="col-lg-12">
<p>Create your awesome CV</p>
<?php echo form_open_multipart('admin_area/add_category/'); ?>
<div class="row mt">
<div class="col-lg-12">
<div class="form-panel">
<h4 class="mb"><i class="fa fa-angle-right"></i>Kelola Portofolio  </h4>
<div class="form-horizontal style-form" >
<div class="form-group">
<label class="col-sm-2 col-sm-2 control-label">Add Category</label>
<div class="col-sm-10">
<input type="text" name="name_category" class="form-control" >
</div>
<div class="col-sm-10">
<input  class="btn btn-round btn-default" type="submit" name="upload" value="Add">  
</div>                      
</div> 
</div>
</div>


                  <div class="col-md-12">
                      <div class="content-panel">

                        <table class="table table-striped table-advance table-hover">

                            <h4><i class="fa fa-angle-right"></i> List Category Blog</h4>
                            <hr>

                              <thead>

                               <tr>
                              <th></i> No</th>
                                  <th><i class="fa fa-bullhorn"></i> Category</th>
                                  <th></th>
                              </tr>
                              </thead>
                                    
                              <?php 
                              $verli2=1;
                            foreach ($kategori_list->result() as $xa) { ?>
                              <tbody>
                              <tr>
                              <td><?php echo $verli2++;?>
                                  <td><a href="basic_table.html#"><?php echo $xa->name_category;?></a></td>
                                  <td>
                                  <a href="<?php echo base_url('admin_area/delete_category_blog/'.$xa->id_category.' ');?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
                                  </td>
                              </tr>
                                 <?php }?>

                
                              </tbody>
                          </table>
                    </div>                      

 
</section>
</section>

  