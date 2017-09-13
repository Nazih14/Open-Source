
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
    <?php foreach ($readmore->result() as $tampil);?>
        <!-- start container -->
        <div class="container">
            <!-- start row -->
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-lg-8">
                    <!-- start post -->
                    <div class="post one-post">
                        <!-- start photo -->
                        <div class="photo">
                            <img src="<?php echo base_url('assets/img_blog/'.$tampil->img_blog.' ');?>" alt="UkieWeb">
                        </div>
                        <!-- end photo -->
                        <!-- start title post -->
                        <h3 class="title title-blog"><?php echo $tampil->judul;?></h3>
                        <!-- end title post -->
                        <div class="entry-byline">
                            <i class="fa fa-user"></i>
                            <span class="entry-author right-border">
                                <a href="#" title="Posts by  Verly" rel="author" >
                                    <span><?php echo $tampil->pengirim;?></span>
                                </a>
                            </span>
                            <i class="fa fa-clock-o"></i>
                            <time class="entry-published right-border"><?php echo $tampil->date;?></time>
                          
                        </div>
                        <!-- start text post -->
                        <p>
                        <?php echo $tampil->isi_blog;?>
                        <!-- start post pagination -->
                        <div class="post-pagination">
                            <a href="<?php echo base_url('index.php/frontend/blog');?>" class="btn btn-color-hover hover-animate pre">Back</a>
                         
                        </div>
                        <div class="clearfix"></div>
                        <!-- end post pagination -->

                    </div>
                    <!-- end post -->

                </div>