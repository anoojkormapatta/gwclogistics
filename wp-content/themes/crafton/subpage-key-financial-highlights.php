<div class="kf-highlights">
	<?php while(have_rows('kfh')) : the_row(); ?>

	<div>
		<div class="chart-wrapper">
			<div class="pieContainer">
			  <div class="innerCircle"><div class="label" data-max="<?= max(array(get_sub_field('value'), get_sub_field('max_value'))) ?>"><?php the_sub_field('value') ?></div><span><?php the_sub_field('unit') ?></span></div>
			</div>
			<div class="title"><?php the_sub_field('label') ?><div><?php the_sub_field('period') ?></div></div>
			<svg class="icon icon-kfh-shape"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-kfh-shape"></use></svg>
		</div>
	</div>
	
	<?php endwhile; ?>
</div>