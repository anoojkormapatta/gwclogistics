<?php
	$quarters = $data['quarter'];
?>

<div class="content">
	<div class="column col-helper">
		<div class="content">
			<?php 
				if(isset($quarters[0])) : 
					$data = $quarters[0]; 
					$data['idx'] = 1; 
					include(locate_template('subpage-financial-report-quarter.php', false, false));
				else:
					echo '<div class="column q-stats"></div>';
				endif;
				if(isset($quarters[1])) :
					$data = $quarters[1];
					$data['idx'] = 2;
					include(locate_template('subpage-financial-report-quarter.php', false, false));
				else:
					echo '<div class="column q-stats"></div>';
				endif;
			?>
		</div>
	</div>
	<div class="column col-helper">
		<div class="content">
			<?php 
				if(isset($quarters[2])) : 
					$data = $quarters[2]; 
					$data['idx'] = 3; 
					include(locate_template('subpage-financial-report-quarter.php', false, false));
				else:
					echo '<div class="column q-stats"></div>';
				endif;
				if(isset($quarters[3])) :
					$data = $quarters[3];
					$data['idx'] = 4;
					include(locate_template('subpage-financial-report-quarter.php', false, false));
				else:
					echo '<div class="column q-stats"></div>';
				endif;
			?>
		</div>
	</div>
</div>