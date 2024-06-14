<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<?php
	if( $post_Style == 'dt-sc-boxed-style' ): ?>
		<span><?php esc_html_e('By', 'augury'); ?></span>
        <?php echo get_avatar( get_the_author_meta( 'ID' ), 25 ); ?>
		<a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>" title="<?php esc_attr_e('View all posts by ', 'augury'); echo get_the_author();?>">
			<?php echo get_the_author();?>
        </a><?php
	elseif( $post_Style == 'dt-sc-overlay-style' ): ?>
        <?php echo get_avatar( get_the_author_meta( 'ID' ), 25 ); ?>
		<span><?php esc_html_e('By', 'augury'); ?></span>
		<a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>" title="<?php esc_attr_e('View all posts by ', 'augury'); echo get_the_author();?>">
			<?php echo get_the_author();?>
        </a><?php
	elseif( $post_Style == 'dt-sc-overlay-ii-style' || $post_Style == 'dt-sc-minimal-style' || $post_Style == 'dt-sc-date-left-modern-style' || $post_Style == 'dt-sc-overflow-style' ): ?>
		<span><?php esc_html_e('By', 'augury'); ?></span>
		<a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>" title="<?php esc_attr_e('View all posts by ', 'augury'); echo get_the_author();?>">
			<?php echo get_the_author();?>
        </a><?php
	elseif( $post_Style == 'dt-sc-overlap-style' ): ?>
		<a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>" title="<?php esc_attr_e('View all posts by ', 'augury'); echo get_the_author();?>">
			<?php echo get_the_author();?>
        </a><?php
	elseif( $post_Style == 'dt-sc-classic-style' || $post_Style == 'dt-sc-classic-ii-style' ): ?>
        <i class="pe-icon pe-user"> </i>
        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>" 
            title="<?php esc_attr_e('View all posts by ', 'augury'); echo get_the_author();?>"><?php echo get_the_author();?></a><?php
	else: ?>
        <i class="fas fa-user"> </i>
        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>" 
            title="<?php esc_attr_e('View all posts by ', 'augury'); echo get_the_author();?>"><?php echo get_the_author();?></a><?php
	endif; ?>