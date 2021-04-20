<?php
the_post();
if(is_ajax()) :
	get_template_part('subpage', 'products');
else :
	get_header('color');
?>
	<section class="head-info">
		<ul class="breadcrumbs">
			<li><a href="<?= home_url() ?>"><?php _e('Home', 'gwc') ?></a></li>
			<li><a href="<?php ($pid = pll_get_post(252)) ? the_permalink($pid) : '#' ?>"><?php _e('Solutions', 'gwc') ?></a></li>
			<li class="active"><?php the_title() ?></li>
		</ul>
	</section>	

	<?php get_template_part('subpage', 'products'); ?>

<?php
	get_footer();
endif;