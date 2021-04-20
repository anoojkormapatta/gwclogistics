<?php
if (!function_exists('crafton_setup')) {
	function crafton_setup() {

		remove_action('wp_head', 'wp_enqueue_scripts', 1);
		remove_action('wp_head', 'feed_links', 2);
		remove_action('wp_head', 'feed_links_extra', 3);
		remove_action('wp_head', 'rsd_link');
		remove_action('wp_head', 'wlwmanifest_link');
		remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
		remove_action('wp_head', 'locale_stylesheet');
		remove_action('wp_head', 'print_emoji_detection_script', 7);
		remove_action('wp_head', 'wp_print_styles', 8);
		remove_action('wp_head', 'wp_print_head_scripts', 9);
		remove_action('wp_head', 'wp_generator');
		remove_action('wp_head', 'rel_canonical');
		remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
		remove_action('wp_footer', 'wp_print_footer_scripts', 20);
		remove_action('template_redirect', 'wp_shortlink_header', 11, 0);
		remove_action('wp_print_footer_scripts', '_wp_footer_scripts');
		remove_action('wp_print_styles', 'print_emoji_styles');

		add_theme_support('automatic-feed-links');
		add_filter('show_admin_bar', '__return_false');
		remove_filter('acf_the_content', 'wpautop');

		register_nav_menus(array(
				'header_menu' => 'Primary menu'
		));
	}
}
add_action('after_setup_theme', 'crafton_setup');

//

function remove_menus() {
	remove_menu_page('edit-comments.php'); // Comments
	remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=category'); // Kategorie
	remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=post_tag'); // Tagi

	$logged_user = wp_get_current_user();
	if ($logged_user->user_login !== 'Crafton') {
		remove_menu_page('edit.php?post_type=acf'); // ACF
		remove_menu_page('plugins.php');
		remove_submenu_page('themes.php', 'theme-editor.php');
		remove_submenu_page('themes.php', 'themes.php');
	}
}
add_action('admin_init', 'remove_menus', 999);

function gkp_add_sticky_post_support() {
	global $post, $typenow; ?>

	<?php if ( $typenow == 'stories' && current_user_can( 'edit_others_posts' ) ) : ?>
	<script>
	jQuery(function($) {
		var sticky = "<br/><span id='sticky-span'><input id='sticky' name='sticky' type='checkbox' value='sticky' <?php checked( is_sticky( $post->ID ) ); ?> /> <label for='sticky' class='selectit'><?php _e("Stick this post", "gwc"); ?></label><br /></span>";
		$('[for=visibility-radio-public]').append(sticky);
	});
	</script>
	<?php endif; ?>
<?php
}
add_action('admin_footer-post.php', 'gkp_add_sticky_post_support' );
add_action('admin_footer-post-new.php', 'gkp_add_sticky_post_support' );

function create_post_type() {
   $types = get_custom_post_types();

   foreach($types as $k => $args) {
   	  register_post_type($k, $args);
   }
}
add_action('init', 'create_post_type');

function polylang_slug_filtered_taxonomies( $taxonomies ){
	$add_taxonomies = array(
			'category' => 'category'
	);
	return array_merge( $taxonomies, $add_taxonomies );
}
add_filter('pll_filtered_taxonomies', 'polylang_slug_filtered_taxonomies');

function loadProductsViaAjax() {
	if (isset($_SERVER['HTTPS']))
		$protocol = 'https://';
	else
		$protocol = 'http://';

?>
   <script type="text/javascript">
   	   var templateUrl = '<?php bloginfo('template_url'); ?>';
	   <?php if (is_page(252) || is_page(pll_get_post(252))) : ?>
	      myAjaxUrl = '<?= admin_url('admin-ajax.php', $protocol); ?>',
	      myNonce = '<?= wp_create_nonce( 'ajax-product-nonce' ) ?>';
	   <?php endif; ?>
   </script>
<?php
}
add_action('wp_head', 'loadProductsViaAjax');

function my_body_class($classes) {
	global $post;
	$classes = array();

	if ($post && $post->ID == pll_get_post(387)) {
		$classes[] = 'dark';
	}

	return $classes;
}
add_filter('body_class', 'my_body_class');

function header_menu_setup() {
	$lang = pll_current_language();
	$headerMenu = wp_get_nav_menu_items($lang.'_header_menu');

	if (empty($headerMenu) && $lang !== pll_default_language()) {
		$lang = pll_default_language();
		$headerMenu = wp_get_nav_menu_items($lang.'_header_menu');
	}

	$menu = array();

	foreach((array)$headerMenu as $m) {
		if (!$m->menu_item_parent) {
			$menu[] = array('id' => $m->ID, 'url' => $m->url, 'title' => $m->title, 'post_name' => $m->post_name, 'submenu' => array());
		}
		else {
			end($menu);

			if ($m->xfn === 'picture') {
				$m->icon = array_filter(Menu_Icons_Meta::get($m->ID));
			}

			$subitem = array('id' => $m->ID, 'url' => $m->url, 'title' => $m->title, 'xfn'=> $m->xfn, 'image' => $m->icon ? (isset($m->icon['url'])?$m->icon['url']:'') : '', 'indent' => ($menu[key($menu)]['id'] != $m->menu_item_parent));

			$menu[key($menu)]['submenu'][] = $subitem;
		}
	}

	echo '<nav class="menu">';
	foreach((array)$menu as $m) {
		$m['class'] = '';
		$m['class'] .= ($m['submenu'] ? "expanded" : "");
		$m['class'] .= (is_page($m['post_name']) ? " active" : "");
		echo '<a href="'.$m['url'].'" '.($m['class'] ? 'class="'.$m['class'].'"' : '').'>'.$m['title'].'</a>';

		if ($m['submenu']) {
			echo '<div class="submenu">';

			if ($m['submenu'][0]['xfn'] === 'picture') {
				echo '<div class="picture">';
			}
			else {
				echo '<div>';
			}

			foreach($m['submenu'] as $k => $sm) {
				if ($k !== 0 && $sm['xfn'] === 'picture') {
					continue;
				}

				if ($sm['xfn'] === 'picture') {
					if (!empty($sm['image'])) {
						echo '<div style="background-image:url('.$sm['image'].')"></div>';
					}

					echo '<a href="'.$sm['url'].'" class="button link btn-icon">'.$sm['title'].'<svg class="icon icon-arrow"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-arrow"></use></svg></a>';
					continue;
				}

				if ($k !== 0 && in_array($sm['url'], array('#', ''))) {
					echo '</div><div>';
				}

				if (in_array($sm['url'], array('#', ''))) {
					echo $sm['title'];
				}
				else {
					echo '<a '.($sm['indent'] ? 'class="indent" ' : '').'href="'.$sm['url'].'">'.$sm['title'].'</a>';
				}
			}

			echo '</div></div>';
		}
	}
	echo '</nav>';
}
add_action('header_menu', 'header_menu_setup');

function footer_menu_setup() {
	$lang = pll_current_language();
	$footerMenu = wp_get_nav_menu_items($lang.'_footer_menu');

	if (empty($footerMenu) && $lang !== pll_default_language()) {
		$lang = pll_default_language();
		$footerMenu = wp_get_nav_menu_items($lang.'_footer_menu');
	}

	$menu = array();

	foreach((array)$footerMenu as $m) {
		if (in_array($m->url, array('#', ''))) {
			$menu[] = array('url' => $m->url, 'title' => $m->title, 'post_name' => $m->post_name, 'submenu' => array());
		}
		else {
			end($menu);
			$menu[key($menu)]['submenu'][] = array('url' => $m->url, 'title' => $m->title, 'desc' => $m->description);
		}
	}

	echo '<div class="column">';
	foreach((array)$menu as $k => $m) {
		if ($k === 0) {
			echo '<div class="content">';
		}
		elseif ($k % 3 === 0) {
			echo '</div><div class="content">';
		}

		if ($k === count($menu)-1) {
			echo '</div></div>';
		}

		echo '<div class="column">';
		echo '<div class="title">'.$m['title'].'<svg class="icon icon-arrow-up"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-arrow-up"></use></svg></div>';
		if ($m['submenu']) {
			echo '<div><ul>';
			foreach($m['submenu'] as $k => $sm) {
				echo '<li><a href="'.$sm['url'].'">'.$sm['title'].'</a></li>';
			}
			echo '</ul></div>';
		}
		echo '</div>';
	}
	echo '</div></div>';
}
add_action('footer_menu', 'footer_menu_setup');

function crafton_login() {
	$loginUrl = get_stylesheet_directory_uri() . '/login.css';
	wp_register_style('loginStyle', $loginUrl);
	wp_enqueue_style('loginStyle');
}
add_action('login_head', 'crafton_login', 1);

function jpeg_new_quality($arg) {
	return 90;
}
add_filter('jpeg_quality', 'jpeg_new_quality');

function custom_menu_order($menu_ord) {
	if (!$menu_ord) return true;
	return array(
			'index.php',

			'separator1',

			'edit.php',
			'edit.php?post_type=news',
			'edit.php?post_type=stories',
			'edit.php?post_type=job',
			'edit.php?post_type=award',
			'edit.php?post_type=certificate',
			'edit.php?post_type=product',
			'edit.php?post_type=address',

			'separator2',

			'edit.php?post_type=page',
			'upload.php',

			'separator3',

			'admin.php?page=loco',

			'separator-last',

			'themes.php',
			'plugins.php',
			'users.php',
			'options-general.php',
	);
}
add_filter('custom_menu_order', 'custom_menu_order');
add_filter('menu_order', 'custom_menu_order');

function hide_editor() {
    remove_post_type_support('page', 'editor');
    remove_post_type_support('post', 'editor');
    remove_post_type_support('post', 'custom-fields');
    remove_post_type_support('post', 'custom-fields');
}
add_action('admin_init', 'hide_editor');

function custom_pre_get_posts($q) {
	if ($title = $q->get('_meta_or_title')) {
		add_filter('get_meta_sql', function($sql) use ($title) {
			global $wpdb;

			// Only run once:
			static $nr = 0;
			if ( 0 != $nr++ ) return $sql;

			// Modify WHERE part:
			$sql['where'] = sprintf(
					" AND ( %s OR %s ) ",
					$wpdb->prepare( "{$wpdb->posts}.post_title like '%%%s%%'", $title),
					str_replace('.meta_key = \'', '.meta_key LIKE \'', mb_substr( $sql['where'], 5, mb_strlen( $sql['where'] ) ) )
					);
			//error_log($sql['where']);

			return $sql;
		});
	}
}
add_action( 'pre_get_posts', 'custom_pre_get_posts');

function my_toolbars($toolbars) {
	// Uncomment to view format of $toolbars
	/*
	 echo '< pre >';
		print_r($toolbars);
		echo '< /pre >';
		die;
		*/

	// Add a new toolbar called "Very Simple"
	// - this toolbar has only 1 row of buttons
	$toolbars['Very simple' ] = array();
	$toolbars['Very simple' ][1] = array('bold' , 'italic' , 'underline', 'link', 'unlink' );

	// Edit the "Full" toolbar and remove 'code'
	// - delete from array code from http://stackoverflow.com/questions/7225070/php-array-delete-by-value-not-key
	if ( ($key = array_search('code' , $toolbars['Full' ][2])) !== false ) {
		unset( $toolbars['Full' ][2][$key] );
	}

	// remove the 'Basic' toolbar completely
	//unset( $toolbars['Basic' ] );

	// return $toolbars - IMPORTANT!
	return $toolbars;
}
add_filter('acf/fields/wysiwyg/toolbars' , 'my_toolbars');

function time_interval() {
	$time = get_the_time('U');

	$datetime = new DateTime();
	$datetime->setTimestamp($time);
	$interval = $datetime->diff(new DateTime(), true);

	if (($cond = $interval->format('%m')) >= 1) {
		$result = intval($cond);

		if ($result === 1) {
			$result .= ' '.__('month', 'gwc');
		}
		else {
			$result .= ' '.__('months', 'gwc');
		}

		return $result;
	}

	if (($cond = $interval->format('%d')) >= 1) {
		$result = intval($cond);

		if ($result > 7) {
			return get_the_time('F j, Y');
		}

		if ($result === 1) {
			$result .= ' '.__('day', 'gwc');
		}
		else {
			$result .= ' '.__('days', 'gwc');
		}

		return $result;
	}

	if (($cond = $interval->format('%h')) >= 1) {
		$result = intval($cond).' H';

		return $result;
	}

	if (($cond = $interval->format('%i')) >= 1) {
		$result = intval($cond).' M';

		return $result;
	}

	return __('now', 'gwc');
}

function endsWith($haystack, $needle) {
	// search forward starting from end minus needle length characters
	return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== false);
}

function is_ajax() {
	return defined('DOING_AJAX') && DOING_AJAX;
}

function get_custom_post_types() {
	$result = array();

	$title = __('News', 'gwc');
	$labels = array(
			'name'                => $title,
			'singular_name'       => $title,
			'menu_name'           => $title,
			'parent_item_colon'   => __('Parent item:', 'gwc'),
			'all_items'           => __('All items', 'gwc' ),
			'view_item'           => __('Show news', 'gwc' ),
			'add_new_item'        => __('Add a news', 'gwc'),
			'add_new'             => __('Add a news', 'gwc'),
			'edit_item'           => __('Edit', 'gwc'),
			'update_item'         => __('Update', 'gwc'),
			'search_items'        => __('Search', 'gwc'),
			'not_found'           => __('Not found', 'gwc'),
			'not_found_in_trash'  => __( 'Not found in trash', 'gwc'),
	);
	$rewrite = array(
			'slug'                => 'news',
			'with_front'          => true,
			'pages'               => true,
			'feeds'               => true,
	);
	$args = array(
			'label'               => $title,
			'description'         => $title,
			'labels'              => $labels,
			'supports'            => array('title', 'thumbnail'),
			'taxonomies'			=> array('post_tag'),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 4,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'rewrite'             => $rewrite,
			'menu_icon'           => 'dashicons-analytics',
			'capability_type'     => 'post',
	);
	$result['news'] = $args;


	$title = __('Stories', 'gwc');
	$labels = array(
			'name'                => $title,
			'singular_name'       => $title,
			'menu_name'           => $title,
			'parent_item_colon'   => __('Parent item:', 'gwc'),
			'all_items'           => __('All items', 'gwc' ),
			'view_item'           => __('Show stories', 'gwc' ),
			'add_new_item'        => __('Add a story', 'gwc'),
			'add_new'             => __('Add a story', 'gwc'),
			'edit_item'           => __('Edit', 'gwc'),
			'update_item'         => __('Update', 'gwc'),
			'search_items'        => __('Search', 'gwc'),
			'not_found'           => __('Not found', 'gwc'),
			'not_found_in_trash'  => __( 'Not found in trash', 'gwc'),
	);
	$rewrite = array(
			'slug'                => 'stories',
			'with_front'          => true,
			'pages'               => true,
			'feeds'               => true,
	);
	$args = array(
			'label'               => $title,
			'description'         => $title,
			'labels'              => $labels,
			'supports'            => array('title'),
			'taxonomies'		  => array('post_tag', 'category'),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'rewrite'             => $rewrite,
			'menu_icon'           => 'dashicons-book-alt',
			'capability_type'     => 'post',
	);
	$result['stories'] = $args;

	$title = __('Job offers', 'gwc');
	$labels = array(
			'name'                => $title,
			'singular_name'       => $title,
			'menu_name'           => $title,
			'parent_item_colon'   => __('Parent item:', 'gwc'),
			'all_items'           => __('All items', 'gwc' ),
			'view_item'           => __('Show offers', 'gwc' ),
			'add_new_item'        => __('Add a offer', 'gwc'),
			'add_new'             => __('Add a offer', 'gwc'),
			'edit_item'           => __('Edit', 'gwc'),
			'update_item'         => __('Update', 'gwc'),
			'search_items'        => __('Search', 'gwc'),
			'not_found'           => __('Not found', 'gwc'),
			'not_found_in_trash'  => __( 'Not found in trash', 'gwc'),
	);
	$rewrite = array(
			'slug'                => 'offers',
			'with_front'          => true,
			'pages'               => true,
			'feeds'               => true,
	);
	$args = array(
			'label'               => $title,
			'description'         => $title,
			'labels'              => $labels,
			'supports'            => array('title'),
			'taxonomies'		  => array('post_tag'),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 6,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'rewrite'             => $rewrite,
			'menu_icon'           => 'dashicons-groups',
			'capability_type'     => 'post',
	);
	$result['job'] = $args;


	$title = __('Awards', 'gwc');
	$labels = array(
			'name'                => $title,
			'singular_name'       => $title,
			'menu_name'           => $title,
			'parent_item_colon'   => __('Parent item:', 'gwc'),
			'all_items'           => __('All items', 'gwc' ),
			'view_item'           => __('Show award', 'gwc' ),
			'add_new_item'        => __('Add award', 'gwc'),
			'add_new'             => __('Add award', 'gwc'),
			'edit_item'           => __('Edit', 'gwc'),
			'update_item'         => __('Update', 'gwc'),
			'search_items'        => __('Search', 'gwc'),
			'not_found'           => __('Not found', 'gwc'),
			'not_found_in_trash'  => __( 'Not found in trash', 'gwc')
	);
	$rewrite = array(
			'slug'                => 'award',
			'with_front'          => true,
			'pages'               => true,
			'feeds'               => true,
	);
	$args = array(
			'label'               => $title,
			'description'         => $title,
			'labels'              => $labels,
			'supports'            => array('title'),
			'taxonomies'			=> array('post_tag'),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 7,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'rewrite'             => $rewrite,
			'menu_icon'           => 'dashicons-awards',
			'capability_type'     => 'post',
	);
	$result['award'] = $args;

	$title = __('Certificates', 'gwc');
	$labels = array(
			'name'                => $title,
			'singular_name'       => $title,
			'menu_name'           => $title,
			'parent_item_colon'   => __('Parent item:', 'gwc'),
			'all_items'           => __('All items', 'gwc' ),
			'view_item'           => __('Show certificate', 'gwc' ),
			'add_new_item'        => __('Add certificate', 'gwc'),
			'add_new'             => __('Add certificate', 'gwc'),
			'edit_item'           => __('Edit', 'gwc'),
			'update_item'         => __('Update', 'gwc'),
			'search_items'        => __('Search', 'gwc'),
			'not_found'           => __('Not found', 'gwc'),
			'not_found_in_trash'  => __( 'Not found in trash', 'gwc')
	);
	$rewrite = array(
			'slug'                => 'certificate',
			'with_front'          => true,
			'pages'               => true,
			'feeds'               => true,
	);
	$args = array(
			'label'               => $title,
			'description'         => $title,
			'labels'              => $labels,
			'supports'            => array('title'),
			'taxonomies'			=> array('post_tag'),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 8,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'rewrite'             => $rewrite,
			'menu_icon'           => 'dashicons-star-filled',
			'capability_type'     => 'post',
	);
	$result['certificate'] = $args;

	$title = __('Products', 'gwc');
	$labels = array(
			'name'                => $title,
			'singular_name'       => $title,
			'menu_name'           => $title,
			'parent_item_colon'   => __('Parent item:', 'gwc'),
			'all_items'           => __('All items', 'gwc' ),
			'view_item'           => __('Show product', 'gwc' ),
			'add_new_item'        => __('Add product', 'gwc'),
			'add_new'             => __('Add product', 'gwc'),
			'edit_item'           => __('Edit', 'gwc'),
			'update_item'         => __('Update', 'gwc'),
			'search_items'        => __('Search', 'gwc'),
			'not_found'           => __('Not found', 'gwc'),
			'not_found_in_trash'  => __( 'Not found in trash', 'gwc')
	);
	$rewrite = array(
			'slug'                => 'product',
			'with_front'          => true,
			'pages'               => true,
			'feeds'               => true,
	);
	$args = array(
			'label'               => $title,
			'description'         => $title,
			'labels'              => $labels,
			'supports'            => array('title'),
			'taxonomies'			=> array('post_tag'),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 9,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'rewrite'             => $rewrite,
			'menu_icon'           => 'dashicons-screenoptions',
			'capability_type'     => 'post',
	);
	$result['product'] = $args;

	$title = __('Addresses', 'gwc');
	$labels = array(
			'name'                => $title,
			'singular_name'       => $title,
			'menu_name'           => $title,
			'parent_item_colon'   => __('Parent item:', 'gwc'),
			'all_items'           => __('All items', 'gwc' ),
			'view_item'           => __('Show address', 'gwc' ),
			'add_new_item'        => __('Add address', 'gwc'),
			'add_new'             => __('Add address', 'gwc'),
			'edit_item'           => __('Edit', 'gwc'),
			'update_item'         => __('Update', 'gwc'),
			'search_items'        => __('Search', 'gwc'),
			'not_found'           => __('Not found', 'gwc'),
			'not_found_in_trash'  => __( 'Not found in trash', 'gwc')
	);
	$rewrite = array(
			'slug'                => 'address',
			'with_front'          => true,
			'pages'               => true,
			'feeds'               => true,
	);
	$args = array(
			'label'               => $title,
			'description'         => $title,
			'labels'              => $labels,
			'supports'            => array('title'),
			'taxonomies'			=> array('post_tag'),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 10,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'rewrite'             => $rewrite,
			'menu_icon'           => 'dashicons-location-alt',
			'capability_type'     => 'page',
	);
	$result['address'] = $args;

	return $result;
}

function ajax_product() {
	if (!wp_verify_nonce($_REQUEST['security'], "ajax-product-nonce" ) ) {
		exit();
	}

	$object = get_post($_REQUEST['post_id']);
	$GLOBALS['post'] = $object;

	if (is_ajax()) {
		get_template_part('subpage', 'products');
		die();
	}
	else {
		wp_redirect(get_permalink(pll_get_post($post_id)));
		exit();
	}
}
add_action('wp_ajax_nopriv_ajax_product', 'ajax_product');
add_action('wp_ajax_ajax_product', 'ajax_product');

add_action('after_setup_theme', 'custom_setup_theme');

   function custom_setup_theme() {
		load_theme_textdomain('gwc', get_template_directory());
	}

// show 10 post on archive news page
add_action( 'pre_get_posts', 'change_number_of_posts' );
	function change_number_of_posts( $query ) {

		if ( is_post_type_archive( 'news' ) && is_year() ) {
			$query->set( 'posts_per_page', 5 );
			return;
		}
	}

//  fixed trouble with acf and tinymce editor that display too small table
add_action('admin_init', 'my_theme_add_editor_styles');

  function my_theme_add_editor_styles() {

  add_editor_style('stylesheets/editor.css');

}

add_filter('acf/fields/google_map/api', function ($value) {
	$value['key'] = 'AIzaSyCI-3LoCijYhHFXqG40GYBcI2TKmGQV1LM';
	return $value;
});


function customWYSIWYG($arr){
	$arr['block_formats'] = 'Paragraph=p;Heading 2=h3';
	return $arr;
}
add_filter('tiny_mce_before_init', 'customWYSIWYG');

/**
*	Easier SQL debugging
*/
function debugQuery($args) {
	$the_query = new WP_Query($args);
	pr($args);
	echo "SQL:\n" . $the_query->request . "\n";
	die('debugQuery died');
}


function sqlDump() {
	global $wpdb;
	foreach ( $wpdb->queries as $key => $data ) {
		$query = rtrim($data[0]);
		echo "=== " . $query . "\n";
	}
}


/**
*	Easier vars debugging
*/
function pr($var, $pre = 1) {
	echo $pre?"\n<pre>\n":"\n";
	if ($var) {
		print_r($var);
	} else {
		var_dump($var);
	}
	echo $pre?"\n</pre>\n":"\n";
}

?>