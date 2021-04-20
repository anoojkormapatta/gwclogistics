<section class="slider">
	<ul class="<?= count(get_field('intro_slider'))>1?'jsBxslider':'' ?>">
		<?php
			if (have_rows('intro_slider')):
				$internal_caption = false;
				$items_count = 0;

				while (have_rows('intro_slider')):
					the_row();

					$items_count++;

					$image = get_sub_field('image');
					$title = get_sub_field('title');
		?>
						<li>
							<img src="<?= $image; ?>" alt="<?= $title ?: get_field('intro_text') ?>" />
							<?php if (!empty($title)) :
								$internal_caption = true;
								?>
								<p><?= $title ?></p>
							<?php endif; ?>
						</li>
		<?php
				endwhile;
			endif;
		?>
	</ul>

	<?php /* Move this section to specified slide if required */ ?>
	<?php if (!$internal_caption && !empty(get_field('intro_text'))) : ?>
		<p><?php the_field('intro_text') ?></p>
	<?php endif; ?>
	</div>
</section>