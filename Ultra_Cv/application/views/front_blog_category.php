
<!-- Load page -->
<div class="animationload">
    <div class="loader"></div>
</div>
<!-- End load page -->

<div id="wraper">

    <!-- Start Head section -->
    <header class="head">
        <!-- start container -->
        <div class="container">
            <!-- start row -->
            <div class="row">
                <div class="col-xs-8 col-sm-11 col-lg-11">
                    <img class="logo-page" src="<?php echo base_url('gui/assets/img/blog_l.png');?>" alt="Ukieweb">
                    <!-- Title Page -->
                    <h2 class="title">Blog</h2>
                    <!-- Description Page -->
                    <h4 class="sub-title">I write here my thoughts</h4>
                </div>
                <div class="col-xs-4 col-sm-1 col-lg-1 text-right">
                     <a href="<?php echo base_url('');?>" class="btn-close hover-animate"></a>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </header>
    <!-- End Head section -->

    <section class="blog padding-block">
        <!-- start container -->
        <div class="container">
            <!-- start row -->
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-lg-8">
                    <!-- start post -->
                    <?php foreach ($categorys as $verlipost) { 
                        $isian=$verlipost->isi_blog;
                        ?>
                        
                    
                
                    <div class="post">
                        <!-- start photo -->
                        <div class="photo">
                            <img src="<?php echo base_url('assets/img_blog/'.$verlipost->img_blog.'   ');?>" alt="UkieWeb">
                        </div>
                        <!-- end photo -->
                        <!-- start title post -->
                        <h3 class="title title-blog"><?php echo $verlipost->judul;?></h3>
                        <!-- end title post -->
                        <div class="entry-byline">
                            <i class="fa fa-user"></i>
                            <span class="entry-author right-border">
                                <a href="#" title="Posts by Theme Admin" rel="author" >
                                    <span><?php echo $verlipost->pengirim;?></span>
                                </a>
                            </span>
                            <i class="fa fa-clock-o"></i>
                            <time class="entry-published right-border"><?php echo $verlipost->date;?></time>
                            
                        </div>
                        <!-- start desc post -->
                        <p><?php echo $isian;?></p>
                        <!-- end desc post -->
                        <a href="<?php echo base_url('index.php/frontend/read_more/'.$verlipost->id_blog.' ');?>" class="btn hover-animate btn-color-hover">Read More</a>
                    </div>
                    <!-- end post -->

                    <?php }?>
    <?php echo $this->pagination->create_links();?>  
                   
                    <!-- end pagination -->
                </div>
               
