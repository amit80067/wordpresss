<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<?php
	$auth = get_post($post_ID);
	$authid = $auth->post_author;

	if( $post_Style == 'breadcrumb-parallax' ): ?>
		<span><?php esc_html_e('By', 'augury'); ?></span>
		<a href="<?php echo get_author_posts_url(get_the_author_meta('ID', $authid));?>" title="<?php esc_attr_e('View all posts by ', 'augury'); echo get_the_author_meta('display_name', $authid);?>">
			<?php echo get_the_author_meta('display_name', $authid);?>
        </a><?php
	elseif( $post_Style == 'overlay' ): ?>
		<span>
			<?php esc_html_e('Posted by: ', 'augury'); ?>
            <a href="<?php echo get_author_posts_url(get_the_author_meta('ID', $authid));?>" title="<?php esc_attr_e('View all posts by ', 'augury'); echo get_the_author_meta('display_name', $authid);?>">
                <?php echo get_the_author_meta('display_name', $authid);?>
            </a>
        </span><?php
	elseif( $post_Style == 'overlap' ): ?>
    	<div class="author-wrap">
            <i class="fas fa-user"> </i>
            <a href="<?php echo get_author_posts_url(get_the_author_meta('ID', $authid));?>" title="<?php esc_attr_e('View all posts by ', 'augury'); echo get_the_author_meta('display_name', $authid);?>">
                <?php echo get_the_author_meta('display_name', $authid);?>
            </a>
		</div><?php
	elseif( $post_Style == 'breadcrumb-fixed' ): ?>
    	<div class="author-wrap">
            <i class="fas fa-user"> </i>
            <a href="<?php echo get_author_posts_url(get_the_author_meta('ID', $authid));?>" title="<?php esc_attr_e('View all posts by ', 'augury'); echo get_the_author_meta('display_name', $authid);?>">
                <?php echo get_the_author_meta('display_name', $authid);?>
            </a>
		</div><?php
	else: ?>
		<i class="fas fa-user"> </i>
		<a href="<?php echo get_author_posts_url(get_the_author_meta('ID', $authid));?>" title="<?php esc_attr_e('View all posts by ', 'augury'); echo get_the_author_meta('display_name', $authid);?>">
			<?php echo get_the_author_meta('display_name', $authid);?>
        </a><?php
	endif; ?>