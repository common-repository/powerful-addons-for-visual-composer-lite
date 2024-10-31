<?php
/**
 * Powerful VC Config.
 *
 * @package Powerful_Visualcomposer_Lite
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class Powerful_VC_Config.
 */
class Powerful_VC_Config {

	/**
	 * Widget List
	 *
	 * @var widget_list
	 */
	public static $widget_list = null;

	/**
	 * Get Widget List.
	 *
	 * @since 1.0.0
	 *
	 * @return array The Widget List.
	 */
	public static function get_widget_list() {
		if ( null === self::$widget_list ) {
			self::$widget_list = array(
				'powerfulHeading'   => array(
					'title'       => esc_html__( 'Powerful Heading', 'pavc' ),
					'title_url'   => '#',
					'doc_url'     => '#',
					'description' => 'An <b> Powerful Heading </b> addon to write attractive headings & make them look attractive too.',
					'default'     => true,
					'is_pro'      => false,
				),
				'ribbon'            => array(
					'title'       => esc_html__( 'Powerful Ribbon', 'pavc' ),
					'title_url'   => '#',
					'doc_url'     => '#',
					'description' => 'An Powerful <b> Ribbon </b> addon to add beauty of your site. Use it to showcase your deal or heading.',
					'default'     => true,
					'is_pro'      => false,
				),
				'powerfulSeparator' => array(
					'title'       => esc_html__( 'Powerful Separator', 'pavc' ),
					'title_url'   => '#',
					'doc_url'     => '#',
					'description' => 'An <b> Powerful Separator </b> addon to break your content with a line & line with icon / image / text.',
					'default'     => true,
					'is_pro'      => false,
				),
				'spacer'            => array(
					'title'       => esc_html__( 'Powerful Spacer', 'pavc' ),
					'title_url'   => '#',
					'doc_url'     => '#',
					'description' => 'An <b> Powerful Spacer </b> addon to insert extra space between two elemnts or enywhere on the page.',
					'default'     => true,
					'is_pro'      => false,
				),
				'photo'             => array(
					'title'       => esc_html__( 'Powerful Photo', 'pavc' ),
					'title_url'   => '#',
					'doc_url'     => '#',
					'description' => 'An <b> Powerful Photo </b> addon take your photo / image from Media / URL with some effects to make it attractive.',
					'default'     => true,
					'is_pro'      => false,
				),
			);
		}

		return self::$widget_list;
	}
}
