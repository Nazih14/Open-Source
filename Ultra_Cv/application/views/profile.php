<body>

<!-- Load page -->
<div class="animationload">
    <div class="loader"></div>
</div>
<!-- End load page -->

<div id="wraper">
<?php foreach ($profile->result() as $tampil); ?>
    <!-- Start Head section -->
    <header class="head">
        <!-- start container -->
        <div class="container">
            <!-- start row -->
            <div class="row">
                <div class="col-xs-8 col-sm-11 col-lg-11">
                    <img class="logo-page" src="<?php echo base_url('gui/assets/img/profile_l.png');?>" alt="Verly">
                    <!-- Title Page -->
                    <h2 class="title">Profile</h2>
                    <!-- Description Page -->
                    <h4 class="sub-title">A Brief About Me</h4>
                </div>
                <div class="col-xs-4 col-sm-1 col-lg-1 text-right">
                    <a href="<?php echo base_url('') ;?>" class="btn-close hover-animate"></a>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </header>
    <!-- End Head section -->

    <!-- Start Content section -->
    <section class="content border-bottom padding-block">
        <!-- start container -->
        <div class="container">
            <!-- start row -->
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-lg-7">
                    <h3 class="title"><?php echo $tampil->pengenalan;?></h3>
                    <p><?php echo $tampil->about;?></p>
         
                    <p>
                        <a href="#" class="btn hover-animate">Hire me Now</a><a href="#" class="btn btn-color hover-animate">Download CV</a>
                    </p>
                </div>
                <div class="col-xs-12 col-sm-12 col-lg-5">
                    <div class="block-grey">
                        <table>
                            <tr>
                                <td class="font-weight-m">Name</td>
                                <td class="text-right"><?php echo $tampil->nama;?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-m">Date of birth</td>
                                <td class="text-right"><?php echo $tampil->date;?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-m">E-mail</td>
                                <td class="text-right"><a href="mailto:info@yourdomain.com"><?php echo $tampil->email;?></a></td>
                            </tr>
                            <tr>
                                <td class="font-weight-m">Address</td>
                                <td class="text-right"><?php echo $tampil->alamat;?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-m">Phone</td>
                                <td class="text-right"><a href="tel:01234567890"><?php echo $tampil->phone;?></a></td>
                            </tr>
                        
                        </table>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
    <!-- End Content section -->

    <!-- Start Info section -->
    <section class="info border-bottom padding-block text-center">
        <!-- start container -->
        <div class="container">
            <!-- start row -->
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-lg-12">
                    <h3 class="title">What i’m doing</h3>
                </div>
            </div>
            <!-- end row -->
            <!-- start row -->
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-lg-12">
                    <div class="circle-block ">
                        <span class="icon hover-animate"><i class="fa fa-android"></i></span>
                        <span class="name hover-animate">Applications</span>
                    </div>
                    <div class="circle-block">
                        <span class="icon hover-animate"><i class="fa fa-desktop"></i></span>
                        <span class="name hover-animate">Web design</span>
                    </div>
                    <div class="circle-block">
                        <span class="icon hover-animate"><i class="fa fa-photo"></i></span>
                        <span class="name hover-animate">Illustrations</span>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
    <!-- End Info section -->
