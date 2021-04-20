<?php
//if (function_exists('ob_gzhandler')) ob_start("ob_gzhandler");
//if (function_exists("ob_gzhandler_no_errors")) ob_start();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<?php include 'head.php'; ?>
	<body <?php body_class(); ?>>
		<div class="icons">
        	<?php require_once(get_template_directory() . '/images/icons.svg'); ?>
     	</div>
     	<div class="loader jsLoader"></div>

     	<header>
			<div class="wrapper">
				<a href="<?= home_url(); ?>"><img class="logo white-logo" src="<?php bloginfo('template_url'); ?>/images/sources/logo-white.png" alt="GWC" /><img class="logo color-logo" src="<?php bloginfo('template_url'); ?>/images/sources/logo-color.png" alt="GWC" /></a>

				<?php do_action('header_menu'); ?>

				<nav class="hamburger-wrapper">
					<a class="hamburger"><svg class="icon icon-menu"><use xlink:href="#icon-menu"></use></svg><span><?php _e('Menu', 'gwc') ?></span></a>
				</nav>
				<div class="language">
					<?php
						if (function_exists('pll_the_languages')){
							$langs = pll_the_languages(array('raw'=>1, 'hide_if_empty'=>0));

							$url_get = array();
							$url_string = "";

							// print_r($_GET);
							if (isset($_GET) && (count($_GET) > 0)){
								$item= $_GET;

								foreach ($item as $key => $value) {
									$url_get[] = $key.'='.$value;
								}
								$url_string = '?' . implode('&', $url_get);
							}


							foreach($langs as $lang){
								if ($lang['current_lang']) continue;
								?>
								<a href="<?= $lang['url'].$url_string; ?>"><?= $lang['name']; ?></a>
								<?php
							}
						}
					?>
				</div>
				<form class="search jsSearch" action="<?= dirname(home_url()) . '/'; ?>" method="get" autocomplete="off">
					<svg class="icon icon-Search"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-Search"></use></svg>
					<input name="s" type="search" placeholder="<?php _e('Search...', 'gwc'); ?>" value="<?php the_search_query(); ?>" />
				</form>
			</div>
		</header>