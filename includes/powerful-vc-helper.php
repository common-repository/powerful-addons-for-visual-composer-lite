<?php
/**
 * Powerful VC Helper.
 *
 * @package Powerful_Visualcomposer_Lite
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class Powerful_VC_Helper.
 *
 * @since 1.0.0
 */
class Powerful_VC_Helper {

	/**
	 * Widget Options
	 *
	 * @var widget_options
	 */
	private static $widget_options = null;

	/**
	 * Widget List
	 *
	 * @var widget_list
	 */
	private static $widget_list = null;

	/**
	 * Provide General settings array().
	 *
	 * @return array
	 * @since 1.0.0
	 */
	static public function get_widget_list() {

		self::$widget_list = Powerful_VC_Config::get_widget_list();

		return apply_filters( 'powerful_vc_addons_list', self::$widget_list );
	}

	/**
	 * Returns an option from the database for the admin settings page.
	 *
	 * @param  string  $key     The option key.
	 * @param  mixed   $default Option default value if option is not available.
	 * @param  boolean $network_override Whether to allow the network admin setting to be overridden on subsites.
	 * @return string           Return the option value
	 */
	public static function get_admin_settings_option( $key, $default = false, $network_override = false ) {

		// Get the site-wide option if we're in the network admin.
		if ( $network_override && is_multisite() ) {
			$value = get_site_option( $key, $default );
		} else {
			$value = get_option( $key, $default );
		}

		return $value;
	}

	/**
	 * Updates an option from the admin settings page.
	 *
	 * @param string $key       The option key.
	 * @param mixed  $value     The value to update.
	 * @param bool   $network   Whether to allow the network admin setting to be overridden on subsites.
	 * @return mixed
	 */
	static public function update_admin_settings_option( $key, $value, $network = false ) {

		// Update the site-wide option since we're in the network admin.
		if ( $network && is_multisite() ) {
			update_site_option( $key, $value );
		} else {
			update_option( $key, $value );
		}

	}

	/**
	 * Provide Widget settings.
	 *
	 * @return array
	 * @since 1.0.0
	 */
	static public function get_widget_options() {

		if ( null === self::$widget_options ) {

			$widgets       = self::get_widget_list();
			$saved_widgets = self::get_admin_settings_option( 'powerful_vc_widgets' );

			if ( is_array( $widgets ) ) {

				foreach ( $widgets as $slug => $data ) {

					if ( isset( $saved_widgets[ $slug ] ) ) {

						if ( 'disabled' === $saved_widgets[ $slug ] ) {
							$widgets[ $slug ]['is_activate'] = false;
						} else {
							$widgets[ $slug ]['is_activate'] = true;
						}
					} else {
						$widgets[ $slug ]['is_activate'] = ( isset( $data['default'] ) ) ? $data['default'] : false;
					}
				}
			}

			self::$widget_options = $widgets;
		}

		return apply_filters( 'powerful_vc_active_widgets', self::$widget_options );
	}

	/**
	 * Widget Active.
	 *
	 * @param string $slug Module slug.
	 * @return string
	 * @since 1.0.0
	 */
	static public function is_widget_active( $slug = '' ) {

		$widgets     = self::get_widget_options();
		$is_activate = false;

		if ( isset( $widgets[ $slug ] ) ) {
			$is_activate = $widgets[ $slug ]['is_activate'];
		}

		return $is_activate;
	}
}
