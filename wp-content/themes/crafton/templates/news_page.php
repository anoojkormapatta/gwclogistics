<?php
/*
Template Name: News Page
*/

get_header();

$intro = get_field('intro_image');

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$perPage = get_option('posts_per_page');
$args = array(
		'post_type' => 'news',
		'paged' => $paged,
		'posts_per_page' => $perPage
);
query_posts($args);

if(have_posts()) :
	the_post();
	?>
	<div class="intro" style="background-image: url(<?= ($i = get_field('intro_image')) ? $i : $intro ?>)"></div>
	<section class="head-info news-info">
		<ul class="breadcrumbs">
			<li><a href="<?= home_url() ?>"><?php _e('Home', 'gwc') ?></a></li>
			<li class="active"><?php _e('News', 'gwc') ?></li>
		</ul>
		<a href="<?php the_permalink() ?>">
			<div class="date"><?php the_time('F Y') ?></div>
			<h1><?php the_title() ?></h1>
			<div class="subtitle"><?php the_field('intro_subtitle') ?></div>
		</a>
	</section>
	<?php

	$countPublishedPosts = pll_count_posts(pll_current_language(), array('post_type' => 'news'));
	$sumPages = ceil($countPublishedPosts/$perPage);

	while(have_posts()) :
		the_post();
		//get_template_part('subpage', 'news');
		include(locate_template('subpage-news.php', false, false ));
    endwhile;

    ?>

    <?php if($paged > 1 || $paged < $sumPages) : ?>
    <div class="article-navigation">
    	<?php if($paged > 1) : ?>
    		<a href="<?php previous_posts(); ?>" class="button black prev-btn"><?php _e('Previous page', 'gwc') ?></a>
    	<?php endif; ?>

    	<?php if($paged < $sumPages) : ?>
    		<a href="<?php next_posts(); ?>" class="button black next-btn"><?php _e('Next page', 'gwc') ?></a>
    	<?php endif; ?>
    </div>
    <?php
    endif;
else :
?>
	</section>
	<article class="news-block">
		<div class="date"><?php _e('Not found any news', 'gwc') ?></div>
	</article>
<?php
endif;

wp_reset_query();

if(intval($countPublishedPosts) > 1) get_template_part('subpage', 'history');

get_footer();
