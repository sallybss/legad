<?php
// Enqueue styles and scripts
function legad_theme_load_resources() {
    wp_enqueue_style('theme-style', get_stylesheet_uri(), array(), null);
    wp_enqueue_script('font-awesome', 'https://kit.fontawesome.com/56a699bfcb.js', array(), null, true); // load in footer
}
add_action('wp_enqueue_scripts', 'legad_theme_load_resources');

// Enable featured images
add_theme_support('post-thumbnails');

// Register navigation menus
function legad_theme_register_menus() {
    register_nav_menus(array(
        'primary-menu' => __('Primary Menu', 'legad'),
    ));
}
add_action('after_setup_theme', 'legad_theme_register_menus');

// Disable Gutenberg editor for pages
function legad_theme_remove_gutenberg() {
    remove_post_type_support('page', 'editor');
}
add_action('init', 'legad_theme_remove_gutenberg');

// Customize My Account tabs on custom login/register pages
add_filter('woocommerce_my_account_my_account_shortcode_args', function($args) {
    $slug = get_post_field('post_name', get_post());

    if ($slug === 'sign-in') {
        $args['registration'] = false;
    }

    if ($slug === 'sign-up') {
        $args['login'] = false;
    }

    return $args;
});

// Remove the "Additional Information" tab from single product pages
add_filter( 'woocommerce_product_tabs', 'remove_additional_info_tab', 98 );
function remove_additional_info_tab( $tabs ) {
    unset( $tabs['additional_information'] );
    return $tabs;
}