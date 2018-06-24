<?php
/**
 * wordpress_template functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wordpress_template
 */

if (! function_exists('wordpress_template_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function wordpress_template_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on wordpress_template, use a find and replace
         * to change 'wordpress_template' to the name of your theme in all the template files.
         */
        load_theme_textdomain('wordpress_template', get_template_directory() . '/languages');

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

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'menu-1' => esc_html__('Primary', 'wordpress_template'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('wordpress_template_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support('custom-logo', array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        ));
    }
endif;
add_action('after_setup_theme', 'wordpress_template_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wordpress_template_content_width()
{
    $GLOBALS['content_width'] = apply_filters('wordpress_template_content_width', 640);
}
add_action('after_setup_theme', 'wordpress_template_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wordpress_template_widgets_init()
{
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'wordpress_template'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here.', 'wordpress_template'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'wordpress_template_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function wordpress_template_scripts()
{
    wp_enqueue_style('wordpress_template-style', get_stylesheet_uri());

    wp_enqueue_script('wordpress_template-navigation', get_template_directory_uri() . '/assets/js/navigation.min.js', array(), '20151215', true);

    wp_enqueue_script('wordpress_template-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.min.js', array(), '20151215', true);

    wp_enqueue_script('barba', get_template_directory_uri() . '/assets/js/barba.min.js', array(), '20151215', true);
    wp_enqueue_script('barba-custom', get_template_directory_uri() . '/assets/js/barba-custom.min.js', array(), '20151215', true);
    wp_enqueue_script('smooth-scroll', get_template_directory_uri() . '/assets/js/smooth-scroll.min.js', array(), '20151215', true);
    wp_enqueue_script('hiraku', get_template_directory_uri() . '/assets/js/hiraku.min.js', array(), '20151215', true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'wordpress_template_scripts');

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
 *  Include SVG icons
 */
if ( ! function_exists( 'wordpress_include_svg_icons' ) ) {
	function wordpress_include_svg_icons() {
		// Define SVG sprite file.
		$svg_icons = get_template_directory() . '/assets/svg/svgSprite.svg';

		// If it exists, include it.
		if ( file_exists( $svg_icons ) ) {
			require_once( $svg_icons );
		}
	}

	add_action( 'wp_footer', 'wordpress_include_svg_icons', 9999 );
}

/**
 * Return SVG markup.
 *
 * @param array $args  {
 *                     Parameters needed to display an SVG.
 *
 * @type string $icon  Required SVG icon filename.
 * @type string $title Optional SVG title.
 * @type string $desc  Optional SVG description.
 * }
 * @return string SVG markup.
 */
function wp_get_svg( $args = array() ) {
	// Make sure $args are an array.
	if ( empty( $args ) ) {
		return __( 'Please define default parameters in the form of an array.', 'schola' );
	}

	// Define an icon.
	if ( false === array_key_exists( 'icon', $args ) ) {
		return __( 'Please define an SVG icon filename.', 'schola' );
	}

	// Set defaults.
	$defaults = array(
		'icon'     => '',
		'title'    => '',
		'desc'     => '',
		'fallback' => false,
	);

	// Parse args.
	$args = wp_parse_args( $args, $defaults );

	// Set aria hidden.
	$aria_hidden = ' aria-hidden="true"';

	// Set ARIA.
	$aria_labelledby = '';

	if ( $args['title'] ) {
		$aria_hidden     = '';
		$unique_id       = uniqid();
		$aria_labelledby = ' aria-labelledby="title-' . $unique_id . '"';

		if ( $args['desc'] ) {
			$aria_labelledby = ' aria-labelledby="title-' . $unique_id . ' desc-' . $unique_id . '"';
		}
	}

	// Begin SVG markup.
	$svg = '<svg class="icon icon-' . esc_attr( $args['icon'] ) . '"' . $aria_hidden . $aria_labelledby . ' role="img">';

	// Display the title.
	if ( $args['title'] ) {
		$svg .= '<title id="title-' . $unique_id . '">' . esc_html( $args['title'] ) . '</title>';

		// Display the desc only if the title is already set.
		if ( $args['desc'] ) {
			$svg .= '<desc id="desc-' . $unique_id . '">' . esc_html( $args['desc'] ) . '</desc>';
		}
	}

	/*
	 * Display the icon.
	 *
	 * The whitespace around `<use>` is intentional - it is a work around to a keyboard navigation bug in Safari 10.
	 *
	 * See https://core.trac.wordpress.org/ticket/38387.
	 */
	$svg .= ' <use href="#' . esc_html( $args['icon'] ) . '" xlink:href="#' . esc_html( $args['icon'] ) . '"></use> ';

	// Add some markup to use as a fallback for browsers that do not support SVGs.
	if ( $args['fallback'] ) {
		$svg .= '<span class="svg-fallback icon-' . esc_attr( $args['icon'] ) . '"></span>';
	}

	$svg .= '</svg>';

	return $svg;
}

//Pagenation
function pagination($pages = '', $range = 2)
{
	$showitems = ($range * 2)+1;//表示するページ数（５ページを表示）

	global $paged;//現在のページ値
	if(empty($paged)) $paged = 1;//デフォルトのページ

	if($pages == '')
	{
		global $wp_query;
		$pages = $wp_query->max_num_pages;//全ページ数を取得
		if(!$pages)//全ページ数が空の場合は、１とする
		{
			$pages = 1;
		}
	}

	if(1 != $pages)//全ページが１でない場合はページネーションを表示する
	{
		echo "<div class=\"pagenation\">\n";
		echo "<ul>\n";
		//Prev：現在のページ値が１より大きい場合は表示
		if($paged > 1) echo "<li class=\"prev\"><a href='".get_pagenum_link($paged - 1)."'>Prev</a></li>\n";

		for ($i=1; $i <= $pages; $i++)
		{
			if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
			{
				//三項演算子での条件分岐
				echo ($paged == $i)? "<li class=\"active\">".$i."</li>\n":"<li><a href='".get_pagenum_link($i)."'>".$i."</a></li>\n";
			}
		}
		//Next：総ページ数より現在のページ値が小さい場合は表示
		if ($paged < $pages) echo "<li class=\"next\"><a href=\"".get_pagenum_link($paged + 1)."\">Next</a></li>\n";
		echo "</ul>\n";
		echo "</div>\n";
	}
}

/*
 * ACF Options setting.
 *
 * Doc https://www.advancedcustomfields.com/add-ons/options-page/
 */
//
//if( function_exists('acf_add_options_page') ) {
//
//	acf_add_options_page(array(
//		'page_title' 	=> '共通オプション設定',
//		'menu_title'	=> '共通オプション',
//		'menu_slug' 	=> 'theme-options',
//		'capability'	=> 'edit_posts',
//		'parent_slug'	=> '',
//		'position'	=> false,
//		'redirect'	=> false,
//	));
//
//}