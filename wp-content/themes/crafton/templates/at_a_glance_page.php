<?php
/*
Template Name: At A Glance Page
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
	<div class="content">
		<div>
			<?php if(($before = get_field('before_subtitle'))) echo "<h4>$before</h4>" ?>
			<h3><?php the_field('subtitle') ?></h3>
		</div>
		<div></div>
	</div>

	<?php get_template_part('subpage', 'advanced-content'); ?>

	<?php
	$args = array(
			'post_type' => 'award',
			'nopaging' => true
	);
	query_posts($args);

	if(have_posts()) :
	?>
		<section class="hm">
			<div class="subtitle"><?php _e('Awards', 'gwc') ?></div>
			<div class="gallery gallery-scrollable with-desc noJs">
			<?php
			while(have_posts()) :
				the_post();
				?>
				<div>
					<h4><?php the_time('Y') ?></h4>
					<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
					<a href="<?php the_permalink() ?>"><div class="picture" style="background-image: url(<?php the_field('picture') ?>);"></div></a>
					<p><?php the_field('description'); ?></p>
				</div>
				<?php
			endwhile;
			?>
			</div>
		</section>
		<?php
	endif;

	wp_reset_query();
	?>
	
	<?php
	$args = array(
			'post_type' => 'certificate',
			'nopaging' => true
	);
	query_posts($args);

	if(have_posts()) :
	?>
		<section class="hm">
			<div class="subtitle"><?php _e('Certificates', 'gwc') ?></div>
			<div class="gallery gallery-scrollable with-desc noJs thin-title">
			<?php
			while(have_posts()) :
				the_post();
				?>
				<div>
					<h4><?php the_time('Y') ?></h4>
					<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
					<a href="<?php the_permalink() ?>"><div class="picture" style="background-image: url(<?php the_field('picture') ?>);"></div></a>
					<p><?php the_field('description') ?></p>
				</div>
				<?php
			endwhile;
			?>
			</div>
		</section>
		<?php
	endif;

	wp_reset_query();
	?>

</article>

<?php
get_footer();
