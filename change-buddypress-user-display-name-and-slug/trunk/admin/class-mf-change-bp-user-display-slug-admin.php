<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://memberfix.rocks/
 * @since      1.0.0
 *
 * @package    Mf_Change_Bp_User_Display_Slug
 * @subpackage Mf_Change_Bp_User_Display_Slug/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Mf_Change_Bp_User_Display_Slug
 * @subpackage Mf_Change_Bp_User_Display_Slug/admin
 * @author     MemberFix <sc@memberfix.rocks>
 */
class Mf_Change_Bp_User_Display_Slug_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Mf_Change_Bp_User_Display_Slug_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mf_Change_Bp_User_Display_Slug_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/mf-change-bp-user-display-slug-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Mf_Change_Bp_User_Display_Slug_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mf_Change_Bp_User_Display_Slug_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/mf-change-bp-user-display-slug-admin.js', array( 'jquery' ), $this->version, false );

	}


	 /**
	 * Add an options page under the Users submenu
	 *
	 * @since  1.0.0
	 */
	public function add_options_page() {
	
		$this->plugin_screen_hook_suffix = add_users_page(
			__( 'Change BuddyPress User Display Name and Slug Settings', 'mf-change-bp-user-display-slug' ),
			__( 'Change BuddyPress User Display Name and Slug', 'mf-change-bp-user-display-slug' ),
			'manage_options',
			$this->plugin_name,
			array( $this, 'display_options_page' )
		);
	
	}

	
    /**
	 * Render the options page for plugin
	 *
	 * @since  1.0.0
	 */
	public function display_options_page() {
		include_once 'partials/mf-change-bp-user-display-slug-admin-display.php';
	}	

}

