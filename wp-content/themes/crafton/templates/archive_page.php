<?php
/*
 Template Name: Archive Page
 */

get_header('color');
?>

	<section class="head-info">
	<ul class="breadcrumbs">
		<li><a href="<?= home_url() ?>"><?php _e('Home', 'gwc') ?></a></li>
		<li class="active"><?php the_title() ?></li>
	</ul>

<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$perPage = max(array(get_option('posts_per_page'), 10));
$args = array(
		'post_type' => 'post',
		'paged' => $paged,
		'posts_per_page' => $perPage,
);
query_posts($args);

if(have_posts()) :
?>
	</section>
	<main class="search-content">
	<?php

	$countPublishedPosts = pll_count_posts(pll_current_language(), array('post_type' => 'post'));
	$sumPages = ceil($countPublishedPosts/$perPage);
	$list = true;

	while(have_posts()) :
		the_post();

		$category = get_the_category();
		$category = empty($category) || $category[0]->term_id === 1 ? __('Gulf ware housing') : $category[0]->name;
		?>
		<article class="search-item">
			<a href="<?php the_permalink() ?>">
				<div class="date"><?php the_time('d F Y') ?></div>
				<h4><?= $category ?></h4>
				<h3><?php the_title() ?></h3>
			</a>
		</article>
		<?php
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
    ?>
    </main>
    <?php
else :
?>
	</section>
	<main class="search-content">
		<article class="search-item">
			<div class="date"><?php _e('Not found any posts', 'gwc') ?></div>
		</article>
	</main>
<?php
endif;

wp_reset_query();

get_footer();
