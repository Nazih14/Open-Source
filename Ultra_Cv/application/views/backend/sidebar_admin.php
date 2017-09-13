   <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              <?php $avatar= $this->session->userdata('avatar');?>
              <?php $username= $this->session->userdata('username');?>
              	  <p class="centered"><a href="profile.html"><img src="<?php echo base_url('gui/assets/ultraviolet_avatar/'.$avatar.'');?>" class="img-circle" width="60"></a></p>
              	  <h5 class="centered"><?php echo $username;?></h5>
              	  	
                      <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-desktop"></i>
                          <span>Settings Frontend</span>
                      </a>
                      <ul class="sub">
        <?php  foreach($query->result() as $tampil); ?>
                          <li><a  href="<?php echo base_url('admin_area/settings_avatar/'.$tampil->id_user.'');?>">Settings Avatar account</a></li>
                          <li><a  href="<?php echo base_url('admin_area/settings_front/'.$tampil->id_frontend.' ');?>">Settings Front</a></li>
                          <li><a  href="<?php echo base_url('admin_area/settings_front_profile/'.$tampil->id_profile.' ');?>">Settings Front Profile
                          <li><a  href="<?php echo base_url('admin_area/settings_portofolio/');?>">Kelola Portofolio</a></li>
                          <li><a  href="<?php echo base_url('admin_area/settings_blog');?>">Kelola Blog</a></li>
                          <li><a  href="<?php echo base_url('admin_area/settings_category_blog');?>">Kelola Category Blog</a></li>
                          <li><a  href="<?php echo base_url('admin_area/settings_footer/'.$tampil->id_frontend.'');?>">Settings Footer Frontend</a></li>
                      </ul>
                  </li>


              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->