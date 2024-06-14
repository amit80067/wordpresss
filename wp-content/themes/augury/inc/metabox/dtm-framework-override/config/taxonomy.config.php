<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.

$options     = array();

// -----------------------------------------
// Taxonomy Options                        -
// -----------------------------------------
$options[]   = array(
  'id'       => '_dt_post_category_options',
  'taxonomy' => 'category', // category, post_tag or your custom taxonomy name
  'fields'   => array(

	array(
	  'id'    => 'category-color',
	  'type'  => 'color_picker',
	  'title' => esc_html__('Color', 'augury')
	),

  ),
);

DTMFramework_Taxonomy::instance( $options );