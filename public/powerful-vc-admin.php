<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://webempire.org.in/
 * @since      1.0.0
 *
 * @package    Powerful_Visualcomposer_Lite
 * @subpackage Powerful_Visualcomposer_Lite/public
 */

?>

<div class="pavc-menu-page-wrapper">
	<div id="pavc-menu-page">
		<div class="pavc-menu-page-header <?php echo esc_attr( implode( ' ', $pavc_admin_header_wrapper_class ) ); ?>">
			<div class="pavc-container pavc-flex">
				<div class="pavc-title">
					<a href="<?php echo esc_url( $pavc_visit_site_url ); ?>" target="_blank" rel="noopener" >
					<h1 class="plug-author-title"> WebEmpire </h1>
					<span class="pavc-plugin-version"><?php echo POWERFUL_VC_LITE_VER; ?></span>
					<?php do_action( 'pavc_admin_header_title' ); ?>
					</a>
				</div>
				<div class="pavc-admin-top-links">
					<?php
						esc_attr_e( 'Let\'s empower Visual Composer!', 'pavc' );
					?>
				</div>
			</div>
		</div>

		<?php
		// Settings update message.
		if ( isset( $_REQUEST['message'] ) && ( 'saved' === $_REQUEST['message'] || 'saved_ext' === $_REQUEST['message'] ) ) {
			?>
				<div id="message" class="notice notice-success is-dismissive pavc-notice"><p> <?php esc_html_e( 'Settings saved successfully.', 'pavc' ); ?> </p></div>
			<?php
		}
		do_action( 'pavc_render_admin_content' );
		?>
	</div>
</div>
