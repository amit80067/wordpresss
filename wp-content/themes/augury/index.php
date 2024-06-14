<?php get_header();

	$settings = array();

	$pageid = get_option('page_for_posts');
	if( $pageid > 0 ) {

		$settings = get_post_meta($pageid, '_tpl_default_settings', TRUE);
		$settings = is_array( $settings ) ?  array_filter( $settings )  : array();

		if( empty($settings) || ( array_key_exists( 'layout', $settings ) && $settings['layout'] == 'global-site-layout' ) ) {
			$settings['layout'] = augury_get_option( 'site-global-sidebar-layout' );
			$settings['show-standard-sidebar-left'] = true;
			$settings['show-standard-sidebar-right'] = true;
		}

		$page_layout  = array_key_exists( "layout", $settings ) ? $settings['layout'] : "content-full-width";

		$sidebar_left = array( 'page', $pageid, 'left' );
		$sidebar_right = array( 'page', $pageid, 'right' );
	} else {
		$page_layout  = augury_get_option( 'blog-archives-page-layout' );
		$page_layout  = !empty( $page_layout ) ? $page_layout : "content-full-width";

		$sidebar_left = array( 'left' );
		$sidebar_right = array( 'right' );
	}
	$header_class	   = augury_get_option( 'breadcrumb-position' ); ?>
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
</div><!-- ** Header Wrapper - End ** -->

<!-- **Main** -->
<div id="main">

    <!-- ** Container ** -->
    <div class="container"><?php
    	$layout = augury_page_layout( $page_layout );
        extract( $layout );

        if ( $show_sidebar ) {
            if ( $show_left_sidebar ) {
                $sticky_class = ( array_key_exists('enable-sticky-sidebar', $settings) && $settings['enable-sticky-sidebar'] == 'true' ) ? ' sidebar-as-sticky' : '';?>
                
                <!-- Secondary Left -->
                <section id="secondary-left" class="secondary-sidebar <?php echo esc_attr( $sidebar_class.$sticky_class );?>"><?php
                    $x = count( $sidebar_left );
                    if( $x == 1 ) {

                        get_sidebar( $sidebar_left[0] );
                    } else {
                        augury_show_sidebar( $sidebar_left[0], $sidebar_left[1], $sidebar_left[2] );
                    }?></section><!-- Secondary Left End --><?php
            }
        }?>

        <!-- Primary -->
        <section id="primary" class="<?php echo esc_attr( $page_layout );?>">
        	<?php get_template_part('framework/loops/content', 'archive');?>
        </section><!-- Primary End --><?php

        if ( $show_sidebar ) {
            if ( $show_right_sidebar ) {
                $sticky_class = ( array_key_exists('enable-sticky-sidebar', $settings) && $settings['enable-sticky-sidebar'] == 'true' ) ? ' sidebar-as-sticky' : '';?>
                <!-- Secondary Right -->
                <section id="secondary-right" class="secondary-sidebar <?php echo esc_attr( $sidebar_class.$sticky_class );?>"><?php
                    $x = count( $sidebar_right );
                	if( $x == 1 ) {
                        get_sidebar( $sidebar_right[0] );
                    } else {
                        augury_show_sidebar( $sidebar_right[0], $sidebar_right[1], $sidebar_right[2] );
                    }?></section><!-- Secondary Right End --><?php
            }
        }?>
    </div>
    <!-- ** Container End ** -->    
</div><!-- **Main - End ** -->
<?php get_footer(); ?>