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

$widgets = Powerful_VC_Helper::get_widget_options();

$kb_url = apply_filters( 'pavc_knowledge_base_link', '#' );

$doc_url = apply_filters( 'pavc_blog_widget_link', '#' );

$code_doc_url = apply_filters( 'pavc_code_snippets_link', '#' );

$vc_icon = esc_url( POWERFUL_VC_LITE_URL . 'public/img/vc.svg' );

?>

<div class="pavc-container pavc-general">
<div id="poststuff">
	<div id="post-body" class="columns-2">
		<div id="post-body-content">
			<!-- All WordPress Notices below header -->
			<h1 class="screen-reader-text"> <?php _e( 'General', 'pavc' ); ?> </h1>
				<div class="widgets postbox">
					<h2 class="hndle pavc-flex pavc-widgets-heading">
						<img src="<?php echo esc_url( $vc_icon ); ?>" class="pavc-vc-icon" alt="" title="" />
						<span><?php esc_html_e( 'Powerful Visual Composer Addons', 'pavc' ); ?></span>
						<div class="pavc-bulk-actions-wrap">
							<a class="bulk-action pavc-addons-activate-all button"> <?php esc_html_e( 'Activate All', 'pavc' ); ?> </a>
							<a class="bulk-action pavc-addons-deactivate-all button"> <?php esc_html_e( 'Deactivate All', 'pavc' ); ?> </a>
						</div>
					</h2>
				</div>

				<div class="pavc-widgets-boxes">
					<div class="pavc-widget-section">
						<?php if ( is_array( $widgets ) && ! empty( $widgets ) ) : ?>

							<section class="pavc-widget-list">
								<?php
								foreach ( $widgets as $addon => $info ) {
									$doc_url       = ( isset( $info['doc_url'] ) && ! empty( $info['doc_url'] ) ) ? ' href="' . esc_url( $info['doc_url'] ) . '"' : '';
									$anchor_target = ( isset( $info['doc_url'] ) && ! empty( $info['doc_url'] ) ) ? " target='_blank' rel='noopener'" : '';
									$addon_type    = ( isset( $info['is_pro'] ) && $info['is_pro'] ) ? 'pro-addon' : 'free-addon';

									$class = 'deactivate';
									$link  = array(
										'link_class' => 'pavc-activate-widget',
										'icon_class' => 'dashicons-visibility',
									);

									if ( $info['is_activate'] && ! $info['is_pro'] ) {
										$class = 'activate';
										$link  = array(
											'link_class' => 'pavc-deactivate-widget',
											'icon_class' => 'dashicons-hidden',
										);
									}

									echo '<div id="' . esc_attr( $addon ) . '"  class="pavc-widget-wrapper ' . esc_attr( $class ) . ' ' . esc_attr( $addon_type ) . '">';
									echo '<h3> <a class="pavc-widget-title ' . $addon_type . '"' . $doc_url . $anchor_target . ' >' . esc_html( $info['title'] ) . '</a>';

									if ( $info['is_pro'] ) {

										$pro_url   = 'http://codecanyon.net/item/social-addons-for-elementor-pro/24234889';
										$pro_label = esc_html__( 'Get Pro', 'pavc' );

										printf(
											'<a href="%1$s" target="_blank" class="get-pro-pavc"> %2$s </a>',
											esc_url( $pro_url ),
											esc_html( $pro_label )
										);
									} else {
										printf(
											'<a href="%1$s" class="%2$s"> <span class="dashicons %3$s"></span> </a>',
											( isset( $link['link_url'] ) && ! empty( $link['link_url'] ) ) ? esc_url( $link['link_url'] ) : '#',
											esc_attr( $link['link_class'] ),
											esc_html( $link['icon_class'] )
										);
									}

									if ( $info['is_activate'] && isset( $info['setting_url'] ) ) {

										printf(
											'<a href="%1$s"> %2$s </a>',
											esc_url( $info['setting_url'] )
										);
									}

									echo '</h3> <div class="pavc-widget-link-wrapper">';
									echo '<p> ' . $info['description'] . ' </p>';
									echo '</div></div>';
								}
								?>
							</section>
						<?php endif; ?>
					</div>
				</div>
		</div>
	</div>
	<!-- /post-body -->
	<br class="clear"/>
</div>

<hr />

<div class="pavc-container pavc-connect">
	<div id="poststuff">
		<div id="post-body" class="columns-2">
			<div id="post-body-content">
				<div id="side-sortables">
					<div class="postbox">
						<h2 class="hndle pavc-normal-cusror">
							<span><?php esc_html_e( 'Visit Demos', 'pavc' ); ?></span>
							<span class="dashicons dashicons-welcome-view-site"></span>
						</h2>
						<div class="inside">
							<p>
								<?php
								esc_html_e( 'Visit here to see our elegant demos for these widgets. We hope you like it!!!', 'pavc' );
								?>
							</p>
								<?php
									$visit_demos      = apply_filters( 'visit_demos', '#' );
									$visit_demos_text = apply_filters( 'visit_demos_text', esc_html__( 'View Demos »', 'pavc' ) );

									printf(
										/* translators: %1$s: demos link. */
										'%1$s',
										! empty( $visit_demos ) ? '<a href=' . esc_url( $visit_demos ) . ' target="_blank" rel="noopener">' . esc_html( $visit_demos_text ) . '</a>' :
										esc_html( $visit_demos_text )
									);
									?>
							</p>
						</div>
					</div>

					<div class="postbox">
						<h2 class="hndle pavc-normal-cusror">
							<span><?php esc_html_e( 'Knowledge Base', 'pavc' ); ?></span>
							<span class="dashicons dashicons-book"></span>
						</h2>
						<div class="inside">
							<p>
								<?php esc_html_e( 'Not sure how something works? Take a peek at the knowledge base and learn.', 'pavc' ); ?>
							</p>
							<a href='<?php echo esc_url( $kb_url ); ?> ' target="_blank" rel="noopener"><?php esc_attr_e( 'Knowledge Base »', 'pavc' ); ?></a>
						</div>
					</div>

					<div class="postbox">
						<h2 class="hndle pavc-normal-cusror">
							<span><?php esc_html_e( 'Code Snippets', 'pavc' ); ?></span>
							<span class="dashicons dashicons-editor-code"></span>
						</h2>
						<div class="inside">
							<p>
								<?php esc_html_e( 'Custom codes are listed here, which will help you for custom requirements.', 'pavc' ); ?>
							</p>
							<a href='<?php echo esc_url( $code_doc_url ); ?> ' target="_blank" rel="noopener"><?php esc_attr_e( 'Actions / Filters / CSS »', 'pavc' ); ?></a>
						</div>
					</div>

					<div class="postbox">
						<h2 class="hndle pavc-normal-cusror">
							<span><?php esc_html_e( 'Five Star Support', 'pavc' ); ?></span>
							<span class="dashicons dashicons-awards"></span>
						</h2>
						<div class="inside">
							<p>
								<?php
								printf(
									/* translators: %1$s: PAVC Help name. */
									esc_html_e( 'Get in touch with Powerful Addons for Visual Composer developers. We\'re happy to help!', 'pavc' )
								);
								?>
							</p>
							<?php
								$pavc_support_link      = apply_filters( 'pavc_support_link', 'https://webempire.org.in/support/submit-a-ticket/?utm_source=google&utm_medium=email&utm_campaign=powerful-vc-lite-plugin' );
								$pavc_support_link_text = apply_filters( 'pavc_support_link_text', esc_html__( 'Get Support »', 'pavc' ) );

								printf(
									/* translators: %1$s: PAVC support link. */
									'%1$s',
									! empty( $pavc_support_link ) ? '<a href=' . esc_url( $pavc_support_link ) . ' target="_blank" rel="noopener">' . esc_html( $pavc_support_link_text ) . '</a>' :
									esc_html( $pavc_support_link_text )
								);
								?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
