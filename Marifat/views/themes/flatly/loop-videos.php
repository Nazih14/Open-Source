<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="col-xs-12 col-md-12">
	<ol class="breadcrumb post-header">
		<li><i class="fa fa-film"></i> GALLERY VIDEO</li>
	</ol>
	<?php $idx = 3; $rows = $query->num_rows(); foreach($query->result() as $row) { ?>
		<?=($idx % 3 == 0) ? '<div class="row">':''?>
			<div class="col-md-4 col-xs-12">
				<div class="thumbnail">
					<?=$row->post_content?>				
					<div class="caption">
						<h4><?=$row->post_title?></h4>
					</div>
				</div>
			</div>
		<?=(($idx % 3 == 2) || ($rows+2 == $idx)) ? '</div>':''?>
	<?php $idx++; } ?>
</div>