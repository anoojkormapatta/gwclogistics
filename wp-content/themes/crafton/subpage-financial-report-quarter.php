<div class="column q-stats q<?= $data['idx'] ?>">
	<div class="title"><?php _e('Q', 'gwc') ?><?= $data['idx'] ?></div>
	<div><?= $data['title'] ?></div>
	<svg class="icon icon-chart"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-chart"></use></svg>
	<i<?= $data['is_progress'] ? ' class="up"' : '' ?>><svg class="icon icon-arrow-up"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-arrow-up"></use></svg></i>
	<span><?= $data['progress_value'] ?></span>
	<?php if(isset($data['attachment']) && !empty($data['attachment'])) : ?>
		<span class="attachment attachment--pdf"><a href="<?= $data['attachment'] ?>" target="_blank"><?= (isset($data['attachment_label']) && !empty($data['attachment_label'])) ? $data['attachment_label'] : __('pdf', 'gwc') ?></a></span>
	<?php endif; ?>
</div>
