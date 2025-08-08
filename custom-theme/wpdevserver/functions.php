<?php
/**
 * WP Dev Server functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WP_Dev_Server
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( ! function_exists( 'wpdevserver_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     */
    function wpdevserver_setup() {
        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        // Let WordPress manage the document title.
        add_theme_support( 'title-tag' );

        // Enable support for Post Thumbnails on posts and pages.
        add_theme_support( 'post-thumbnails' );

        // Switch default core markup for search form, comment form, and comments to output valid HTML5.
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );

        // Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'wpdevserver_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        ) ) );

        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );

        // Add support for core custom logo.
        add_theme_support( 'custom-logo', array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        ) );
    }
endif;
add_action( 'after_setup_theme', 'wpdevserver_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 */
function wpdevserver_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'wpdevserver_content_width', 1200 );
}
add_action( 'after_setup_theme', 'wpdevserver_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function wpdevserver_scripts() {
    wp_enqueue_style( 'wpdevserver-style', get_stylesheet_uri(), array(), '1.0.0' );
    
    // Only enqueue jQuery if needed
    if ( is_admin() ) {
        wp_enqueue_script( 'jquery' );
    }
}
add_action( 'wp_enqueue_scripts', 'wpdevserver_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/customizer.php';

// Remove unnecessary WordPress features for development server
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' );

// Add security headers
function wpdevserver_security_headers() {
    header( 'X-Content-Type-Options: nosniff' );
    header( 'X-Frame-Options: SAMEORIGIN' );
    header( 'X-XSS-Protection: 1; mode=block' );
}
add_action( 'send_headers', 'wpdevserver_security_headers' );

// Display PHP info in admin footer for development
function wpdevserver_admin_footer_text() {
    if ( current_user_can( 'manage_options' ) ) {
        echo '<span id="footer-thankyou">WordPress Development Server v1.0.0 | PHP ' . phpversion() . ' | MySQL ' . $GLOBALS['wpdb']->db_version() . '</span>';
    }
}
add_filter( 'admin_footer_text', 'wpdevserver_admin_footer_text' );

?>
