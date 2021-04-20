<div>
	<div class="subtitle"><?php the_field('place') ?> <span><?php the_field('place_details') ?></span></div>
	<div class="title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></div>
	<div class="date"><?php the_time('F Y') ?></div>
	<div class="offer-details">
		<div>
			<h3 class="hidden"><?php the_title() ?></h3>

			<?php
				if(have_rows('offer_details')):
					while(have_rows('offer_details')) : the_row();
			?>

			<div class="hint"><?php the_sub_field('title') ?></div>
			<p><?php the_sub_field('text') ?></p>

			<?php
					endwhile;
				endif;
			?>
		</div>
		<div>
			<a href="mailto:<?php echo ($e = get_custom('application_email')) ? $e : '' ?>" class="apply button white btn-icon"><?php _e('Apply', 'gwc') ?><svg class="icon icon-arrow"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-arrow"></use></svg></a>
			<div class="list">
				<div class="hint"><?php _e('Responsibilities', 'gwc') ?></div>
				<?php
					if(have_rows('responsibilities')):
						while(have_rows('responsibilities')) : the_row();
				?>

					<div><?php the_sub_field('item') ?></div>

				<?php
						endwhile;
					endif;
				?>
			</div>
		</div>
	</div>
</div>
