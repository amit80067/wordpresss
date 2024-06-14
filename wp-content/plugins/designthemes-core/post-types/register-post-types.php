<?php
if (! class_exists ( 'DTCorePostTypes' )) {

	/**
	 *
	 * @author iamdesigning11
	 *        
	 */
	class DTCorePostTypes {

		function __construct() {

			// Header Post Type
			require_once plugin_dir_path ( __FILE__ ) . '/header-post-type.php';
			if( class_exists('DTHeaderPostType') ){
				new DTHeaderPostType();
			}

			// Mega Menu Post Type
			require_once plugin_dir_path ( __FILE__ ) . '/mega-menu-post-type.php';
			if( class_exists('DTMegaMenuPostType') ){
				new DTMegaMenuPostType();
			}			
			
			// Footer Post Type
			require_once plugin_dir_path ( __FILE__ ) . '/footer-post-type.php';
			if( class_exists('DTFooterPostType') ){
				new DTFooterPostType();
			}

			// Product Template Post Type
			require_once plugin_dir_path ( __FILE__ ) . '/product-template-post-type.php';
			if( class_exists('DTShopProductTemplatePostType') ){
				new DTShopProductTemplatePostType();
			}
		}
	}
}