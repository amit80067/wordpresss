<?php if ( ! defined( 'ABSPATH' ) ) { exit; }

	$format = !empty( $meta['post-format-type'] ) ? $meta['post-format-type'] : 'standard';

	// If it's galley post
	if( $format === "gallery" && $meta['post-gallery-items'] != '' ) : ?>
		<ul class="entry-gallery-post-slider"><?php
			$items = explode(',', $meta["post-gallery-items"]);
			foreach ( $items as $item ) { ?>
				<li><?php echo wp_get_attachment_image( $item, 'full' ); ?></li><?php
			}?>
		</ul><?php
	// If it's video post
	elseif( $format === "video" && $meta['media-url'] != '' ) : ?>
		<div class="dt-video-wrap"><?php
			if( $meta['media-type'] == 'oembed' && ! isset( $_COOKIE['dtPrivacyVideoEmbedsDisabled'] ) ) :
				echo wp_oembed_get($meta['media-url']);
			elseif( $meta['media-type'] == 'self' ) :
				echo wp_video_shortcode( array('src' => $meta['media-url']) );
			endif;?>
		</div><?php
	// If it's audio post
	elseif( $format === "audio" ) :
		if( $meta['media-url'] != '' ) :
			if( $meta['media-type'] == 'oembed' ) :
				echo wp_oembed_get($meta['media-url']);
			elseif( $meta['media-type'] == 'self' ) :
				echo wp_audio_shortcode( array('src' => $meta['media-url']) );
			endif;
		endif;
	// If it's having feature image
	elseif( has_post_thumbnail( $post_ID ) ) :
		if( $meta['enable-lightbox'] ): ?>
            <a href="<?php echo get_the_post_thumbnail_url( $post_ID, 'full' );?>" title="<?php the_title_attribute();?>" class="mag-pop">
                <?php echo get_the_post_thumbnail( $post_ID, 'full' );?>
            </a><?php
		else:
			echo get_the_post_thumbnail( $post_ID, 'full' );
		endif;
	endif;