<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<?php
	if( $post_Style == 'dt-sc-simple-style' || $post_Style == 'dt-sc-title-overlay-style' || $post_Style == 'dt-sc-simple-withbg-style' || $post_Style == 'dt-sc-overflow-style'  ):
		echo sprintf( esc_html__( '%s ago', 'augury' ), human_time_diff( get_the_date('U'), current_time('timestamp') ) );
	elseif( $post_Style == 'dt-sc-overlap-style' ):
    	echo esc_html__('on ', 'augury').get_the_date ( get_option('date_format') ).esc_html__(' at ', 'augury').get_the_time('', $post_ID);
	elseif( $post_Style == 'dt-sc-classic-style' || $post_Style == 'dt-sc-classic-ii-style' ): ?>
        <i class="pe-icon pe-date"> </i>
        <?php echo get_the_date ( get_option('date_format') );
	else: ?>
        <i class="fas fa-calendar"> </i>
        <?php echo get_the_date ( get_option('date_format') );
	endif; ?>