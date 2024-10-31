<?php
/**
 * Powerful VC Module Base.
 *
 * @package Powerful_Visualcomposer_Lite
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Module Base
 *
 * @since 1.0.0
 */
class Module_Base {

	/**
	 * Constructor
	 */
	public function __construct() {

		/**
		 * Initialize Powerful VC Addons
		 *
		 * @param $api \VisualComposer\Modules\Api\Factory
		 * @since 1.0.0
		 */
		add_action(
			'vcv:api',
			function( $api ) {

				$powerful_vc_addons = array(
					'ribbon',
					'powerfulHeading',
					'powerfulSeparator',
					'spacer',
					'photo',
				);

				/**
				 * Visual Composer API.
				 *
				 * @var \VisualComposer\Modules\Elements\ApiController $elements_api
				 */
				$elements_api = $api->elements;

				foreach ( $powerful_vc_addons as $addon ) {
					if ( Powerful_VC_Helper::is_widget_active( $addon ) ) {
						$manifest_path    = POWERFUL_VC_LITE_MODULES_DIR . $addon . '/manifest.json';
						$element_base_url = POWERFUL_VC_LITE_MODULES_URL . $addon;
						$elements_api->add( $manifest_path, $element_base_url );
					}
				}
			}
		);
	}
}

/**
 *  Prepare if class 'Module_Base' exist. Kicking this off by creating 'new' instance.
 */
new Module_Base();
