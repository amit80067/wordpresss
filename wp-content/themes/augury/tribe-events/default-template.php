<?php
/**
 * Default Events Template
 * This file is the basic wrapper template for all the views if 'Default Events Template'
 * is selected in Events -> Settings -> Template -> Events Template.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/default-template.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
get_header();

$global_breadcrumb = augury_get_option( 'show-breadcrumb' );
$header_class = '';
$container_class = 'container';
$settings = array();

	if( is_singular('tribe_events') ) {        

		$settings = get_post_meta(get_the_ID(),'_custom_settings',TRUE);
		$settings = is_array( $settings ) ?  array_filter( $settings )  : array();

		if( empty($settings) || !isset($settings['breadcrumb-option']) ) { 
            $settings['breadcrumb-option'] = 'global-option';
		}
		
		$breadcrumb_disabled = false;
		if( $settings['breadcrumb-option'] == 'global-option' ) {
			$global_breadcrumb = augury_get_option( 'show-breadcrumb' );
			if( !empty( $global_breadcrumb ) ) {
				$header_class = augury_get_option( 'breadcrumb-position' );
			} else {
				$breadcrumb_disabled = true;
			}
		} else if( $settings['breadcrumb-option'] == 'individual-option' ) {
			if( isset( $settings['enable-sub-title'] ) && $settings['enable-sub-title'] ) {
				$header_class = isset( $settings['breadcrumb_position'] ) ? $settings['breadcrumb_position'] : '';
			} else {
				$breadcrumb_disabled = true;
			}
		}

		$post_style = array_key_exists( "event-post-style", $settings ) ? $settings['event-post-style'] : "type1";
		switch( $post_style ):
			case 'type2':
                $container_class = "event-type2-fullwidth";
            break;
            case 'type5':
                $container_class = "event-type5-fullwidth";
            break;
            default:
                $container_class = "container";
            break;
        endswitch;
	}?>

<!-- ** Header Wrapper ** -->
<div id="header-wrapper" class="<?php echo esc_attr($header_class); ?>">

    <!-- **Header** -->
    <header id="header">

        <div class="container"><?php
            /**
             * augury_header hook.
             * 
             * @hooked augury_ele_header_template - 10
             *
             */
            do_action( 'augury_header' ); ?>
        </div>
    </header><!-- **Header - End ** -->

    <!-- ** Breadcrumb ** -->
    <?php

	$bstyle = augury_get_option( 'breadcrumb-style' );

	if( is_singular('tribe_events') ) {

		if(!$breadcrumb_disabled) {

			$breadcrumbs = array();

            $darkbg = '';
            if( $settings['breadcrumb-option'] == 'global-option' ) {
                $darkbg = augury_get_option( 'apply-dark-bg-breadcrumb' );
                $darkbg = $darkbg ? "dark-bg-breadcrumb" : "";
            }else if( $settings['breadcrumb-option'] == 'individual-option' ) {
                if( isset( $settings['enable-dark-bg'] ) && $settings['enable-dark-bg'] ) {
                    $darkbg = "dark-bg-breadcrumb";
                }
            }			

			$category = tribe_get_event_taxonomy( get_the_ID(), array( 'before' => '', 'sep' => ',', 'after' => '') );
			if( $category ) {
				$breadcrumbs[] = $category;
			}

			$breadcrumbs[] = the_title( '<span class="current">', '</span>', false );

			echo '<section class="main-title-section-wrapper '.esc_attr( $bstyle .' '. $darkbg ).'">';
			echo '  <div class="main-title-section-bg"></div>';
			echo '  <div class="container">';
			echo '      <div class="main-title-section">'.the_title( '<h1>', '</h1>',false ).'</div>';
			echo        augury_new_breadcrumbs( $breadcrumbs );
			echo '  </div>';
			echo '</section>';

		}

	} else {

		if( !empty( $global_breadcrumb ) ) {

			$darkbg = augury_get_option( 'apply-dark-bg-breadcrumb' );
			$darkbg = $darkbg ? "dark-bg-breadcrumb" : "";

			$separator = '<span class="'.augury_get_option( 'breadcrumb-delimiter' ).'"></span>';

			$change_delimiter = augury_get_option( 'change-breadcrumb-delimiter' );
			if( !$change_delimiter ) {
				$separator = '<span class="breadcrumb-default-delimiter"></span>';
			}
			
			$breadcrumbs = array();
			$breadcrumbs[] = '<span class="current">'.tribe_get_events_title().'</span>';
			$title = augury_events_title();

			echo '<section class="main-title-section-wrapper '.esc_attr( $bstyle .' '. $darkbg ).'">';
			echo '  <div class="main-title-section-bg"></div>';
			echo '  <div class="container">';
			echo '      <div class="main-title-section"> <h1>'.$title.' </h1> </div>';
			echo        augury_new_breadcrumbs( $breadcrumbs );
			echo '  </div>';
			echo '</section>';
		
		}

	} ?>
    <!-- ** Breadcrumb End ** -->

</div><!-- ** Header Wrapper - End ** -->

<!-- **Main** -->
<div id="main">

    <!-- ** Container ** -->
    <div class="<?php echo esc_attr($container_class); ?>">
    	<div id="tribe-events-pg-template" class="tribe-events-pg-template">
    		<?php tribe_events_before_html(); ?>
    		<?php tribe_get_view(); ?>
    		<?php tribe_events_after_html(); ?>
    	</div> <!-- #tribe-events-pg-template -->
    </div>
    <!-- ** Container End ** -->

</div><!-- **Main - End ** -->
<?php get_footer(); ?>