<?php
if( ! class_exists( 'Augury_Walker_Nav_Menu' ) ) {

	class Augury_Walker_Nav_Menu extends Walker_Nav_Menu {

		private $currentParent;

		public function start_lvl( &$output, $depth = 0, $args = null ) {

			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}
			$indent = str_repeat( $t, $depth );
            $parent = $this->currentParent;

			// Default class.
			$classes = array( 'sub-menu', 'is-hidden', $parent->child_menu_animation );

			$class_names = join( ' ', apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			$data_animation = ( !empty($parent->child_menu_animation) ) ? ' data-animation="'.$parent->child_menu_animation.'"' : '';

			$output .= "{$n}{$indent}<ul$class_names{$data_animation}>{$n}";
			$output .= '<li class="close-nav"></li>';
			$output .= '<li class="go-back"><a href="javascript:void(0);"></a></li>';
			$output .= '<li class="see-all"></li>';			
		}		

		public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {

			$this->currentParent = $item;

			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}

			$indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

			$classes   = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;

			$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
			
			$li_attrs          = array();
			$id                = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
			$li_attrs['id']    = $id ? esc_attr( $id ) : '';
			$li_attrs['class'] = $class_names ? esc_attr( $class_names ) : '';

			$li_attrs = apply_filters( 'nav_menu_li_attributes', $li_attrs, $item, $args, $depth );

			$li_attributes = '';
			foreach ( $li_attrs as $attr => $value ) {
				if ( is_scalar( $value ) && '' !== $value && false !== $value ) {
					$value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$li_attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			$output .= $indent . '<li'. $li_attributes . '>';

			$atts           = array();
			$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
			$atts['target'] = ! empty( $item->target ) ? $item->target : '';
			if ( '_blank' === $item->target && empty( $item->xfn ) ) {
				$atts['rel'] = 'noopener noreferrer';
			} else {
				$atts['rel'] = $item->xfn;
			}
			$atts['href']         = ! empty( $item->url ) ? $item->url : '';
			$atts['aria-current'] = $item->current ? 'page' : '';

            // add class for icon positions
			if( !empty( $item->icon ) || !empty( $item->image ) ) {
            	$atts['class']   = ! empty( $item->icon_position ) ? 'item-has-icon icon-position-'.$item->icon_position : '';
            }

			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( is_scalar( $value ) && '' !== $value && false !== $value ) {
					$value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			/** This filter is documented in wp-includes/post-template.php */
			$title = apply_filters( 'the_title', $item->title, $item->ID );
			$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

			$item_output  = $args->before;
			$item_output .= '<a' . $attributes . '>';

				if( !empty( $item->icon ) || !empty( $item->image ) ) {
					if( !empty( $item->icon ) ) {
						$item_output .= '<i class="menu-item-icon '.esc_attr($item->icon).'"></i>';
					}

					if( !empty( $item->image ) ) {
						$item_output .= '<i class="menu-item-image">';
							$item_output .= '<img src="'.esc_url( $item->image ).'" alt="'.esc_attr( 'Image', 'augury' ).'"/>';
						$item_output .= '</i>';
					}					
				}

			$item_output .= $args->link_before . $title . $args->link_after;
			$item_output .= '</a>';
			$item_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}
}

if( !class_exists( 'Augury_Default_Hedaer_Walker_Nav_Menu' ) ) {


	class Augury_Default_Hedaer_Walker_Nav_Menu extends Walker_Nav_Menu {

		private $currentParent;

		public function start_lvl( &$output, $depth = 0, $args = null ) {
			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}
			$indent = str_repeat( $t, $depth );
            $parent = $this->currentParent;
			
			$classes = array( 'sub-menu', 'is-hidden', $parent->child_menu_animation );
			$class_names = join( ' ', apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			$data_animation = ( !empty($parent->child_menu_animation) ) ? ' data-animation="'.$parent->child_menu_animation.'"' : '';

			$output .= "{$n}{$indent}<ul$class_names{$data_animation}>{$n}";
			$output .= '<li class="close-nav"></li>';
			$output .= '<li class="go-back"><a href="javascript:void(0);"></a></li>';
			$output .= '<li class="see-all"></li>';
		}

		public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {

			$this->currentParent = $item;

			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}

			$indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

			$classes   = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;

			$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
			
			$li_attrs          = array();
			$id                = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
			$li_attrs['id']    = $id ? esc_attr( $id ) : '';
			$li_attrs['class'] = $class_names ? esc_attr( $class_names ) : '';

			$li_attrs = apply_filters( 'nav_menu_li_attributes', $li_attrs, $item, $args, $depth );

			$li_attributes = '';
			foreach ( $li_attrs as $attr => $value ) {
				if ( is_scalar( $value ) && '' !== $value && false !== $value ) {
					$value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$li_attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			$output .= $indent . '<li'. $li_attributes . '>';

			$atts           = array();
			$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
			$atts['target'] = ! empty( $item->target ) ? $item->target : '';
			if ( '_blank' === $item->target && empty( $item->xfn ) ) {
				$atts['rel'] = 'noopener noreferrer';
			} else {
				$atts['rel'] = $item->xfn;
			}
			$atts['href']         = ! empty( $item->url ) ? $item->url : '';
			$atts['aria-current'] = $item->current ? 'page' : '';

            // add class for icon positions
			if( !empty( $item->icon ) || !empty( $item->image ) ) {
            	$atts['class']   = ! empty( $item->icon_position ) ? 'item-has-icon icon-position-'.$item->icon_position : '';
            }

			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( is_scalar( $value ) && '' !== $value && false !== $value ) {
					$value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			/** This filter is documented in wp-includes/post-template.php */
			$title = apply_filters( 'the_title', $item->title, $item->ID );
			$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

			$item_output  = $args->before;
			$item_output .= '<a' . $attributes . '>';

				if( !empty( $item->icon ) || !empty( $item->image ) ) {
					if( !empty( $item->icon ) ) {
						$item_output .= '<i class="menu-item-icon '.esc_attr($item->icon).'"></i>';
					}

					if( !empty( $item->image ) ) {
						$item_output .= '<i class="menu-item-image">';
							$item_output .= '<img src="'.esc_url( $item->image ).'" alt="'.esc_attr( 'Image', 'augury' ).'"/>';
						$item_output .= '</i>';
					}					
				}

			$item_output .= $args->link_before . $title . $args->link_after;
			$item_output .= '</a>';
			$item_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}
}