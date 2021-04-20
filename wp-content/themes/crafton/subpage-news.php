<?php
	$post_date = get_the_time('F Y', $post->ID);
?>

<article class="news-block <?= intval($countPublishedPosts) < 1 ? 'no-padding-left' : '' ?>">
	<div class="date"><?= $post_date ?></div>
	<div class="article-action text-right">
		<div class="rounded inline sharing">
			<a class="jsShare-it white" data-href="<?php the_permalink() ?>" data-title="<?php the_title() ?>">
				<div class="social">
					<svg class="icon icon-share"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-share"></use></svg>
				</div>
			</a>
		</div>
		<div class="rounded inline printing">
			<a class="jsPrint white" data-url="<?php the_permalink() ?>">
				<svg class="icon icon-print"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-print"></use></svg>
			</a>
		</div>
	</div>
	<h3><?php the_title() ?></h3>
	<?php the_tags('<div class="tags">', '', '</div>') ?>

	<?php
		if (have_rows('paragraph')):
			while(have_rows('paragraph')) :
				the_row();

				$subtitle = get_sub_field('subtitle');
				$hint = get_sub_field('hint');
				$paragraphs = get_sub_field('text_block');
				$picture = get_sub_field('picture');
				$picture_label = get_sub_field('picture_label');
				$picture_pin_left = get_sub_field('picture_pin_left');
				$picture_pin_right = get_sub_field('picture_pin_right');
				$picture_link = get_sub_field('picture_link');
				$quote_custom_title = get_sub_field('quote_custom_title');
				$quote = get_sub_field('quote');
				$quote_author = get_sub_field('quote_author');

				if (!empty($subtitle)) :
					?>
					<div class="subtitle"><?= $subtitle ?></div>
					<?php
				endif;

				if (!empty($hint)) :
					?>
					<div class="hint"><?= $hint ?></div>
					<?php
				endif;

				if (!empty($paragraphs)) :
					foreach ($paragraphs as $p)  {
						$p_block = trim(str_replace(array('<p>', '&nbsp;</p>', '</p>'), array('', '', '<br>'), $p['block']));
						echo '<p>' . $p_block . '</p>';
					}
				endif;

				if (!empty($picture)) :
					?>
					<figure class="<?= $picture_pin_left ? 'pin-left' : ($picture_pin_right ? 'pin-right' : 'right-expand') ?>">
						<?php
						if (!empty($picture_link)) :
							?>
							<a href="<?= $picture_link ?>" target="_blank">
						<?php endif; ?>
						<img src="<?= $picture ?>" alt="A marque of GWC Group" />
						<?php
						if (!empty($picture_link)) :
						?>
							</a>
							<?php
						endif;
							?>
						<?php if (!empty($picture_label)) : ?>
							<figcaption><?= $picture_label ?></figcaption>
						<?php endif; ?>
					</figure>
					<?php
				endif;

				if (!empty($quote)) :
					?>
					<blockquote>
						<div class="caption">
							<?php
								if ($quote_custom_title) :
									echo $quote_custom_title;
								endif;
							?>
						</div>
						<p><?= $quote ?></p>
						<div class="rounded sharing">
							<a class="jsShare-it white">
								<div class="social">
									<svg class="icon icon-share"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-share"></use></svg>
								</div>
							</a>
						</div>
						<?php if (!empty($quote_author)) : ?>
							<div class="description">
								<div class="caption"><?php _e('Author', 'gwc'); ?></div>
								<?= $quote_author ?>
							</div>
						<?php endif; ?>
					</blockquote>
					<?php
				endif;

			endwhile;
		endif;
	?>

	<section class="more-info">
		<div class="article-action text-right">
			<div class="rounded inline sharing">
				<a class="jsShare-it white" data-href="<?php the_permalink() ?>" data-title="<?php the_title() ?>">
					<div class="social">
						<svg class="icon icon-share"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-share"></use></svg>
					</div>
				</a>
			</div>
			<div class="rounded inline printing">
				<a class="jsPrint white">
					<svg class="icon icon-print"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-print"></use></svg>
				</a>
			</div>
		</div>

		<?php /*?><h3><?php _e('Share the news', 'gwc') ?></h3><?php */ ?>
	</section>
</article>
