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
										<!--<div class="caption">
											<span><?= $title ?></span>
										</div>-->
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
	            case 8:
	              $table_description = get_sub_field('statistics_table_description');
	              $items = get_sub_field('statistics_items');

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
 			endswitch;

		endwhile;
	endif;
?>
