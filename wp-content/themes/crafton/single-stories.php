<?php
get_header();
the_post();
?>
	<div class="intro" style="background-image: url(<?php the_field('intro_image'); ?>)"></div>

	<section class="head-info">
		<ul class="breadcrumbs">
			<li><a href="<?= home_url() ?>"><?php _e('Home', 'gwc') ?></a></li>
			<li><a href="<?php ($pid = pll_get_post(223)) ? the_permalink($pid) : '#' ?>"><?php _e('Stories', 'gwc') ?></a></li>
			<li class="active"><?php _e('Global trade story', 'gwc') ?></li>
		</ul>
		<h2><?php the_field('subtitle') ?></h2>
		<h1><?php the_field('description') ?></h1>
	</section>
	<?php 
		get_template_part('subpage', 'stories');
	?>

<?php
get_footer();
