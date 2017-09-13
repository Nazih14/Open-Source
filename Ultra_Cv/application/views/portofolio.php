
    <!-- Start Portfolio section -->
    <div class="portfolio-section padding-block">
        <!-- start container -->
        <div class="container">
            <!-- start row -->
            <div class="row">
                    <!-- Portfolio -->
                  <div class="portfolio">

                        <div class="filter_div controls">
                            <div class="col-xs-12 col-sm-12 col-lg-11">
                                <ul>
                                    <li class="hover-animate filter active" data-filter="all">All</li>
                                </ul>
                            </div>
                        </div>
                           <div id="portfolio-grid">
                        <?php foreach ($portos->result() as $tampiver) {?>
                    
                            <div class="mix col-xs-12 col-sm-6 col-lg-4 portfolio-item category-2">
                                <div class="within">

                                    <img src="<?php echo base_url('assets/img_porto/'.$tampiver->img_porto.'');?>" alt="Alt">
                                    <div class="port-item-cont">
                                        <h3 class="title"><?php echo $tampiver->judul;?></h3>
                                        <p class="desc">Your Project description</p>
                                        <a href="#" class="popup-content view-work hover-animate">View details</a>
                                    </div>

                                    <div class="hidden">
                                        <div class="podrt-desc">
                                            <div class="modal-box-content">
                                                <img src="<?php echo base_url('assets/img_porto/'.$tampiver->img_porto.'');?>" alt="Alt">
                                                <button class="mfp-close"></button>
                                                <div class="text">
                                                    <h3 class="title"><?php echo $tampiver->judul;?></h3>
                                                    <table>
                                                        <tr>
                                                            <td class="font-weight-m width-td">Completed</td>
                                                            <td><?php echo $tampiver->completed;?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="font-weight-m">Client</td>
                                                            <td><?php echo $tampiver->client;?></td>
                                                        </tr>
                                                    </table>
                                                    <p><?php echo $tampiver->desc;?>....</p>
                                                    <a href="#" class="btn btn-color">See Live</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                          
                          <?php      } ?>
                            


                        </div>

                    </div>
                           
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- End Portfolio section -->

