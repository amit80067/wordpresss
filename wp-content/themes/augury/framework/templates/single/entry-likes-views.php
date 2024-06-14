<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<?php if( class_exists('DTElementorCore') ): ?>
    <div class="dt-sc-like-views">
    	<?php if( shortcode_exists( 'dt_sc_post_like_count' ) && class_exists( 'DTElementorCore' ) ): ?>
            <div class="likes dt_like_btn">
                <i class="fas fa-heart"></i>
                <a href="#" data-postid="<?php echo esc_attr($post_ID); ?>" data-action="like">
                    <span><?php echo do_shortcode('[dt_sc_post_like_count post_id="'.$post_ID.'" /]');?></span>
                </a>
            </div>
        <?php endif;?>

		<?php if( shortcode_exists( 'dt_sc_post_view_count' ) && class_exists( 'DTElementorCore' ) ): ?>
            <div class="views">
                <i class="fas fa-eye"></i>
                <span><?php echo do_shortcode('[dt_sc_post_view_count post_id="'.$post_ID.'" /]');?></span>
            </div>
        <?php endif;?>
    </div>
<?php endif; ?>