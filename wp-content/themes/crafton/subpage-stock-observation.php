<div class="stock-observation-content content">
	<?php foreach($subdata as $subsection) : ?>
	<div>
		<div class="column col-helper content <?php if ($subsection['col2_img']) : echo "content-havePicture"; endif;?>">
			<div class="column table">
				<div class="title"><?= $subsection['title'] ?> <span class="date"><?= $subsection['date'] ?></span></div>
				<div class="desc"><?= $subsection['desc'] ?></div>
				<div>

					<?php if ($subsection['pdf_url']) : ?>
					<div><?php _e('PDF', 'gwc') ?>
						<a class="button black btn-icon link" href="<?= $subsection['pdf_url'] ?>" target="_blank">
							<?php _e('Read', 'gwc') ?>
							<svg class="icon icon-arrow"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-arrow"></use></svg>
						</a>
					</div>
					<?php endif; ?>

					<?php if ($subsection['btn_txt']) : ?>
					<div>
						<a href="<?php echo $subsection['btn_pdf'] ? $subsection['pdf_url'] : $subsection['btn_url']; ?>" title="<?php _e('More info', 'gwc') ?>">
							<span class="button black"><?= $subsection['btn_txt'] ?></span>
						</a>
					</div>
					<?php endif; ?>
				</div>
			</div>

			<?php if ($subsection['col2_img']) : ?>
			<div class="column column--img">

				<?php if ($subsection['col2_img_link']) : ?>
				<a href="<?= $subsection['col2_img_link'] ?>" title="<?php _e('More info', 'gwc') ?>">
				<?php endif; ?>

					<img src="<?= $subsection['col2_img'] ?>" alt="<?= $subsection['col2_img'] ?>">

				<?php if ($subsection['col2_img_link']) : ?>
				</a>
				<?php endif; ?>
			</div>
			<?php endif; ?>

		</div>
	</div>
	<?php endforeach; ?>
</div>
