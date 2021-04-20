<div class="hint"><?php the_field('subtitle') ?></div>

<p><?php the_field('description') ?></p>


<section class="download">

	<!-- download content -->
	<div class="content download-list">
	<?php
	if(have_rows('cat')):
		while(have_rows('cat')):
			the_row();

		$categoryName = get_sub_field('cat_name');

		?>

		<div class="content download-category">
		<?php if(!empty($categoryName)) : ?>
			<div class="download-head">
				<h3><?= $categoryName ?></h3>
				<span>
					<svg class="icon icon-arrow-up">
						<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-arrow-up"></use>
					</svg>
				</span>
			</div>
		<?php endif; ?>

		<?php
			if(have_rows('cat_files')): ?>
				<div class="download-items">
					<div>
					<?
					while(have_rows('cat_files')):
						the_row();

						$fileUrl = get_sub_field('cat_files_item');
						$fileName = get_sub_field('cat_files_name');

					?>
						<div class="download-item">
							<a href="<?= $fileUrl ?>" target="_blank">
								<img src="<?php echo includes_url( $path ); ?>images/media/document.png" />
							</a>
							<span><?= $fileName ?></span>
						</div>
				<?php
					endwhile; ?>
					</div>
				</div>
			<?php
			endif;
		?>
		</div>
		<?php
		endwhile;

	endif;
	?>
	</div>

</section>
