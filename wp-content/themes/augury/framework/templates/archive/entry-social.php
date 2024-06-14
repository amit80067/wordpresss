<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<?php
if(function_exists('dt_blog_single_social_share')) {
    echo dt_blog_single_social_share($post_ID);
}
?>