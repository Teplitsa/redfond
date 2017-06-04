<?php
/**
 * Theme functions
 **/

define('GRT_VERSION', wp_get_theme()->get('Version'));
define('GRT_UPDATE_METADATA_URL', 'https://github.com/Teplitsa/grassroots/blob/master/grassroots-metadata.json');

/**  Theme setup **/
add_action('after_setup_theme', 'grt_setup');
function grt_setup() {
	
	// Automatic feed
	add_theme_support('automatic-feed-links');
	
	// Set content-width
	global $content_width;
	if( !isset($content_width) ) {
        $content_width = 700;
    }
	
	// Post thumbnails
	add_theme_support('post-thumbnails');
	set_post_thumbnail_size(340, 235, true);
	
	add_image_size('post-mini', 88, 88, true);
	add_image_size('post-image', 973, 640, false);
	add_image_size('post-thumb', 700, 380, true); // to-do
		
	// Add nav menu
	register_nav_menu('primary', __('Primary Menu','grt'));
	
	// Translation
	load_theme_textdomain('grt', get_template_directory().'/lang');
		
	$locale = get_locale();
	$locale_file = get_template_directory()."/lang/$locale.php";
	if(is_readable($locale_file))
		require_once($locale_file);
	
}

/** Widget area **/
add_action('widgets_init', 'grt_register_sidebar');
function grt_register_sidebar() {
	register_sidebar(array(
	  'name' => __( 'Sidebar', 'grt' ),
	  'id' => 'sidebar',
	  'description' => __( 'Widgets in this area will be shown in the sidebar.', 'grt' ),
	  'before_title' => '<h3 class="widget-title">',
	  'after_title' => '</h3>',
	  'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
	  'after_widget' => '</div><div class="clear"></div></div>'
	));
}


/** Scripts and styles **/

// Front:
add_action('wp_enqueue_scripts', 'grt_front_scripts');
function grt_front_scripts() {

    $theme_dir_url = get_template_directory_uri();
	
	$script_dependencies = array('jquery');
	
    wp_register_script(
        'jq-imagelightbox',
        $theme_dir_url.'/js/imagelightbox.js',
        $script_dependencies,
		GRT_VERSION,
		true
    );	
	$script_dependencies[] =  'jq-imagelightbox';

    if(get_option('show_on_front') == 'posts' && get_theme_mod('homepage_template') == 'campaigns') {

        wp_enqueue_script('jquery-masonry');
        $script_dependencies[] = 'jquery-masonry';
    }
	
	//@to_do add imageloaded
	 
    wp_enqueue_script(
		'grt-front',
		$theme_dir_url.'/js/front.js',
		$script_dependencies,
		GRT_VERSION,
		true
	);

	wp_enqueue_script(
		'grt-likely',
		$theme_dir_url.'/js/likely.js',
		$script_dependencies,
		GRT_VERSION,
		true
	);

	wp_enqueue_script(
		'grt-emerge',
		$theme_dir_url.'/js/emerge.js',
		$script_dependencies,
		GRT_VERSION,
		true
	);


	// Styles
	$style_dependencies = array();

	// Google fonts	
	$google_request = '//fonts.googleapis.com/css?family=PT+Sans:400,500,700,700i&amp;subset=cyrillic,latin';
	$google_request1 = '//fonts.googleapis.com/css?family=PT+Serif:400,700;subset=cyrillic,latin';
	wp_enqueue_style(
		'grt-google-fonts',
		$google_request, $google_request1,
		$style_dependencies,
		GRT_VERSION
	);

	$style_dependencies[] = 'grt-google-fonts';
	
	// Dashicons
	wp_enqueue_style('dashicons');
	$style_dependencies[] = 'dashicons';

	// Stylesheet
	wp_enqueue_style('grt-style', $theme_dir_url.'/style.css', $style_dependencies, GRT_VERSION);
	wp_enqueue_style('grt-likelystyle', $theme_dir_url.'/likely.css', $style_dependencies, GRT_VERSION);
}

// Admin:
add_action('admin_enqueue_scripts', 'grt_admin_scripts');
function grt_admin_scripts() {

    wp_enqueue_script('grt-admin', get_template_directory_uri().'/js/admin.js', array('jquery'), GRT_VERSION, true);
}

// test for browser supports javascript
add_action('wp_head', 'html_js_class', 1);
function html_js_class() {
    echo '<script>document.documentElement.className = document.documentElement.className.replace("no-js","js");</script>'."\n";
}

/** Includes **/
require get_template_directory().'/inc/media.php';
require get_template_directory().'/inc/extras.php';
require get_template_directory().'/inc/customizer.php';
require get_template_directory().'/inc/cyr-to-lat.php';

/* Description to be translatable */
__('Minimalistic theme to be used with Leyka plugin by Teplitsa. Design based on Fukasava theme by Anders Norén (http://www.andersnoren.se)', 'grt');

add_action( 'pre_get_posts', 'my_show_campaigns' );
function my_show_campaigns( $query ) {
	// is_home - проверяет, чтобы это была главная страница
	if( is_home() && $query->is_main_query() ) :
		$query->set( 'post_type', 'leyka_campaign' );
	endif;
}
add_filter('the_excerpt', 'do_shortcode');
remove_filter('get_the_excerpt', 'wp_trim_excerpt', 10);
add_filter('get_the_excerpt', 'my_custom_wp_trim_excerpt', 99, 1);
function my_custom_wp_trim_excerpt($text) {
    if(''==$text) {
        $text= preg_replace('/\s/', ' ', wp_strip_all_tags(get_the_content('')));
        $text= explode(' ', $text, 56);
        array_pop($text);
        $text= implode(' ', $text);
    }
    return $text;
}