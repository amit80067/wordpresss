<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<?php
	if( $post_Style == 'breadcrumb-fixed' ): ?>

        <div class="thumb">
            <?php echo get_avatar(get_the_author_meta('ID'), 150 );?>
        </div>

        <div class="details">
        	<p><?php esc_html_e('Written by', 'augury'); ?></p>
            <h3><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author_meta( 'display_name' ); ?></a></h3>
            <div class="desc"><?php the_author_meta('description'); ?></div>
        </div><?php
	elseif( $post_Style == 'breadcrumb-parallax' ): ?>

        <div class="thumb">
            <?php echo get_avatar(get_the_author_meta('ID'), 150 );?>
        </div>

        <div class="details">
            <h3><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author_meta( 'display_name' ); ?></a></h3>
            <div class="desc"><?php the_author_meta('description'); ?></div>
        </div><?php
	else: ?>

        <div class="thumb">
            <?php echo get_avatar(get_the_author_meta('ID'), 450 );?>
        </div>

        <div class="details">
            <h3>
            	<span><?php esc_html_e('Author', 'augury'); ?></span>
                <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author_meta( 'display_name' ); ?></a>
            </h3>
            <div class="desc"><?php the_author_meta('description'); ?></div>
        </div><?php
	endif; ?>