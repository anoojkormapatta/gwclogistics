<?php
/*
Template Name: Team Page
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

<article class="team">
	<h3><?php the_field('subtitle') ?></h3>

	<?php
		if(have_rows('humans')) :
			$i = 0;
			$count = count(get_field('humans'));

			while(have_rows('humans')) :
				the_row();

				$post = get_sub_field('post');
				$fullname = get_sub_field('full_name');
				$is_chairman = get_sub_field('is_chairman');
				$chairmans_message_url = get_sub_field('chairmans_message_url');
				$picture = get_sub_field('picture');
				$bio = get_sub_field('bio_info');
				?>

				<?php if($i % 2 === 0) : ?>
					<div class="content <?= $is_chairman ? 'primary' : 'secondary' ?>-data">
				<?php endif; ?>

					<div class="team__member<?php if(!$picture) : echo " team__member--nophoto"; endif; ?>">
						<div class="picture-wrapper">
							<?php if($picture) : ?>
								<img src="<?= $picture ?>" alt="<?= $fullname ?>" />
							<?php endif; ?>
						</div>
						<div class="details">
							<div class="title"><?= $post ?></div>
							<div><?= $fullname ?></div>

							<?php if($is_chairman && $chairmans_message_url) : ?>
								<div class="message">
									<div class="hint"><?php _e('Chairman\'s message', 'gwc') ?></div>
									<div><a class="button white btn-icon" href="<?= $chairmans_message_url ?>"><?php _e('Read now', 'gwc') ?><svg class="icon icon-arrow"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-arrow"></use></svg></a></div>
								</div>
							<?php endif; ?>
							<?php if($bio) : ?>
								<a data-bioid="<?php echo $i ?>" class="show-bio button white btn-icon"><?php _e('Biography', 'gwc') ?><svg class="icon icon-arrow"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-arrow"></use></svg></a>
							<?php endif; ?>
						</div>
						<?php if($bio) : ?>
							<div data-bioid="<?php echo $i ?>" class="bio-info<?php if($is_chairman) : echo" bio--chairman"; endif;?>">
								<p><?= $bio ?></p>
							</div>
						<?php endif; ?>
					</div>

				<?php if(($i + 1) % 2 === 0 || $count === $i + 1) : ?>
					</div>
				<?php endif; ?>

				<?php
				$i++;
			endwhile;
		endif;
	?>
</article>

<?php
get_footer();
