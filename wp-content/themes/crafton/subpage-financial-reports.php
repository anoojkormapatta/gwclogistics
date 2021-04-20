<div class="financial-reports tab-panel tp2">
	<div class="tabs <?= isset($subclass) ? $subclass : '' ?>">
		<?php 
			$reports = get_field('financial_reports');
			$reports = array_reverse($reports);
			$activeTab = count($reports);
			foreach($reports as $i=>$data) :
				$i++;
				if($data['year'] == date("Y")) $activeTab = $i;
		?>
			<div data-rel="tp2-<?= $i ?>"<?= $activeTab == $i ? ' class="active"' : '' ?>><?= $data['year'] ?></div>
		<?php 
			endforeach; 
		?>
	</div>
	<div class="tabs-content">
		<?php 
			foreach($reports as $i=>$data) : 
				$i++;
		?>
		<div id="tp2-<?= $i ?>" class="internal-content<?= $activeTab == $i ? ' active' : '' ?>">
			<?php include(locate_template('subpage-financial-report-year.php', false, false)); ?>
		</div>
		<?php 
			endforeach; 			
		?>
	</div>
</div>