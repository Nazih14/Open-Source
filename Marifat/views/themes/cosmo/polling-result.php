<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script src="<?=base_url('assets/js/Chart.js');?>"></script>
<div class="col-xs-12 col-md-9">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="fa fa-bar-chart"></i> <?=strtoupper($title)?></h3>
		</div>
		<div class="panel-body">
			<canvas id="buildChart"></canvas>
			<script>
			var ctx = document.getElementById("buildChart");
			var buildChart = new Chart(ctx, {
			    type: 'bar',
			    data: {
			        labels: <?=$labels;?>,
			        datasets: [{
			            label: '',
			            data: <?=$data;?>,
			            borderWidth: 2,
			            backgroundColor: 'rgba(75, 192, 192, 0.2)',
			            borderColor: 'rgba(75, 192, 192, 1)'
			        }]
			    },
			    options: {
					title: {
					   display: true,
					   text: '<?=$question;?>'
					},
					responsive: true,
					scales: {
		            yAxes: [{
		                ticks: {
		                    beginAtZero:true
		                }
		            }]
		        }
			   }
			});
			</script>
		</div>
	</div>
</div>
<?php $this->load->view('themes/cosmo/sidebar')?>