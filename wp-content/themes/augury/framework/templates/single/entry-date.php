<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<?php
	if( $post_Style == 'breadcrumb-fixed' ): ?>
    	<div class="date-wrap">
            <i class="fas fa-clock"> </i>
            <?php echo get_the_date ( get_option('date_format') ); ?>
        </div><?php
	elseif( $post_Style == 'overlap' ): ?>
    	<div class="date-wrap">
            <i class="fas fa-clock"> </i>
            <?php echo get_the_date ( get_option('date_format') ); ?>
        </div><?php
	elseif( $post_Style == 'breadcrumb-parallax' || $post_Style == 'overlay' ):
		echo get_the_date ( get_option('date_format') );
	elseif( $post_Style == 'custom-classic' ): ?>
		<div class="date-wrap">
			<span><?php esc_html_e( 'Date: ', 'augury' ) ?></span>
			<?php echo get_the_date ( get_option('date_format') ); ?>
		</div><?php
	else: ?>
		<i class="fas fa-calendar"> </i>
		<?php echo get_the_date ( get_option('date_format') );
	endif; ?>