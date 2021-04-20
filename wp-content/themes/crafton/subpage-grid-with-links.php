<section class="grid-with-links">
	<?php if (isset($is_part) && $is_part) : ?>
		<h2 class="title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
	<?php endif; ?>

	<article>
		<?= wpautop(get_field('description')); ?>
	</article>

	<div class="grid-container">
		<div class="content">
		<?PHP
			if (have_rows('items')):
				while(have_rows('items')) :
					the_row();

					$icon = get_sub_field('icon');
					$title = get_sub_field('title');
					$link = get_sub_field('link');
					$newWindow = get_sub_field('open_in_new_window');
		?>

					<div class="column">
						<?= file_get_contents(get_attached_file( $icon['id'] )); ?>
						<a href="<?= $link ?>"<?= $newWindow ? ' target="_blank"' : '' ?>><?= $title ?></a>
					</div>

		<?php
				endwhile;
			endif;
		?>
		</div>
	</div>
</section>