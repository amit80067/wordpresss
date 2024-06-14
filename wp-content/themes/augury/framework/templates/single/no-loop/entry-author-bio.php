<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<?php
	$auth = get_post($post_ID);
	$authid = $auth->post_author;

	if( $post_Style == 'breadcrumb-fixed' ): ?>

        <div class="thumb">
            <?php echo get_avatar(get_the_author_meta('ID', $authid), 150 );?>
        </div>

        <div class="details">
        	<p><?php esc_html_e('Written by', 'augury'); ?></p>
            <h3><a href="<?php echo get_author_posts_url( get_the_author_meta('ID', $authid) ); ?>"><?php echo get_the_author_meta('display_name', $authid); ?></a></h3>
            <div class="desc"><?php echo get_the_author_meta('description', $authid); ?></div>
        </div><?php
	elseif( $post_Style == 'breadcrumb-parallax' ): ?>

        <div class="thumb">
            <?php echo get_avatar(get_the_author_meta('ID', $authid), 150 );?>
        </div>

        <div class="details">
            <h3><a href="<?php echo get_author_posts_url( get_the_author_meta('ID', $authid) ); ?>"><?php echo get_the_author_meta('display_name', $authid); ?></a></h3>
            <div class="desc"><?php echo get_the_author_meta('description', $authid); ?></div>
        </div><?php
	else: ?>

        <div class="thumb">
            <?php echo get_avatar(get_the_author_meta('ID', $authid), 450 );?>
        </div>

        <div class="details">
            <h3>
            	<span><?php esc_html_e('Author', 'augury'); ?></span>
            	<a href="<?php echo get_author_posts_url( get_the_author_meta('ID', $authid) ); ?>"><?php echo get_the_author_meta('display_name', $authid); ?></a>
			</h3>
            <div class="desc"><?php echo get_the_author_meta('description', $authid); ?></div>
        </div><?php
	endif; ?>