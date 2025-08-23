<?php
/**
 * Firstfold functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package firstfold
 */

if (!defined('_FF_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_FF_VERSION', '1.0.2');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function firstfold_setup()
{
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on firstfold, use a find and replace
	 * to change 'firstfold' to the name of your theme in all the template files.
	 */
	load_theme_textdomain('firstfold', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support('title-tag');

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support('post-thumbnails');

	/*
	 * This theme uses wp_nav_menu() in one location.
	 * Dont forget to remove unused menu
	 */

	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'firstfold'),
			'privacy-menu' => esc_html__('Privacy Policy', 'firstfold'),
			'social-menu' => esc_html__('Social', 'firstfold'),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'firstfold_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height' => 250,
			'width' => 250,
			'flex-width' => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'firstfold_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function firstfold_content_width()
{
	$GLOBALS['content_width'] = apply_filters('firstfold_content_width', 640);
}
add_action('after_setup_theme', 'firstfold_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function firstfold_widgets_init()
{
	register_sidebar(
		array(
			'name' => esc_html__('Sidebar', 'firstfold'),
			'id' => 'sidebar-1',
			'description' => esc_html__('Add widgets here.', 'firstfold'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		)
	);
}
add_action('widgets_init', 'firstfold_widgets_init');

/**
 * Enqueue scripts and styles in the frontend.
 */
function firstfold_scripts()
{
	wp_enqueue_style('firstfold-style', get_stylesheet_uri(), array(), _FF_VERSION);
	wp_style_add_data('firstfold-style', 'rtl', 'replace');
	wp_enqueue_style('main', get_template_directory_uri() . '/frontend/static/css/main.min.css', array(), _FF_VERSION);
	wp_enqueue_script('jquery');
	wp_enqueue_script('firstfold-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _FF_VERSION, true);
	wp_enqueue_script('main', get_template_directory_uri() . '/frontend/static/js/main.min.js', array(), _FF_VERSION, true);
	wp_enqueue_script('transition', get_template_directory_uri() . '/frontend/static/js/transition.min.js', array(), _FF_VERSION, true);
	wp_enqueue_script('swiper', get_template_directory_uri() . '/libraries/swiper/swiper-bundle.min.js', array(), _FF_VERSION, true);
	wp_enqueue_style('swiper', get_template_directory_uri() . '/libraries/swiper/swiper-bundle.min.css', array(), _FF_VERSION);
	wp_enqueue_script('split-type', get_stylesheet_directory_uri() . '/libraries/split-type/index.min.js', array(), _FF_VERSION, true);
	wp_enqueue_script('gsap', get_stylesheet_directory_uri() . '/libraries/gsap/gsap.min.js', array(), _FF_VERSION, true);
	wp_enqueue_script('gsap-scroll', get_stylesheet_directory_uri() . '/libraries/gsap/ScrollTrigger.min.js', array(), _FF_VERSION, true);

	wp_localize_script(
		'main',
		'ajaxVar',
		array(
			'ajaxUrl' => admin_url('admin-ajax.php'),
			'nonce' => wp_create_nonce('ajax-nonce'),
		)
	);
	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'firstfold_scripts');

/**
 * Enqueues styles and script on the frontend and in the block editor.
 */
function ff_block_assets()
{
	wp_enqueue_style('tailwind', get_template_directory_uri() . '/tailwind/dist/output.min.css', array(), _FF_VERSION);
	wp_enqueue_style('slick', get_template_directory_uri() . '/libraries/slick/slick.css', array(), _FF_VERSION);
	wp_enqueue_style('components', get_template_directory_uri() . '/frontend/static/css/components.min.css', array(), _FF_VERSION);
	wp_enqueue_script('components', get_template_directory_uri() . '/frontend/static/js/components.min.js', array(), _FF_VERSION, true);
	wp_enqueue_script('preline', get_template_directory_uri() . '/libraries/preline/preline.js', array(), _FF_VERSION, true);
	wp_enqueue_script('resize-sensor', get_template_directory_uri() . '/libraries/resize-sensor/resize-sensor.js', array(), _FF_VERSION, true);
	wp_enqueue_script('alpine', 'https://cdn.jsdelivr.net/npm/alpinejs@3.12.1/dist/cdn.min.js', array(), _FF_VERSION, true);
	wp_enqueue_script('jquery-resizable', get_template_directory_uri() . '/libraries/jquery-resizable/jquery-resizable.js', array(), _FF_VERSION, true);
}
add_action('enqueue_block_assets', 'ff_block_assets');

/**
 * Add defer attribute to script.
 *
 * @param String $tag script tag.
 * @param String $handle Name of the script.
 * @param String $src Full URL of the script, or path of the script.
 */
function ff_defer_scripts($tag, $handle, $src)
{
	$defer = array(
		'alpine',
	);

	if (in_array($handle, $defer, true)) {
		return '<script src="' . $src . '" defer="defer" type="text/javascript"></script>' . "\n"; // phpcs:ignore WordPress.WP.EnqueuedResources.NonEnqueuedScript
	}

	return $tag;
}

add_filter('script_loader_tag', 'ff_defer_scripts', 10, 3);

/**
 * Enqueue a script and style in the WordPress admin.
 */
function ff_load_admin_styles()
{
	wp_enqueue_style('admin', get_template_directory_uri() . '/dashboard/dashboard.min.css', array(), _FF_VERSION);
}
add_action('admin_enqueue_scripts', 'ff_load_admin_styles');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if (class_exists('WooCommerce')) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Load autoload.
 */
require_once __DIR__ . '/vendor/autoload.php';

/**
 * Load Frontend Components.
 *
 * @param array $directories array of directory.
 */
function ff_load_directories($directories)
{
	$directories[] = get_template_directory() . '/frontend/components';
	return $directories;
}
add_filter('loader_directories', 'ff_load_directories');

/**
 * Create alias for moxie-lean/loader.
 *
 * @param array $alias array of alias.
 */
function ff_load_alias($alias)
{
	$alias['atom'] = 'atoms';
	$alias['molecule'] = 'molecules';
	$alias['organism'] = 'organisms';
	return $alias;
}
add_filter('loader_alias', 'ff_load_alias');

/**
 * Load acf blocks.
 */
require get_template_directory() . '/acf/blocks/blocks.php';

/**
 * Load Register blocks.
 */
require get_template_directory() . '/acf/blocks/register-fields.php';

/**
 * Load acf fields.
 */
require get_template_directory() . '/acf/global-fields/fields.php';


/**
 * Enable SVG and json file upload
 *
 * @param mimes $mimes return mime type.
 */
function ff_mime_types($mimes)
{
	$mimes['svg'] = 'image/svg+xml';
	$mimes['json'] = 'text/plain';
	return $mimes;
}
add_filter('upload_mimes', 'ff_mime_types');

/**
 * Enable ACF Option page.
 */
if (function_exists('acf_add_options_page')) {
	acf_add_options_page(
		array(
			'page_title' => 'Theme General Settings',
			'menu_title' => 'Theme Settings',
			'menu_slug' => 'theme-general-settings',
			'capability' => 'edit_posts',
			'redirect' => false,
		)
	);
}

/**
 * Add inline css style in editor
 * to make it full width.
 */
function ff_editor_full_width_gutenberg()
{
	$is_enable = true;

	if ($is_enable) {
		echo '<style>
			body.gutenberg-editor-page .editor-post-title__block, body.gutenberg-editor-page .editor-default-block-appender, body.gutenberg-editor-page .editor-block-list__block {
				max-width: none !important;
			}
			.block-editor__container .wp-block {
				max-width: none !important;
			}

			/*code editor*/
			.edit-post-text-editor__body {
				max-width: none !important;
				margin-left: 2%;
				margin-right: 2%;
			}
		</style>';
	}
}
add_action('admin_head', 'ff_editor_full_width_gutenberg');

/**
 * Add ACF Blocks Category
 *
 * @param Array  $categories array of categories.
 * @param Object $post post object.
 */
function ff_block_category($categories, $post)
{
	return array_merge(
		$categories,
		array(
			array(
				'slug' => 'ff-blocks',
				'title' => 'GL Blocks',
			),
		)
	);
}
add_filter('block_categories_all', 'ff_block_category', 10, 2);

/**
 * Get Blocks assets.
 *
 * @param String $block_name block folder name.
 * @param String $filename asset filename.
 */
function ff_get_block_asset($block_name, $filename)
{
	echo esc_url(get_template_directory_uri() . '/acf/blocks/' . $block_name . '/img/' . $filename);
}

/**
 * Get Blocks assets url.
 *
 * @param String $block_name block folder name.
 * @param String $filename asset filename.
 */
function ff_get_block_asset_url($block_name, $filename)
{
	return get_template_directory_uri() . '/acf/blocks/' . $block_name . '/img/' . $filename;
}

/**
 * Get Component assets.
 *
 * @param String $component_type component type.
 * @param String $component_name component folder name.
 * @param String $filename component image file name.
 */
function ff_get_component_url($component_type, $component_name, $filename)
{
	return get_template_directory_uri() . '/frontend/components/' . $component_type . '/' . $component_name . '/img/' . $filename;
}

/**
 * Add Custom attributes to menu link.
 *
 * @param Array  $atts array of attributes.
 * @param Object $item object item.
 * @param Object $args object arguments.
 */
function ff_add_menu_link_attributes($atts, $item, $args)
{
	if ('menu-1' === $args->theme_location) {
		$atts['class'] = 'custom-class-here';
	}
	return $atts;
}
add_filter('nav_menu_link_attributes', 'ff_add_menu_link_attributes', 10, 3);

/**
 * Customize WYSIWYG ACF Toolbars
 *
 * @param Array $toolbars array of ACF WYSIWYG toolbars.
 */
function ff_customize_acf_wysiwyg($toolbars)
{
	// Unset Basic Type Toolbar.
	unset($toolbars['Basic']['bold']);

	// Register a basic toolbar with a single row of options.
	$toolbars['Full'][1] = array(
		'formatselect',
		// 'fontsizeselect',
		'bold',
		'italic',
		'alignleft',
		'aligncenter',
		'alignright',
		'bullist',
		'numlist',
		'link',
		'unlink',
		'forecolor',
		// 'removeformat'
	);

	return $toolbars;
}
add_filter('acf/fields/wysiwyg/toolbars', 'ff_customize_acf_wysiwyg');

/**
 * Remove Copy/Paste Preformatting on ACF WYSIWYG.
 *
 * @param array $settings array of ACF WYSIWYG Settings.
 */
function ff_remove_acf_preformatting($settings)
{
	// Disable paste with formatting.
	$settings['paste_as_text'] = true;

	return $settings;
}
add_filter('tiny_mce_before_init', 'ff_remove_acf_preformatting');

/**
 * Remove All Native Block.
 * Except blocks in the $allowed_blocks
 *
 * @param array $allowed_blocks array of Native Blocks.
 */
function ff_allow_acf_blocks_starting_with_acf($allowed_blocks)
{
	// Disable all native blocks.
	$allowed_blocks = array('core/paragraph', 'core/heading', 'core/list');

	// Get all ACF blocks and add them to the allowed blocks list.
	$acf_blocks = WP_Block_Type_Registry::get_instance()->get_all_registered();
	foreach ($acf_blocks as $acf_block) {
		if (0 === strpos($acf_block->name, 'acf/')) {
			$allowed_blocks[] = $acf_block->name;
		}
	}
	return $allowed_blocks;
}
add_filter('allowed_block_types_all', 'ff_allow_acf_blocks_starting_with_acf');

/**
 * Check if key exists in non and muti dimensional array
 *
 * @param string $search_key search key.
 * @param array  $array array to search for.
 */
function ff_array_key_exists_recursive($search_key, $array)
{
	if (!is_array($array)) {
		return null;
	}

	foreach ($array as $key => $value) {
		if ($key === $search_key) {
			return $value;
		}

		if (is_array($value)) {
			$result = ff_array_key_exists_recursive($search_key, $value);

			if (null !== $result) {
				return $result;
			}
		}
	}
	return null;
}

/**
 * Get Block Path
 *
 * @param String $block_name block folder name.
 * @param String $filename asset filename.
 */
function ff_get_custom_block_template($block_name, $filename)
{
	return get_template_directory() . '/acf/blocks/' . $block_name . '/templates/' . $filename;
}

/**
 * Hide Admin Bar in the frontend.
 */
add_filter('show_admin_bar', '__return_false');

/**
 * Add Custom class to nav li
 *
 * @param Array    $classes Array of the CSS classes that are applied to the menu item's <li> element.
 * @param WP_post  $item The current menu item object.
 * @param stdClass $args An object of wp_nav_menu() arguments.
 */
function ff_add_additional_class_on_li($classes, $item, $args)
{
	if (isset($args->add_li_class)) {
		$classes[] = $args->add_li_class;
	}
	return $classes;
}
add_filter('nav_menu_css_class', 'ff_add_additional_class_on_li', 1, 3);

/**
 * Remove empty p tag on wysiwyg.
 *
 * @param Html   $value html value.
 * @param Number $post_id The current menu item object.
 * @param Array  $field The field array containing all settings.
 */
function ff_my_acf_load_value($value, $post_id, $field)
{
	$content = apply_filters('the_content', $value);
	$content = force_balance_tags($content);
	$content = preg_replace('#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $content);
	$content = preg_replace('~\s?<p>(\s| )+</p>\s?~', '', $content);

	return $content;
}

add_filter('acf/load_value/type=wysiwyg', 'ff_my_acf_load_value', 10, 3);

/**
 * Function for cf7 newsletter
 *
 * @param string $result Form.
 * @param string $tag Form Details.
 */
function cf7_prevent_duplicate_email($result, $tag)
{
	$email_field_name = 'email-no-duplicate';
	$submission = WPCF7_Submission::get_instance();
	$wpcf7 = WPCF7_ContactForm::get_current();
	$form_id = $wpcf7->id();
	$form_name = $wpcf7->name();

	if ($submission) {

		if ('no-event-form' === $form_name || 'newsletter-form' === $form_name || 'newsletter' === $form_name) {
			$email = $submission->get_posted_data($email_field_name);
			global $wpdb;

			// Check if the email already exists in the database.
			$existing_submission = $wpdb->get_results( // phpcs:ignore WordPress.DB.DirectDatabaseQuery.NoCaching, WordPress.DB.DirectDatabaseQuery.DirectQuery
				$wpdb->prepare('SELECT * FROM wp_cf7_vdata_entry WHERE name LIKE %s AND value=%s AND cf7_id=%d', $email_field_name, $email, $form_id)
			);

			if ($existing_submission) {
				$result->invalidate($tag, 'Email Address already exists!');
			}
		}
	}

	return $result;
}

add_filter('wpcf7_validate_email*', 'cf7_prevent_duplicate_email', 10, 2);
add_filter('wpcf7_validate_email', 'cf7_prevent_duplicate_email', 10, 2);

add_filter('wpcf7_autop_or_not', '__return_false');
/**
 *
 * Add navbar item descriptions to the menu output .
 *
 * @param string   $item_output The HTML output for the menu item .
 * @param WP_Post  $item        The menu item object .
 * @param int      $depth       Depth of menu item . Used for padding .
 * @param stdClass $args        An object of wp_nav_menu() arguments .
 *
 * @return string  The modified HTML output for the menu item .
 */
function add_menu_description($item_output, $item, $depth, $args)
{
	if (!empty($item->description)) {
		$item_output = str_replace('>' . $item->title, '><span><span class="title">' . $item->title . '</span><span class="menu-item-description">' . $item->description . '</span></span>', $item_output);
	}
	return $item_output;
}
add_filter('walker_nav_menu_start_el', 'add_menu_description', 10, 4);

add_action(
	'acf/include_fields',
	function () { // phpcs:ignore PHPCompatibility.FunctionDeclarations.NewClosure.Found
		if (!function_exists('acf_add_local_field_group')) {
			return;
		}

		acf_add_local_field_group(
			array(
				'key' => 'group_65ee94d9b88b3',
				'title' => 'Code',
				'fields' => array(
					array(
						'key' => 'field_65ee94dad3d4e',
						'label' => 'Code Editor',
						'name' => 'code_editor',
						'type' => 'acfe_code_editor',
						'mode' => 'text/html',
						'lines' => 1,
						'indent_unit' => 4,
						'maxlength' => '',
						'rows' => 4,
						'max_rows' => '',
						'return_format' => array(
							0 => 'htmlentities',
						),
					),
				),
				'location' => array(
					array(
						array(
							'param' => 'block',
							'operator' => '==',
							'value' => 'acf/resizable',
						),
					),
				),
			)
		);
	}
);

/**
 * Function for excerpt
 *
 */
function add_excerpt_support_for_pages()
{
	add_post_type_support('page', 'excerpt');
}
add_action('init', 'add_excerpt_support_for_pages');
