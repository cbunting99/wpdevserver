<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package WP_Dev_Server
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function wpdevserver_body_classes( $classes ) {
    // Adds a class of hfeed to non-singular pages.
    if ( ! is_singular() ) {
        $classes[] = 'hfeed';
    }

    // Adds a class of no-sidebar when there is no sidebar present.
    if ( ! is_active_sidebar( 'sidebar-1' ) ) {
        $classes[] = 'no-sidebar';
    }

    return $classes;
}
add_filter( 'body_class', 'wpdevserver_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function wpdevserver_pingback_header() {
    if ( is_singular() && pings_open() ) {
        printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
    }
}
add_action( 'wp_head', 'wpdevserver_pingback_header' );

/**
 * Customizer additions.
 */
function wpdevserver_customize_register( $wp_customize ) {
    // Add postMessage support for site title and description.
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

    if ( isset( $wp_customize->selective_refresh ) ) {
        $wp_customize->selective_refresh->add_partial(
            'blogname',
            array(
                'selector'        => '.site-title a',
                'render_callback' => 'wpdevserver_customize_partial_blogname',
            )
        );
        $wp_customize->selective_refresh->add_partial(
            'blogdescription',
            array(
                'selector'        => '.site-description',
                'render_callback' => 'wpdevserver_customize_partial_blogdescription',
            )
        );
    }
}
add_action( 'customize_register', 'wpdevserver_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function wpdevserver_customize_partial_blogname() {
    bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function wpdevserver_customize_partial_blogdescription() {
    bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function wpdevserver_customize_preview_js() {
    wp_enqueue_script( 'wpdevserver-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '1.0.0', true );
}
add_action( 'customize_preview_init', 'wpdevserver_customize_preview_js' );

/**
 * Custom development server header
 */
function wpdevserver_development_header() {
    if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
        echo '<div style="background: #ffeb3b; color: #000; padding: 10px; text-align: center; font-weight: bold; border-bottom: 1px solid #ffc107;">';
        echo '⚠️ DEVELOPMENT SERVER - Do not use in production';
        echo '</div>';
    }
}
add_action( 'wp_body_open', 'wpdevserver_development_header' );

?>
