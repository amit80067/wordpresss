<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	} ?>
    <div class="circle-cursor circle-cursor--outer"></div>
	<div class="circle-cursor circle-cursor--inner"></div>
    <?php
    
        /**
         * augury_hook_top hook.
         *      augury_hook_top - 10
         *      augury_page_loader - 20
         */
         do_action( 'augury_hook_top' );
    ?>
    
    <!-- **Wrapper** -->
    <div class="wrapper">
    
        <!-- ** Inner Wrapper ** -->
        <div class="inner-wrapper">

            <?php
                /**
                 * augury_hook_content_before hook.
                 * 
                 */
                do_action( 'augury_hook_content_before' );
            ?>