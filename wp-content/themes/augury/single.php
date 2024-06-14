<?php get_header();

	$global_breadcrumb = augury_get_option( 'show-breadcrumb' );

    $settings = get_post_meta($post->ID,'_dt_post_settings',TRUE);
    $settings = is_array( $settings ) ?  array_filter( $settings )  : array();

	if( empty($settings) || ( array_key_exists( 'layout', $settings ) && $settings['layout'] == 'global-site-layout' ) ) {
		if( empty($settings) ) { 
            $settings['breadcrumb-option'] = 'global-option';
		}		
		$settings['layout'] = augury_get_option( 'site-global-sidebar-layout' );
		$settings['show-standard-sidebar-left'] = true;
		$settings['show-standard-sidebar-right'] = true;
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

    <!-- ** Breadcrumb ** -->
    <?php
    	# Global Breadcrumb
		if( array_key_exists( 'single-post-style', $settings ) ) {

			// Breadcrumb fixed style...
			if( $settings['single-post-style'] == 'breadcrumb-fixed' ) {

				$post_cls = '';
				if( has_post_thumbnail( $post->ID ) ):
					$bgimage = get_the_post_thumbnail_url( $post->ID, 'full' );
					$post_cls = ' has-post-thumbnail';
				endif;

				echo '<div class="single-post-header-wrapper aligncenter '.$post_cls.'">';

					if( $bgimage ):
						echo '<div class="main-title-section-bg" style="background-image: url('.$bgimage.');"></div>';
					else:
						echo '<div class="main-title-section-bg"></div>';
					endif;

					echo '<div class="container">';
						echo the_title( '<h1 class="single-post-title">', '</h1>', false );

						$template = 'framework/templates/single/entry-categories.php';
						$template_args['post_ID'] = $post->ID;
						$template_args['post_Style'] = 'breadcrumb-fixed'; ?>

                        <div class="post-meta-data">
                            <div class="post-categories"><?php augury_get_template( $template, $template_args ); ?></div>
                            <div class="date"><?php echo sprintf( esc_html__( '%s ago', 'augury' ), human_time_diff( get_the_date('U'), current_time('timestamp') ) ); ?></div>
						</div><?php
					echo '</div>';

				echo '</div>';
			} elseif( $settings['single-post-style'] == 'breadcrumb-parallax' ) {

				$post_cls = '';
				if( has_post_thumbnail( $post->ID ) ):
					$bgimage = get_the_post_thumbnail_url( $post->ID, 'full' );
					$post_cls = ' has-post-thumbnail';
				endif;

				// Breadcrumb parallax style...
				echo '<div class="single-post-header-wrapper dt-parallax-bg aligncenter '.$post_cls.'">';

					if( $bgimage ):
						echo '<div class="main-title-section-bg" style="background-image: url('.$bgimage.');"></div>';
					else:
						echo '<div class="main-title-section-bg"></div>';
					endif;

					echo '<div class="container">';
						$template = 'framework/templates/single/entry-categories.php';
						$template_args['post_ID'] = $post->ID;
						$template_args['post_Style'] = 'breadcrumb-parallax'; ?>

                        <div class="post-categories"><?php augury_get_template( $template, $template_args ); ?></div><?php

						echo the_title( '<h1 class="single-post-title">', '</h1>', false ); ?>

                        <div class="post-meta">
							<div class="post-author"><?php
								$auth = get_post( $post->ID );
								$authid = $auth->post_author;
								echo '<span>'.esc_html__('By ', 'augury').'</span>';
                            	echo '<a href="'.get_author_posts_url($authid).'" title="'.esc_attr__('View all posts by ', 'augury').get_the_author_meta('display_name', $authid).'">'.get_the_author_meta('display_name', $authid).'</a>'; ?>
                            </div>

							<div class="post-date"><?php
								$template = 'framework/templates/single/entry-date.php';
								augury_get_template( $template, $template_args ); ?></div>
 	
							<?php if( ! post_password_required() && ( comments_open() || get_comments_number() ) ) { ?>
	                            <div class="post-comments"><?php
    	                        	comments_popup_link( esc_html__('No Comments', 'augury'), esc_html__('1 Comment', 'augury'), esc_html__('% Comments', 'augury'), '', esc_html__('Comments Off', 'augury'));?>
        	                    </div>
        	                <?php } ?>
                        </div><?php
					echo '</div>';
				echo '</div>';
			} else {

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

					$separator = '<span class="'.augury_get_option( 'breadcrumb-delimiter' ).'"></span>';
					$change_delimiter = augury_get_option( 'change-breadcrumb-delimiter' );
					if( !$change_delimiter ) {
						$separator = '<span class="breadcrumb-default-delimiter"></span>';
					}					

					$cat = get_the_category();
					if( $cat ) {
						$cat = $cat[0];
						$breadcrumbs[] = get_category_parents( $cat, true, $separator );
					}
					$breadcrumbs[] = the_title( '<span class="current">', '</span>', false );
					$bcsettings = isset( $settings['breadcrumb_background'] ) ? $settings['breadcrumb_background'] : array();

					augury_breadcrumb_output ( the_title( '<h1>', '</h1>',false ), $breadcrumbs, $bstyle .' '.$darkbg, array () );
		
				}

			}
		} else {

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

				$separator = '<span class="'.augury_get_option( 'breadcrumb-delimiter' ).'"></span>';

				$change_delimiter = augury_get_option( 'change-breadcrumb-delimiter' );
				if( !$change_delimiter ) {
					$separator = '<span class="breadcrumb-default-delimiter"></span>';
				}

				$cat = get_the_category();
				if( $cat ) {
					$cat = $cat[0];
					$breadcrumbs[] = get_category_parents( $cat, true, $separator );
				}
				$breadcrumbs[] = the_title( '<span class="current">', '</span>', false );
				$bcsettings = isset( $settings['breadcrumb_background'] ) ? $settings['breadcrumb_background'] : array();

				augury_breadcrumb_output ( the_title( '<h1>', '</h1>',false ), $breadcrumbs, $bstyle .' '.$darkbg, array () );
	
			}

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
                    get_template_part( 'framework/loops/content', 'single' );
                }
            }?>
        </section><!-- Primary End --><?php

        if ( $show_sidebar ) {
            if ( $show_left_sidebar ) {
                $sticky_class = ( array_key_exists('enable-sticky-sidebar', $settings) && $settings['enable-sticky-sidebar'] == 'true' ) ? ' sidebar-as-sticky' : '';?>
                
                <!-- Secondary Left -->
                <section id="secondary-left" class="secondary-sidebar <?php echo esc_attr( $sidebar_class.$sticky_class );?>"><?php
                    augury_show_sidebar( 'post', $post->ID, 'left' ); ?></section><!-- Secondary Left End --><?php
            }
        }

        if ( $show_sidebar ) {
            if ( $show_right_sidebar ) {
                $sticky_class = ( array_key_exists('enable-sticky-sidebar', $settings) && $settings['enable-sticky-sidebar'] == 'true' ) ? ' sidebar-as-sticky' : '';?>

                <!-- Secondary Right -->
                <section id="secondary-right" class="secondary-sidebar <?php echo esc_attr( $sidebar_class.$sticky_class );?>"><?php
                    augury_show_sidebar( 'post', $post->ID, 'right' ); ?></section><!-- Secondary Right End --><?php
            }
        }?>
    </div>
    <!-- ** Container End ** -->
    
</div><!-- **Main - End ** -->    
<?php get_footer(); ?>