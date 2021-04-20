<?php
get_header('color');
the_post();
?>

<section class="head-info">
	<ul class="breadcrumbs">
		<li><a href="<?= home_url() ?>"><?php _e('Home', 'gwc') ?></a></li>
		<li class="active"><?php the_title() ?></li>
	</ul>
	<?php
	$category = get_the_category();
	$category = empty($category) || $category[0]->term_id === 1 ? __('Gulf ware housing') : $category[0]->name;
	?>
	<h2><?= $category ?></h2>
	<h1><?php the_title() ?></h1>
</section>

<article>
	<h3><?php the_field('subtitle') ?></h3>
	
	<?php get_template_part('subpage', 'advanced-content'); ?>
	
	<br /><br /><br />
</article>

<?php
get_footer();
