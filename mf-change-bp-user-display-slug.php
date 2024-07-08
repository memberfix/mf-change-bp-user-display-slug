<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://memberfix.rocks/
 * @since             1.0.0
 * @package           Mf_Change_Bp_User_Display_Slug
 *
 * @wordpress-plugin
 * Plugin Name:       WP Change BuddyPress User Display Name and Slug
 * Plugin URI:        https://memberfix.rocks/
 * Description:       This plugin will allow you to change the display name and slug for a certain user. It also changes the BuddyPress display name and all existing mentions in discussions and activity.
 * Version:           1.0.0
 * Author:            MemberFix
 * Author URI:        
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       mf-change-bp-user-display-slug
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'MF_CHANGE_BP_USER_DISPLAY_SLUG_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-mf-change-bp-user-display-slug-activator.php
 */
function activate_mf_change_bp_user_display_slug() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mf-change-bp-user-display-slug-activator.php';
	Mf_Change_Bp_User_Display_Slug_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-mf-change-bp-user-display-slug-deactivator.php
 */
function deactivate_mf_change_bp_user_display_slug() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mf-change-bp-user-display-slug-deactivator.php';
	Mf_Change_Bp_User_Display_Slug_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_mf_change_bp_user_display_slug' );
register_deactivation_hook( __FILE__, 'deactivate_mf_change_bp_user_display_slug' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-mf-change-bp-user-display-slug.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_mf_change_bp_user_display_slug() {

	$plugin = new Mf_Change_Bp_User_Display_Slug();
	$plugin->run();

}
run_mf_change_bp_user_display_slug();
