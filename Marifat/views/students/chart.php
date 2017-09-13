<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section class="content-header">
   <h1><i class="fa fa-bar-chart text-green"></i> <?=ucwords(strtolower($title));?></h1>
 </section>
 <section class="content">
 	<div class="panel panel-default">
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
					   text: 'Grafik Peserta Didik Berdasarkan Status Peserta Didik'
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
 </section>