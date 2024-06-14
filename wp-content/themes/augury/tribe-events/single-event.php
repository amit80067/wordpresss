<?php 
    $id = get_the_ID();
    $settings = get_post_meta($id,'_custom_settings',TRUE);
    $settings = is_array( $settings ) ?  array_filter( $settings )  : array();

    $page_layout  = array_key_exists( "layout", $settings ) ? $settings['layout'] : "content-full-width";
    $post_style   = array_key_exists( "event-post-style", $settings ) ? $settings['event-post-style'] : "type1";
    
    $layout = augury_page_layout( $page_layout );
    extract( $layout );

    if( $post_style == 'type2' || $post_style == 'type5' ){
        $show_sidebar = false;
        $page_layout = "content-full-width";
    }?>

    <!-- Primary -->
    <section id="primary" class="<?php echo esc_attr( $page_layout );?>"><?php
        if( have_posts() ) {
            while( have_posts() ) {
                the_post();?>
                    <article id="post-<?php the_ID();?>" <?php post_class($post_style. ' tribe-events-single');?>>
                        <?php get_template_part('tribe-events/templates/event', $post_style); ?>
                    </article>
                <?php
            }
        }?>
    </section><!-- Primary End --><?php

    if ( $show_sidebar ) {

        if ( $show_left_sidebar ) {

            $sticky_class = ( array_key_exists('enable-sticky-sidebar', $settings) && $settings['enable-sticky-sidebar'] == 'true' ) ? ' sidebar-as-sticky' : '';?>
            
            <!-- Secondary Left -->
            <section id="secondary-left" class="secondary-sidebar <?php echo esc_attr( $sidebar_class.$sticky_class );?>"><?php
                augury_show_sidebar( 'tribe_events', $id, 'left' ); ?></section><!-- Secondary Left End --><?php
        }
    }    

    if ( $show_sidebar ) {

        if ( $show_right_sidebar ) {

            $sticky_class = ( array_key_exists('enable-sticky-sidebar', $settings) && $settings['enable-sticky-sidebar'] == 'true' ) ? ' sidebar-as-sticky' : '';?>

            <!-- Secondary Right -->
            <section id="secondary-right" class="secondary-sidebar <?php echo esc_attr( $sidebar_class.$sticky_class );?>"><?php
                augury_show_sidebar( 'tribe_events', $id, 'right' ); ?></section><!-- Secondary Right End --><?php
        }
    }?>