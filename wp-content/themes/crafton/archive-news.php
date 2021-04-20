<?php

get_header('color');

?>

<section class="head-info">
	<h1><?php echo get_the_archive_title(); ?> - <?php _e('News Archive', 'gwc') ?></h1>
</section>
<main class="search-content">
<?php

if(have_posts()) : while(have_posts()) : the_post();

?>

	<article class="search-item">
		<a href="<?php echo get_permalink(); ?>" title="<?php the_title(); ?>">
			<div class="date"><?php echo get_the_date(); ?></div>
			<h3><?php the_title(); ?></h3>
		</a>
	</article>

<?php

endwhile; endif;

?>

<div class="article-navigation">
	<?php previous_posts_link('<span class="button black next-btn">' . __('Newer news', 'gwc') . '</span>'); ?>
	<?php next_posts_link('<span class="button black prev-btn">' . __('Older news', 'gwc') . '</span>'); ?>
</div>

<?php
wp_reset_query();
?>

</main>

<?php
get_footer();
?>
