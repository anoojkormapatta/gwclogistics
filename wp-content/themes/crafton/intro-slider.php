<section class="slider">
	<ul class="jsBxslider">
		<?php
	     	if(have_rows('intro_slider')):
	     		$internal_caption = false;
	     		$items_count = 0;

	     		while(have_rows('intro_slider')) :
	     			the_row();

			     	$items_count++;

			     	$image = get_sub_field('image');
			     	$category = get_sub_field('category');
			     	$title = get_sub_field('title');
			     	$subtitle = get_sub_field('subtitle');
			     	$video = get_sub_field('video');
						$url= get_sub_field('image_url');
					?>
						<li data-youtube="<?= ($isVideo = (!empty($video) && preg_match("/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/", $video))) ? $video : '' ?>">
							<a href="<?= $url; ?>" target="_blank"><img src="<?= $image; ?>" alt="<?= $subtitle ?: get_field('subtitle') ?>" /></a>
							<?php
								if($isVideo) :
									echo file_get_contents(__DIR__."/images/sources/play-button.svg");
								endif;
							?>
							<?php if(!empty($category) || !empty($title) || !empty($subtitle)) :
								$internal_caption = true;
								?>
								<!--<div class="caption with-signature">
									<span><?= $category ?></span>
									<h1 class="title"><?= $title ?></h1>
									<h2 class="subtitle"><?= $subtitle ?></h2>
								</div>-->
							<?php endif; ?>
						</li>
					<?php
				endwhile;
			endif;
		?>
	</ul>

	<?php /* Move this section to specified slide if required */ ?>
	<?php //if(!$internal_caption && (!empty(get_field('category')) || !empty(get_field('title')) || !empty(get_field('subtitle')))) : ?>
		<!--<div class="caption with-signature">
		<span><?php //the_field('category') ?></span>
		<h1 class="title"><?php //the_field('title') ?></h1>

		<h2 class="subtitle"><?php //the_field('subtitle') ?></h2>
	<?php //endif; ?>
</div>-->
</section>
