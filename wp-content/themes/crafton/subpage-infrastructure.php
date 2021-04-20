<section class="infrastructure">
	<?php if(isset($is_part) && $is_part) : ?>
	<h2 class="title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
	<?php endif; ?>
	<div class="content world-map">
		<div class="column narrow description">
			<div>
				<h3 class="subtitle"><?php the_field('subtitle') ?></h3>
				<p><?php the_field('description') ?></p>
			</div>
		</div>
		<div class="column wide stats">
			<div class="hubs-info">
				<h3 class="subtitle"><?php the_field('logistics_stats_label') ?></h3>
				<?php have_rows('logistics_stats') && the_row(); ?>
				<div class="info-row content">
					<div class="column jsOdometer"><?php echo number_format(get_sub_field('value'), 0, '.', ','); ?></div>
					<div class="column subdescription"><?php the_sub_field('description') ?></div>
				</div>
				<svg class="icon icon-hub"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-hub"></use></svg>
				<span class="icon-round"></span>
			</div>
			<div class="area-info">
				<?php have_rows('logistics_stats') && the_row(); ?>
				<div class="info-row content">
					<div class="column jsOdometer"><?php echo number_format(get_sub_field('value'), 0, '.', ','); ?></div>
					<div class="column subdescription"><?php the_sub_field('description') ?></div>
				</div>
			</div>
			<div class="builds-info content">
				<?php have_rows('additional_stats') && the_row(); ?>
				<div class="column">
					<h3 class="subtitle"><?php the_sub_field('label') ?></h3>
					<div class="info-row jsOdometer"><?php echo number_format(get_sub_field('value'), 0, '.', ','); ?></div>
					<div class="subdescription"><?php the_sub_field('description') ?></div>
				</div>
				<?php have_rows('additional_stats') && the_row(); ?>
				<div class="column">
					<h3 class="subtitle"><?php the_sub_field('label') ?></h3>
					<div class="info-row jsOdometer"><?php echo number_format(get_sub_field('value'), 0, '.', ','); ?></div>
					<div class="subdescription"><?php the_sub_field('description') ?></div>
				</div>
			</div>
		</div>
	</div>
	<div class="footer-stats content">
		<?php have_rows('footer_stats') && the_row(); ?>
		<div class="column stat-info"><?php the_sub_field('value') ?><br />
			<svg class="icon icon-Trucks"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-Trucks"></use></svg>
			<div class="hint"><?php the_sub_field('label') ?></div>
		</div>
		<div class="column stat-info separator"><i></i></div>
		<?php have_rows('footer_stats') && the_row(); ?>
		<div class="column stat-info"><?php the_sub_field('value') ?><br />
			<svg class="icon icon-Capital"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-Capital"></use></svg>
			<div class="hint"><?php the_sub_field('label') ?></div>
		</div>
		<div class="column stat-info separator"><i></i></div>
		<?php have_rows('footer_stats') && the_row(); ?>
		<div class="column stat-info"><?php the_sub_field('value') ?><br />
			<svg class="icon icon-Servers"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-Servers"></use></svg>
			<div class="hint"><?php the_sub_field('label') ?></div>
		</div>
		<div class="column stat-info separator"><i></i></div>
		<?php have_rows('footer_stats') && the_row(); ?>
		<div class="column stat-info"><?php the_sub_field('value') ?><br />
			<svg class="icon icon-Office"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-Office"></use></svg>
			<div class="hint"><?php the_sub_field('label') ?></div>
		</div>
	</div>
	&nbsp;
</section>