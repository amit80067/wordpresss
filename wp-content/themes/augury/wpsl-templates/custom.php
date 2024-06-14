<?php 
global $wpsl_settings, $wpsl;

$output         = $this->get_custom_css(); 
$autoload_class = ( !$wpsl_settings['autoload'] ) ? 'class="wpsl-not-loaded"' : '';


$output .= "\t" . '<div id="wpsl-gmap" class="wpsl-gmap-canvas dt-sc-storelocator-map"></div>' . "\r\n";

$output .= '<div id="wpsl-wrap">' . "\r\n";
$output .= "\t" . '<div class="wpsl-search wpsl-clearfix ' . $this->get_css_classes() . '">' . "\r\n";
$output .= "\t\t" . '<div id="wpsl-search-wrap">' . "\r\n";
$output .= "\t\t\t" . '<form autocomplete="off">' . "\r\n";

$output .= "\t\t\t\t" . '<div class="wpsl-input">' . "\r\n";
$output .= "\t\t\t\t\t" . '<input id="wpsl-search-input" type="text" value="' . apply_filters( 'wpsl_search_input', '' ) . '" name="wpsl-search-input" aria-required="true" placeholder="' . esc_attr( $wpsl->i18n->get_translation( 'search_label', esc_html__( 'Location', 'augury' ) ) ) . '" />' . "\r\n";
$output .= "\t\t\t\t\t" . '<div class="wpsl-search-btn-wrap"><input id="wpsl-search-btn" type="submit" value="&#xf002;" class="dt-sc-storesearch-btn"></div>' . "\r\n";

$output .= "\t\t\t\t" . '</div>' . "\r\n";

$output .= "\t\t\t" . '<a href="#" class="dt-sc-toggle-advanced-options">'.esc_html__('Advanced Options', 'augury').' <span class="fas fa-angle-down"></span> </a>' . "\r\n";

$output .= "\t\t\t" . '<div class="dt-sc-advanced-options">' . "\r\n";

	if ( $wpsl_settings['radius_dropdown'] || $wpsl_settings['results_dropdown']  ) {
			
		$output .= "\t\t\t" . '<div class="wpsl-select-wrap">' . "\r\n";
	
			if ( $wpsl_settings['radius_dropdown'] ) {
				$output .= "\t\t\t\t" . '<div id="wpsl-radius">' . "\r\n";
				$output .= "\t\t\t\t\t" . '<label for="wpsl-radius-dropdown">' . esc_html( $wpsl->i18n->get_translation( 'radius_label', esc_html__( 'Search radius', 'augury' ) ) ) . '</label>' . "\r\n";
				$output .= "\t\t\t\t\t" . '<select id="wpsl-radius-dropdown" class="wpsl-dropdown" name="wpsl-radius">' . "\r\n";
				$output .= "\t\t\t\t\t\t" . $this->get_dropdown_list( 'search_radius' ) . "\r\n";
				$output .= "\t\t\t\t\t" . '</select>' . "\r\n";
				$output .= "\t\t\t\t" . '</div>' . "\r\n";
			}
		
			if ( $wpsl_settings['results_dropdown'] ) {
				$output .= "\t\t\t\t" . '<div id="wpsl-results">' . "\r\n";
				$output .= "\t\t\t\t\t" . '<label for="wpsl-results-dropdown">' . esc_html( $wpsl->i18n->get_translation( 'results_label', esc_html__( 'Results', 'augury' ) ) ) . '</label>' . "\r\n";
				$output .= "\t\t\t\t\t" . '<select id="wpsl-results-dropdown" class="wpsl-dropdown" name="wpsl-results">' . "\r\n";
				$output .= "\t\t\t\t\t\t" . $this->get_dropdown_list( 'max_results' ) . "\r\n";
				$output .= "\t\t\t\t\t" . '</select>' . "\r\n";
				$output .= "\t\t\t\t" . '</div>' . "\r\n";
			} 
	
		$output .= "\t\t\t" . '</div>' . "\r\n";
			
	}
	
	if ( $wpsl_settings['category_filter'] ) {
		$output .= $this->create_category_filter();
	}

$output .= "\t\t\t" . '</div>' . "\r\n";

$output .= "\t\t" . '</form>' . "\r\n";
$output .= "\t\t" . '</div>' . "\r\n";
$output .= "\t" . '</div>' . "\r\n";
    
$output .= "\t" . '<div id="wpsl-result-list">' . "\r\n";
$output .= "\t\t" . '<div id="wpsl-stores" '. $autoload_class .'>' . "\r\n";
$output .= "\t\t\t" . '<ul></ul>' . "\r\n";
$output .= "\t\t" . '</div>' . "\r\n";
$output .= "\t\t" . '<div id="wpsl-direction-details">' . "\r\n";
$output .= "\t\t\t" . '<ul></ul>' . "\r\n";
$output .= "\t\t" . '</div>' . "\r\n";
$output .= "\t" . '</div>' . "\r\n";

if ( $wpsl_settings['show_credits'] ) { 
    $output .= "\t" . '<div class="wpsl-provided-by">'. sprintf( esc_html__( "Search provided by %1\$sWP Store Locator%2\$s", "augury" ), "<a target='_blank' href='https://wpstorelocator.co'>", "</a>" ) .'</div>' . "\r\n";
}

$output .= '</div>' . "\r\n";

return $output;