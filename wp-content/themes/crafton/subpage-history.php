<div class="history">
<?php
$currentId = intval($post->ID);
$args = array(
		'post_type' => 'news',
		'paged' => 1,
		'posts_per_page' => 6
);
query_posts($args);

$yearly_archive = wp_get_archives(array( 'type' => 'yearly', 'post_type' => 'news', 'echo' => '0') );
?>

	<div class="history__year">
		<div class="title"><?= _e('Filter by year', 'gwc') ?></div>
			<div class="item">
				<?php echo str_replace('<a', '<a target="_blank" ', $yearly_archive); ?>
			</div>
	</div>

<?php
if(have_posts()) :
	?>
		<div class="title"><?= _e('Latest', 'gwc') ?></div>
	<?php
	while(have_posts()) :
		the_post();
		$time = time_interval();
		?>
		<a <?= $post->ID != $currentId ? 'href="'.get_permalink().'"' : '' ?> class="<?= $post->ID == $currentId ? 'active' : '' ?>">
			<div class="item">
				<div class="category"><?= $time ?></div>
				<div><?= the_title() ?></div>
				<div class="picture" style="background-image:url('<?php the_field('intro_image') ?>')"></div>
			</div>
		</a>
		<?php
	endwhile;
endif;

wp_reset_query();

$args = array(
		'post_type' => 'post',
		'paged' => 1,
		'posts_per_page' => 6
);
query_posts($args);

if(have_posts()) :
	?>
		<div class="title"><?= _e('Blog', 'gwc') ?></div>
	<?php
	while(have_posts()) :
		the_post();
		$time = time_interval();
		$picture = '';

		if(have_rows('section')) :
			while(have_rows('section')) :
				the_row();

				if(get_sub_field('section_type') == 2) :
					$picture = get_sub_field('picture');
					break;
				endif;
			endwhile;
		endif;
		?>
		<a <?= $post->ID != $currentId ? 'href="'.get_permalink().'"' : '' ?> class="<?= $post->ID == $currentId ? 'active' : '' ?>">
			<div class="item">
				<div class="category"><?= $time ?></div>
				<div><?= the_title() ?></div>
				<div class="picture" style="background-image:url('<?= $picture ?>')"></div>
			</div>
		</a>
		<?php
	endwhile;
endif;

wp_reset_query();
?>

</div>
