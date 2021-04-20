<main class="investor-relations panel-wrapper">
	<div class="tab-panel tp1">
		<div class="tabs">
			<div data-rel="tp1-1" class="active"><?php _e('Charts', 'gwc') ?></div>
			<?php if(($item = get_field('board_charter')) && !empty($item)) : ?>
				<div data-rel="tp1-2"><?php _e('Board charter', 'gwc') ?></div>
			<?php endif; ?>
			<?php if(($item = get_field('constitution')) && !empty($item)) : ?>
				<div data-rel="tp1-3"><?php _e('Constitution', 'gwc') ?></div>
			<?php endif; ?>
			<?php if(($item = get_field('corporation_governance')) && !empty($item)) : ?>
				<div data-rel="tp1-4"><?php _e('Corpo. governance', 'gwc') ?></div>
			<?php endif; ?>
			<?php if(($item = get_field('analyst_coverage')) && !empty($item)) : ?>
				<div data-rel="tp1-5"><?php _e('Analyst coverage', 'gwc') ?></div>
			<?php endif; ?>
			<?php if(($item = get_field('conference_call')) && !empty($item)) : ?>
				<div data-rel="tp1-6"><?php _e('Conference call', 'gwc') ?></div>
			<?php endif; ?>
		</div>
		<div class="tabs-content">
			<div id="tp1-1" class="active">
				<div class="investor">
					<h3 class="title"><?php _e('Investor corner', 'gwc') ?></h3>

					<?php get_template_part('subpage', 'investor-corner'); ?>
				</div>
				<div class="investor">
					<h3 class="title"><?php _e('Key financial highlights', 'gwc') ?></h3>

					<?php if(have_rows('kfh')) : ?>

					<?php get_template_part('subpage', 'key-financial-highlights'); ?>

					<?php if(false): //temporary disable mothly stats ?>
					<div class="month-stats">
						<?php _e('This month', 'gwc') ?>

						<?php
						while(have_rows('kfh')) :
							the_row();
							$data = get_sub_field('month_stats');

							if(!empty($data)) :
								$data = $data[0];
						?>

						<div class="content">
							<div class="column data">
								<div class="content">
									<div class="column general">
										<div><span class="jsOdometer" data-format="float"><?= trim(number_format($data['value'], 5, ',', ''), '0') ?></span><br /><?= $data['hint'] ?></div>
									</div>
									<div class="column">
										<div class="rate">
											<i<?= $data['rate_table_is_progress'] ? ' class="up"' : '' ?>><svg class="icon icon-arrow-up"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-arrow-up"></use></svg></i>
											<div><?= $data['rate_table_title'] ?></div>
											<?php foreach($data['rate_table'] as $row) : ?>
												<div><?= $row['value'] ?><span class="suffix"><?= $row['label'] ?></span></div>
											<?php endforeach; ?>
											<div><?= $data['rate_table_footer'] ?></div>
										</div>
									</div>
								</div>
							</div>
							<div class="column chart">
								<div class="chart-panel">
									<script type="text/javascript" charset="UTF-8" src="<?php echo get_template_directory_uri(); ?>/javascripts/easyXDM-2.4.19.3.min.js"></script>
									<script type="text/javascript" charset="UTF-8" src="<?php echo get_template_directory_uri(); ?>/javascripts/postMessageDocumentHeight.min.js"></script>
									<?php 
									$rnd = rand(); ?>
									    <div id="embedded_<?php echo $rnd ?>" class="eqs-iframe-tools"></div>
									    <script>
									        (function(global) {
									            var transport = new easyXDM.Socket({
									                remote: 'https://charts3.equitystory.com/chart/gulfwarehousing/Arabic/',
									                //swf: 'easyxdm.swf',
									                container: 'embedded_<?php echo $rnd ?>',
									                onMessage: function(message, origin) {
									                    this.container.getElementsByTagName('iframe')[0].style.height = message + 'px';
									                    this.container.getElementsByTagName('iframe')[0].scrolling = 'no';
									                }
									            });
									            /*window.onorientationchange = function() {
									                transport.postMessage(Math.abs(window.orientation) == 90 ? 'landscape' : 'portrait');
									            };*/
									        })();
									    </script>
									<!--img src="<?= $data['longtime_chart'] ?>" alt="<?php _e('Chart', 'gwc') ?>" />
									<div class="x-axis label"><?php _e('Y', 'gwc') ?></div>
									<div class="x-axis-panel">
										<?php/*
											$year = intval($data['last_year']);
											$n = intval($data['number_of_years']) - 1;

											for($n; $n >= 0; --$n) :
										?>
											<div class="x-axis"><?= ($year-$n) ?></div>
										<?php
											endfor;
										*/?>-->
									</div>
								</div>
							</div>
						</div>

						<?php
							endif;
						endwhile;
						?>
					</div>

					<?php endif; ?>
				</div>
				<?php endif; ?>
				<div class="investor">
					<h3 class="title"><?php _e('Financial reports', 'gwc') ?></h3>

					<?php $subclass = 'gray-bottom-border'; ?>
					<?php include(locate_template('subpage-financial-reports.php', false, false)); ?>
				</div>

				<?php if(($item = get_field('annual_report')) && !empty($item)) : ?>
				<div class="investor">
					<h3 class="title"><?php _e('Annual reports', 'gwc') ?></h3>

					<?php foreach($item as $data) include(locate_template('subpage-annual-reports.php', false, false)); ?>
				</div>
				<?php endif; ?>

				<?php if(($item = get_field('stock_observation')) && !empty($item)) : $data = $item[0]; ?>
				<div class="investor">
					<h3 class="title"><?php _e('Announcements', 'gwc') ?></h3>

					<?php include(locate_template('subpage-stock-observations.php', false, false)); ?>
				</div>
				<?php endif; ?>
			</div>

			<?php if(($item = get_field('board_charter')) && !empty($item)) : $data = $item[0]; ?>
			<div id="tp1-2">
				<h3><?php _e('Board charter', 'gwc') ?></h3>
				<div class="flex-content">
					<div>
						<p class="lead">
							<?= $data['description'] ?>
						</p>
					</div>
					<div>
						<div class="table">
							<div class="title"><?= $data['report_title'] ?>
							</div>
							<div>
								<div><?php _e('Report', 'gwc') ?></div>
								<div><?php _e('Pdf', 'gwc') ?> <a class="button black btn-icon link" href="<?= $data['pdf'] ?>" target="_blank"><?php _e('Read', 'gwc') ?> <svg class="icon icon-arrow"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-arrow"></use></svg></a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php endif; ?>

			<?php if(($item = get_field('constitution')) && !empty($item)) : $data = $item[0]; ?>
			<div id="tp1-3">
				<h3><?php _e('Constitution', 'gwc') ?></h3>
				<div class="flex-content">
					<?php foreach($data['paragraph'] as $k => $d) : ?>
						<div><p<?= $k === 0 ? ' class="lead"' : '' ?>><?= $d['text'] ?></p></div>
					<?php endforeach; ?>
				</div>
				<?php if(isset($data['attachment']) && !empty($data['attachment'])) : ?>
				<div class="documents">
					<?php foreach($data['attachment'] as $a) : ?>
						<a href="<?= $a['file'] ?>" target="_blank">
							<div class="title"><?= $a['title'] ?></div>
							<div class="subtitle"><?php _e('Pdf', 'gwc') ?></div>
							<div class="hvr-curl-bottom-right"></div>
						</a>
					<?php endforeach; ?>
					<?php if(isset($data['all_attachments_url']) && !empty($data['all_attachments_url'])) : ?>
						<div class="download-all"><a class="button black btn-icon" href="<?= $data['all_attachments_url'] ?>"><?php _e('Download all', 'gwc') ?> <svg class="icon icon-arrow"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-arrow"></use></svg></a></div>
					<?php endif; ?>
				</div>
				<?php endif; ?>

				<?php if(isset($data['statistic']) && !empty($data['statistic'])) : ?>
				<div class="number-stats flex-content">
					<?php foreach($data['statistic'] as $s) : ?>
						<div>
							<div class="jsOdometer"><?= intval($s['value']) ?></div>
							<span><?= $s['description'] ?></span>
						</div>
					<?php endforeach; ?>
				</div>
				<?php endif; ?>
			</div>
			<?php endif; ?>

			<?php if(($item = get_field('corporation_governance')) && !empty($item)) : $data = $item[0]; ?>
			<div id="tp1-4">
				<h3><?php _e('Corporation governance', 'gwc')?></h3>

				<?php
				if(isset($data['section']) && !empty($data['section'])) :
					foreach($data['section'] as $section) :
						switch($section['section_type']) :
							case 1:
								$title = isset($section['title']) ? $section['title'] : null;
								$subtitle = isset($section['subtitle']) ? $section['subtitle'] : null;
								$hint = isset($section['hint']) ? $section['hint'] : null;

								if(!empty($title) || !empty($subtitle) || !empty($hint)) :
								?>
								<div class="subsection-header">
									<?= !empty($title) ? "<h4>$title</h4>" : '' ?>
									<?= !empty($subtitle) ? "<h5>$subtitle</h5>" : '' ?>
									<?= !empty($hint) ? "<h6>$hint</h6>" : '' ?>
								</div>
								<?php
								endif;

								$texts = isset($section['text_block']) ? $section['text_block'] : null;
								if(!empty($texts)) :
								?>
								<div class="flex-content">
									<div>
									<?php
									foreach($texts as $t) :
									?>
										<p<?= $t['is_lead'] ? ' class="lead"' : '' ?>><?= $t['paragraph'] ?></p>
									<?php
									endforeach;
									?>
									</div>
								</div>
								<?php
								endif;
								break;
							case 2:
								$attachments = isset($section['attachments']) ? $section['attachments'] : null;
								$all = isset($section['all_attachments_file']) ? $section['all_attachments_file'] : null;

								if(!empty($attachments)) :
								?>
								<div class="documents">
									<?php
									foreach($attachments as $a) :
									?>
										<a href="<?= $a['pdf'] ?>" target="_blank">
											<div class="title"><?= $a['title'] ?></div>
											<div class="subtitle"><?php _e('Pdf', 'gwc') ?></div>
											<div class="hvr-curl-bottom-right"></div>
										</a>
									<?php
									endforeach;

									if(!empty($all)) :
									?>
										<div class="download-all"><a class="button black btn-icon" href="<?= $all ?>" target="_blank"><?php _e('Download all', 'gwc') ?> <svg class="icon icon-arrow"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-arrow"></use></svg></a></div>
									<?php
									endif;
									?>
								</div>
								<?php
								endif;
								break;
							case 3:
								$first = $section['first_column'];
								$second = $section['second_column'];

								if(!empty($first) || !empty($second)) :
								?>
								<div class="flex-content">
									<div>
									<?php
										if(isset($first[0]) && isset($first[0]['text_block'])) :
											foreach($first[0]['text_block'] as $t) echo '<p'.($t['is_lead'] ? ' class="lead"' : '').'>'.$t['paragraph'].'</p>';
										endif;
									?>
									</div>
									<div>
									<?php
										if(isset($second[0]) && isset($second[0]['text_block'])) :
											foreach($second[0]['text_block'] as $t) echo '<p'.($t['is_lead'] ? ' class="lead"' : '').'>'.$t['paragraph'].'</p>';
										endif;
									?>
									</div>
								</div>
								<?php
								endif;
								break;
							case 4:
								$picture1 = isset($section['first_picture']) ? $section['first_picture'] : null;
								$picture2 = isset($section['second_picture']) ? $section['second_picture'] : null;
								$caption = isset($section['caption_of_pictures']) ? $section['caption_of_pictures'] : null;

								if(!empty($picture1) && !empty($picture2)) :
								?>
									<div class="flex-content">
										<div class="clear-padding-md">
											<figure>
												<img src="<?= $picture1 ?>" alt="<?= $caption ?>" />
											</figure>
										</div>
										<div class="hide-md clear-padding-md">
											<figure>
												<img src="<?= $picture2 ?>" alt="<?= $caption ?>" />
											</figure>
										</div>
									</div>
								<?php
									if(!empty($caption)) :
									?>
										<div class="figcaption"><?= $caption ?></div>
									<?php
									endif;
								endif;
						endswitch;
					endforeach;
				endif;
				?>

				<?php
				if(isset($data['reports']) && !empty($data['reports'])) :
				?>
				<section>
					<div class="subsection-header">
						<h4><?php _e('Reports', 'gwc') ?></h4>
						<h5><?php _e('Corporate governance reports', 'gwc' )?></h5>
					</div>
					<div class="tab-panel tp4">
						<div class="tabs gray-border">
						<?php
						$data['reports'] = array_reverse($data['reports']);
						$activeTab = count($data['reports'])-1;
						foreach($data['reports'] as $k=>$r) :
							if($r['year'] == date('Y')) $activeTab = $k;
						?>
							<div data-rel="tp4-<?= ($k+1) ?>"<?= $activeTab == $k ? ' class="active"' : '' ?>><?= $r['year'] ?></div>
						<?php
						endforeach;
						?>
						</div>
						<div class="tabs-content">
						<?php
						foreach($data['reports'] as $k=>$r) :
						?>
							<div id="tp4-<?= ($k+1) ?>" class="internal-content<?= $activeTab == $k ? ' active' : '' ?>">
								<div class="flex-content">
									<div class="calendar-signature">
										<svg class="icon icon-calendar"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-calendar"></use></svg><?= $r['year'] ?>
									</div>
									<div>
										<div class="table">
											<div class="title"><?= $r['title'] ?>
											</div>
											<div>
												<div><?php _e('Report', 'gwc') ?></div>
												<div><?php _e('Pdf', 'gwc') ?> <a class="button black btn-icon link" href="<?= $r['pdf'] ?>" target="_blank"><?php _e('Read', 'gwc') ?> <svg class="icon icon-arrow"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-arrow"></use></svg></a></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php
						endforeach;
						?>
						</div>
					</div>
				</section>
				<?php
				endif;
				?>
			</div>
			<?php endif; ?>

			<?php if(($item = get_field('analyst_coverage')) && !empty($item)) : $data = $item[0]; ?>
			<div id="tp1-5">
				<h3><?php _e('Analyst coverage', 'gwc') ?></h3>
				<div class="flex-content">
					<div>
						<p class="lead">
							<?= $data['lead_paragraph'] ?>
						</p>
					</div>
					<div>
						<p><?= isset($data['additional_paragraph']) ? $data['additional_paragraph'] : '' ?></p>
					</div>
				</div>
				<div class="h-scrollable analysis-table">
					<div class="scroll-table">
						<div>
							<div></div>
							<?php foreach($data['analysts'] as $d) : ?>
								<div><?php _e('Analyst', 'gwc') ?></div>
							<?php endforeach; ?>
						</div>
						<div>
							<div><?php _e('Name', 'gwc') ?></div>
							<?php foreach($data['analysts'] as $d) : ?>
								<div><?= $d['name'] ?></div>
							<?php endforeach; ?>
						</div>
						<div>
							<div><?php _e('Company', 'gwc') ?></div>
							<?php foreach($data['analysts'] as $d) : ?>
								<div><?= $d['company'] ?></div>
							<?php endforeach; ?>
						</div>
						<div>
							<div><?php _e('Contact', 'gwc') ?></div>
							<?php foreach($data['analysts'] as $d) : ?>
								<div><?= nl2br($d['contact']) ?></div>
							<?php endforeach; ?>
						</div>
						<div>
							<div></div>
							<?php foreach($data['analysts'] as $d) : ?>
								<div>
								<?php if(isset($d['file']) && !empty($d['file'])) : ?>
									<a class="button white btn-icon" href="<?= $d['file'] ?>" target="_blank"><?php _e('Read', 'gwc') ?> <svg class="icon icon-arrow"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-arrow"></use></svg></a>
								<?php endif; ?>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
			<?php endif; ?>

			<?php if(($item = get_field('conference_call')) && !empty($item)) : $data = $item[0]; ?>
			<div id="tp1-6">
				<h3><?php _e('Conference call', 'gwc') ?></h3>
				<div class="flex-content">
					<div>
						<p class="lead">
							<?= $data['description'] ?>
						</p>
					</div>
					<div>
						<div class="table">
							<div class="title"><?= $data['report_title'] ?>
							</div>
							<div>
								<div><?php _e('Report', 'gwc') ?></div>
								<div><?php _e('Pdf', 'gwc') ?> <a class="button black btn-icon link" href="<?= $data['pdf'] ?>" target="_blank"><?php _e('Read', 'gwc') ?> <svg class="icon icon-arrow"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-arrow"></use></svg></a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php endif; ?>

		</div>
	</div>
</main>
