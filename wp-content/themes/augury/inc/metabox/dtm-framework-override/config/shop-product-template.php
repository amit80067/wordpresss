<?php
// -----------------------------------------
// Header And Footer Options Metabox
// -----------------------------------------

function augury_shop_product_template() {

  $options[] = array (
    'id'	                     => '_dt_shop_product_template_settings',
    'title'	                   => esc_html__('Product Template Settings','augury'),
    'post_type'                => 'dt_product_template',
    'priority'                 => 'high',
    'context'                  => 'normal', 
    'sections'                 => array (
    
      # Default Options
      array (
        'name'                 => 'default_options_section',
        'title'                => esc_html__('Default', 'augury'),
        'icon'                 => 'fa fa-angle-double-right',
        'fields'               => array (
        
          array (
            'id'         => 'product-style',
            'type'       => 'select',
            'title'      => esc_html__('Product Style', 'augury'),
            'options'    => array (
                      'product-style-default'              => esc_html__('Default', 'augury'),
                      'product-style-cornered'             => esc_html__('Cornered', 'augury'),
                      'product-style-title-eg-highlighter' => esc_html__('Title & Element Group Highlighter', 'augury'),
                      'product-style-content-highlighter'  => esc_html__('Content Highlighter', 'augury'),
                      'product-style-egrp-overlap-pc'      => esc_html__('Element Group Overlap Product Content', 'augury'),
                      'product-style-egrp-reveal-pc'       => esc_html__('Element Group Reveal Product Content', 'augury'),
                      'product-style-igrp-over-pc'         => esc_html__('Icon Group over Product Content', 'augury'),
                      'product-style-egrp-over-pc'         => esc_html__('Element Group over Product Content', 'augury')
                    ),
            'default'    => 'product-style-default'
          )	

        )
      ),
      # Default Settings


      # Hover Options
      array (
        'name'                 => 'hover_options_section',
        'title'                => esc_html__('Hover Options', 'augury'),
        'icon'                 => 'fa fa-angle-double-right',
        'fields'               => array (
        
          array(
            'id'         => 'product-hover-styles',
            'type'       => 'select',
            'title'      => esc_html__('Hover Styles', 'augury'),
            'options'    => array(
                      ''                                        => esc_html__('None', 'augury'),
                      'product-hover-fade-border'               => esc_html__('Fade - Border', 'augury'),
                      'product-hover-fade-skinborder'           => esc_html__('Fade - Skin Border', 'augury'),
                      'product-hover-fade-gradientborder'       => esc_html__('Fade - Gradient Border', 'augury'),
                      'product-hover-fade-shadow'               => esc_html__('Fade - Shadow', 'augury'),
                      'product-hover-fade-inshadow'             => esc_html__('Fade - InShadow', 'augury'),
                      'product-hover-thumb-fade-border'         => esc_html__('Fade Thumb Border', 'augury'),
                      'product-hover-thumb-fade-skinborder'     => esc_html__('Fade Thumb SkinBorder', 'augury'),
                      'product-hover-thumb-fade-gradientborder' => esc_html__('Fade Thumb Gradient Border', 'augury'),
                      'product-hover-thumb-fade-shadow'         => esc_html__('Fade Thumb Shadow', 'augury'),
                      'product-hover-thumb-fade-inshadow'       => esc_html__('Fade Thumb InShadow', 'augury')
                    ),
            'default'    => 'product-hover-fade-border'
          ),

          array(
            'id'         => 'product-overlay-bgcolor',
            'type'       => 'color_picker',
            'title'      => esc_html__('Overlay Background Color', 'augury')
          ),

          array(
            'id'         => 'product-overlay-dark-bgcolor',
            'type'       => 'switcher',
            'title'      => esc_html__('Overlay Dark Background', 'augury'),
          ),

          array(
            'id'         => 'product-overlay-effects',
            'type'       => 'select',
            'title'      => esc_html__('Overlay Effects', 'augury'),
            'options'    => array(
                      ''                                    => esc_html__('None', 'augury'),
                      'product-overlay-fixed'               => esc_html__('Fixed', 'augury'),
                      'product-overlay-toptobottom'         => esc_html__('Top to Bottom', 'augury'),
                      'product-overlay-bottomtotop'         => esc_html__('Bottom to Top', 'augury'),
                      'product-overlay-righttoleft'         => esc_html__('Right to Left', 'augury'),
                      'product-overlay-lefttoright'         => esc_html__('Left to Right', 'augury'),
                      'product-overlay-middle'              => esc_html__('Middle', 'augury'),
                      'product-overlay-middleradial'        => esc_html__('Middle Radial', 'augury'),
                      'product-overlay-gradienttoptobottom' => esc_html__('Gradient - Top to Bottom', 'augury'),
                      'product-overlay-gradientbottomtotop' => esc_html__('Gradient - Bottom to Top', 'augury'),
                      'product-overlay-gradientrighttoleft' => esc_html__('Gradient - Right to Left', 'augury'),
                      'product-overlay-gradientlefttoright' => esc_html__('Gradient - Left to Right', 'augury'),
                      'product-overlay-gradientradial'      => esc_html__('Gradient - Radial', 'augury'),
                      'product-overlay-flash'               => esc_html__('Flash', 'augury'),
                      'product-overlay-scale'               => esc_html__('Scale', 'augury'),
                      'product-overlay-horizontalelastic'   => esc_html__('Horizontal - Elastic', 'augury'),
                      'product-overlay-verticalelastic'     => esc_html__('Vertical - Elastic', 'augury')
                    ),
            'default'    => ''
          ),

          array(
            'id'         => 'product-hover-image-effects',
            'type'       => 'select',
            'title'      => esc_html__('Hover Image Effects', 'augury'),
            'options'    => array(
                      ''                                => esc_html__('None', 'augury'),
                      'product-hover-image-blur'        => esc_html__('Blur', 'augury'),
                      'product-hover-image-blackwhite'  => esc_html__('Black & White', 'augury'),
                      'product-hover-image-fadeinleft'  => esc_html__('Fade In Left', 'augury'),
                      'product-hover-image-fadeinright' => esc_html__('Fade In Right', 'augury'),
                      'product-hover-image-rotate'      => esc_html__('Rotate', 'augury'),
                      'product-hover-image-rotatealt'   => esc_html__('Rotate - Alt', 'augury'),
                      'product-hover-image-scalein'     => esc_html__('Scale In', 'augury'),
                      'product-hover-image-scaleout'    => esc_html__('Scale Out', 'augury'),
                      'product-hover-image-floatout'    => esc_html__('Float Up', 'augury')
                    ),
            'default'    => ''
          ),

          array(
            'id'         => 'product-hover-secondary-image-effects',
            'type'       => 'select',
            'title'      => esc_html__('Hover Secondary Image Effects', 'augury'),
            'options'    => array(
                      'product-hover-secimage-fade'              => esc_html__('Fade', 'augury'),
                      'product-hover-secimage-zoomin'            => esc_html__('Zoom In', 'augury'),
                      'product-hover-secimage-zoomout'           => esc_html__('Zoom Out', 'augury'),
                      'product-hover-secimage-zoomoutup'         => esc_html__('Zoom Out Up', 'augury'),
                      'product-hover-secimage-zoomoutdown'       => esc_html__('Zoom Out Down', 'augury'),
                      'product-hover-secimage-zoomoutleft'       => esc_html__('Zoom Out Left', 'augury'),
                      'product-hover-secimage-zoomoutright'      => esc_html__('Zoom Out Right', 'augury'),
                      'product-hover-secimage-pushup'            => esc_html__('Push Up', 'augury'),
                      'product-hover-secimage-pushdown'          => esc_html__('Push Down', 'augury'),
                      'product-hover-secimage-pushleft'          => esc_html__('Push Left', 'augury'),
                      'product-hover-secimage-pushright'         => esc_html__('Push Right', 'augury'),
                      'product-hover-secimage-slideup'           => esc_html__('Slide Up', 'augury'),
                      'product-hover-secimage-slidedown'         => esc_html__('Slide Down', 'augury'),
                      'product-hover-secimage-slideleft'         => esc_html__('Slide Left', 'augury'),
                      'product-hover-secimage-slideright'        => esc_html__('Slide Right', 'augury'),		
                      'product-hover-secimage-hingeup'           => esc_html__('Hinge Up', 'augury'),
                      'product-hover-secimage-hingedown'         => esc_html__('Hinge Down', 'augury'),
                      'product-hover-secimage-hingeleft'         => esc_html__('Hinge Left', 'augury'),
                      'product-hover-secimage-hingeright'        => esc_html__('Hinge Right', 'augury'),		
                      'product-hover-secimage-foldup'            => esc_html__('Fold Up', 'augury'),
                      'product-hover-secimage-folddown'          => esc_html__('Fold Down', 'augury'),
                      'product-hover-secimage-foldleft'          => esc_html__('Fold Left', 'augury'),
                      'product-hover-secimage-foldright'         => esc_html__('Fold Right', 'augury'),
                      'product-hover-secimage-fliphoriz'         => esc_html__('Flip Horizontal', 'augury'),
                      'product-hover-secimage-flipvert'          => esc_html__('Flip Vertical', 'augury')
                    ),
            'default'    => 'product-hover-secimage-fade'
          ),

          array(
            'id'         => 'product-content-hover-effects',
            'type'       => 'select',
            'title'      => esc_html__('Content Hover Effects', 'augury'),
            'options'    => array(
                      ''                                   => esc_html__('None', 'augury'),
                      'product-content-hover-fade'         => esc_html__('Fade', 'augury'),
                      'product-content-hover-zoom'         => esc_html__('Zoom', 'augury'),
                      'product-content-hover-slidedefault' => esc_html__('Slide Default', 'augury'),
                      'product-content-hover-slideleft'    => esc_html__('Slide From Left', 'augury'),
                      'product-content-hover-slideright'   => esc_html__('Slide From Right', 'augury'),
                      'product-content-hover-slidetop'     => esc_html__('Slide From Top', 'augury'),
                      'product-content-hover-slidebottom'  => esc_html__('Slide From Bottom', 'augury')
                    ),
            'default'    => ''
          ),

          array(
            'id'         => 'product-icongroup-hover-effects',
            'type'       => 'select',
            'title'      => esc_html__('Icon Group Hover Effects', 'augury'),
            'options'    => array(
                      ''                               => esc_html__('None', 'augury'),
                      'product-icongroup-hover-flipx'  => esc_html__('Flip X', 'augury'),
                      'product-icongroup-hover-flipy'  => esc_html__('Flip Y', 'augury'),
                      'product-icongroup-hover-bounce' => esc_html__('Bounce', 'augury')
                    ),
            'default'    => ''
          ),

        )
      ),
      # Hover Options


      # Common Options
      array (
        'name'                 => 'common_options_section',
        'title'                => esc_html__('Common Options', 'augury'),
        'icon'                 => 'fa fa-angle-double-right',
        'fields'               => array (
        
          array(
            'id'         => 'product-borderorshadow',
            'type'       => 'select',
            'title'      => esc_html__('Border or Shadow', 'augury'),
            'options'    => array(
                      ''                              => esc_html__('None', 'augury'),
                      'product-borderorshadow-border' => esc_html__('Border', 'augury'),
                      'product-borderorshadow-shadow' => esc_html__('Shadow', 'augury')
                    ),
            'default'    => '',
            'desc'      => esc_html__('Choose either Border or Shadow for your product listing.', 'augury')
          ),										
          array(
            'id'         => 'product-border-type',
            'type'       => 'select',
            'title'      => esc_html__('Border - Type', 'augury'),
            'options'    => array(
                      'product-border-type-default' => esc_html__('Default', 'augury'),
                      'product-border-type-thumb'   => esc_html__('Thumb', 'augury')
                    ),
            'default'    => 'product-border-type-default',
          ),													
          array(
            'id'         => 'product-border-position',
            'type'       => 'select',
            'title'      => esc_html__('Border - Position', 'augury'),
            'options'    => array(
                      'product-border-position-default'      => esc_html__('Default', 'augury'),
                      'product-border-position-left'         => esc_html__('Left', 'augury'),
                      'product-border-position-right'        => esc_html__('Right', 'augury'),
                      'product-border-position-top'          => esc_html__('Top', 'augury'),
                      'product-border-position-bottom'       => esc_html__('Bottom', 'augury'),
                      'product-border-position-top-left'     => esc_html__('Top Left', 'augury'),
                      'product-border-position-top-right'    => esc_html__('Top Right', 'augury'),
                      'product-border-position-bottom-left'  => esc_html__('Bottom Left', 'augury'),
                      'product-border-position-bottom-right' => esc_html__('Bottom Right', 'augury')														
                    ),
            'default'    => 'product-border-position-default',
          ),	
          array(
            'id'         => 'product-shadow-type',
            'type'       => 'select',
            'title'      => esc_html__('Shadow - Type', 'augury'),
            'options'    => array(
                      'product-shadow-type-default' => esc_html__('Default', 'augury'),
                      'product-shadow-type-thumb'   => esc_html__('Thumb', 'augury')
                    ),
            'default'    => 'product-shadow-type-default',
          ),
          array(
            'id'         => 'product-shadow-position',
            'type'       => 'select',
            'title'      => esc_html__('Shadow - Position', 'augury'),
            'options'    => array(
                      'product-shadow-position-default'      => esc_html__('Default', 'augury'),
                      'product-shadow-position-top-left'     => esc_html__('Top Left', 'augury'),
                      'product-shadow-position-top-right'    => esc_html__('Top Right', 'augury'),
                      'product-shadow-position-bottom-left'  => esc_html__('Bottom Left', 'augury'),
                      'product-shadow-position-bottom-right' => esc_html__('Bottom Right', 'augury')
                    ),
            'default'    => 'product-shadow-position-default',
          ),

          array(
            'id'         => 'product-bordershadow-highlight',
            'type'       => 'select',
            'title'      => esc_html__('Border / Shadow - Highlight', 'augury'),
            'options'    => array(
                      ''                                       => esc_html__('None', 'augury'),
                      'product-bordershadow-highlight-default' => esc_html__('Default', 'augury'),
                      'product-bordershadow-highlight-onhover' => esc_html__('On Hover', 'augury')
                    ),
            'default'    => '',
          ),

          array(
            'id'         => 'product-background-bgcolor',
            'type'       => 'color_picker',
            'title'      => esc_html__('Background - Background Color', 'augury')
          ),

          array(
            'id'         => 'product-background-dark-bgcolor',
            'type'       => 'switcher',
            'title'      => esc_html__('Background - Dark Background', 'augury')
          ),
        
          array(
            'id'         => 'product-padding',
            'type'       => 'select',
            'title'      => esc_html__('Padding', 'augury'),
            'options'    => array(
                      'product-padding-default' => esc_html__('Default', 'augury'),
                      'product-padding-overall' => esc_html__('Product', 'augury'),
                      'product-padding-thumb'   => esc_html__('Thumb', 'augury'),
                      'product-padding-content' => esc_html__('Content', 'augury'),
                    ),
            'default'    => 'product-padding-default'
          ),
          array(
            'id'         => 'product-space',
            'type'       => 'select',
            'title'      => esc_html__('Space', 'augury'),
            'options'    => array(
                      'product-without-space' => esc_html__('False', 'augury'),
                      'product-with-space'  => esc_html__('True', 'augury')
                    ),
            'default'    => 'product-with-space'
          ),
          array(
            'id'         => 'product-display-type',
            'type'       => 'select',
            'title'      => esc_html__('Display Type', 'augury'),
            'options'    => array(
                      'grid' => esc_html__('Grid', 'augury'),
                      'list'  => esc_html__('List', 'augury')
                    ),
            'default'    => 'grid'
          ),
          array(
            'id'         => 'product-display-type-list-options',
            'type'       => 'select',
            'title'      => esc_html__('List Options', 'augury'),
            'options'    => array(
                      'left-thumb'  => esc_html__('Left Thumb', 'augury'),
                      'right-thumb' => esc_html__('Right Thumb', 'augury')
                    ),
            'default'    => 'left-thumb'
          ),	
          array(
            'id'         => 'product-show-labels',
            'type'       => 'select',
            'title'      => esc_html__('Show Product Labels', 'augury'),
            'options'    => array(
                      'true'  => esc_html__('True', 'augury'),
                      'false' => esc_html__('False', 'augury')
                    ),
            'default'    => 'true'
          ),															
          array(
            'id'         => 'product-label-design',
            'type'       => 'select',
            'title'      => esc_html__('Product Label Design', 'augury'),
            'options'    => array(
                      'product-label-boxed'      => esc_html__('Boxed', 'augury'),
                      'product-label-circle'  => esc_html__('Circle', 'augury'),
                      'product-label-rounded'   => esc_html__('Rounded', 'augury'),
                      'product-label-angular'   => esc_html__('Angular', 'augury'),
                      'product-label-ribbon'   => esc_html__('Ribbon', 'augury'),
                    ),
            'default'    => 'product-label-boxed',
          ),

          array(
            'id'         => 'product-custom-class',
            'type'       => 'text',
            'title'      => esc_html__('Custom Class', 'augury')
          ),	

        )
      ),
      # Common Options


      # Thumb Options
      array (
        'name'                 => 'thumb_options_section',
        'title'                => esc_html__('Thumb Options', 'augury'),
        'icon'                 => 'fa fa-angle-double-right',
        'fields'               => array (

          array(
            'id'         => 'product-thumb-secondary-image-onhover',
            'type'       => 'switcher',
            'title'      => esc_html__('Show Secondary Image On Hover', 'augury'),
            'desc'	 => esc_html__('YES! to show secondary image on product hover. First image in the gallery will be used as secondary image.', 'augury')
          ),

          array(
            'id'             => 'product-thumb-content',
            'type'           => 'sorter',
            'title'          => esc_html__('Content', 'augury'),
            'default'        => array(
              'enabled'      => array(
                'title'          => esc_html__('Title', 'augury'),
                'category'       => esc_html__('Category', 'augury'),
                'price'          => esc_html__('Price', 'augury'),
                'button_element' => esc_html__('Button Element', 'augury'),
                'icons_group'    => esc_html__('Icons Group', 'augury'),
              ),
              'disabled'     => array(
                'excerpt'       => esc_html__('Excerpt', 'augury'),
                'rating'        => esc_html__('Rating', 'augury'),
                'countdown'     => esc_html__('Count Down', 'augury'),
                'separator'     => esc_html__('Separator', 'augury'),
                'element_group' => esc_html__('Element Group', 'augury'),
                'swatches'      => esc_html__('Swatches', 'augury'),
              ),
            ),
            'enabled_title'  => esc_html__('Active Elements', 'augury'),
            'disabled_title' => esc_html__('Deatcive Elements', 'augury'),
          ),

          array(
            'id'         => 'product-thumb-alignment',
            'type'       => 'select',
            'title'      => esc_html__('Alignment', 'augury'),
            'options'    => array(
                      'product-thumb-alignment-top'          => esc_html__('Top', 'augury'),
                      'product-thumb-alignment-top-left'     => esc_html__('Top Left', 'augury'),
                      'product-thumb-alignment-top-right'    => esc_html__('Top Right', 'augury'),
                      'product-thumb-alignment-middle'       => esc_html__('Middle', 'augury'),
                      'product-thumb-alignment-bottom'       => esc_html__('Bottom', 'augury'),
                      'product-thumb-alignment-bottom-left'  => esc_html__('Bottom Left', 'augury'),
                      'product-thumb-alignment-bottom-right' => esc_html__('Bottom Right', 'augury')
                    ),
            'default'    => 'product-thumb-alignment-top'
          ),

          array(
            'id'         => 'product-thumb-iconsgroup-icons',
            'type'       => 'select',
            'title'      => esc_html__('Icons Group - Icons', 'augury'),
            'options'    => array(
                      'cart'      => esc_html__('Cart', 'augury'),
                      'wishlist'  => esc_html__('Wishlist', 'augury'),
                      'compare'   => esc_html__('Compare', 'augury'),
                      'quickview' => esc_html__('Quick View', 'augury')
                    ),
            'class'         => 'chosen',
            'attributes'    => array(
              'multiple'    => 'multiple',
            ),							
          ),

          array(
            'id'         => 'product-thumb-iconsgroup-style',
            'type'       => 'select',
            'title'      => esc_html__('Icons Group - Style', 'augury'),
            'options'    => array(
                      'product-thumb-iconsgroup-style-simple'  => esc_html__('Simple', 'augury'),
                      'product-thumb-iconsgroup-style-bgfill-square'  => esc_html__('Background Fill Square', 'augury'),
                      'product-thumb-iconsgroup-style-bgfill-rounded-square' => esc_html__('Background Fill Rounded Square', 'augury'),
                      'product-thumb-iconsgroup-style-bgfill-rounded'  => esc_html__('Background Fill Rounded', 'augury'),
                      'product-thumb-iconsgroup-style-brdrfill-square'  => esc_html__('Border Fill Square', 'augury'),
                      'product-thumb-iconsgroup-style-brdrfill-rounded-square' => esc_html__('Border Fill Rounded Square', 'augury'),
                      'product-thumb-iconsgroup-style-brdrfill-rounded'  => esc_html__('Border Fill Rounded', 'augury'),
                      'product-thumb-iconsgroup-style-skinbgfill-square'  => esc_html__('Skin Background Fill Square', 'augury'),
                      'product-thumb-iconsgroup-style-skinbgfill-rounded-square' => esc_html__('Skin Background Fill Rounded Square', 'augury'),
                      'product-thumb-iconsgroup-style-skinbgfill-rounded'  => esc_html__('Skin Background Fill Rounded', 'augury'),
                      'product-thumb-iconsgroup-style-skinbrdrfill-square'  => esc_html__('Skin Border Fill Square', 'augury'),
                      'product-thumb-iconsgroup-style-skinbrdrfill-rounded-square' => esc_html__('Skin Border Fill Rounded Square', 'augury'),
                      'product-thumb-iconsgroup-style-skinbrdrfill-rounded'  => esc_html__('Skin Border Fill Rounded', 'augury')																											
                    ),
            'default'    => 'product-thumb-iconsgroup-style-simple'
          ),

          array(
            'id'         => 'product-thumb-iconsgroup-position',
            'type'       => 'select',
            'title'      => esc_html__('Icons Group - Position', 'augury'),
            'options'    => array(

                    ''                                                                              => esc_html__('Default', 'augury'),

                    'product-thumb-iconsgroup-position-horizontal horizontal-position-top'          => esc_html__('Horizontal Top', 'augury'),
                    'product-thumb-iconsgroup-position-horizontal horizontal-position-top-left'     => esc_html__('Horizontal Top Left', 'augury'),
                    'product-thumb-iconsgroup-position-horizontal horizontal-position-top-right'    => esc_html__('Horizontal Top Right', 'augury'),
                    'product-thumb-iconsgroup-position-horizontal horizontal-position-middle'       => esc_html__('Horizontal Middle', 'augury'),
                    'product-thumb-iconsgroup-position-horizontal horizontal-position-bottom'       => esc_html__('Horizontal Bottom', 'augury'),
                    'product-thumb-iconsgroup-position-horizontal horizontal-position-bottom-left'  => esc_html__('Horizontal Bottom Left', 'augury'),
                    'product-thumb-iconsgroup-position-horizontal horizontal-position-bottom-right' => esc_html__('Horizontal Bottom Right', 'augury'),

                    'product-thumb-iconsgroup-position-vertical vertical-position-top-left'         => esc_html__('Vertical Top Left', 'augury'),
                    'product-thumb-iconsgroup-position-vertical vertical-position-top-right'        => esc_html__('Vertical Top Right', 'augury'),
                    'product-thumb-iconsgroup-position-vertical vertical-position-middle-left'      => esc_html__('Vertical Middle Left', 'augury'),
                    'product-thumb-iconsgroup-position-vertical vertical-position-middle-right'     => esc_html__('Vertical Middle Right', 'augury'),
                    'product-thumb-iconsgroup-position-vertical vertical-position-bottom-left'      => esc_html__('Vertical Bottom Left', 'augury'),
                    'product-thumb-iconsgroup-position-vertical vertical-position-bottom-right'     => esc_html__('Vertical Bottom Right', 'augury')

                  ),
            'default'    => ''
          ),

          array(
            'id'         => 'product-thumb-buttonelement-button',
            'type'       => 'select',
            'title'      => esc_html__('Button Element - Button', 'augury'),
            'options'    => array(
                      ''          => esc_html__('None', 'augury'),
                      'cart'      => esc_html__('Cart', 'augury'),
                      'wishlist'  => esc_html__('Wishlist', 'augury'),
                      'compare'   => esc_html__('Compare', 'augury'),
                      'quickview' => esc_html__('Quick View', 'augury')
                    )
          ),	

          array(
            'id'         => 'product-thumb-buttonelement-secondary-button',
            'type'       => 'select',
            'title'      => esc_html__('Button Element - Secondary Button', 'augury'),
            'options'    => array(
                      ''          => esc_html__('None', 'augury'),
                      'cart'      => esc_html__('Cart', 'augury'),
                      'wishlist'  => esc_html__('Wishlist', 'augury'),
                      'compare'   => esc_html__('Compare', 'augury'),
                      'quickview' => esc_html__('Quick View', 'augury')
                    )
          ),

          array(
            'id'         => 'product-thumb-buttonelement-style',
            'type'       => 'select',
            'title'      => esc_html__('Button Element - Style', 'augury'),
            'options'    => array(
                      'product-thumb-buttonelement-style-simple'  => esc_html__('Simple', 'augury'),
                      'product-thumb-buttonelement-style-bgfill-square'  => esc_html__('Background Fill Square', 'augury'),
                      'product-thumb-buttonelement-style-bgfill-rounded-square' => esc_html__('Background Fill Rounded Square', 'augury'),
                      'product-thumb-buttonelement-style-bgfill-rounded'  => esc_html__('Background Fill Rounded', 'augury'),
                      'product-thumb-buttonelement-style-brdrfill-square'  => esc_html__('Border Fill Square', 'augury'),
                      'product-thumb-buttonelement-style-brdrfill-rounded-square' => esc_html__('Border Fill Rounded Square', 'augury'),
                      'product-thumb-buttonelement-style-brdrfill-rounded'  => esc_html__('Border Fill Rounded', 'augury'),
                      'product-thumb-buttonelement-style-skinbgfill-square'  => esc_html__('Skin Background Fill Square', 'augury'),
                      'product-thumb-buttonelement-style-skinbgfill-rounded-square' => esc_html__('Skin Background Fill Rounded Square', 'augury'),
                      'product-thumb-buttonelement-style-skinbgfill-rounded'  => esc_html__('Skin Background Fill Rounded', 'augury'),
                      'product-thumb-buttonelement-style-skinbrdrfill-square'  => esc_html__('Skin Border Fill Square', 'augury'),
                      'product-thumb-buttonelement-style-skinbrdrfill-rounded-square' => esc_html__('Skin Border Fill Rounded Square', 'augury'),
                      'product-thumb-buttonelement-style-skinbrdrfill-rounded'  => esc_html__('Skin Border Fill Rounded', 'augury')																
                    ),
            'default'    => 'product-thumb-buttonelement-style-simple'
          ),

          array(
            'id'         => 'product-thumb-buttonelement-stretch',
            'type'       => 'select',
            'title'      => esc_html__('Button Element - Stretch', 'augury'),
            'options'    => array(
                      ''                                    => esc_html__('False', 'augury'),
                      'product-thumb-buttonelement-stretch' => esc_html__('True', 'augury')
                    )
          ),

          array(
            'id'             => 'product-thumb-element-group',
            'type'           => 'sorter',
            'title'          => esc_html__('Element Group Content', 'augury'),
            'default'        => array(
              'enabled'      => array(
                'title' => esc_html__('Title', 'augury'),
                'price' => esc_html__('Price', 'augury')
              ),
              'disabled'     => array(
                'cart'           => esc_html__('Cart', 'augury'),
                'wishlist'       => esc_html__('Wishlist', 'augury'),
                'compare'        => esc_html__('Compare', 'augury'),
                'quickview'      => esc_html__('Quick View', 'augury'),
                'category'       => esc_html__('Category', 'augury'),
                'button_element' => esc_html__('Button Element', 'augury'),
                'icons_group'    => esc_html__('Icons Group', 'augury'),
                'excerpt'        => esc_html__('Excerpt', 'augury'),
                'rating'         => esc_html__('Rating', 'augury'),
                'separator'      => esc_html__('Separator', 'augury'),
                'swatches'       => esc_html__('Swatches', 'augury')
              ),
            ),
            'enabled_title'  => esc_html__('Active Elements', 'augury'),
            'disabled_title' => esc_html__('Deatcive Elements', 'augury'),
          ),


        )
      ),
      # Thumb Options

      # Content Options
      array (
        'name'                 => 'content_options_section',
        'title'                => esc_html__('Content Options', 'augury'),
        'icon'                 => 'fa fa-angle-double-right',
        'fields'               => array (

          array(
            'id'         => 'product-content-enable',
            'type'       => 'switcher',
            'title'      => esc_html__('Enable Content Section', 'augury'),
            'desc'	 => esc_html__('YES! to enable content section.', 'augury')
          ),

          array(
            'id'             => 'product-content-content',
            'type'           => 'sorter',
            'title'          => esc_html__('Content', 'augury'),
            'default'        => array(
              'enabled'      => array(
                'title'          => esc_html__('Title', 'augury'),
                'category'       => esc_html__('Category', 'augury'),
                'price'          => esc_html__('Price', 'augury'),
                'button_element' => esc_html__('Button Element', 'augury'),
                'icons_group'    => esc_html__('Icons Group', 'augury'),
              ),
              'disabled'     => array(
                'excerpt'       => esc_html__('Excerpt', 'augury'),
                'rating'        => esc_html__('Rating', 'augury'),
                'countdown'     => esc_html__('Count Down', 'augury'),
                'separator'     => esc_html__('Separator', 'augury'),
                'element_group' => esc_html__('Element Group', 'augury'),
                'swatches'      => esc_html__('Swatches', 'augury'),
              ),
            ),
            'enabled_title'  => esc_html__('Active Elements', 'augury'),
            'disabled_title' => esc_html__('Deatcive Elements', 'augury'),
          ),

          array(
            'id'         => 'product-content-alignment',
            'type'       => 'select',
            'title'      => esc_html__('Alignment', 'augury'),
            'options'    => array(
                      'product-content-alignment-left'   => esc_html__('Left', 'augury'),
                      'product-content-alignment-right'  => esc_html__('Right', 'augury'),
                      'product-content-alignment-center' => esc_html__('Center', 'augury')
                    ),
            'default'    => 'product-content-alignment-left'
          ),

          array(
            'id'         => 'product-content-iconsgroup-icons',
            'type'       => 'select',
            'title'      => esc_html__('Icons Group - Icons', 'augury'),
            'options'    => array(
                      'cart'      => esc_html__('Cart', 'augury'),
                      'wishlist'  => esc_html__('Wishlist', 'augury'),
                      'compare'   => esc_html__('Compare', 'augury'),
                      'quickview' => esc_html__('Quick View', 'augury')
                    ),
            'class'         => 'chosen',
            'attributes'    => array(
              'multiple'    => 'multiple',
            ),							
          ),

          array(
            'id'         => 'product-content-iconsgroup-style',
            'type'       => 'select',
            'title'      => esc_html__('Icons Group - Style', 'augury'),
            'options'    => array(
                      'product-content-iconsgroup-style-simple'  => esc_html__('Simple', 'augury'),
                      'product-content-iconsgroup-style-bgfill-square'  => esc_html__('Background Fill Square', 'augury'),
                      'product-content-iconsgroup-style-bgfill-rounded-square' => esc_html__('Background Fill Rounded Square', 'augury'),
                      'product-content-iconsgroup-style-bgfill-rounded'  => esc_html__('Background Fill Rounded', 'augury'),
                      'product-content-iconsgroup-style-brdrfill-square'  => esc_html__('Border Fill Square', 'augury'),
                      'product-content-iconsgroup-style-brdrfill-rounded-square' => esc_html__('Border Fill Rounded Square', 'augury'),
                      'product-content-iconsgroup-style-brdrfill-rounded'  => esc_html__('Border Fill Rounded', 'augury'),
                      'product-content-iconsgroup-style-skinbgfill-square'  => esc_html__('Skin Background Fill Square', 'augury'),
                      'product-content-iconsgroup-style-skinbgfill-rounded-square' => esc_html__('Skin Background Fill Rounded Square', 'augury'),
                      'product-content-iconsgroup-style-skinbgfill-rounded'  => esc_html__('Skin Background Fill Rounded', 'augury'),
                      'product-content-iconsgroup-style-skinbrdrfill-square'  => esc_html__('Skin Border Fill Square', 'augury'),
                      'product-content-iconsgroup-style-skinbrdrfill-rounded-square' => esc_html__('Skin Border Fill Rounded Square', 'augury'),
                      'product-content-iconsgroup-style-skinbrdrfill-rounded'  => esc_html__('Skin Border Fill Rounded', 'augury')																													
                    ),
            'default'    => 'product-content-iconsgroup-style-simple'
          ),

          array(
            'id'         => 'product-content-buttonelement-button',
            'type'       => 'select',
            'title'      => esc_html__('Button Element - Button', 'augury'),
            'options'    => array(
                      ''          => esc_html__('None', 'augury'),
                      'cart'      => esc_html__('Cart', 'augury'),
                      'wishlist'  => esc_html__('Wishlist', 'augury'),
                      'compare'   => esc_html__('Compare', 'augury'),
                      'quickview' => esc_html__('Quick View', 'augury')
                    )
          ),	

          array(
            'id'         => 'product-content-buttonelement-secondary-button',
            'type'       => 'select',
            'title'      => esc_html__('Button Element - Secondary Button', 'augury'),
            'options'    => array(
                      ''          => esc_html__('None', 'augury'),
                      'cart'      => esc_html__('Cart', 'augury'),
                      'wishlist'  => esc_html__('Wishlist', 'augury'),
                      'compare'   => esc_html__('Compare', 'augury'),
                      'quickview' => esc_html__('Quick View', 'augury')
                    )
          ),

          array(
            'id'         => 'product-content-buttonelement-style',
            'type'       => 'select',
            'title'      => esc_html__('Button Element - Style', 'augury'),
            'options'    => array(
                      'product-content-buttonelement-style-simple'  => esc_html__('Simple', 'augury'),
                      'product-content-buttonelement-style-bgfill-square'  => esc_html__('Background Fill Square', 'augury'),
                      'product-content-buttonelement-style-bgfill-rounded-square' => esc_html__('Background Fill Rounded Square', 'augury'),
                      'product-content-buttonelement-style-bgfill-rounded'  => esc_html__('Background Fill Rounded', 'augury'),
                      'product-content-buttonelement-style-brdrfill-square'  => esc_html__('Border Fill Square', 'augury'),
                      'product-content-buttonelement-style-brdrfill-rounded-square' => esc_html__('Border Fill Rounded Square', 'augury'),
                      'product-content-buttonelement-style-brdrfill-rounded'  => esc_html__('Border Fill Rounded', 'augury'),
                      'product-content-buttonelement-style-skinbgfill-square'  => esc_html__('Skin Background Fill Square', 'augury'),
                      'product-content-buttonelement-style-skinbgfill-rounded-square' => esc_html__('Skin Background Fill Rounded Square', 'augury'),
                      'product-content-buttonelement-style-skinbgfill-rounded'  => esc_html__('Skin Background Fill Rounded', 'augury'),
                      'product-content-buttonelement-style-skinbrdrfill-square'  => esc_html__('Skin Border Fill Square', 'augury'),
                      'product-content-buttonelement-style-skinbrdrfill-rounded-square' => esc_html__('Skin Border Fill Rounded Square', 'augury'),
                      'product-content-buttonelement-style-skinbrdrfill-rounded'  => esc_html__('Skin Border Fill Rounded', 'augury')																													
                    ),
            'default'    => 'product-content-buttonelement-style-simple'
          ),

          array(
            'id'         => 'product-content-buttonelement-stretch',
            'type'       => 'select',
            'title'      => esc_html__('Button Element - Stretch', 'augury'),
            'options'    => array(
                      ''                                    => esc_html__('False', 'augury'),
                      'product-content-buttonelement-stretch' => esc_html__('True', 'augury')
                    )
          ),

          array(
            'id'             => 'product-content-element-group',
            'type'           => 'sorter',
            'title'          => esc_html__('Element Group Content', 'augury'),
            'default'        => array(
              'enabled'      => array(
                'title'          => esc_html__('Title', 'augury'),
                'price'          => esc_html__('Price', 'augury')
              ),
              'disabled'     => array(
                'cart'           => esc_html__('Cart', 'augury'),
                'wishlist'       => esc_html__('Wishlist', 'augury'),
                'compare'        => esc_html__('Compare', 'augury'),
                'quickview'      => esc_html__('Quick View', 'augury'),
                'category'       => esc_html__('Category', 'augury'),
                'button_element' => esc_html__('Button Element', 'augury'),
                'icons_group'    => esc_html__('Icons Group', 'augury'),
                'excerpt'        => esc_html__('Excerpt', 'augury'),
                'rating'         => esc_html__('Rating', 'augury'),
                'separator'      => esc_html__('Separator', 'augury'),
                'swatches'       => esc_html__('Swatches', 'augury')
              ),
            ),
            'enabled_title'  => esc_html__('Active Elements', 'augury'),
            'disabled_title' => esc_html__('Deactive Elements', 'augury')
          ),


        )
      ),
      # Content Options

    )
  );

  return $options;

}