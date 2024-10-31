<?php
/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://webempire.org.in/
 * @since      1.0.0
 *
 * @package    Powerful_Visualcomposer_Lite
 * @subpackage Powerful_Visualcomposer_Lite/includes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class Powerful_VC_Admin.
 *
 * @since 1.0.0
 */
final class Powerful_VC_Admin {

	/**
	 * Calls on initialization
	 *
	 * @since 1.0.0
	 */
	public static function init() {

		self::initialize_ajax();
		self::initialise_plugin();
		add_action( 'after_setup_theme', __CLASS__ . '::init_hooks' );
	}

	/**
	 * Adds the admin menu and enqueues CSS/JS if we are on the builder admin settings page.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	static public function init_hooks() {

		if ( ! is_admin() ) {
			return;
		}

		// Add Powerful VC menu option to admin.
		add_action( 'network_admin_menu', __CLASS__ . '::menu' );
		add_action( 'admin_menu', __CLASS__ . '::menu' );

		add_action( 'pavc_render_admin_content', __CLASS__ . '::render_content' );

		if ( isset( $_REQUEST['page'] ) && POWERFUL_VC_LITE_SLUG === $_REQUEST['page'] ) {

			// Enqueue admin scripts.
			add_action( 'admin_enqueue_scripts', __CLASS__ . '::styles_scripts' );
			self::save_settings();
		}
	}

	/**
	 * Initialises the Plugin Name.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	static public function initialise_plugin() {

		$name = 'Powerful Addons for VisualComopser';

		$short_name = 'Powerful VC';

		define( 'POWERFUL_VC_LITE_PLUGIN_NAME', $name );

		define( 'POWERFUL_VC_LITE_PLUGIN_SHORT_NAME', $short_name );
	}

	/**
	 * Renders the admin settings menu.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	static public function menu() {

		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		add_submenu_page(
			'vcv-settings',
			POWERFUL_VC_LITE_PLUGIN_SHORT_NAME,
			POWERFUL_VC_LITE_PLUGIN_SHORT_NAME,
			'edit_posts',
			POWERFUL_VC_LITE_SLUG,
			__CLASS__ . '::render'
		);
	}

	/**
	 * Renders the admin settings.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	static public function render() {
		$action = ( isset( $_GET['action'] ) ) ? esc_attr( $_GET['action'] ) : '';
		$action = ( ! empty( $action ) && '' !== $action ) ? $action : 'general';
		$action = str_replace( '_', '-', $action );

		// Enable header icon filter below.
		$pavc_visit_site_url             = apply_filters( 'powerful_vc_site_url', 'https://webempire.org.in/?utm_campaign=web-agency&utm_medium=website&utm_source=google' );
		$pavc_admin_header_wrapper_class = apply_filters( 'pavc_admin_header_wrapper_class', array( $action ) );

		include_once POWERFUL_VC_LITE_DIR . 'public/powerful-vc-admin.php';
	}

	/**
	 * Renders the admin settings content.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	static public function render_content() {

		$action = ( isset( $_GET['action'] ) ) ? esc_attr( $_GET['action'] ) : '';
		$action = ( ! empty( $action ) && '' !== $action ) ? $action : 'general';
		$action = str_replace( '_', '-', $action );

		$pavc_admin_header_wrapper_class = apply_filters( 'pavc_admin_header_wrapper_class', array( $action ) );

		include_once POWERFUL_VC_LITE_DIR . 'public/powerful-vc-' . $action . '.php';
	}

	/**
	 * Enqueues the needed CSS/JS for the builder's admin settings page.
	 *
	 * @since 1.0.0
	 */
	static public function styles_scripts() {

		// Styles.
		wp_enqueue_style( 'pavc-admin-settings', POWERFUL_VC_LITE_URL . 'public/css/powerful-visualcomposer-lite-public.css', array(), POWERFUL_VC_LITE_VER );
		// Script.
		wp_enqueue_script( 'pavc-admin-settings', POWERFUL_VC_LITE_URL . 'public/js/powerful-visualcomposer-lite-public.js', array( 'jquery', 'wp-util', 'updates' ), POWERFUL_VC_LITE_VER );

		$localize = array(
			'ajax_nonce' => wp_create_nonce( 'powerful-vc-widget-nonce' ),
		);

		wp_localize_script( 'pavc-admin-settings', 'pavc_admin_js', apply_filters( 'pavc_js_localize', $localize ) );
	}

	/**
	 * Save All admin settings here.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	static public function save_settings() {

		// Only admins can save settings.
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		// Let extensions hook into saving.
		do_action( 'pavc_admin_settings_save' );
	}

	/**
	 * Initialize Ajax admin actions.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	static public function initialize_ajax() {
		// Ajax requests.
		add_action( 'wp_ajax_powerful_vc_activate_widget', __CLASS__ . '::activate_widget' );
		add_action( 'wp_ajax_powerful_vc_deactivate_widget', __CLASS__ . '::deactivate_widget' );

		add_action( 'wp_ajax_powerful_vc_bulk_activate_widgets', __CLASS__ . '::bulk_activate_widgets' );
		add_action( 'wp_ajax_powerful_vc_bulk_deactivate_widgets', __CLASS__ . '::bulk_deactivate_widgets' );
	}

	/**
	 * Activate individual module.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	static public function activate_widget() {

		if ( ! apply_filters( 'pavc_user_cap_check', current_user_can( 'manage_options' ) ) ) {
			return;
		}

		check_ajax_referer( 'powerful-vc-widget-nonce', 'nonce' );

		$widgets               = Powerful_VC_Helper::get_admin_settings_option( 'powerful_vc_widgets', array() );
		$module_id             = isset( $_POST['module_id'] ) ? sanitize_text_field( $_POST['module_id'] ) : '';
		$widgets[ $module_id ] = $module_id;
		$widgets               = array_map( 'esc_attr', $widgets );

		// Update widgets.
		Powerful_VC_Helper::update_admin_settings_option( 'powerful_vc_widgets', $widgets );

		echo $module_id;

		die();
	}

	/**
	 * Deactivate individual module.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	static public function deactivate_widget() {

		if ( ! apply_filters( 'pavc_user_cap_check', current_user_can( 'manage_options' ) ) ) {
			return;
		}

		check_ajax_referer( 'powerful-vc-widget-nonce', 'nonce' );

		$widgets               = Powerful_VC_Helper::get_admin_settings_option( 'powerful_vc_widgets', array() );
		$module_id             = isset( $_POST['module_id'] ) ? sanitize_text_field( $_POST['module_id'] ) : '';
		$widgets[ $module_id ] = 'disabled';
		$widgets               = array_map( 'esc_attr', $widgets );

		// Update widgets.
		Powerful_VC_Helper::update_admin_settings_option( 'powerful_vc_widgets', $widgets );

		echo $module_id;

		die();
	}

	/**
	 * Activate all bulk module.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	static public function bulk_activate_widgets() {

		if ( ! apply_filters( 'pavc_user_cap_check', current_user_can( 'manage_options' ) ) ) {
			return;
		}

		check_ajax_referer( 'powerful-vc-widget-nonce', 'nonce' );

		// Get all widgets.
		$all_widgets = Powerful_VC_Helper::get_widget_list();
		$new_widgets = array();

		// Set all extension to enabled.
		foreach ( $all_widgets  as $slug => $value ) {
			$new_widgets[ $slug ] = $slug;
		}

		// Escape attrs.
		$new_widgets = array_map( 'esc_attr', $new_widgets );

		// Update new_extensions.
		Powerful_VC_Helper::update_admin_settings_option( 'powerful_vc_widgets', $new_widgets );

		echo 'success';

		die();
	}

	/**
	 * Deactivate all bulk module.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	static public function bulk_deactivate_widgets() {

		if ( ! apply_filters( 'pavc_user_cap_check', current_user_can( 'manage_options' ) ) ) {
			return;
		}

		check_ajax_referer( 'powerful-vc-widget-nonce', 'nonce' );

		// Get all extensions.
		$old_widgets = Powerful_VC_Helper::get_widget_list();
		$new_widgets = array();

		// Set all extension to enabled.
		foreach ( $old_widgets as $slug => $value ) {
			$new_widgets[ $slug ] = 'disabled';
		}

		// Escape attrs.
		$new_widgets = array_map( 'esc_attr', $new_widgets );

		// Update new_extensions.
		Powerful_VC_Helper::update_admin_settings_option( 'powerful_vc_widgets', $new_widgets );

		echo 'success';

		die();
	}
}

/**
 *  Let's initialize the class by calling its init() method.
 */
Powerful_VC_Admin::init();
