<?php
/**
 * Theme Functions
 *
 * @package DTtheme
 * @author DesignThemes
 * @link http://wedesignthemes.com
 */
define( 'AUGURY_DIR', get_template_directory() );
define( 'AUGURY_URI', get_template_directory_uri() );
define( 'AUGURY_SETTINGS', 'augury-settings' );

if (function_exists ('wp_get_theme')) :
	$themeData = wp_get_theme();
	define( 'AUGURY_NAME', $themeData->get('Name'));
	define( 'AUGURY_VERSION', $themeData->get('Version'));
endif;

/* ---------------------------------------------------------------------------
 * Load default theme options
 * ---------------------------------------------------------------------------*/
require_once AUGURY_DIR .'/inc/class-theme-options.php';

/* ---------------------------------------------------------------------------
 * Loads Customizer
 * ---------------------------------------------------------------------------*/
require_once( AUGURY_DIR .'/inc/customizer/lib/class-fontawesome.php' );
require_once( AUGURY_DIR .'/inc/customizer/lib/class-font-families.php' );
require_once( AUGURY_DIR .'/inc/customizer/lib/class-customizer-sanitizes.php' );
require_once( AUGURY_DIR .'/inc/customizer/index.php' );
require_once( AUGURY_DIR .'/inc/metabox/index.php' );
function augury_defaults() {}

/* ---------------------------------------------------------------------------
 * Widget Area
 * ---------------------------------------------------------------------------*/
require_once AUGURY_DIR .'/inc/widget-area/class-widget-area.php';

/* ---------------------------------------------------------------------------
 * Dynamic CSS
 * ---------------------------------------------------------------------------*/
require_once AUGURY_DIR .'/inc/class-theme-dynamic-css.php';
require_once AUGURY_DIR .'/inc/class-theme-dynamic-skin-css.php';

/* ---------------------------------------------------------------------------
 * Loads Theme Textdomain
 * ---------------------------------------------------------------------------*/ 
define( 'AUGURY_LANG_DIR', AUGURY_DIR. '/languages' );
load_theme_textdomain( 'augury', AUGURY_LANG_DIR );

/* ---------------------------------------------------------------------------
 * Loads Theme Functions
 * ---------------------------------------------------------------------------*/

// Functions --------------------------------------------------------------------
require_once( AUGURY_DIR .'/framework/register-functions.php' );

// Header -----------------------------------------------------------------------
require_once( AUGURY_DIR .'/framework/register-head.php' );

// Hooks ------------------------------------------------------------------------
require_once( AUGURY_DIR .'/framework/register-hooks.php' );

// Backend Menu Walker
require_once( AUGURY_DIR .'/framework/register-backend-menu-walker.php' );
require_once( AUGURY_DIR .'/framework/register-frontend-menu-walker.php' );

// Post Functions ---------------------------------------------------------------
require_once( AUGURY_DIR .'/framework/register-post-functions.php' );
new augury_post_functions;

// Plugins ---------------------------------------------------------------------- 
require_once( AUGURY_DIR .'/framework/register-plugins.php' );

// WooCommerce ------------------------------------------------------------------
if( function_exists( 'is_woocommerce' ) ){
	require_once( AUGURY_DIR .'/framework/woocommerce/register-woocommerce.php' );
}

// Register Templates -----------------------------------------------------------
require_once( AUGURY_DIR .'/framework/register-templates.php' );

// Register Gutenberg -----------------------------------------------------------
require_once( AUGURY_DIR .'/framework/register-gutenberg-editor.php' );