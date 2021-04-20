<?php
the_post();
$intro = get_field('intro_image');
$countPublishedPosts = pll_count_posts(pll_current_language(), array('post_type' => 'news'));

get_header($intro ? null : 'color');
?>
	<?php if($intro) : ?>
	<div class="intro" style="background-image: url(<?= $intro; ?>)"></div>
	<?php endif; ?>

	<section class="head-info<?= $intro ? ' news-info' : '' ?>">
		<ul class="breadcrumbs">
			<li><a href="<?= home_url() ?>"><?php _e('Home', 'gwc') ?></a></li>
			<li><a href="<?php ($pid = pll_get_post(118)) ? the_permalink($pid) : '#' ?>"><?php _e('News', 'gwc') ?></a></li>
			<li class="active"><?php the_title() ?></li>
		</ul>
	</section>
	<?php 
		//get_template_part('subpage', 'news');
		include(locate_template('subpage-news.php', false, false));
	?>

<?php
if(intval($countPublishedPosts) > 1) get_template_part('subpage', 'history');

get_footer();
