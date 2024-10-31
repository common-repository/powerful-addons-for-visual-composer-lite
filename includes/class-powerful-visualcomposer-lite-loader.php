<?php
/**
 * Register & load all actions and filters & required files for the plugin
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
 * Register & load all actions and filters & required files for the plugin.
 *
 * Maintain a list of all hooks that are registered throughout
 * the plugin, and register them with the WordPress API. Call the
 * run function to execute the list of actions and filters.
 *
 * @package    Powerful_Visualcomposer_Lite
 * @subpackage Powerful_Visualcomposer_Lite/includes
 * @author     WebEmpire <admin@webempire.org.in>
 */
class Powerful_Visualcomposer_Lite_Loader {

	/**
	 * Constructor
	 */
	public function __construct() {

		$this->includes();
		$this->setup_actions_filters();
	}

	/**
	 * Includes.
	 *
	 * @since 1.0.0
	 */
	private function includes() {

		require POWERFUL_VC_LITE_DIR . 'includes/powerful-vc-config.php';
		require POWERFUL_VC_LITE_DIR . 'includes/powerful-vc-helper.php';
		require POWERFUL_VC_LITE_DIR . 'includes/class-powerful-vc-admin.php';
		require POWERFUL_VC_LITE_DIR . 'base/module-base.php';
	}

	/**
	 * Setup Actions Filters.
	 *
	 * @since 1.0.0
	 */
	private function setup_actions_filters() {

		// Filter to add body class.
		add_filter( 'body_class', array( $this, 'body_classes' ), 10, 1 );
	}

	/**
	 * Add Body Classes.
	 *
	 * @param    string $classes    The existing classes added to <body> tag.
	 * @return   array     $classes    The collection of clases append to <body> tag.
	 */
	function body_classes( $classes ) {

		$classes[] = 'powerful-vc-lite-' . POWERFUL_VC_LITE_VER . '';
		return $classes;
	}
}

/**
 *  Prepare if class 'Powerful_Visualcomposer_Lite_Loader' exist. Kicking this off by creating 'new' instance.
 */
new Powerful_Visualcomposer_Lite_Loader();
