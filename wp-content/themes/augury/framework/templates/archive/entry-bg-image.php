<?php if ( ! defined( 'ABSPATH' ) ) { exit; }

	$post_meta = get_post_meta($post_ID, '_dt_post_settings', TRUE);
	$post_meta = is_array($post_meta) ? $post_meta  : array();

	$format = !empty( $post_meta['post-format-type'] ) ? $post_meta['post-format-type'] : 'standard';

	// If it's galley post
	if( $format === "gallery" && $post_meta['post-gallery-items'] != '' && $meta[5] == true && $post_Layout != 'entry-cover' ) : ?>
		<ul class="entry-gallery-post-slider"><?php
			$items = explode(',', $post_meta["post-gallery-items"]);
			foreach ( $items as $item ) {
				$entry_bg = '';
				$url = wp_get_attachment_image_src( $item, 'full' );
				$entry_bg = "style=background-image:url(".$url[0].")"; ?>

				<li <?php echo esc_attr($entry_bg);?>></li><?php
			}?>
		</ul><?php
	// If it's video post
	elseif( $format === "video" && $post_meta['media-url'] != '' && $meta[6] == true && $post_Layout != 'entry-cover' ) : ?>
		<div class="dt-video-wrap"><?php
			if( $post_meta['media-type'] == 'oembed' && ! isset( $_COOKIE['dtPrivacyVideoEmbedsDisabled'] ) ) :
				echo wp_oembed_get($post_meta['media-url']);
			elseif( $post_meta['media-type'] == 'self' ) :
				echo wp_video_shortcode( array('src' => $post_meta['media-url']) );
			endif;?>
		</div><?php
	// If it's audio post
	elseif( $format === "audio" && $meta[6] == true && $post_Layout != 'entry-cover' ) :
		if( $post_meta['media-url'] != '' ) :
			if( $post_meta['media-type'] == 'oembed' ) :
				echo wp_oembed_get($post_meta['media-url']);
			elseif( $post_meta['media-type'] == 'self' ) :
				echo wp_audio_shortcode( array('src' => $post_meta['media-url']) );
			endif;
		endif;
	// If it's having feature image	
	elseif( has_post_thumbnail( $post_ID ) ) :
		$entry_bg = '';
		$url = get_the_post_thumbnail_url( $post_ID, 'full' );
		$entry_bg = "style=background-image:url(".$url.")"; ?>

		<a <?php echo esc_attr($entry_bg);?> href="<?php echo get_permalink( $post_ID );?>" title="<?php printf(esc_attr__('Permalink to %s','augury'), the_title_attribute('echo=0'));?>"></a><?php
	endif;