<?php
/**
 * Plugin Name: Val Town Elementor Widget
 * Description: Embed Val Town web apps in Elementor
 * Version: 1.0.0
 * Author: Val Town
 * Text Domain: valtown-elementor
 *
 * Requires Plugins: elementor
 * Elementor tested up to: 3.24.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Register Widget
function register_valtown_widget($widgets_manager) {
    require_once(__DIR__ . '/widgets/valtown-widget.php');
    require_once( __DIR__ . '/widgets/hello-world-widget-1.php' );
	require_once( __DIR__ . '/widgets/hello-world-widget-2.php' );

    $widgets_manager->register(new \Elementor_ValTown_Widget());
    $widgets_manager->register( new \Elementor_Hello_World_Widget_1() );
	$widgets_manager->register( new \Elementor_Hello_World_Widget_2() );
}
add_action('elementor/widgets/register', 'register_valtown_widget');