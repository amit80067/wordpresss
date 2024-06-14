<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

	<?php
	$post_meta = get_post_meta($post_ID, '_dt_post_settings', TRUE);
	$post_meta = is_array($post_meta) ? $post_meta : array(); ?>

    <div class="dt-sc-like-views">
        <div class="likes dt_like_btn">
            <?php $lcount = !empty( $post_meta['like_count'] ) ? $post_meta['like_count'] : 0;
			if( $post_Style == 'dt-sc-classic-style' ):
				echo '<i class="pe-icon pe-like"></i>';
			else:
				echo '<i class="fas fa-heart"></i>';
			endif; ?>
            <span><?php echo esc_html($lcount); ?></span>
        </div>

        <div class="views">
            <?php $vcount = !empty( $post_meta['view_count'] ) ? $post_meta['view_count'] : 0;
			if( $post_Style == 'dt-sc-classic-style' ):
				echo '<i class="pe-icon pe-look"></i>';
			else:
				echo '<i class="fas fa-eye"></i>';
			endif; ?>
            <span><?php echo esc_html($vcount); ?></span>
        </div>
    </div>