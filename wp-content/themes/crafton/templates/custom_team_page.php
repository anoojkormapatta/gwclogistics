<?php
/*
Template Name: Custom Team Page
*/

get_header('color');
?>

<section class="head-info">
	<ul class="breadcrumbs">
		<li><a href="<?= home_url() ?>"><?php _e('Home', 'gwc') ?></a></li>
		<li class="active"><?php _e('Board', 'gwc') ?></li>
	</ul>
	<h2><?php _e('Board', 'gwc') ?></h2>
	<h1><?php the_title() ?></h1>
</section>

<?PHP if (get_field('intro_slider_show')): ?>
	<?php get_template_part('intro', 'basic-slider'); ?>
<?PHP endif ?>

<article class="team">
	<h3><?php the_field('subtitle') ?></h3>

	<?php
		if (have_rows('humans')) :
			$i = 0;
			$count = count(get_field('humans'));
			$big_panel = false;

			while(have_rows('humans')) :
				the_row();

				$post = get_sub_field('post');
				$fullname = get_sub_field('full_name');
				$is_chairman = get_sub_field('is_chairman');
				$chairmans_message_url = get_sub_field('chairmans_message_url');
				$picture = get_sub_field('picture');
				$bio = get_sub_field('bio_info');
				if ($i === 0) $big_panel = $is_chairman;
				?>

				<?php if ($i % 2 === 0 && ($i > 3 || $i === 0)) : ?>
					<div class="content secondary-data <?= $i === 0 && $big_panel ? 'big-panel' : '' ?>">
				<?php endif; ?>

				<?php if ($big_panel && $i === 1) : ?>
					<div><div class="content secondary-data">
				<?php endif; ?>

					<div class="team__member<?php if (!$picture) : echo " team__member--nophoto"; endif; ?>">
						<div class="picture-wrapper">
							<?php if ($picture) : ?>
								<img src="<?= $picture ?>" alt="<?= $fullname ?>" />
							<?php endif; ?>
						</div>
						<div class="details <?php if ($is_chairman) : echo " details--chairman"; endif; ?>">
							<div class="title"><?= $post ?></div>
							<div><?= $fullname ?></div>

							<?php if ($is_chairman && $chairmans_message_url) : ?>
								<div class="message">
									<div class="hint"><?php _e('Group CEO\'s message', 'gwc') ?></div>
									<div><a class="button white btn-icon" href="<?= $chairmans_message_url ?>"><?php _e('Read now', 'gwc') ?><svg class="icon icon-arrow"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-arrow"></use></svg></a></div>
								</div>
							<?php endif; ?>
							<?php if ($bio) : ?>
								<a data-bioid="<?php echo $i ?>" class="show-bio button white btn-icon"><?php _e('Biography', 'gwc') ?><svg class="icon icon-arrow"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-arrow"></use></svg></a>
							<?php endif; ?>
						</div>
						<?php if ($bio) : ?>
							<div data-bioid="<?php echo $i ?>" class="bio-info">
								<p><?= $bio ?></p>
							</div>
						<?php endif; ?>
					</div>

				<?php if ($big_panel && $i === 3) : ?>
					</div></div></div>
				<?php endif; ?>

				<?php if ($i > 3 && (($i + 1) % 2 === 0 || $count === $i + 1)) : ?>
					</div>
				<?php endif; ?>

				<?php
				$i++;
			endwhile;
		endif;
	?>

	<?php if (have_rows('group')) : ?>

	<div class="staff">
		<?php while(have_rows('group')) :
			the_row();

			$group_name = get_sub_field('group_name');
		?>
			<div class="hint"><?= $group_name ?></div>
			<?php while(have_rows('humans')) : the_row(); ?>
				<div class="item"><?php the_sub_field('full_name') ?><span class="title"><?php the_sub_field('post') ?></span></div>
			<?php endwhile; ?>

		<?php endwhile; ?>
	</div>

	<?php endif; ?>
</article>

<?php
	get_footer();
?>