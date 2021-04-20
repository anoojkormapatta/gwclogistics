<div class="annual-reports sheer-content content">
	<div class="column">
		<div class="calendar-signature">
			<svg class="icon icon-calendar"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-calendar"></use></svg><?= $data['year'] ?>
		</div>
	</div>
	<div class="column">
		<div class="table">
			<div class="title"><?= $data['title'] ?></div>
			<div>
				<div><?php _e('Report', 'gwc') ?></div>
				<div><?php _e('Pdf', 'gwc') ?> <a class="button black btn-icon link" href="<?= $data['pdf'] ?>" target="_blank"><?php _e('Read', 'gwc') ?> <svg class="icon icon-arrow"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-arrow"></use></svg></a></div>
			</div>
		</div>
	</div>
</div>