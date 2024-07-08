<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://memberfix.rocks/
 * @since      1.0.0
 *
 * @package    Mf_Change_Bp_User_Display_Slug
 * @subpackage Mf_Change_Bp_User_Display_Slug/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Mf_Change_Bp_User_Display_Slug
 * @subpackage Mf_Change_Bp_User_Display_Slug/includes
 * @author     MemberFix <sc@memberfix.rocks>
 */
class Mf_Change_Bp_User_Display_Slug_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'mf-change-bp-user-display-slug',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
