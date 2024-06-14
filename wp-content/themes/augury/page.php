<?php get_header();

    $settings = get_post_meta($post->ID,'_tpl_default_settings',TRUE);
    $settings = is_array( $settings ) ?  array_filter( $settings )  : array();

	if( empty($settings) || ( array_key_exists( 'layout', $settings ) && $settings['layout'] == 'global-site-layout' ) ) {
		if( empty($settings) ) { 
            $settings['breadcrumb-option'] = 'global-option';
        }
		$settings['layout'] = augury_get_option( 'site-global-sidebar-layout' );
		$settings['show-standard-sidebar-left'] = true;
        $settings['show-standard-sidebar-right'] = true;
    }

    if(function_exists( 'is_woocommerce' ) && (is_cart() || is_checkout() || is_account_page() || (function_exists( 'yith_wcwl_is_wishlist_page' ) && yith_wcwl_is_wishlist_page()) )) {
        if($settings['layout'] == 'with-both-sidebar') {
            $settings['layout'] = 'content-full-width';
        }
    }    

    if( !isset($settings['breadcrumb-option']) ) { 
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

    $show_slider = false;
    if($breadcrumb_disabled) {
        if( isset( $settings['show_slider'] ) && $settings['show_slider'] ) {
            $show_slider = true;
            if( isset( $settings['slider_type'] ) ) {
                $header_class =  $settings['slider_position'];
            }
        }
    }

    ?>
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

    <!-- ** Slider ** -->
    <?php
        if( $show_slider ) {
            if( isset( $settings['slider_type'] ) ) {
                if( $settings['slider_type'] == 'layerslider' && !empty( $settings['layerslider_id'] ) ) {
                    echo '<div id="slider">';
                    echo '  <div id="dt-sc-layer-slider" class="dt-sc-main-slider">';
                    echo    do_shortcode('[layerslider id="'.$settings['layerslider_id'].'"/]');
                    echo '  </div>';
                    echo '</div>';
                } elseif( $settings['slider_type'] == 'revolutionslider' && !empty( $settings['revolutionslider_id'] ) ) {
                    echo '<div id="slider">';
                    echo '  <div id="dt-sc-rev-slider" class="dt-sc-main-slider">';
                    echo    do_shortcode('[rev_slider '.$settings['revolutionslider_id'].'/]');
                    echo '  </div>';
                    echo '</div>';
                } elseif( $settings['slider_type'] == 'customslider' && !empty( $settings['customslider_sc'] ) ) {
                    echo '<div id="slider">';
                    echo '  <div id="dt-sc-custom-slider" class="dt-sc-main-slider">';
                    echo    do_shortcode( $settings['customslider_sc'] );
                    echo '  </div>';
                    echo '</div>';
                }
            }
        }
    ?><!-- ** Slider End ** -->

    <!-- ** Breadcrumb ** -->
    <?php 

        if(!$breadcrumb_disabled) {

            $breadcrumbs = array();
            $bstyle = augury_get_option( 'breadcrumb-style' );

            $darkbg = '';
            if( $settings['breadcrumb-option'] == 'global-option' ) {
                $darkbg = augury_get_option( 'apply-dark-bg-breadcrumb' );
                $darkbg = $darkbg ? "dark-bg-breadcrumb" : "";
            }else if( $settings['breadcrumb-option'] == 'individual-option' ) {
                if( isset( $settings['enable-dark-bg'] ) && $settings['enable-dark-bg'] ) {
                    $darkbg = "dark-bg-breadcrumb";
                }
            }

            if( $post->post_parent ) {
                $parent_id  = $post->post_parent;
                $parents = array();

                while( $parent_id ) {
                    $page = get_page( $parent_id );
                    $parents[] = '<a href="' . get_permalink( $page->ID ) . '">' . get_the_title( $page->ID ) . '</a>';
                    $parent_id  = $page->post_parent;
                }

                $parents = array_reverse( $parents );
                $breadcrumbs = array_merge_recursive($breadcrumbs, $parents);
            }

            $breadcrumbs[] = the_title( '<span class="current">', '</span>', false );
            $bcsettings = isset( $settings['breadcrumb_background'] ) ? $settings['breadcrumb_background'] : array();

            augury_breadcrumb_output ( the_title( '<h1>', '</h1>',false ), $breadcrumbs, $bstyle .' '.$darkbg, array () );

        }

    ?><!-- ** Breadcrumb End ** -->
</div><!-- ** Header Wrapper - End ** -->

<!-- **Main** -->
<div id="main">

    <!-- ** Container ** -->
    <div class="container"><?php
        $page_layout  = array_key_exists( "layout", $settings ) ? $settings['layout'] : "content-full-width";
        $layout = augury_page_layout( $page_layout );
        extract( $layout );?>

        <!-- Primary -->
        <section id="primary" class="<?php echo esc_attr( $page_layout );?>"><?php
            if( have_posts() ) {
                while( have_posts() ) {
                    the_post();
                    get_template_part( 'framework/loops/content', 'page' );
                }
            }?>
        </section><!-- Primary End --><?php

        if ( $show_sidebar ) {
            if ( $show_left_sidebar ) {
                $sticky_class = ( array_key_exists('enable-sticky-sidebar', $settings) && $settings['enable-sticky-sidebar'] == 'true' ) ? ' sidebar-as-sticky' : '';?>
                
                <!-- Secondary Left -->
                <section id="secondary-left" class="secondary-sidebar <?php echo esc_attr( $sidebar_class.$sticky_class );?>"><?php
                    augury_show_sidebar( 'page', $post->ID, 'left' );
                ?></section><!-- Secondary Left End --><?php
            }
        }

        if ( $show_sidebar ) {
            if ( $show_right_sidebar ) {
                $sticky_class = ( array_key_exists('enable-sticky-sidebar', $settings) && $settings['enable-sticky-sidebar'] == 'true' ) ? ' sidebar-as-sticky' : '';?>

                <!-- Secondary Right -->
                <section id="secondary-right" class="secondary-sidebar <?php echo esc_attr( $sidebar_class.$sticky_class );?>"><?php
                    augury_show_sidebar( 'page', $post->ID, 'right' );
                ?></section><!-- Secondary Right End --><?php
            }
        }?>
    </div>
    <!-- ** Container End ** -->
    
</div><!-- **Main - End ** -->    
<?php get_footer(); ?>