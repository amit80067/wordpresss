<?php

function dtportfolio_generate_skin_colors() {

	$output = '';

	$primary_color 	 = augury_get_option('primary-color');
	$secondary_color = augury_get_option('secondary-color');
	$tertiary_color  = augury_get_option('tertiary-color');

	$primary_color_rgba = augury_hex2rgb( $primary_color );
	$primary_color_rgba = implode(',', $primary_color_rgba);

	$secondary_color_rgba = augury_hex2rgb( $secondary_color );
	$secondary_color_rgba = implode(',', $secondary_color_rgba);

	$tertiary_color_rgba = augury_hex2rgb( $tertiary_color );
	$tertiary_color_rgba = implode(',', $tertiary_color_rgba);

	if( !empty( $primary_color ) ) {

		$output .= '.dtportfolio-item .dtportfolio-image-overlay .links a:hover, .dtportfolio-item .dtportfolio-image-overlay a:hover, .dtportfolio-fullpage-carousel .dtportfolio-fullpage-carousel-content a:hover, .dtportfolio-item.dtportfolio-hover-modern-title .dtportfolio-image-overlay .links a:hover, .dtportfolio-swiper-pagination-holder .dtportfolio-swiper-playpause:hover, .dtportfolio-categories a:hover { color:'.$primary_color.'; }';

		$output .= '.dtportfolio-swiper-pagination-holder .swiper-pagination-bullet-active { background:'.$primary_color.'; }';

	}

	return $output;

}

?>