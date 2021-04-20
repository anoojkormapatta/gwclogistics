<?php
/*
Template Name: Advanced Content Page
*/

get_header('color');
?>

<section class="head-info">
	<ul class="breadcrumbs">
		<li><a href="<?= home_url() ?>"><?php _e('Home', 'gwc') ?></a></li>
		<li class="active"><?php the_title() ?></li>
	</ul>
	<h1><?php the_title() ?></h1>
</section>

<article>
<br>
<div class="article-action text-right"> 
		<div class="rounded inline sharing">
			<a class="jsShare-it white" data-href="<?php the_permalink() ?>" data-title="<?php the_title() ?>">
				<div class="social">
					<svg class="icon icon-share"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-share"></use></svg>
				</div>
			</a>
		</div>
		<div class="rounded inline printing">
			<a class="jsPrint white" data-url="<?php the_permalink() ?>">
				<svg class="icon icon-print"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-print"></use></svg>
			</a>
		</div>
	</div>
	<?php if(($subtitle = get_field('subtitle'))) : ?>
	<h3><?= trim($subtitle) ?></h3>
	<?php endif; ?>
	
	<?php get_template_part('subpage', 'advanced-content'); ?>
	
	<br>
<div class="article-action text-right"> 
		<div class="rounded inline sharing">
			<a class="jsShare-it white" data-href="<?php the_permalink() ?>" data-title="<?php the_title() ?>">
				<div class="social">
					<svg class="icon icon-share"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-share"></use></svg>
				</div>
			</a>
		</div>
		<div class="rounded inline printing">
			<a class="jsPrint white" data-url="<?php the_permalink() ?>">
				<svg class="icon icon-print"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-print"></use></svg>
			</a>
		</div>
	</div>
	<br>
</article>
	
<?php
get_footer();
