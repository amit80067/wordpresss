<?php
	$global_post_styles = array( 'breadcrumb-fixed', 'breadcrumb-parallax', 'overlay', 'overlap', 'custom-minimal', 'custom-classic', 'custom-modern', 'custom' );

	$post_meta = get_post_meta($post->ID,'_dt_post_settings',TRUE);
	$post_meta = is_array($post_meta) ? $post_meta  : array();

	$enable_lightbox = augury_get_option( 'enable-image-lightbox' );
	$post_meta['enable-lightbox'] = !empty( $enable_lightbox ) ? $enable_lightbox : '';

	$post_style = isset( $post_meta['single-post-style'] ) && in_array( $post_meta['single-post-style'], $global_post_styles ) ? $post_meta['single-post-style'] : 'custom-classic';
	$post_classes = array('blog-single-entry', 'post-'.$post_style );

	if( !empty( $post_style ) && $post_style != 'custom' ): ?>

        <article id="post-<?php the_ID();?>" <?php post_class($post_classes);?>><?php
            $template = apply_filters( 'augury_blog_single_template', 'framework/templates/single/post-'.$post_style.'.php' );
            $template_args['ID'] = $post->ID;
            $template_args['Post_Style'] = $post_style;
            $template_args['Post_Meta'] = $post_meta;
            augury_get_template( $template, $template_args ); ?>
        </article><?php
	else:
		$custom_style = isset( $post_meta['single-custom-style'] ) ? '-'.$post_meta['single-custom-style'] : '';
		$post_classes = array('blog-single-entry', 'post-custom'.$custom_style ); ?>

        <article id="post-<?php the_ID();?>" <?php post_class($post_classes);?>><?php
			the_content();
			wp_link_pages( array( 'before'=>'<div class="page-link">', 'after'=>'</div>', 'link_before'=>'<span>', 'link_after'=>'</span>', 'next_or_number'=>'number', 'pagelink' => '%', 'echo' => 1 ) );
			edit_post_link( esc_html__( ' Edit ','augury' ) ); ?>
        </article><?php
	endif;