<?php
/**
 * Single Product Up-Sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $upsells ) : ?>

	<section class="up-sells upsells products">

		<?php
		/* Title script customized */

		$product_upsell_hide_title = wc_get_loop_prop('product_upsell_hide_title');
		$product_template = augury_woo_product_single_template_option();
		if( ( $product_template == 'custom-template' && $product_upsell_hide_title != 'true' ) || $product_template == 'woo-default' ) {
			
			$title = augury_get_option( 'dt-single-product-upsell-title' );
			if( !empty( $title ) ) {
				echo '<h2>'.augury_html_output($title).'</h2>';
			} else {
				?>
				<h2><?php esc_html_e( 'You may also like&hellip;', 'augury' ) ?></h2>
				<?php 
			}

		}
		?>

		<?php woocommerce_product_loop_start(); ?>

			<?php foreach ( $upsells as $upsell ) : ?>

				<?php
					$post_object = get_post( $upsell->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object );

					wc_get_template_part( 'content', 'product' ); ?>

			<?php endforeach; ?>

		<?php woocommerce_product_loop_end(); ?>

	</section>

<?php endif;

wp_reset_postdata();