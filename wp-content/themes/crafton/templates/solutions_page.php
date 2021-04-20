<?php
/*
Template Name: Solutions Page
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

<article>
	<h3><?php the_field('subtitle') ?></h3>
	
	<?php get_template_part('subpage', 'advanced-content'); ?>
	
	<?php get_template_part('subpage', 'products-gallery'); ?>
	
</article>
	
<?php
get_footer();
