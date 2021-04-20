<?php
/*
Template Name: Careers Page
*/

get_header();

$title = the_title('', '', false);
$description = get_field('description');
$search = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';
?>
	<div class="intro small-intro" style="background-image: url(<?php the_field('intro_image'); ?>)"></div>
	
	<section class="head-info careers-info">
		<ul class="breadcrumbs">
			<li><a href="<?= home_url() ?>">Home</a></li>
			<li class="active"><?php the_title() ?></li>
		</ul>
		<?php if(!empty($description)) : ?>
		<h2><?= $title ?></h2>
		<?php endif; ?>
		<h1><?= (!empty($description) ? $description : $title) ?></h1>
		<div class="subtitle"><?php the_field('subtitle') ?></div>
	</section>
	
	<?php
		$search = (isset($_REQUEST['q']) ? sanitize_text_field($_REQUEST['q']) : '');
	
		$args = array(
				'post_type' => 'job',
				//'post_status' => 'publish',
				'paged' => 1,
				'posts_per_page' => -1
		);
		if($search) {
			$args['_meta_or_title'] = $search;
			$args['meta_query'] = array(
					'relation' => 'OR',
					array(
							'key' => 'place',
							'value' => $search,
							'compare' => 'LIKE'
					),
					array(
							'key' => 'place_details',
							'value' => $search,
							'compare' => 'LIKE'
					),
					array(
							'key' => 'responsibilities_%',
							'value' => $search,
							'compare' => 'LIKE'
					),
					array(
							'key' => 'offer_details_%',
							'value' => $search,
							'compare' => 'LIKE'
					)
			);
		}
		
		query_posts($args);
	?>
	
	<article class="careers-block">
		<div class="search-panel">
			<form action="<?php the_permalink(pll_get_post($post->ID)); ?>">
				<input type="hidden" name="page_id" value="<?= $post->ID ?>" />
				<input name="q" type="text" placeholder="<?php _e('Keyword', 'gwc') ?>" value="<?= $search ?>" />
				<a class="jsSubmit button white btn-icon"><?php _e('Search', 'gwc') ?><svg class="icon icon-Search"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-Search"></use></svg></a>
			</form>
		</div>
		<div class="offers">
		<?php
			if(have_posts()) :
				while(have_posts()) : the_post();
					get_template_part('subpage', 'offers');
			    endwhile;
			else :
			?>
				<div><?php _e('Not found any offers') ?></div>
			<?php
			endif;
			
			wp_reset_query();
		?>
		</div>
		
		<div class="informations">
			<div class="number-stats flex-content">
			<?php if(have_rows('basic_statistics')):
					while(have_rows('basic_statistics')) : the_row();
			?>
				<div>
					<div class="jsOdometer" data-format="float"><?php the_sub_field('value') ?></div>
					<span><?php the_sub_field('label') ?></span>
				</div>
			<?php
					endwhile;
				endif;
			?>
			</div>
			<div class="flex-content">
				<div>
					<p class="lead"><?php the_field('lead_text') ?></p>
				</div>
				<div>
					<p><?php the_field('text') ?></p>
					<div class="rounded sharing">
						<a class="jsShare-it white">
							<div class="social">
								<svg class="icon icon-share"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-share"></use></svg>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
		
		<?php
			$args = array(
					'post_type' => 'stories',
					//'post_status' => 'publish',
					'paged' => 1,
					'posts_per_page' => 4,
					'category_name' => 'thanks-for'
			);
			query_posts($args);
		?>
		
		<section class="picture-panel">
			<?php
				$exists = have_posts();
				while(have_posts()) : the_post();
					get_template_part('subpage', 'picture-story');
			    endwhile;
				
				wp_reset_query();
			?>
			
			<?php if($exists) : ?>
			<h2 class="footer">
				<?php _e('Stories behind our doors.', 'gwc') ?>
				<a class="button white btn-icon" href=""><?php _e('Discover', 'gwc') ?><svg class="icon icon-arrow"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-arrow"></use></svg></a>
			</h2>
			<?php endif; ?>
		</section>
	</article>
	
<?php 
get_footer();
