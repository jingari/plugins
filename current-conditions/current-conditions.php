<?php
/**
* Plugin Name: Current Conditions Widget
*
* Description: Adds a current weather conditions widget
* Version: 0.2
* Author: Jessica Ingari
* Author URI: http://www.jaeldius.com
*
*/


//Exit if not called in proper context
if (!defined('ABSPATH')) exit();

define( 'CURRENTCONDITIONS_VERSION', '0.1' );
define( 'CURRENTCONDITIONS__MINIMUM_WP_VERSION', '4.0' );
define( 'CURRENTCONDITIONS__PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'CURRENTCONDITIONS__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

register_activation_hook( __FILE__, array( 'current_conditions', 'plugin_activation' ) );
register_deactivation_hook( __FILE__, array( 'current_conditions', 'plugin_deactivation' ) );

require_once( CURRENTCONDITIONS__PLUGIN_DIR . 'current-conditions-widget.php' );

//add_action( 'init', array( 'conditions', 'init' ) );

if ( is_admin() ) {
	require_once( CURRENTCONDITIONS__PLUGIN_DIR . 'current-conditions-admin.php' );
}

