    <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              2015 - Ultraviolet - CV By.Verlyananda
              <a href="index.html#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url('gui/backend/assets/js/jquery.js');?>"></script>
    <script src="<?php echo base_url('gui/backend/assets/js/jquery-1.8.3.min.js');?>"></script>
    <script src="<?php echo base_url('gui/backend/assets/js/bootstrap.min.js');?>"></script>
    <script class="include" type="text/javascript" src="<?php echo base_url('gui/backend/assets/js/jquery.dcjqaccordion.2.7.js');?>"></script>
    <script src="<?php echo base_url('gui/backend/assets/js/jquery.scrollTo.min.js');?>"></script>
    <script src="<?php echo base_url('gui/backend/assets/js/jquery.nicescroll.js" type="text/javascript');?>"></script>
    <script src="<?php echo base_url('gui/backend/assets/js/jquery.sparkline.js');?>"></script>


    <!--common script for all pages-->
    <script src="<?php echo base_url('gui/backend/assets/js/common-scripts.js');?>"></script>
    
    <script type="text/javascript" src="<?php echo base_url('gui/backend/assets/js/gritter/js/jquery.gritter.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('gui/backend/assets/js/gritter-conf.js');?>"></script>

    <!--script for this page-->
    <script src="<?php echo base_url('gui/backend/assets/js/sparkline-chart.js');?>"></script>    
	<script src="<?php echo base_url('gui/backend/assets/js/zabuto_calendar.js');?>"></script>	
	<script type="text/javascript">
        $(document).ready(function () {
        var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'Welcome Back to Ultra CV Admin!   ',
            // (string | mandatory) the text inside the notification
            text: 'Ultraviolet CV By Verly Ananda,Build with CodeIgniter, If you like my job you can donate me transfer some Money 139 249 6984 a/n Elita BCA For buy some foods, Thanks...',
            // (string | optional) the image to display on the left
           
            sticky: true,
            // (int | optional) the time you want it to be alive for before fading out
            time: '',
            // (string | optional) the class name you want to apply to that specific message
            class_name: 'my-sticky-class'
        });

        return false;
        });
	</script>
	
	<script type="application/javascript">
        $(document).ready(function () {
            $("#date-popover").popover({html: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
                $(this).hide();
            });
        
            $("#my-calendar").zabuto_calendar({
                action: function () {
                    return myDateFunction(this.id, false);
                },
                action_nav: function () {
                    return myNavFunction(this.id);
                },
                ajax: {
                    url: "show_data.php?action=1",
                    modal: true
                },
                legend: [
                    {type: "text", label: "Special event", badge: "00"},
                    {type: "block", label: "Regular event", }
                ]
            });
        });
        
        
        function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }
    </script>
  

  </body>
</html>
