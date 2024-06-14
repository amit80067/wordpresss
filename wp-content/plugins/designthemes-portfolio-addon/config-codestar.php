<?php
if ( ! class_exists( 'DTPortfolioCodeStar' ) ) {

	class DTPortfolioCodeStar {

		function __construct() {
			# Metabox Options
			add_filter( 'dtm_metabox_options', array( $this, 'dtportfolio_cs_metabox_options'), 1 );
		}

		function dtportfolio_cs_metabox_options( $options ) {

			$options[] = array (
				'id'        => 'dtportfolio_template_settings',
				'title'     => esc_html__('Portfolio Addon Options', 'dtportfolio'),
				'post_type' => 'page',
				'context'   => 'normal',
				'priority'  => 'high',
				'sections'  => array (
					array (
						'name'  => 'dtportfolio_footer_section',
						'fields' => array (
							array (
								'type' 	=> 'switcher',
								'id' 	=> 'dtportfolio-transparent-header',
								'title' => esc_html__('Enable Transparent Header', 'dtportfolio'),
								'desc'  => esc_html__('If you wish you can enable transparent header for your theme.', 'dtportfolio'),
							),
							array (
								'type' 	=> 'switcher',
								'id' 	=> 'dtportfolio-remove-spaces',
								'title' => esc_html__('Remove Additional Spaces', 'dtportfolio'),
								'desc'  => esc_html__('This option is usefull if u like to keep any item in fullscreen.', 'dtportfolio'),
							),							
						)
					)
				)
			);

			return $options;
		}
	}
}