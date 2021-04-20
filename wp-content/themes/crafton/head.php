	<head>
		<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>

    <META HTTP-EQUIV="Content-type" CONTENT="text/html; charset=<?= bloginfo('charset'); ?>">
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="format-detection" content="telephone=no"/>

		<link href="<?php bloginfo('template_url'); ?>/style.css?v=2017-01-23" rel="stylesheet" type="text/css" />

		<!--[if lte IE 9]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
			<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
		<![endif]-->

		<link rel="apple-touch-icon" sizes="180x180" href="<?php bloginfo('template_url'); ?>/images/favicons/apple-touch-icon.png?v=kPgYqRwAoR">
		<link rel="icon" type="image/png" href="<?php bloginfo('template_url'); ?>/images/favicons/favicon-32x32.png?v=kPgYqRwAoR" sizes="32x32">
		<link rel="icon" type="image/png" href="<?php bloginfo('template_url'); ?>/images/favicons/favicon-16x16.png?v=kPgYqRwAoR" sizes="16x16">
		<link rel="manifest" href="<?php bloginfo('template_url'); ?>/images/favicons/manifest.json?v=kPgYqRwAoR">
		<link rel="mask-icon" href="<?php bloginfo('template_url'); ?>/images/favicons/safari-pinned-tab.svg?v=kPgYqRwAoR" color="#43b02a">
		<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/images/favicons/favicon.ico?v=kPgYqRwAoR">
		<meta name="msapplication-config" content="<?php bloginfo('template_url'); ?>/images/favicons/browserconfig.xml?v=kPgYqRwAoR">
		<meta name="theme-color" content="#ffffff">

		<meta property="og:url" content="<?php the_permalink() ?>" />
		<meta property="og:type" content="website" />
		<meta property="og:title" content="<?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?>" />
		<?php
			$image = get_field('intro_image');
			if (empty($image)) $image = get_field('picture');
			if (empty($image) && have_rows('section')) :
				while(have_rows('section')) :
					the_row();

					if ($image = get_sub_field('picture')) break;
				endwhile;
				reset_rows();
			endif;
			if (empty($image)) $image = get_bloginfo('template_url').'/images/sources/logo-color.png';

			$imagepath = str_replace(get_site_url().'/', '', $image);
			if (file_exists($imagepath)) {
				list($width, $height) = getimagesize($imagepath);
				?>
				<meta property="og:image:width" content="<?= $width ?>" />
				<meta property="og:image:height" content="<?= $height ?>" />
				<?PHP
			}
		?>
		<meta property="og:image" content="<?= $image ?>" />

		<?php wp_head(); ?>
	</head>