<?php foreach ($data_footers->result() as $verlitampil); ?>
        <!-- Start Footer section -->
        <footer class="footer">
            <!-- start container -->
            <div class="container">
                <!-- start row -->
                <div class="row">
                    <!-- start phone number -->
                    <div class="col-xs-12 col-sm-6 col-lg-3">
                        <a href="#" class="hover-animate">
                            <span class="ukie-icons hover-animate"><i class="fa fa-phone"></i></span><?php echo $verlitampil->notelp;?>
                        </a>
                    </div>
                    <!-- end phone number -->
                    <!-- start email -->
                    <div class="col-xs-12 col-sm-6 col-lg-3">
                        <a href="#" class="hover-animate">
                            <span class="ukie-icons hover-animate"><i class="fa fa-paper-plane"></i></span> <?php echo $verlitampil->email;?>
                        </a>
                    </div>
                    <!-- end email -->
                    <!-- start address -->
                    <div class="col-xs-12 col-sm-6 col-lg-3">
                        <a href="#" class="hover-animate">
                            <span class="ukie-icons hover-animate"><i class="fa fa-map-marker"></i></span><?php echo $verlitampil->lokasi;?>
                        </a>
                    </div>
                    <!-- end address -->
                    <!-- start Copyright -->
                    <div class="col-xs-12 col-sm-6 col-lg-3 text-right">
                        <span class="copyright"><?php echo $verlitampil->copyright;?></span>
                    </div>
                    <!-- end Copyright -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </footer>
        <!-- End Footer section -->

    </div>

    <!-- Scroll to Top -->
    <a href="#" class="btn scrollToTop"><i class="fa fa-angle-up"></i></a>
    <!-- End Scroll to Top -->

    <!-- Style Switcher -->
    <!-- delete this from site once you have decided on a colour scheme - follow documentation for insructions -->
    <div class="style-switcher style-off">

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-lg-12 text-center">

                    <div class="switch-colours clearfix">
                        <div class="set clearfix">

                            <h3 class="lighter">Select A Color</h3>

                            <a href="color-blue.html" class="new-colour color-blue" id="color-blue" data-color="#00b6f9"></a>
                            <a href="color-orange.html" class="new-colour color-orange" id="color-orange" data-color="#ffc400"></a>
                            <a href="color-purple.html" class="new-colour color-purple" id="color-purple" data-color="#7c4dff"></a>
                            <a href="color-green.html" class="new-colour color-green" id="color-green" data-color="#9ccc65"></a>
                            <a href="color-red.html" class="new-colour color-red" id="color-red" data-color="#ff7043"></a>
                            <a href="color-brown.html" class="new-colour color-brown" id="color-brown" data-color="#ae8c64"></a>

                            <h3 class="lighter">Select A Background</h3>
                            <a href="bg-white.html" class="new-bg bg-white" data-bg="#ffffff"></a>
                            <a href="bg-grey.html" class="new-bg bg-grey" data-bg="#f5f5f5"></a>
                            <a href="bg-light-blue.html" class="new-bg bg-light-blue" data-bg="#cfd8dc"></a>
                            <a href="bg-dark-blue.html" class="new-bg bg-dark-blue" data-bg="#263238"></a>
                            <a href="bg-dark-purple.html" class="new-bg bg-dark-purple" data-bg="#1e1f38"></a>
                            <a href="bg-brown.html" class="new-bg bg-brown" data-bg="#383231"></a>

                        </div>
                        <!-- end set -->
                    </div>

                    <div class="style-open">
                        <i class="fa fa-tint"></i>
                    </div>
                    <!-- end style-open -->

                </div>
            </div>
            <!-- end row -->


    </div>
    <!-- end Style Switcher -->

<!-- Scripts -->
<script src="<?php echo base_url('gui/assets/js/jquery-1.11.2.min.js');?>"type="text/javascript"></script>
<script src="<?php echo base_url('gui/assets/boostrap-files/js/bootstrap.min.js');?>"type="text/javascript"></script>
<script src="<?php echo base_url('gui/assets/js/jquery.appear.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('gui/assets/js/jquery.nicescroll.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('gui/assets/js/jquery.mixitup.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('gui/assets/js/jquery.magnific-popup.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('gui/assets/js/owl.carousel.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('gui/assets/js/jquery.inview.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('gui/assets/js/jquery.knob.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('gui/assets/js/jquery.cookie.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('gui/assets/js/portfolio_scripts.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('gui/assets/js/scripts.js');?>" type="text/javascript"></script>

</body>

</html>