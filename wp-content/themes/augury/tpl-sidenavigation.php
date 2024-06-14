<?php
/*
Template Name: Side Navigation Template
*/

get_header();

    $settings = get_post_meta($post->ID,'_tpl_default_settings',TRUE);
    $settings = is_array( $settings ) ?  array_filter( $settings )  : array();

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
        extract( $layout );

        if( array_key_exists('sidenav-align', $settings ) && $settings ['sidenav-align'] == 'true' ) {
            $page_layout .= ' sidenav-alignright';
        }

        if( array_key_exists('sidenav-sticky', $settings ) && $settings ['sidenav-sticky'] == 'true' ) {
            $page_layout .= ' sidenav-sticky';
        }?>

        <!-- Primary -->
        <section id="primary" class="<?php echo esc_attr( $page_layout );?>">

            <?php $sidenav_style = array_key_exists( "sidenav-style", $settings ) ? $settings['sidenav-style'] : ""; ?>

            <div class="side-navigation <?php echo esc_attr($sidenav_style); ?>">
                <div class="side-nav-container">
                    <ul class="side-nav"><?php
                        
                        if( $post->post_parent ):
                            $args = array('child_of' => $post->post_parent,'title_li' => '','sort_order'=> 'ASC','sort_column' => 'menu_order');
                        else:
                            $args = array('child_of' => $post->ID,'title_li' => '','sort_order'=> 'ASC','sort_column' => 'menu_order');
                        endif;

                        $pages = get_pages( $args );
                        $ids = array();
                        $page_id = $post->ID;

                        foreach($pages as $value) {
                            $ids[] = $value->ID;
                        }

                        foreach( $ids as $id ) {
                            $title = get_the_title($id);
                            $title = esc_attr( $title );

                            $permalink = get_permalink( $id );
                            $permalink = esc_url( $permalink );

                            $current = ( $id ===  $page_id) ? "current_page_item" : "";
                            $current = esc_attr( $current );

                            $sidemeta = get_post_meta($id, '_tpl_default_settings', TRUE);
                            $sidemeta = is_array( $sidemeta ) ?  array_filter( $sidemeta )  : array();

                            echo "<li class='{$current}'>";
                            if( array_key_exists('sidenav-icon', $sidemeta) ){
                                echo wp_get_attachment_image( $sidemeta['sidenav-icon'], 'full', "", array( "class" => "dt-sc-sidenav-icon" ) );
                            }
                            if( array_key_exists('sidenav-hover-icon', $sidemeta) ){
                                echo wp_get_attachment_image( $sidemeta['sidenav-hover-icon'], 'full', "", array( "class" => "dt-sc-sidenav-hovericon" ) );
                            }
                            echo "<a href='{$permalink}'>$title</a>";
                            echo "</li>";
                        }?>
                    </ul>
                </div>
                <?php
                    // Side Nav Content
                    if( array_key_exists('enable-sidenav-content', $settings) && $settings['enable-sidenav-content'] == 'true' ) :
                        $hook = $settings['sidenav-content'];
                        if (!empty($hook)) : ?>
                            <div class="side-navigation-bottom-content"><?php
							if( class_exists( '\Elementor\Frontend' ) ) {
								$frontend = Elementor\Frontend::instance();
								$template_content = $frontend->get_builder_content( $settings['sidenav-content'], true );
								echo "{$template_content}";
							} ?>
                            </div><?php
                        endif;
                    endif;
                ?>
            </div>

            <div class="side-navigation-content"><?php
                if( have_posts() ) {
                    while( have_posts() ) {
                        the_post();
                        get_template_part( 'framework/loops/content', 'page' );
                    }
                }?>
            </div>
        </section><!-- Primary End --><?php

        if ( $show_sidebar ) {
            if ( $show_left_sidebar ) {
                $sticky_class = ( array_key_exists('enable-sticky-sidebar', $settings) && $settings['enable-sticky-sidebar'] == 'true' ) ? ' sidebar-as-sticky' : '';?>
                
                <!-- Secondary Left -->
                <section id="secondary-left" class="secondary-sidebar <?php echo esc_attr( $sidebar_class.$sticky_class );?>"><?php
                    augury_show_sidebar( 'page', $post->ID, 'left' ); ?>
                </section><!-- Secondary Left End --><?php
            }
        }        

        if ( $show_sidebar ) {
            if ( $show_right_sidebar ) {
                $sticky_class = ( array_key_exists('enable-sticky-sidebar', $settings) && $settings['enable-sticky-sidebar'] == 'true' ) ? ' sidebar-as-sticky' : '';?>

                <!-- Secondary Right -->
                <section id="secondary-right" class="secondary-sidebar <?php echo esc_attr( $sidebar_class.$sticky_class );?>"><?php
                    augury_show_sidebar( 'page', $post->ID, 'right' ); ?>
                </section><!-- Secondary Right End --><?php
            }
        }?>
    </div>
    <!-- ** Container End ** -->
    
</div><!-- **Main - End ** -->    
<?php get_footer(); ?>