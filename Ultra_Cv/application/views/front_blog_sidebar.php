 <div class="col-xs-12 col-sm-12 col-lg-4">
                    <!-- start slidebar -->

                    <aside class="widget widget_categories">
                        <h3 class="widget-title">Categories</h3>
                        <ul>
                        <?php foreach ($sidebar->result() as $kat) {?>
                                                
                            <li class="cat-item cat-item-6"><a href="<?php echo base_url('index.php/frontend/blog_category/'.$kat->id_category.' ');?>"><?php echo $kat->name_category;?></a></li>
                         <?php } ?>
                          
                        </ul>
                    </aside>

                  
                  

                    <!-- end slidebar -->
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>