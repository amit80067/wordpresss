<?php
add_action( 'wp_enqueue_scripts', 'augury_child_enqueue_styles', 100 );
function augury_child_enqueue_styles() {
    wp_enqueue_style( 'augury-parent', get_template_directory_uri() . '/style.css' );
}
?>