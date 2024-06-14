<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<?php
	$comment_style_opt = augury_get_option( 'post-comments-list-style' );
	$comment_Style = isset( $comment_Style ) ? $comment_Style : $comment_style_opt; ?>

    <section class="commententries <?php echo esc_attr($comment_Style); ?>">
        <?php comments_template('', true); ?>
    </section>