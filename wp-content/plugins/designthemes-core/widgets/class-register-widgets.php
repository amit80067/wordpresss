<?php
namespace DTElementor\widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class DTElementorWidgets {

	/**
	 * A Reference to an instance of this class
	 */
	private static $_instance = null;

	/**
	 * Instance
	 * 
	 * Ensures only one instance of the class is loaded or can be loaded.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Constructor
	 */
	public function __construct() {

		add_action( 'elementor/widgets/register', array( $this, 'register_widgets' ) );
		add_action( 'elementor/editor/after_enqueue_scripts', array( $this, 'register_admin_scripts' ) );

		add_action( 'elementor/frontend/after_register_styles', array( $this, 'register_widget_styles' ) );
		add_action( 'elementor/frontend/after_register_scripts', array( $this, 'register_widget_scripts' ) );

		add_action( 'elementor/preview/enqueue_styles', array( $this, 'preview_styles') );

		add_filter( 'elementor/editor/localize_settings', array( $this, 'localize_settings' )  );
	}

	/**
	 * Register designthemes widgets
	 */
	public function register_widgets( $widgets_manager ) {

		require dt_elementor()->plugin_path( 'widgets/class-common-widget-base.php' );

		#Logo
		require dt_elementor()->plugin_path( 'widgets/modules/class-widget-logo.php');
		$widgets_manager->register( new \Elementor_Logo() );				

		#Button
		require dt_elementor()->plugin_path( 'widgets/modules/class-widget-button.php');
		$widgets_manager->register( new \Elementor_Button() );		

		#Advanced Carousel
		require dt_elementor()->plugin_path( 'widgets/modules/class-widget-advanced-carousel.php');
		$widgets_manager->register( new \Elementor_Advanced_Carousel() );		

		#Counter
		require dt_elementor()->plugin_path( 'widgets/modules/class-widget-counter.php');
		$widgets_manager->register( new \Elementor_Counter() );		

		#Carousel
		require dt_elementor()->plugin_path( 'widgets/modules/class-widget-carousel.php');
		$widgets_manager->register( new \Elementor_AnyCarousel() );

		#Header Icons
		require dt_elementor()->plugin_path( 'widgets/modules/class-widget-header-icons.php');
		$widgets_manager->register( new \Elementor_Header_Icons() );

		# Ordered List
		require dt_elementor()->plugin_path( 'widgets/modules/class-widget-ordered-list.php');
		$widgets_manager->register( new \Elementor_OrderedList() );

		# Icon Box
		require dt_elementor()->plugin_path( 'widgets/modules/class-widget-iconbox.php');
		$widgets_manager->register( new \Elementor_IconBox() );

		#Blog Posts
		require dt_elementor()->plugin_path( 'widgets/modules/blog/class-widget-blog-posts.php');
		$widgets_manager->register( new \Elementor_Blog_Posts() );

		#Meta Group
		require dt_elementor()->plugin_path( 'widgets/modules/blog/class-widget-post-meta-group.php');
		$widgets_manager->register( new \Elementor_Post_Meta_Group() );

		#Feature Image
		require dt_elementor()->plugin_path( 'widgets/modules/blog/class-widget-post-feature-image.php');
		$widgets_manager->register( new \Elementor_Post_Feature_Image() );

		#Title
		require dt_elementor()->plugin_path( 'widgets/modules/blog/class-widget-post-title.php');
		$widgets_manager->register( new \Elementor_Post_Title() );

		#Author
		require dt_elementor()->plugin_path( 'widgets/modules/blog/class-widget-post-author.php');
		$widgets_manager->register( new \Elementor_Post_Author() );

		#Date
		require dt_elementor()->plugin_path( 'widgets/modules/blog/class-widget-post-date.php');
		$widgets_manager->register( new \Elementor_Post_Date() );

		#Comments
		require dt_elementor()->plugin_path( 'widgets/modules/blog/class-widget-post-comments.php');
		$widgets_manager->register( new \Elementor_Post_Comments() );

		#Categories
		require dt_elementor()->plugin_path( 'widgets/modules/blog/class-widget-post-categories.php');
		$widgets_manager->register( new \Elementor_Post_Categories() );

		#Tags
		require dt_elementor()->plugin_path( 'widgets/modules/blog/class-widget-post-tags.php');
		$widgets_manager->register( new \Elementor_Post_Tags() );

		#Socials
		require dt_elementor()->plugin_path( 'widgets/modules/blog/class-widget-post-socials.php');
		$widgets_manager->register( new \Elementor_Post_Socials() );

		#Likes & Views
		require dt_elementor()->plugin_path( 'widgets/modules/blog/class-widget-post-likes-views.php');
		$widgets_manager->register( new \Elementor_Post_Likes_Views() );

		#Related Article
		require dt_elementor()->plugin_path( 'widgets/modules/blog/class-widget-post-related-article.php');
		$widgets_manager->register( new \Elementor_Post_Related_Article() );

		#Navigation
		require dt_elementor()->plugin_path( 'widgets/modules/blog/class-widget-post-navigation.php');
		$widgets_manager->register( new \Elementor_Post_Navigation() );

		#Author Bio
		require dt_elementor()->plugin_path( 'widgets/modules/blog/class-widget-post-author-bio.php');
		$widgets_manager->register( new \Elementor_Post_Author_Bio() );

		#Comment Box
		require dt_elementor()->plugin_path( 'widgets/modules/blog/class-widget-post-comment-box.php');
		$widgets_manager->register( new \Elementor_Post_Comment_Box() );

		#Related Posts
		require dt_elementor()->plugin_path( 'widgets/modules/blog/class-widget-post-related-posts.php');
		$widgets_manager->register( new \Elementor_Post_Related_Posts() );

		#LightBox
		require dt_elementor()->plugin_path( 'widgets/modules/blog/class-widget-lightbox.php');
		$widgets_manager->register( new \Elementor_Lightbox() );

		# Header Menu
		require dt_elementor()->plugin_path( 'widgets/modules/header/class-widget-header-menu.php');
		$widgets_manager->register( new \Elementor_Header_Menu() );


		if ( class_exists( 'WooCommerce' ) ) {

			require_once dt_elementor()->plugin_path( 'widgets/modules/woocommerce/woo-functions.php' );

			require dt_elementor()->plugin_path( 'widgets/modules/woocommerce/images-default/class-product-images-default.php' );
			$widgets_manager->register( new \DTElementor_Woo_Product_Images_Default() );

			require dt_elementor()->plugin_path( 'widgets/modules/woocommerce/images-carousel/class-product-images-carousel.php' );
			$widgets_manager->register( new \DTElementor_Woo_Product_Images_Carousel() );

			require dt_elementor()->plugin_path( 'widgets/modules/woocommerce/images-list/class-product-images-list.php' );
			$widgets_manager->register( new \DTElementor_Woo_Product_Images_List() );

			require dt_elementor()->plugin_path( 'widgets/modules/woocommerce/360-image-viewer/class-product-360-image-viewer.php' );
			$widgets_manager->register( new \DTElementor_Woo_Product_360_Image_Viewer() );

			require dt_elementor()->plugin_path( 'widgets/modules/woocommerce/summary-nav-bar/class-product-summary-nav-bar.php' );
			$widgets_manager->register( new \DTElementor_Woo_Product_Summary_Nav_bar() );

			require dt_elementor()->plugin_path( 'widgets/modules/woocommerce/summary/class-product-summary.php' );
			$widgets_manager->register( new \DTElementor_Woo_Product_Summary() );

			require dt_elementor()->plugin_path( 'widgets/modules/woocommerce/product-tabs/class-product-tabs.php' );
			$widgets_manager->register( new \DTElementor_Woo_Product_Tabs() );

			require dt_elementor()->plugin_path( 'widgets/modules/woocommerce/product-tabs-exploded/class-product-tabs-exploded.php' );
			$widgets_manager->register( new \DTElementor_Woo_Product_Tabs_Exploded() );

			require dt_elementor()->plugin_path( 'widgets/modules/woocommerce/upsell-products/class-upsell-products.php' );
			$widgets_manager->register( new \DTElementor_Woo_Upsell_Products() );

			require dt_elementor()->plugin_path( 'widgets/modules/woocommerce/related-products/class-related-products.php' );
			$widgets_manager->register( new \DTElementor_Woo_Related_Products() );

			require dt_elementor()->plugin_path( 'widgets/modules/woocommerce/products/class-widget-products.php' );
			$widgets_manager->register( new \DTElementor_Woo_Products() );

			require dt_elementor()->plugin_path( 'widgets/modules/woocommerce/menu-icon/class-widget-menu-icon.php' );
			$widgets_manager->register( new \DTElementor_Woo_Menu_Icon() );

		}
	}

	/**
	 * Register designthemes widgets styles
	 */
	public function register_widget_styles() {

		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '';

		# Libraries
		wp_register_style( 'slick',
			dt_elementor()->plugin_url('css/slick.css'),
			array(),
			dt_elementor()::DT_ELEMENTOR_VERSION
		);

		wp_register_style( 'swiper',
			dt_elementor()->plugin_url('css/swiper.min.css'),
			array(),
			dt_elementor()::DT_ELEMENTOR_VERSION
		);

		wp_register_style( 'prettyPhoto',
			dt_elementor()->plugin_url('css/prettyPhoto.css'),
			array(),
			dt_elementor()::DT_ELEMENTOR_VERSION
		);

		wp_register_style( 'dt-button',
			dt_elementor()->plugin_url('css/dt-button.css'),
			array(),
			dt_elementor()::DT_ELEMENTOR_VERSION
		);		

		wp_register_style( 'dt-advanced-carousel',
			dt_elementor()->plugin_url('css/dt-advanced-carousel.css'),
			array(),
			dt_elementor()::DT_ELEMENTOR_VERSION
		);		

		wp_register_style( 'dt-counter',
			dt_elementor()->plugin_url('css/counter.css'),
			array(),
			dt_elementor()::DT_ELEMENTOR_VERSION
		);		

		wp_register_style( 'dt-anycarousel',
			dt_elementor()->plugin_url('css/anycarousel.css'),
			array(),
			dt_elementor()::DT_ELEMENTOR_VERSION
		);		

		wp_register_style( 'dt-header-icons',
			dt_elementor()->plugin_url('css/header-icons.css'),
			array(),
			dt_elementor()::DT_ELEMENTOR_VERSION
		);		

		wp_register_style( 'dt-ordered-list',
			dt_elementor()->plugin_url('css/dt-ordered-list.css'),
			array(),
			dt_elementor()::DT_ELEMENTOR_VERSION
		);		

		# WooCommerce
		if ( class_exists( 'WooCommerce' ) ) {

			# Images Carousel
			wp_register_style( 'dtel-product-single-images-carousel',
				dt_elementor()->plugin_url('widgets/modules/woocommerce/images-carousel/style'.$suffix.'.css'),
				array(),
				dt_elementor()::DT_ELEMENTOR_VERSION
			);

			# Images List
			wp_register_style( 'dtel-product-single-images-list',
				dt_elementor()->plugin_url('widgets/modules/woocommerce/images-list/style'.$suffix.'.css'),
				array(),
				dt_elementor()::DT_ELEMENTOR_VERSION
			);

			# 360 Image Viewer
			wp_register_style( 'dtel-product-single-images-360-viewer',
				dt_elementor()->plugin_url('widgets/modules/woocommerce/360-image-viewer/style'.$suffix.'.css'),
				array(),
				dt_elementor()::DT_ELEMENTOR_VERSION
			);				

			# Summary Nav Bar
			wp_register_style( 'dtel-product-single-summary-nav-bar',
				dt_elementor()->plugin_url('widgets/modules/woocommerce/summary-nav-bar/style'.$suffix.'.css'),
				array(),
				dt_elementor()::DT_ELEMENTOR_VERSION
			);				

			# Summary
			wp_register_style( 'dtel-product-single-summary',
				dt_elementor()->plugin_url('widgets/modules/woocommerce/summary/style'.$suffix.'.css'),
				array(),
				dt_elementor()::DT_ELEMENTOR_VERSION
			);				

			# Product Tabs
			wp_register_style( 'dtel-product-single-tabs',
				dt_elementor()->plugin_url('widgets/modules/woocommerce/product-tabs/style'.$suffix.'.css'),
				array(),
				dt_elementor()::DT_ELEMENTOR_VERSION
			);				

			# Product Tabs Exploded
			wp_register_style( 'dtel-product-single-tabs-exploded',
				dt_elementor()->plugin_url('widgets/modules/woocommerce/product-tabs-exploded/style'.$suffix.'.css'),
				array(),
				dt_elementor()::DT_ELEMENTOR_VERSION
			);

			# Upsell Products
			wp_register_style( 'dtel-product-single-upsell-products',
				dt_elementor()->plugin_url('widgets/modules/woocommerce/upsell-products/style'.$suffix.'.css'),
				array(),
				dt_elementor()::DT_ELEMENTOR_VERSION
			);

			# Related Products
			wp_register_style( 'dtel-product-single-related-products',
				dt_elementor()->plugin_url('widgets/modules/woocommerce/related-products/style'.$suffix.'.css'),
				array(),
				dt_elementor()::DT_ELEMENTOR_VERSION
			);

			# Products
			wp_register_style( 'dtel-products',
				dt_elementor()->plugin_url('widgets/modules/woocommerce/products/style'.$suffix.'.css'),
				array(),
				dt_elementor()::DT_ELEMENTOR_VERSION
			);

			# Menu Icon
			wp_register_style( 'dtel-shop-menu-icon',
				dt_elementor()->plugin_url('widgets/modules/woocommerce/products/style'.$suffix.'.css'),
				array(),
				dt_elementor()::DT_ELEMENTOR_VERSION
			);
		}
	}

	/**
	 * Register designthemes widgets scripts
	 */
	public function register_widget_scripts() {

		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '';

		# Libraries
		wp_register_script( 'inview',
			dt_elementor()->plugin_url('js/jquery.inview.js'),
			array( 'jquery' ),
			dt_elementor()::DT_ELEMENTOR_VERSION,
			true );

		wp_register_script( 'slick',
			dt_elementor()->plugin_url('js/slick.min.js'),
			array( 'jquery' ),
			dt_elementor()::DT_ELEMENTOR_VERSION,
			true );

		wp_register_script( 'swiper',
			dt_elementor()->plugin_url('js/swiper.min.js'),
			array( 'jquery' ),
			dt_elementor()::DT_ELEMENTOR_VERSION,
			true );

		wp_register_script( 'jquery.prettyphoto',
			dt_elementor()->plugin_url('js/jquery.prettyphoto.js'),
			array( 'jquery' ),
			dt_elementor()::DT_ELEMENTOR_VERSION,
			true );

		wp_register_script( 'jquery.nicescroll',
			dt_elementor()->plugin_url('js/jquery.nicescroll.js'),
			array( 'jquery' ),
			dt_elementor()::DT_ELEMENTOR_VERSION,
			true );

		wp_register_script( 'jquery.carouFredSel',
			dt_elementor()->plugin_url('js/jquery.carouFredSel.packed.js'),
			array( 'jquery' ),
			dt_elementor()::DT_ELEMENTOR_VERSION,
			true );

		wp_register_script( 'jquery.360viewer',
			dt_elementor()->plugin_url('js/dt-360-viewer.js'),
			array( 'jquery' ),
			dt_elementor()::DT_ELEMENTOR_VERSION,
			true );

		wp_register_script( 'jquery-animateNumber',
			dt_elementor()->plugin_url('js/jquery.animateNumber.min.js'),
			array( 'jquery' ),
			dt_elementor()::DT_ELEMENTOR_VERSION,
			true );

		wp_register_script( 'dt-advanced-carousel',
			dt_elementor()->plugin_url('js/dt-advanced-carousel.js'),
			array( 'jquery' ),
			dt_elementor()::DT_ELEMENTOR_VERSION,
			true );


		wp_register_script( 'dt-counter',
			dt_elementor()->plugin_url('js/dt-counter.js'),
			array( 'jquery' ),
			dt_elementor()::DT_ELEMENTOR_VERSION,
			true );

		wp_register_script( 'dt-anycarousel',
			dt_elementor()->plugin_url('js/dt-anycarousel.js'),
			array( 'jquery' ),
			dt_elementor()::DT_ELEMENTOR_VERSION,
			true );

		wp_register_script( 'dt-header-icons',
			dt_elementor()->plugin_url('js/dt-header-icons.js'),
			array( 'jquery' ),
			dt_elementor()::DT_ELEMENTOR_VERSION,
			true );

		# WooCommerce
		if ( class_exists( 'WooCommerce' ) ) {

			# Images Carousel
			wp_register_script( 'dtel-product-single-images-carousel',
				dt_elementor()->plugin_url('widgets/modules/woocommerce/images-carousel/script'.$suffix.'.js'),
				array( 'jquery' ),
				dt_elementor()::DT_ELEMENTOR_VERSION,
				true
			);

			# Images List
			wp_register_script( 'dtel-product-single-images-list',
				dt_elementor()->plugin_url('widgets/modules/woocommerce/images-list/script'.$suffix.'.js'),
				array( 'jquery' ),
				dt_elementor()::DT_ELEMENTOR_VERSION,
				true
			);

			# 360 Image Viewer
			wp_register_script( 'dtel-product-single-images-360-viewer',
				dt_elementor()->plugin_url('widgets/modules/woocommerce/360-image-viewer/script'.$suffix.'.js'),
				array( 'jquery' ),
				dt_elementor()::DT_ELEMENTOR_VERSION,
				true
			);

			# Product Tabs - Exploded
			wp_register_script( 'dtel-product-single-tabs-exploded',
				dt_elementor()->plugin_url('widgets/modules/woocommerce/product-tabs-exploded/script'.$suffix.'.js'),
				array( 'jquery' ),
				dt_elementor()::DT_ELEMENTOR_VERSION,
				true
			);

			# Products
			wp_register_script( 'dtel-products',
				dt_elementor()->plugin_url('widgets/modules/woocommerce/products/script'.$suffix.'.js'),
				array( 'jquery' ),
				dt_elementor()::DT_ELEMENTOR_VERSION,
				true
			);

			# Menu Icon
			wp_register_script( 'dtel-shop-menu-icon',
				dt_elementor()->plugin_url('widgets/modules/woocommerce/menu-icon/script'.$suffix.'.js'),
				array( 'jquery' ),
				dt_elementor()::DT_ELEMENTOR_VERSION,
				true
			);
		}
	}
	
	/**
	 *  Editor Preview Style
	 */
	public function preview_styles() {

		# Libraries
		wp_enqueue_style( 'slick' );
		wp_enqueue_style( 'swiper' );
		wp_enqueue_style( 'prettyPhoto' );
		wp_enqueue_style( 'dt-button' );
		wp_enqueue_style( 'dt-anycarousel' );
		wp_enqueue_style( 'dt-advanced-carousel' );
		wp_enqueue_style( 'dt-ordered-list' );

		# WooCommerce
		# Images Carousel
		wp_enqueue_style( 'dtel-product-single-images-carousel' );
					
		# Images List
		wp_enqueue_style( 'dtel-product-single-images-list' );

		# 360 Image Viewer
		wp_enqueue_style( 'dtel-product-single-images-360-viewer' );

		# Summary Nav Bar
		wp_enqueue_style( 'dtel-product-single-summary-nav-bar' );

		# Summary
		wp_enqueue_style( 'dtel-product-single-summary' );

		# Product Tabs
		wp_enqueue_style( 'dtel-product-single-tabs' );

		# Product Tabs Exploded
		wp_enqueue_style( 'dtel-product-single-tabs-exploded' );

		# Upsell Products
		wp_enqueue_style( 'dtel-product-single-upsell-products' );

		# Related Products
		wp_enqueue_style( 'dtel-product-single-related-products' );

		# Products
		wp_enqueue_style( 'dtel-products' );

		# Menu Icon
		wp_enqueue_style( 'dtel-shop-menu-icon' );
	}

	/**
	 * Enqueue localized texts
	 */
	public function localize_settings( $settings ) {

		$settings['DTHotspots'] = array(
			'text'  => __( 'Text', 'dt-elementor' ),
			'icon'  => __( 'Icon', 'dt-elementor' ),
			'blank' => __( 'Blank', 'dt-elementor' ),
		);

		$settings['DTTeamSocial'] = array(
			'fa fa-dribbble'     => esc_html__( 'Dribble', 'dt-elementor'),
			'fa fa-flickr'       => esc_html__( 'Flickr', 'dt-elementor'),
			'fa fa-github'       => esc_html__( 'Github', 'dt-elementor'),
			'fa fa-pinterest'    => esc_html__( 'Pinterest', 'dt-elementor'),
			'fa fa-twitter'      => esc_html__( 'Twitter', 'dt-elementor'),
			'fa fa-youtube'      => esc_html__( 'Youtube', 'dt-elementor'),
			'fa fa-android'      => esc_html__( 'Android', 'dt-elementor'),
			'fa fa-dropbox'      => esc_html__( 'Dropbox', 'dt-elementor'),
			'fa fa-instagram'    => esc_html__( 'Instagram', 'dt-elementor'),
			'fa fa-windows'      => esc_html__( 'Windows', 'dt-elementor'),
			'fa fa-apple'        => esc_html__( 'Apple', 'dt-elementor'),
			'fa fa-facebook-f'   => esc_html__( 'Facebook', 'dt-elementor'),
			'fa fa-google-plus'  => esc_html__( 'Google Plus', 'dt-elementor'),
			'fa fa-linkedin'     => esc_html__( 'Linkedin', 'dt-elementor'),
			'fa fa-skype'        => esc_html__( 'Skype', 'dt-elementor'),
			'fa fa-tumblr'       => esc_html__( 'Tumblr', 'dt-elementor'),
			'fa fa-vimeo-square' => esc_html__( 'Vimeo','dt-elementor'),
		);		

		return $settings;
	}

	public function register_admin_scripts() {	

		wp_enqueue_script( 'dt-elementor-admin',
			dt_elementor()->plugin_url('js/admin.js'),
			array(),
			dt_elementor()::DT_ELEMENTOR_VERSION,
			true );
	}
}

DTElementorWidgets::instance();