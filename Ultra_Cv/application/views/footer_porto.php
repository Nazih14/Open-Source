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

<!-- Scripts -->
<!-- Scripts -->
<script src="<?php echo base_url('gui/assets/js/jquery-1.11.2.min.js');?>"            type="text/javascript"></script>

<script src="<?php echo base_url('gui/assets/boostrap-files/js/bootstrap.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('gui/assets/js/jquery.appear.js');?>"                type="text/javascript"></script>
<script src="<?php echo base_url('gui/assets/js/jquery.nicescroll.min.js');?>"        type="text/javascript"></script>
<script src="<?php echo base_url('gui/assets/js/jquery.mixitup.min.js');?>"           type="text/javascript"></script>
<script src="<?php echo base_url('gui/assets/js/jquery.magnific-popup.min.js');?>"    type="text/javascript"></script>
<script src="<?php echo base_url('gui/assets/js/owl.carousel.min.js');?>"             type="text/javascript"></script>
<script src="<?php echo base_url('gui/assets/js/jquery.inview.min.js');?>"            type="text/javascript"></script>
<script src="<?php echo base_url('gui/assets/js/jquery.knob.min.js');?>"              type="text/javascript"></script>
<script src="<?php echo base_url('gui/assets/js/portfolio_scripts.js');?>"            type="text/javascript"></script>
<script src="<?php echo base_url('gui/assets/js/jquery.cookie.js');?>"                type="text/javascript"></script>
<script src="<?php echo base_url('gui/assets/js/scripts.js');?>"                      type="text/javascript"></script>
</body>

</html>