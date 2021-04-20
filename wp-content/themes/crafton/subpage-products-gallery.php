<?php
$args = array(
		'post_type' => 'product',
		'paged' => 1,
		'posts_per_page' => -1
);
query_posts($args);

if(have_posts()) :
?>
	<section>
		<h3><?php _e('Our Solutions', 'gwc') ?></h3>
		<div class="gallery">
		<?php
		while(have_posts()) :
			the_post();
			?>
			<div>
				<a href="<?php the_permalink() ?>" data-postid="<?= $post->ID ?>"><?php the_title() ?></a>
				<a href="<?php the_permalink() ?>" data-postid="<?= $post->ID ?>"><div class="picture" style="background-image: url(<?php the_field('picture') ?>);"></div></a>
			</div>
			<?php
		endwhile;
		?>
		</div>
	</section>
	<?php
else : echo '<br /><br />';
endif;

wp_reset_query();
?>
