<?php
	$post_date = get_the_time('F, Y', $post->ID);
?>

<article class="stories">
	<div class="date"><?= $post_date ?></div>
	<h3><?php the_title() ?></h3>
	<div class="rounded sharing">
		<a class="jsShare-it white" data-href="<?php the_permalink() ?>" data-title="<?php the_title() ?>">
			<div class="social">
				<svg class="icon icon-share"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-share"></use></svg>
			</div>
		</a>
	</div>

	<?php
     	if(have_rows('section')):
     		while(have_rows('section')) :
     			the_row();

     			$type = get_sub_field('section_type');

     			switch($type) :
					case 1:
	     				$subtitle = get_sub_field('subtitle');
	     				$hint = get_sub_field('hint');
	     				$paragraphs = get_sub_field('text_block');

	     				if(!empty($subtitle)) :
	     				?>
				     		<div class="subtitle"><?= $subtitle ?></div>
			     		<?php
				     	endif;

						if(!empty($hint)) :
						?>
							<div class="hint"><?= $hint ?></div>
						<?php
						endif;

						if(!empty($paragraphs)) :
							foreach($paragraphs as $p) :
								$classes = array();
								$p['is_lead'] && $classes[] = 'lead';
								$p['is_narrow'] && $classes[] = 'narrow';
								echo '<p'.(!empty($classes) ? ' class="'.implode(' ', $classes).'"' : '').'>'.str_replace('&nbsp;', ' ', nl2br($p['paragraph'])).'</p>';
							endforeach;
						endif;

     					break;
					case 2:
						$picture = get_sub_field('picture');
						$picture_label = get_sub_field('picture_label');
						$picture_pin_left = get_sub_field('picture_pin_left');
						$picture_expanded_to_left = get_sub_field('picture_expanded_to_left');
						$picture_expanded_to_right = get_sub_field('picture_expanded_to_right');

						if(!empty($picture)) :
						?>
							<figure class="<?= $picture_pin_left ? 'pin-left' : '' ?> <?= $picture_expanded_to_left ? 'left-expand' : '' ?> <?= $picture_expanded_to_right ? 'right-expand' : '' ?>">
								<img src="<?= $picture ?>" alt="<?= $picture_label ?>" />
								<?php if(!empty($picture_label)) : ?>
									<figcaption><?= $picture_label ?></figcaption>
								<?php endif; ?>
							</figure>
						<?php
						endif;

						break;
					case 3:
						$quote = get_sub_field('quote');
						$quote_author = get_sub_field('quote_author');
						$quote_custom_title = get_sub_field('quote_custom_title');
						$quote_pin_left = get_sub_field('quote_pin_left');
						$quote_pin_right = get_sub_field('quote_pin_right');

						if(!empty($quote)) :
						?>
							<blockquote class="<?= $quote_pin_left ? 'pin-left' : '' ?> <?= $quote_pin_right ? 'pin-right' : '' ?>">
								<div class="caption">
									<?php
										if($quote_custom_title) :
											echo $quote_custom_title;
										endif;
									?>
								</div>
								<p><?= $quote ?></p>
								<?php if(!empty($quote_author)) : ?>
									<div class="description">
										<?php if(!$quote_pin_left) : ?>
											<div class="caption"><?php _e('Author', 'gwc'); ?></div>
										<?php endif; ?>
										<?= $quote_author ?>
									</div>
								<?php endif; ?>
							</blockquote>
						<?php
						endif;

						break;
					case 4:
						$slider = get_sub_field('slider');
						$slider_expanded_to_left = get_sub_field('slider_expanded_to_left');
						$slider_caption = get_sub_field('slider_caption');

						if(!empty($slider)) :
						?>
							<div class="slider <?= $slider_expanded_to_left ? 'left-expand' : '' ?>">
								<ul class="jsBxslider">
									<?php
									foreach($slider as $k=>$s) :
										$title = (empty($s['title']) ? __('Slide', 'gwc').' '.($k + 1) : $s['title']);
									?>
										<li>
											<img src="<?= $s['image'] ?>" alt="<?= $title ?>" />
											<div class="caption">
												<span><?= $title ?></span>
											</div>
										</li>
									<?php
									endforeach;
									?>
								</ul>
							</div>

							<?php if(!empty($slider_caption)) : ?>
								<div class="figcaption"><?= $slider_caption ?></div>
							<?php endif; ?>

						<?php
						endif;

						break;
     			endswitch;
			endwhile;
		endif;
	?>

	<?php if(!isset($list)) : ?>
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

		<?php
			$cat = get_cat_ID('thanks-for');
			$args2 = array(
					'post_type' => 'stories',
					'post__not_in' => array($post->ID),
					'category__not_in' => array($cat),
					'paged' => 1,
					'posts_per_page' => 2
			);
			$my_query = new WP_Query($args2);
		?>

		<?php if($my_query->have_posts()) : ?>

			<h3><?php _e('Check also', 'gwc') ?></h3>

			<?php while($my_query->have_posts()) : $my_query->the_post(); ?>
				<a href="<?php the_permalink() ?>">
					<div class="item">
						<div class="category"><?php _e('Story', 'gwc') ?></div>
						<div><?php the_title() ?></div>
						<div class="picture" style="background-image:url(<?php the_field('intro_image') ?>)"></div>
					</div>
				</a>
			<?php endwhile; ?>

		<?php endif; ?>

		<?php wp_reset_postdata(); ?>
	</section>
	<?php endif; ?>
</article>
