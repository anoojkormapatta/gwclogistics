<div class="stock-observation tab-panel tp3">
	<div class="tabs visible-block">
		<div data-rel="tp3-1" class="active"><?= $data['tab_1_title'] ?></div>
		<?php if($data['tab_2_visible']) : ?>
		<div data-rel="tp3-2"><?= $data['tab_2_title'] ?></div>
		<?php endif; ?>
	</div>
	<div class="tabs-content">
		<div id="tp3-1" class="active internal-content">
			<?php $subdata = $data['tab_1'] ?>
			<?php include(locate_template('subpage-stock-observation.php', false, false)); ?>
		</div>
		<?php if($data['tab_2_visible']) : ?>
		<div id="tp3-2" class="internal-content">
			<?php $subdata = $data['tab_2'] ?>
			<?php include(locate_template('subpage-stock-observation.php', false, false)); ?>
		</div>
		<?php endif; ?>
	</div>
</div>
