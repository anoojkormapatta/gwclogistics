<?php
	$post_date = get_the_time('F, Y', $post->ID);
?>

<article class="<?= is_ajax() ? '' : 'news-block no-padding-left ' ?>details-dialog">

	<?php if(!is_ajax()) : ?>

	<div class="article-action text-right">
		<div class="rounded inline sharing">
			<a class="jsShare-it white">
				<div class="social">
					<svg class="icon icon-share"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-share"></use></svg>
				</div>
			</a>
		</div>
		<!-- <div class="rounded inline printing">
			<a class="jsPrint white">
				<svg class="icon icon-print"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-print"></use></svg>
			</a>
		</div> -->
	</div>
	<?php endif; ?>

	<?php if(is_ajax()) : ?>
	<h2><?php the_field('subtitle') ?></h2>
	<?php endif; ?>
	<h3><?php the_title() ?></h3>

	<?php if(!is_ajax()) : ?>
		<?php the_tags('<div class="tags">', '', '</div>') ?>

		<?php /* if(!empty(get_field('picture'))) : ?>
		<figure class="pin-left small-picture">
			<img src="<?php the_field('picture') ?>" alt="<?php the_title() ?>" />
		</figure>
		<?php endif; */ ?>
	<?php endif; ?>

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
					$picture_pin_right = get_sub_field('picture_pin_right');
					$picture_expanded_to_left = get_sub_field('picture_expanded_to_left');
					$picture_expanded_to_right = get_sub_field('picture_expanded_to_right');

					if(!empty($picture)) :
					?>
						<figure class="<?= $picture_pin_left ? 'pin-left' : '' ?> <?= $picture_pin_right ? 'pin-right' : '' ?> <?= $picture_expanded_to_left ? 'left-expand' : '' ?> <?= $picture_expanded_to_right ? 'right-expand' : '' ?>">
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


					if(!empty($quote)) :
					?>
						<blockquote class="<?= $quote_pin_left ? 'pin-left' : '' ?>">
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
				case 5:
					$columns = get_sub_field('two_columns');
					?>
					<div class="content">
					<?php

					foreach((array)$columns as $column) :
						$subtype = $column['subsection_type'];

						?>
						<div>
						<?php

						switch($subtype) :
							case 1:
								$subtitle = $column['subsubtitle'];
								$hint = $column['subhint'];
								$paragraphs = $column['subtext_block'];

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
										$p['sub_is_lead'] && $classes[] = 'lead';
										$p['sub_is_narrow'] && $classes[] = 'narrow';
										echo '<p'.(!empty($classes) ? ' class="'.implode(' ', $classes).'"' : '').'>'.str_replace('&nbsp;', ' ', nl2br($p['subparagraph'])).'</p>';
									endforeach;
								endif;

		     					break;
							case 2:
								$picture = $column['subpicture'];
								$picture_label = $column['subpicture_label'];

								if(!empty($picture)) :
								?>
									<figure class="<?= $picture_pin_left ? 'pin-left' : '' ?>">
										<img src="<?= $picture ?>" alt="<?= $picture_label ?>" />
										<?php if(!empty($picture_label)) : ?>
											<figcaption><?= $picture_label ?></figcaption>
										<?php endif; ?>
									</figure>
								<?php
								endif;

								break;
							case 3:
								$table_description = $column['statistics_table_description'];
								$items = $column['statistics_items'];

								if(!empty($items)) :
								?>
									<div class="table-title"><?= $table_description ?></div>
									<div class="table">
									<?php foreach($items as $item) : ?>
										<div>
											<div class="large jsOdometer"><?php echo number_format($item['value'], 0, '.', ','); ?></div>
											<div><?= $item['description'] ?></div>
										</div>
									<?php endforeach; ?>
									</div>
								<?php
								endif;

								break;
							case 4:
								$video = $column['video'];

								$regExp = '/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/';
								if ( preg_match($regExp, $video, $matches) && strlen( $matches[7] ) == 11 ) :
								$video = (isset($matches[7]) ? ('https://www.youtube.com/embed/' . $matches[7]. '?autoplay=0&html5=1&modesbranding=0&color=white&iv_load_policy=3&showinfo=0&playsinline=1&controls=1&rel=0') : '');

								if(!empty($video)) :
								?>
										<div class="youtubeVideo">
											<iframe src="<?= $video ?>" frameborder="0" allowfullscreen></iframe>
										</div>
									<?php
								endif;

								endif;

								break;
							case 5:
								$quote = $column['quote'];
								$quote_author = $column['quote_author'];
								$quote_custom_title = $column['quote_custom_title'];
								$quote_pin_left = $column['quote_pin_left'];


								if(!empty($quote)) :
									?>
									<blockquote class="<?= $quote_pin_left ? 'pin-left' : '' ?>">
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
							case 6:
								$list = $column['list'];
								$label = $column['list_label'];

								if(!empty($list)) :
								?>
									<div class="list">
										<?php if(!empty($label)) : ?><div class="hint"><?= $label ?>:</div><?php endif; ?>
										<?php foreach((array)$list as $item) : ?>

													<div><span>&#8226;</span><?= nl2br($item['item']) ?></div>

										<?php endforeach; ?>
									</div>
								<?php
								endif;

								break;
							case 7:
								$subcolumns = $column['list_and_quote'];
								?>
								<div class="content2">
								<?php
								foreach((array)$subcolumns as $subcolumn) :
									$subtype2 = $subcolumn['subsection_type2'];
									?>
									<div>
									<?php
									switch($subtype2) :
										case 1:
											$sublist = $subcolumn['list'];
											$sublabel = $subcolumn['list_label'];
											if(!empty($sublist)) :
											?>
												<div class="list">
													<?php if(!empty($sublabel)) : ?><div class="hint"><?= $sublabel ?>:</div><?php endif; ?>
													<?php foreach((array)$sublist as $item) : ?>
															<div><span>&#8226;</span><?= nl2br($item['item']) ?></div>
													<?php endforeach; ?>
												</div>
											<?php endif;

											break;
										case 2:
											$subquote = $subcolumn['quote'];
											$subquote_author = $subcolumn['quote_author'];
											$subquote_custom_title = $subcolumn['quote_custom_title'];

											if(!empty($subquote)) :
								        ?>
								        <blockquote>
								          <div class="caption">
								            <?php
												if($subquote_custom_title) :
													echo $subquote_custom_title;
												endif;
											?>
								          </div>
								          <p><?= $subquote ?></p>
								          <?php if(!empty($subquote_author)) : ?>
								            <div class="description">
								                <div class="caption"><?php _e('Author', 'gwc'); ?></div>
								              <?= $subquote_author ?>
								            </div>
								          <?php endif; ?>
								        </blockquote>
								        <?php
								      endif;

											break;
									endswitch;
									?> </div> <?php
								endforeach;
								?> </div> <?php
						endswitch;

						?>
						</div>
						<?php

					endforeach;

					?>
					</div>
					<?php

					break;
				case 6:
					$video = get_sub_field('video');

					$regExp = '/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/';
					if ( preg_match($regExp, $video, $matches) && strlen( $matches[7] ) == 11 ) :
						$video = (isset($matches[7]) ? ('https://www.youtube.com/embed/' . $matches[7]. '?autoplay=0&html5=1&modesbranding=0&color=white&iv_load_policy=3&showinfo=0&playsinline=1&controls=1&rel=0') : '');

						if(!empty($video)) :
						?>
							<div class="youtubeVideo">
								<iframe src="<?= $video ?>" frameborder="0" allowfullscreen></iframe>
							</div>
						<?php
					endif;

					endif;

					break;
				case 7:
					$list = get_sub_field('list');
					$label = get_sub_field('list_label');

					if(!empty($list)) :
					?>
						<div class="list">
							<?php if(!empty($label)) : ?><div class="hint"><?= $label ?>:</div><?php endif; ?>
							<?php foreach((array)$list as $item) : ?>

										<div><span>&#8226;</span><?= nl2br($item['item']) ?></div>

							<?php endforeach; ?>
						</div>
					<?php
					endif;

					break;
	 		endswitch;
		endwhile;
	endif;
	?>

	<?php $flyer = get_field('flyer');
	if(!empty($flyer)) :
	?>
		<a href="<?= $flyer ?>" class="<?= !is_ajax() ? 'static-' : '' ?>download button white btn-icon" target="_blank"><?php _e('Download', 'gwc') ?><svg class="icon icon-download"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-download"></use></svg></a>
	<?php
	endif;
	?>
	<a href="mailto:<?php echo ($e = get_custom('application_email')) ? $e : '' ?>" class="<?= !is_ajax() ? 'static-' : '' ?>apply button white btn-icon"><?php _e('Apply', 'gwc') ?><svg class="icon icon-arrow"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-arrow"></use></svg></a>

	<?php if(!is_ajax()) : ?>
	<section class="more-info">
		<div class="article-action text-right">
			<div class="rounded inline sharing">
				<a class="jsShare-it white">
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
	<?php endif; ?>
</article>
