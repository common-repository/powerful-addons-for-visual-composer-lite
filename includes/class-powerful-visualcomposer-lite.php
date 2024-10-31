<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
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
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Powerful_Visualcomposer_Lite
 * @subpackage Powerful_Visualcomposer_Lite/includes
 * @author     WebEmpire <admin@webempire.org.in>
 */

/**
 * Class Powerful_Visualcomposer_Lite.
 *
 * @since 1.0.0
 */
final class Powerful_Visualcomposer_Lite {

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		$this->define_constants();

		// Activation hook.
		register_activation_hook( POWERFUL_VC_LITE_FILE, array( $this, 'activation_reset' ) );

		// deActivation hook.
		register_deactivation_hook( POWERFUL_VC_LITE_FILE, array( $this, 'deactivation_reset' ) );

		add_action( 'plugins_loaded', array( $this, 'load_plugin' ) );
	}

	/**
	 * Show action links on the plugin screen.
	 *
	 * @param   mixed $links Plugin Action links.
	 * @return  array
	 * @since 1.0.0
	 */
	public function action_links( $links = array() ) {

		$slug = 'pavc';

		$action_links = array(
			'settings' => '<a href="' . esc_url( admin_url( 'admin.php?page=' . $slug ) ) . '" aria-label="' . esc_attr__( 'View Powerful VisualComposer Settings', 'pavc' ) . '">' . esc_html__( 'Configure', 'pavc' ) . '</a>',
		);

		return array_merge( $action_links, $links );
	}

	/**
	 * Defines all constants
	 *
	 * @since 1.0.0
	 */
	public function define_constants() {
		define( 'POWERFUL_VC_LITE_BASE', plugin_basename( POWERFUL_VC_LITE_FILE ) );
		define( 'POWERFUL_VC_LITE_ROOT', dirname( POWERFUL_VC_LITE_BASE ) );
		define( 'POWERFUL_VC_LITE_DIR', plugin_dir_path( POWERFUL_VC_LITE_FILE ) );
		define( 'POWERFUL_VC_LITE_URL', plugins_url( '/', POWERFUL_VC_LITE_FILE ) );
		define( 'POWERFUL_VC_LITE_VER', '1.2.0' );
		define( 'POWERFUL_VC_LITE_MODULES_DIR', POWERFUL_VC_LITE_DIR . 'addons/' );
		define( 'POWERFUL_VC_LITE_MODULES_URL', POWERFUL_VC_LITE_URL . 'addons/' );
		define( 'POWERFUL_VC_LITE_SLUG', 'pavc' );
	}

	/**
	 * Loads plugin files.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	function load_plugin() {

		if ( ! defined( 'VCV_VERSION' ) ) {
			/* TO DO */
			add_action( 'admin_notices', array( $this, 'powerful_visualcomposer_fails_to_load' ) );
			return;
		}

		// Action Links.
		add_action( 'plugin_action_links_' . POWERFUL_VC_LITE_BASE, array( $this, 'action_links' ) );

		$this->load_textdomain();

		require_once POWERFUL_VC_LITE_DIR . 'includes/class-powerful-visualcomposer-lite-loader.php';
	}

	/**
	 * Load Powerful VisualComposer Text Domain.
	 * This will load the translation textdomain depending on the file priorities.
	 *      1. Global Languages /wp-content/languages/powerful-visualcomposer-lite/ folder
	 *      2. Local dorectory /wp-content/plugins/powerful-visualcomposer-lite/languages/ folder
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function load_textdomain() {
		/**
		 * Filters the languages directory path to use for Powerful VisualComposer.
		 *
		 * @param string $lang_dir The languages directory path.
		 */
		$lang_dir = apply_filters( 'powerful_visualcomposer_domain_loader', POWERFUL_VC_LITE_ROOT . '/languages/' );
		load_plugin_textdomain( 'pavc', false, $lang_dir );
	}

	/**
	 * Fires admin notice when Visual Composer is not installed and activated.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function powerful_visualcomposer_fails_to_load() {

		$notice_css_style = '.powerful-vc-notice.notice { padding: 12px; }
		.powerful-vc-notice.notice p, .powerful-vc-notice.notice p span { margin-right: 20px; }
		.powerful-vc-notice.notice p span:last-child a { float: right; background-color: #8141bb; margin-top: -14px; }';

		$class = 'powerful-vc-notice notice notice-error';

		/* translators: 1: HTML Strong open tag, 2: HTML Strong close tag, 3: HTML br tag */
		$message = sprintf( esc_html__( '%1$s Thanks for choosing Powerful Addons for VisualComposer plugin!!! %2$s %3$s', 'pavc' ), '<strong>', '</strong>', '<br/>' );

		$message .= esc_html__( 'Please install and activate the VisualComposer plugin, to explore the features of this plugin.', 'pavc' );

		$plugin = 'visualcomposer/plugin-wordpress.php';

		if ( _is_visualcomposer_installed() ) {
			if ( ! current_user_can( 'activate_plugins' ) ) {
				return;
			}

			$action_url   = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin );
			$button_label = esc_html__( 'Activate VisualComposer Now', 'pavc' );

		} else {
			if ( ! current_user_can( 'install_plugins' ) ) {
				return;
			}

			$action_url   = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=visualcomposer' ), 'install-plugin_visualcomposer' );
			$button_label = esc_html__( 'Install VisualComposer', 'pavc' );
		}

		$button = '<span> <a href="' . $action_url . '" class="button-primary">' . $button_label . '</a></span>';

		printf( '<style> %1$s </style> <div class="%2$s"> <p> <span> %3$s </span> %4$s </p> </div>', $notice_css_style, esc_attr( $class ), $message, $button );
	}

	/**
	 * Activation Reset
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function activation_reset() { }

	/**
	 * Deactivation Reset
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function deactivation_reset() { }
}

/**
 *  Prepare if class 'Powerful_Visualcomposer_Lite' exist. Kicking this off by creating 'new' instance.
 */
new Powerful_Visualcomposer_Lite();

/**
 * Is VisualComposer plugin installed.
 */
if ( ! function_exists( '_is_visualcomposer_installed' ) ) {

	/**
	 * Check if VisualComposer is installed
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	function _is_visualcomposer_installed() {
		$path    = 'visualcomposer/plugin-wordpress.php';
		$plugins = get_plugins();

		return isset( $plugins[ $path ] );
	}
}
