<?php
	$post_date = get_the_time('F Y', $post->ID);
?>

<article class="news-block wt-infrastructure no-padding-left">
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
					$tables = get_sub_field('flexible_table');
					
					if(!empty($tables)) :
						foreach($tables as $table) :
							$tableType = $table['type_of_table'];
					
							if($tableType == 4) :
								echo '<div class="section-table table-pairs">';
								
									if(!empty($table['pairs'])) :
										foreach($table['pairs'] as $pair) :
											echo '<div>';
												echo '<div class="label">'.$pair['label'].'</div>';
												echo '<div class="value">'.$pair['value'].'</div>';
											echo '</div>';
										endforeach;
									endif;
								
								echo '</div>';
							else :
								$tableClass = 'table-vertical-header table-horizontal-header';
							
								if($tableType == 2) $tableClass = 'table-vertical-header';
								if($tableType == 3) $tableClass = 'table-horizontal-header';
								
								echo '<div class="section-table '.$tableClass.'">';
								
								if(!empty($table['table_row'])) :
									foreach($table['table_row'] as $row) :
										echo '<div class="table-row">';
										
										foreach($row['items'] as $cell) :
											echo '<div>'.$cell['item'].'</div>';
										endforeach;
										
										echo '</div>';
									endforeach;
								endif;
								
								echo '</div>';
							endif;
						endforeach;
					endif;
					
					break;
 			endswitch;

		endwhile;
	endif;
	?>

	<?php /* ?><section class="more-info">
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

		<h3><?php _e('Share the news', 'gwc') ?></h3>
	</section> <?php */ ?>
</article>
