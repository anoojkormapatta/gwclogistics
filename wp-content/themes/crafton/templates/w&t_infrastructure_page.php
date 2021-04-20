<?php
/*
Template Name: Warehousing/Transfort Infrastructure Page
*/

get_header();
?>

	<div class="intro" style="background-image: url(<?php the_field('intro_image'); ?>)"></div>
	<section class="head-info news-info">
		<ul class="breadcrumbs">
			<li><a href="<?= home_url() ?>"><?php _e('Home', 'gwc') ?></a></li>
			<li class="active"><?php the_title() ?></li>
		</ul>
		<h1><?php the_title() ?></h1>
	</section>

	<?php get_template_part('subpage', 'flexible-page-with-tables'); ?>
	
<?php
get_footer();
?>