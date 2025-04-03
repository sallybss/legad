<?php 
function legad_theme_load_resources() {
    wp_enqueue_style('stylesheet', get_template_directory_uri() . '/style.css', array(), null);
    wp_enqueue_script('font-awesome', 'https://kit.fontawesome.com/56a699bfcb.js', array(), null, false);
}

add_action('wp_enqueue_scripts', 'legad_theme_load_resources');

add_theme_support('post-thumbnails');

function legad_theme_register_menus() {
    register_nav_menus(array(
        'primary-menu' => __('Primary Menu', 'legad'),
    ));
}
add_action('after_setup_theme', 'legad_theme_register_menus');

function legad_theme_remove_gutenberg() {
    remove_post_type_support('page', 'editor');
}
add_action('init', 'legad_theme_remove_gutenberg');

function theme_enqueue_styles() {
    wp_enqueue_style('theme-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');