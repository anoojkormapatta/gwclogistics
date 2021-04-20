<?php
/*
Template Name: Home Page
*/

get_header();
get_template_part('intro', 'slider');
?>

<?PHP if (get_field('video_popup_show') && !isset($_COOKIE['splash'])): ?>
	<div class="splash active jsSplash">
			<!-- universal -->
		<div class="splash__box active">
			<div class="splash__close jsCloseSplash">
				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
					<path d="M30.667 26.891l-10.913-10.916 10.913-10.899-3.776-3.743-10.909 10.905-10.901-10.905-3.747 3.747 10.915 10.928-10.915 10.912 3.747 3.747 10.937-10.923 10.907 10.923z"></path>
				</svg>
			</div>
			<div class="splash__content">
				<div class="splash__contentImg">
					<iframe width="800" height="450" src="https://www.youtube.com/embed/<?= get_field('video_popup_youtube_id') ?>?rel=0&autoplay=1&showinfo=0&controls=0&iv_load_policy=3&modestbranding" frameborder="0" allowfullscreen="" ng-show="showvideo"></iframe>
				</div>
				<!--<div class="splash__dsc"><p>Lorem ipsum sit amei</p></div>-->
			</div>
		</div>
	</div>
<?PHP endif; ?>

<?php
	if(get_bloginfo("language") == 'en-GB'){
		$covidurl 		= 'https://gwclogistics.com/covid19';
		
	} else {
		$covidurl 		= 'https://gwclogistics.com/ar/covid19-ar';
		
	}?>

<section class="covid19" >
			<!--	<h2 class="subtitle"><?php _e('Check ', 'gwc') ?></h2>-->
				<h3 class="description"><?php _e('COVID 19 – Information and Resources', 'gwc') ?></h3>
				<a class="button white white--special" href="<?php _e($covidurl)?>"><?php _e('Click here', 'gwc') ?></a>
			</section>

<main>
	
	<section class="articles">
		<div class="column">
			<div class="news block">
				<div class="title">
					<h2><?php _e('News', 'gwc') ?></h2>
					<a class="button black black--special btn-icon" href="<?php ($pid = pll_get_post(118)) ? the_permalink($pid) : '#' ?>"><?php _e('Archive', 'gwc') ?><svg class="icon icon-arrow"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-arrow"></use></svg></a>
				</div>

				<?php
					$args = array(
							'post_type' => 'news',
							'paged' => 1,
							'posts_per_page' => 3
					);
					query_posts($args);
				?>
				<div class="items">
					<?php while(have_posts()) : the_post(); ?>

						<a href="<?php the_permalink(); ?>"><div class="text-item"><span class="date"><?php the_time('d.m.y'); ?></span><h3 class="subject"><?php the_title() ?></h3></div></a>

					<?php endwhile; ?>
				</div>
				<?php wp_reset_query(); ?>
			</div>
			<div class="bussiness block">
				<div class="title">
					<h2><?php _e('Business articles', 'gwc') ?></h2>
					<?php
					$pages = get_posts(array(
							'post_type' => 'page',
							'meta_key' => '_wp_page_template',
							'meta_value' => 'templates/archive_page.php',
							'paged' => 1,
							'posts_per_page' => 1,
							'lang' => pll_current_language()
					));
					if(!empty($pages)) :
					?>
					<a class="button black black--special btn-icon" href="<?php the_permalink($pages[0]->ID) ?>"><?php _e('Blog', 'gwc') ?><svg class="icon icon-arrow"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-arrow"></use></svg></a>
					<?php
					endif;
					?>
				</div>

				<?php
					$args = array(
							'post_type' => 'post',
							'paged' => 1,
							'posts_per_page' => 2
					);
					query_posts($args);
				?>
				<div class="items">
					<?php while(have_posts()) : the_post();
						$picture = get_field('picture');
						$category = get_the_category();
						$category = empty($category) || $category[0]->term_id === 1 ? '' : $category[0]->name;
					?>

						<a href="<?php the_permalink(); ?>"><div class="text-item"><h3 class="category"><?= $category ?></h3><h4 class="subject"><?php the_title() ?></h4></div></a>

					<?php endwhile; ?>
				</div>
				<?php wp_reset_query(); ?>
			</div>
		</div>
		<?php
		if(pll_current_language() === pll_default_language()) {
			remove_filter('option_sticky_posts', array($polylang->filters, 'option_sticky_posts'));
		}
		$sticky = get_option('sticky_posts');
		$cat = get_cat_ID('thanks-for');
		$args = array(
				'post_type' => 'stories',
				'paged' => 1,
				'posts_per_page' => 5,
				'post__in' => $sticky,
				'category__not_in' => array($cat)
		);
		query_posts($args);

		if(have_posts()) :
		?>
		<div class="column slider full-height">
			<div class="jsBxslider">
				<?php
					while(have_posts()) : the_post();
				?>

			  		<div class="slide">
						<div class="bg-picture" style="background-image: url(<?php the_field('intro_image'); ?>)"></div>
						<div class="caption">
							<h3 class="text-white"><?php the_field('subtitle'); ?></h3>
							<h4 class="title text-white"><?php the_field('description'); ?></h4>
							<a class="button black black--special" href="<?php the_permalink() ?>"><?php _e('Discover', 'gwc') ?></a>
						</div>
					</div>
				<?php
					endwhile;

					wp_reset_query();
				?>
			</div>
		</div>
		<?php endif; ?>
	</section>

	<?php
	$args = array(
			'post_type' => 'stories',
			'paged' => 1,
			'posts_per_page' => 1,
			'category_name' => 'csr-stories'
	);
	$csr_query = new WP_Query($args);

	$args = array(
			'post_type' => 'stories',
			'paged' => 1,
			'posts_per_page' => 1,
			'category_name' => 'industry-stories'
	);
	$industry_query = new WP_Query($args);

	if($csr_query->have_posts() && $industry_query->have_posts()) :
	?>

	<section class="picture-panels">
		<?php
			$csr_query->the_post();
			$category = get_the_category();
			$category = empty($category) || $category[0]->term_id === 1 ? '' : $category[0]->name;
			$csr_title = get_the_title();
			$csr_link = get_the_permalink();
			$image = get_field('intro_image');
		?>
		<div class="column narrow csr" <?= !empty($image) ? 'style="background-image:url('.$image.')"' : '' ?>>
			<div class="footer">
				<h2 class="category-title"><?= $category ?></h2>
				<a class="button black black--special btn-icon" href="<?= ($pid = pll_get_post(223)) ? get_permalink($pid).'?category_name=csr-stories' : '#' ?>"><?php _e('More', 'gwc') ?><svg class="icon icon-arrow"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-arrow"></use></svg></a>
			</div>
		</div>
		<?php
			$industry_query->the_post();
			$category = get_the_category();
			$category = empty($category) || $category[0]->term_id === 1 ? '' : $category[0]->name;
			$industry_title = get_the_title();
			$industry_link = get_the_permalink();
			$image = get_field('intro_image');
		?>
		<div class="column wide industry" <?= !empty($image) ? 'style="background-image:url('.$image.')"' : '' ?>>
			<div class="footer">
				<h2 class="category-title"><?= $category ?></h2>
				<a class="button black black--special btn-icon" href="<?= ($pid = pll_get_post(223)) ? get_permalink($pid).'?category_name=industry-stories' : '#' ?>"><?php _e('More', 'gwc') ?><svg class="icon icon-arrow"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-arrow"></use></svg></a>
			</div>
		</div>
		<div class="panels">
			<div class="panel green">
				<h3 class="category"><?php _e('CSR', 'gwc') ?></h3>
				<h4 class="title"><?= $csr_title ?></h4>
				<a class="button black black--special" href="<?= $csr_link ?>"><?php _e('Discover', 'gwc') ?></a>
			</div>
			<div class="panel blue">
				<h3 class="category"><?php _e('Industry', 'gwc') ?></h3>
				<h4 class="title"><?= $industry_title ?></h4>
				<a class="button black black--special" href="<?= $industry_link ?>"><?php _e('Discover', 'gwc') ?></a>
			</div>
			<div class="panel empty-panel"></div>
		</div>
	</section>

	<?php
	wp_reset_postdata();

	endif;
	?>

	<?php
		$postId = pll_get_post(231);
		if($postId) :
			$post = get_post($postId);
			setup_postdata($post);

			$is_part = true;
			include(locate_template('subpage-infrastructure.php', false, false));
			//get_template_part('subpage', 'infrastructure');

			wp_reset_postdata();
		endif;

		$postId = pll_get_post(387);
		if($postId) :
			$post = get_post($postId);
			setup_postdata($post);

			?>

			<section class="investor">
				<h2 class="title"><a href="<?php the_permalink($postId) ?>"><?php _e('Investor Relations', 'gwc') ?></a></h2>

				<?php //get_template_part('subpage', 'investor-corner'); ?>

				<div class="reports">
					<div class="tab-panel text-uppercase tp1">
						<div class="tabs">
							<div data-rel="tp1-1" class="active"><?php _e('Key financial highlights', 'gwc') ?></div>
							<div data-rel="tp1-2"><?php _e('Financial reports', 'gwc') ?></div>
							<?php if(($item = get_field('annual_report')) && !empty($item)) : ?>
							<div data-rel="tp1-3"><?php _e('Annual reports', 'gwc') ?></div>
							<?php endif; ?>
							<?php if(($item = get_field('stock_observation')) && !empty($item)) : ?>
							<div data-rel="tp1-4"><?php _e('Announcements', 'gwc') ?></div>
							<?php endif; ?>
						</div>
						<div class="tabs-content">
							<div id="tp1-1" class="active">
								<?php get_template_part('subpage', 'key-financial-highlights'); ?>
							</div>
							<div id="tp1-2">
								<?php include(locate_template('subpage-financial-reports.php', false, false)); ?>
							</div>
							<?php if(($item = get_field('annual_report')) && !empty($item)) : $data = $item[0]; ?>
							<div id="tp1-3">
								<?php include(locate_template('subpage-annual-reports.php', false, false)); ?>
							</div>
							<?php endif; ?>
							<?php if(($item = get_field('stock_observation')) && !empty($item)) : $data = $item[0]; ?>
							<div id="tp1-4">
								<?php include(locate_template('subpage-stock-observations.php', false, false)); ?>
							</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</section>

			<?php

			wp_reset_postdata();
		endif;

		// $postId = pll_get_post(193);
		// pr($postId);
		// if(1 || $postId) :
		// 	$post = get_post($postId);
		// 	setup_postdata($post);
	?>




			<section class="career">
				<h2 class="subtitle"><?php _e('Check our', 'gwc') ?></h2>
				<h3 class="description"><?php _e('GWC Career area', 'gwc') ?></h3>
				<a class="button black black--special" href="https://career5.successfactors.eu/career?company=gulfwarehoP"><?php _e('Discover', 'gwc') ?></a>
			</section>
	<?php
		// 	wp_reset_postdata();
		// endif;
	?>
</main>

<?php get_footer(); ?>
