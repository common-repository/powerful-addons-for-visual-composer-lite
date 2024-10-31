<?php
/**
 * Powerful Addons for Visual Composer - Lite
 *
 * @link              https://webempire.org.in/
 * @since             1.0.0
 * @package           Powerful_Visualcomposer_Lite
 *
 * @wordpress-plugin
 * Plugin Name:       Powerful Addons for Visual Composer - Lite
 * Plugin URI:        https://wordpress.org/plugins/powerful-addons-for-visual-composer-lite/
 * Description:       Power-up the new amazing Visual Composer drag-and-drop builder editor with these advanced and powerful addons that help you build websites in no time!  You can use it with any WordPress theme.
 * Version:           1.2.0
 * Author:            WebEmpire
 * Author URI:        https://webempire.org.in/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       pavc
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently active plugin file.
 */
define( 'POWERFUL_VC_LITE_FILE', __FILE__ );

/**
 * The core plugin class that is used to define admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-powerful-visualcomposer-lite.php';
