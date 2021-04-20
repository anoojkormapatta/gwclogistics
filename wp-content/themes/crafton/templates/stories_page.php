<?php
/*
Template Name: Stories Page
*/

get_header();
?>

	<div class="intro small-intro" style="background-image: url(<?php the_field('intro_image'); ?>)"></div>
	<section class="head-info news-info">
		<ul class="breadcrumbs">
			<li><a href="<?= home_url() ?>"><?php _e('Home', 'gwc') ?></a></li>
			<li class="active"><?php _e('Stories', 'gwc') ?> <?= get_query_var('category_name') ?></li>
		</ul>
	
<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$perPage = get_option('posts_per_page');
$args = array(
		'post_type' => 'stories',
		'paged' => $paged,
		'posts_per_page' => $perPage
);

if($cat = get_query_var('category_name', false)) :
	$term = get_category_by_slug($cat);
	$term = pll_get_term($term->term_id);
	$term = get_category($term);
	$cat = $term->slug;
	$args['category_name'] = $cat;
endif;

query_posts($args);

if(have_posts()) : 
?>
	</section>
	<?php 

	$countPublishedPosts = pll_count_posts(pll_current_language(), array('post_type' => 'stories', 'category_name' => $cat));
	$sumPages = ceil($countPublishedPosts/$perPage);
	$list = true;

	while(have_posts()) :
		the_post();
		//get_template_part('subpage', 'stories');
		include(locate_template('subpage-stories.php', false, false ));
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
	<article class="stories">
		<div class="date"><?php _e('Not found any stories', 'gwc') ?></div>
	</article>
<?php
endif;

wp_reset_query();

get_footer();
