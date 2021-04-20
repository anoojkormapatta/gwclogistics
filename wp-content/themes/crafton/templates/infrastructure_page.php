<?php
/*
Template Name: Infrastructure Page
*/

get_header('color');
?>

<section class="head-info">
	<ul class="breadcrumbs">
		<li><a href="<?= home_url() ?>"><?php _e('Home', 'gwc') ?></a></li>
		<li class="active"><?php the_title() ?></li>
	</ul>
	<h1><?php the_title() ?></h1>
</section>

<?php get_template_part('subpage', 'infrastructure'); ?>

<?php
get_footer();
