<?php
/**
 * Check activated plugins
 * @return boolean
 */
if ( ! function_exists( 'dt_booking_check_plugin_active' ) ) {

	function dt_booking_check_plugin_active($plugin) {
		return in_array( $plugin, (array) get_option( 'active_plugins', array() ) ) || dt_booking_check_plugin_active_for_network( $plugin );
	}
}

if ( ! function_exists( 'dt_booking_check_plugin_active_for_network' ) ) {

	function dt_booking_check_plugin_active_for_network( $plugin ) {
		if ( !is_multisite() )
			return false;

		$plugins = get_site_option( 'active_sitewide_plugins');
		if ( isset($plugins[$plugin]) )
			return true;

		return false;
	}
}

/**
 * Returns the value if file exists.
 * @return boolean
 */
function dt_booking_theme_has_codestar() {

	if ( file_exists( get_stylesheet_directory().'/cs-framework/cs-framework.php') ) {
		return true;
	}

	return false;
}

/**
 * Returns the value of excerpt content.
 * @return html content
 */
function dt_booking_post_excerpt($limit = NULL) {
	$limit = !empty($limit) ? $limit : 10;

	$excerpt = explode(' ', get_the_excerpt(), $limit);
	$excerpt = array_filter($excerpt);

	if (!empty($excerpt)) {
		if (count($excerpt) >= $limit) {
			array_pop($excerpt);
			$excerpt = implode(" ", $excerpt).'...';
		} else {
			$excerpt = implode(" ", $excerpt);
		}
		$excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);
		$excerpt = str_replace('&nbsp;', '', $excerpt);
		if(!empty ($excerpt))
			return "<p>{$excerpt}</p>";
	}
}

/**
 * Returns the value from codestar array.
 * @return any value
 */
if ( ! function_exists( 'dt_booking_cs_get_option' ) ) {

	function dt_booking_cs_get_option( $key, $value = '' ) {

		$v = cs_get_option( $key );

		if ( !empty( $v ) ) {
			return $v;
		} else {
			return $value;
		}
	}
}

/**
 * Returns string for time duration.
 */
if ( ! function_exists( 'dt_booking_duration_to_string' ) ) {

	function dt_booking_duration_to_string( $duration ) {

		$hours   = (int)( $duration / 3600 );
		$minutes = (int)( ( $duration % 3600 ) / 60 );
		$result  = '';
		if ( $hours > 0 ) {
			$result = sprintf( __( '%d hr', 'dt-booking-manager' ), $hours );
			if ( $minutes > 0 ) {
				$result .= ' ';
			}
		}

		if ( $minutes > 0 ) {
			$result .= sprintf( __( '%d min', 'dt-booking-manager' ), $minutes );
		}
		return $result;
	}
}

/**
 * Returns time for string.
 */
if ( ! function_exists( 'dt_booking_string_to_time' ) ) {

	function dt_booking_string_to_time( $str ) {
		return strtotime( sprintf( '1985-03-17 %s', $str ) );
	}
}

/**
 * Returns posts array with price.
 */
if ( ! function_exists( 'dt_booking_get_posts_array' ) ) {

	function dt_booking_get_posts_array( $post_type = 'service' ) {

		$result_arr = array();
		$symbol = dt_booking_get_currency_symbol();
		$args = array( 'post_type' => 'dt_'.$post_type, 'order' => 'ASC', 'post_status' => 'publish', 'posts_per_page' => -1 );

		$the_query = new WP_Query( $args );
		if( $the_query->have_posts() ) {

			while ( $the_query->have_posts() ){
				$the_query->the_post();
				$id = get_the_ID();
				$title = get_the_title();

				$post_meta = get_post_meta($id ,'_custom_settings',TRUE);
				$post_meta = is_array($post_meta) ? $post_meta : array();

				$price = !empty( $post_meta[$post_type.'-price'] ) ? $post_meta[$post_type.'-price'] : '0';

				$result_arr[$id] = $title.' ( '.$symbol.' '.dt_booking_number_format($price).' )';
				
			}
			wp_reset_postdata();
		}

		return $result_arr;
	}
}

/**
 * Get Base Currency Code.
 * @return string
 */
function dt_booking_get_currency() {
	return apply_filters( 'dt_booking_currency', cs_get_option( 'book-currency' ) );
}

/**
 * Get full list of currency codes.
 * @return array
 */
function dt_booking_get_currencies() {
	return array_unique(
		apply_filters( 'dt_booking_currencies',
			array(
				'AED' => __( 'United Arab Emirates dirham', 'dt-booking-manager' ),
				'AFN' => __( 'Afghan afghani', 'dt-booking-manager' ),
				'ALL' => __( 'Albanian lek', 'dt-booking-manager' ),
				'AMD' => __( 'Armenian dram', 'dt-booking-manager' ),
				'ANG' => __( 'Netherlands Antillean guilder', 'dt-booking-manager' ),
				'AOA' => __( 'Angolan kwanza', 'dt-booking-manager' ),
				'ARS' => __( 'Argentine peso', 'dt-booking-manager' ),
				'AUD' => __( 'Australian dollar', 'dt-booking-manager' ),
				'AWG' => __( 'Aruban florin', 'dt-booking-manager' ),
				'AZN' => __( 'Azerbaijani manat', 'dt-booking-manager' ),
				'BAM' => __( 'Bosnia and Herzegovina convertible mark', 'dt-booking-manager' ),
				'BBD' => __( 'Barbadian dollar', 'dt-booking-manager' ),
				'BDT' => __( 'Bangladeshi taka', 'dt-booking-manager' ),
				'BGN' => __( 'Bulgarian lev', 'dt-booking-manager' ),
				'BHD' => __( 'Bahraini dinar', 'dt-booking-manager' ),
				'BIF' => __( 'Burundian franc', 'dt-booking-manager' ),
				'BMD' => __( 'Bermudian dollar', 'dt-booking-manager' ),
				'BND' => __( 'Brunei dollar', 'dt-booking-manager' ),
				'BOB' => __( 'Bolivian boliviano', 'dt-booking-manager' ),
				'BRL' => __( 'Brazilian real', 'dt-booking-manager' ),
				'BSD' => __( 'Bahamian dollar', 'dt-booking-manager' ),
				'BTC' => __( 'Bitcoin', 'dt-booking-manager' ),
				'BTN' => __( 'Bhutanese ngultrum', 'dt-booking-manager' ),
				'BWP' => __( 'Botswana pula', 'dt-booking-manager' ),
				'BYR' => __( 'Belarusian ruble', 'dt-booking-manager' ),
				'BZD' => __( 'Belize dollar', 'dt-booking-manager' ),
				'CAD' => __( 'Canadian dollar', 'dt-booking-manager' ),
				'CDF' => __( 'Congolese franc', 'dt-booking-manager' ),
				'CHF' => __( 'Swiss franc', 'dt-booking-manager' ),
				'CLP' => __( 'Chilean peso', 'dt-booking-manager' ),
				'CNY' => __( 'Chinese yuan', 'dt-booking-manager' ),
				'COP' => __( 'Colombian peso', 'dt-booking-manager' ),
				'CRC' => __( 'Costa Rican col&oacute;n', 'dt-booking-manager' ),
				'CUC' => __( 'Cuban convertible peso', 'dt-booking-manager' ),
				'CUP' => __( 'Cuban peso', 'dt-booking-manager' ),
				'CVE' => __( 'Cape Verdean escudo', 'dt-booking-manager' ),
				'CZK' => __( 'Czech koruna', 'dt-booking-manager' ),
				'DJF' => __( 'Djiboutian franc', 'dt-booking-manager' ),
				'DKK' => __( 'Danish krone', 'dt-booking-manager' ),
				'DOP' => __( 'Dominican peso', 'dt-booking-manager' ),
				'DZD' => __( 'Algerian dinar', 'dt-booking-manager' ),
				'EGP' => __( 'Egyptian pound', 'dt-booking-manager' ),
				'ERN' => __( 'Eritrean nakfa', 'dt-booking-manager' ),
				'ETB' => __( 'Ethiopian birr', 'dt-booking-manager' ),
				'EUR' => __( 'Euro', 'dt-booking-manager' ),
				'FJD' => __( 'Fijian dollar', 'dt-booking-manager' ),
				'FKP' => __( 'Falkland Islands pound', 'dt-booking-manager' ),
				'GBP' => __( 'Pound sterling', 'dt-booking-manager' ),
				'GEL' => __( 'Georgian lari', 'dt-booking-manager' ),
				'GGP' => __( 'Guernsey pound', 'dt-booking-manager' ),
				'GHS' => __( 'Ghana cedi', 'dt-booking-manager' ),
				'GIP' => __( 'Gibraltar pound', 'dt-booking-manager' ),
				'GMD' => __( 'Gambian dalasi', 'dt-booking-manager' ),
				'GNF' => __( 'Guinean franc', 'dt-booking-manager' ),
				'GTQ' => __( 'Guatemalan quetzal', 'dt-booking-manager' ),
				'GYD' => __( 'Guyanese dollar', 'dt-booking-manager' ),
				'HKD' => __( 'Hong Kong dollar', 'dt-booking-manager' ),
				'HNL' => __( 'Honduran lempira', 'dt-booking-manager' ),
				'HRK' => __( 'Croatian kuna', 'dt-booking-manager' ),
				'HTG' => __( 'Haitian gourde', 'dt-booking-manager' ),
				'HUF' => __( 'Hungarian forint', 'dt-booking-manager' ),
				'IDR' => __( 'Indonesian rupiah', 'dt-booking-manager' ),
				'ILS' => __( 'Israeli new shekel', 'dt-booking-manager' ),
				'IMP' => __( 'Manx pound', 'dt-booking-manager' ),
				'INR' => __( 'Indian rupee', 'dt-booking-manager' ),
				'IQD' => __( 'Iraqi dinar', 'dt-booking-manager' ),
				'IRR' => __( 'Iranian rial', 'dt-booking-manager' ),
				'IRT' => __( 'Iranian toman', 'dt-booking-manager' ),
				'ISK' => __( 'Icelandic kr&oacute;na', 'dt-booking-manager' ),
				'JEP' => __( 'Jersey pound', 'dt-booking-manager' ),
				'JMD' => __( 'Jamaican dollar', 'dt-booking-manager' ),
				'JOD' => __( 'Jordanian dinar', 'dt-booking-manager' ),
				'JPY' => __( 'Japanese yen', 'dt-booking-manager' ),
				'KES' => __( 'Kenyan shilling', 'dt-booking-manager' ),
				'KGS' => __( 'Kyrgyzstani som', 'dt-booking-manager' ),
				'KHR' => __( 'Cambodian riel', 'dt-booking-manager' ),
				'KMF' => __( 'Comorian franc', 'dt-booking-manager' ),
				'KPW' => __( 'North Korean won', 'dt-booking-manager' ),
				'KRW' => __( 'South Korean won', 'dt-booking-manager' ),
				'KWD' => __( 'Kuwaiti dinar', 'dt-booking-manager' ),
				'KYD' => __( 'Cayman Islands dollar', 'dt-booking-manager' ),
				'KZT' => __( 'Kazakhstani tenge', 'dt-booking-manager' ),
				'LAK' => __( 'Lao kip', 'dt-booking-manager' ),
				'LBP' => __( 'Lebanese pound', 'dt-booking-manager' ),
				'LKR' => __( 'Sri Lankan rupee', 'dt-booking-manager' ),
				'LRD' => __( 'Liberian dollar', 'dt-booking-manager' ),
				'LSL' => __( 'Lesotho loti', 'dt-booking-manager' ),
				'LYD' => __( 'Libyan dinar', 'dt-booking-manager' ),
				'MAD' => __( 'Moroccan dirham', 'dt-booking-manager' ),
				'MDL' => __( 'Moldovan leu', 'dt-booking-manager' ),
				'MGA' => __( 'Malagasy ariary', 'dt-booking-manager' ),
				'MKD' => __( 'Macedonian denar', 'dt-booking-manager' ),
				'MMK' => __( 'Burmese kyat', 'dt-booking-manager' ),
				'MNT' => __( 'Mongolian t&ouml;gr&ouml;g', 'dt-booking-manager' ),
				'MOP' => __( 'Macanese pataca', 'dt-booking-manager' ),
				'MRO' => __( 'Mauritanian ouguiya', 'dt-booking-manager' ),
				'MUR' => __( 'Mauritian rupee', 'dt-booking-manager' ),
				'MVR' => __( 'Maldivian rufiyaa', 'dt-booking-manager' ),
				'MWK' => __( 'Malawian kwacha', 'dt-booking-manager' ),
				'MXN' => __( 'Mexican peso', 'dt-booking-manager' ),
				'MYR' => __( 'Malaysian ringgit', 'dt-booking-manager' ),
				'MZN' => __( 'Mozambican metical', 'dt-booking-manager' ),
				'NAD' => __( 'Namibian dollar', 'dt-booking-manager' ),
				'NGN' => __( 'Nigerian naira', 'dt-booking-manager' ),
				'NIO' => __( 'Nicaraguan c&oacute;rdoba', 'dt-booking-manager' ),
				'NOK' => __( 'Norwegian krone', 'dt-booking-manager' ),
				'NPR' => __( 'Nepalese rupee', 'dt-booking-manager' ),
				'NZD' => __( 'New Zealand dollar', 'dt-booking-manager' ),
				'OMR' => __( 'Omani rial', 'dt-booking-manager' ),
				'PAB' => __( 'Panamanian balboa', 'dt-booking-manager' ),
				'PEN' => __( 'Peruvian nuevo sol', 'dt-booking-manager' ),
				'PGK' => __( 'Papua New Guinean kina', 'dt-booking-manager' ),
				'PHP' => __( 'Philippine peso', 'dt-booking-manager' ),
				'PKR' => __( 'Pakistani rupee', 'dt-booking-manager' ),
				'PLN' => __( 'Polish z&#x142;oty', 'dt-booking-manager' ),
				'PRB' => __( 'Transnistrian ruble', 'dt-booking-manager' ),
				'PYG' => __( 'Paraguayan guaran&iacute;', 'dt-booking-manager' ),
				'QAR' => __( 'Qatari riyal', 'dt-booking-manager' ),
				'RON' => __( 'Romanian leu', 'dt-booking-manager' ),
				'RSD' => __( 'Serbian dinar', 'dt-booking-manager' ),
				'RUB' => __( 'Russian ruble', 'dt-booking-manager' ),
				'RWF' => __( 'Rwandan franc', 'dt-booking-manager' ),
				'SAR' => __( 'Saudi riyal', 'dt-booking-manager' ),
				'SBD' => __( 'Solomon Islands dollar', 'dt-booking-manager' ),
				'SCR' => __( 'Seychellois rupee', 'dt-booking-manager' ),
				'SDG' => __( 'Sudanese pound', 'dt-booking-manager' ),
				'SEK' => __( 'Swedish krona', 'dt-booking-manager' ),
				'SGD' => __( 'Singapore dollar', 'dt-booking-manager' ),
				'SHP' => __( 'Saint Helena pound', 'dt-booking-manager' ),
				'SLL' => __( 'Sierra Leonean leone', 'dt-booking-manager' ),
				'SOS' => __( 'Somali shilling', 'dt-booking-manager' ),
				'SRD' => __( 'Surinamese dollar', 'dt-booking-manager' ),
				'SSP' => __( 'South Sudanese pound', 'dt-booking-manager' ),
				'STD' => __( 'S&atilde;o Tom&eacute; and Pr&iacute;ncipe dobra', 'dt-booking-manager' ),
				'SYP' => __( 'Syrian pound', 'dt-booking-manager' ),
				'SZL' => __( 'Swazi lilangeni', 'dt-booking-manager' ),
				'THB' => __( 'Thai baht', 'dt-booking-manager' ),
				'TJS' => __( 'Tajikistani somoni', 'dt-booking-manager' ),
				'TMT' => __( 'Turkmenistan manat', 'dt-booking-manager' ),
				'TND' => __( 'Tunisian dinar', 'dt-booking-manager' ),
				'TOP' => __( 'Tongan pa&#x2bb;anga', 'dt-booking-manager' ),
				'TRY' => __( 'Turkish lira', 'dt-booking-manager' ),
				'TTD' => __( 'Trinidad and Tobago dollar', 'dt-booking-manager' ),
				'TWD' => __( 'New Taiwan dollar', 'dt-booking-manager' ),
				'TZS' => __( 'Tanzanian shilling', 'dt-booking-manager' ),
				'UAH' => __( 'Ukrainian hryvnia', 'dt-booking-manager' ),
				'UGX' => __( 'Ugandan shilling', 'dt-booking-manager' ),
				'USD' => __( 'United States dollar', 'dt-booking-manager' ),
				'UYU' => __( 'Uruguayan peso', 'dt-booking-manager' ),
				'UZS' => __( 'Uzbekistani som', 'dt-booking-manager' ),
				'VEF' => __( 'Venezuelan bol&iacute;var', 'dt-booking-manager' ),
				'VND' => __( 'Vietnamese &#x111;&#x1ed3;ng', 'dt-booking-manager' ),
				'VUV' => __( 'Vanuatu vatu', 'dt-booking-manager' ),
				'WST' => __( 'Samoan t&#x101;l&#x101;', 'dt-booking-manager' ),
				'XAF' => __( 'Central African CFA franc', 'dt-booking-manager' ),
				'XCD' => __( 'East Caribbean dollar', 'dt-booking-manager' ),
				'XOF' => __( 'West African CFA franc', 'dt-booking-manager' ),
				'XPF' => __( 'CFP franc', 'dt-booking-manager' ),
				'YER' => __( 'Yemeni rial', 'dt-booking-manager' ),
				'ZAR' => __( 'South African rand', 'dt-booking-manager' ),
				'ZMW' => __( 'Zambian kwacha', 'dt-booking-manager' ),
			)
		)
	);
}

/**
 * Get Currency symbol.
 * @param string $currency (default: '')
 * @return string
 */
function dt_booking_get_currency_symbol( $currency = '' ) {
	if ( ! $currency ) {
		$currency = dt_booking_get_currency();
	}

	$symbols = apply_filters( 'dt_booking_currency_symbols', array(
		'AED' => '&#x62f;.&#x625;',
		'AFN' => '&#x60b;',
		'ALL' => 'L',
		'AMD' => 'AMD',
		'ANG' => '&fnof;',
		'AOA' => 'Kz',
		'ARS' => '&#36;',
		'AUD' => '&#36;',
		'AWG' => 'Afl.',
		'AZN' => 'AZN',
		'BAM' => 'KM',
		'BBD' => '&#36;',
		'BDT' => '&#2547;&nbsp;',
		'BGN' => '&#1083;&#1074;.',
		'BHD' => '.&#x62f;.&#x628;',
		'BIF' => 'Fr',
		'BMD' => '&#36;',
		'BND' => '&#36;',
		'BOB' => 'Bs.',
		'BRL' => '&#82;&#36;',
		'BSD' => '&#36;',
		'BTC' => '&#3647;',
		'BTN' => 'Nu.',
		'BWP' => 'P',
		'BYR' => 'Br',
		'BZD' => '&#36;',
		'CAD' => '&#36;',
		'CDF' => 'Fr',
		'CHF' => '&#67;&#72;&#70;',
		'CLP' => '&#36;',
		'CNY' => '&yen;',
		'COP' => '&#36;',
		'CRC' => '&#x20a1;',
		'CUC' => '&#36;',
		'CUP' => '&#36;',
		'CVE' => '&#36;',
		'CZK' => '&#75;&#269;',
		'DJF' => 'Fr',
		'DKK' => 'DKK',
		'DOP' => 'RD&#36;',
		'DZD' => '&#x62f;.&#x62c;',
		'EGP' => 'EGP',
		'ERN' => 'Nfk',
		'ETB' => 'Br',
		'EUR' => '&euro;',
		'FJD' => '&#36;',
		'FKP' => '&pound;',
		'GBP' => '&pound;',
		'GEL' => '&#x10da;',
		'GGP' => '&pound;',
		'GHS' => '&#x20b5;',
		'GIP' => '&pound;',
		'GMD' => 'D',
		'GNF' => 'Fr',
		'GTQ' => 'Q',
		'GYD' => '&#36;',
		'HKD' => '&#36;',
		'HNL' => 'L',
		'HRK' => 'Kn',
		'HTG' => 'G',
		'HUF' => '&#70;&#116;',
		'IDR' => 'Rp',
		'ILS' => '&#8362;',
		'IMP' => '&pound;',
		'INR' => '&#8377;',
		'IQD' => '&#x639;.&#x62f;',
		'IRR' => '&#xfdfc;',
		'IRT' => '&#x062A;&#x0648;&#x0645;&#x0627;&#x0646;',
		'ISK' => 'kr.',
		'JEP' => '&pound;',
		'JMD' => '&#36;',
		'JOD' => '&#x62f;.&#x627;',
		'JPY' => '&yen;',
		'KES' => 'KSh',
		'KGS' => '&#x441;&#x43e;&#x43c;',
		'KHR' => '&#x17db;',
		'KMF' => 'Fr',
		'KPW' => '&#x20a9;',
		'KRW' => '&#8361;',
		'KWD' => '&#x62f;.&#x643;',
		'KYD' => '&#36;',
		'KZT' => 'KZT',
		'LAK' => '&#8365;',
		'LBP' => '&#x644;.&#x644;',
		'LKR' => '&#xdbb;&#xdd4;',
		'LRD' => '&#36;',
		'LSL' => 'L',
		'LYD' => '&#x644;.&#x62f;',
		'MAD' => '&#x62f;.&#x645;.',
		'MDL' => 'MDL',
		'MGA' => 'Ar',
		'MKD' => '&#x434;&#x435;&#x43d;',
		'MMK' => 'Ks',
		'MNT' => '&#x20ae;',
		'MOP' => 'P',
		'MRO' => 'UM',
		'MUR' => '&#x20a8;',
		'MVR' => '.&#x783;',
		'MWK' => 'MK',
		'MXN' => '&#36;',
		'MYR' => '&#82;&#77;',
		'MZN' => 'MT',
		'NAD' => '&#36;',
		'NGN' => '&#8358;',
		'NIO' => 'C&#36;',
		'NOK' => '&#107;&#114;',
		'NPR' => '&#8360;',
		'NZD' => '&#36;',
		'OMR' => '&#x631;.&#x639;.',
		'PAB' => 'B/.',
		'PEN' => 'S/.',
		'PGK' => 'K',
		'PHP' => '&#8369;',
		'PKR' => '&#8360;',
		'PLN' => '&#122;&#322;',
		'PRB' => '&#x440;.',
		'PYG' => '&#8370;',
		'QAR' => '&#x631;.&#x642;',
		'RMB' => '&yen;',
		'RON' => 'lei',
		'RSD' => '&#x434;&#x438;&#x43d;.',
		'RUB' => '&#8381;',
		'RWF' => 'Fr',
		'SAR' => '&#x631;.&#x633;',
		'SBD' => '&#36;',
		'SCR' => '&#x20a8;',
		'SDG' => '&#x62c;.&#x633;.',
		'SEK' => '&#107;&#114;',
		'SGD' => '&#36;',
		'SHP' => '&pound;',
		'SLL' => 'Le',
		'SOS' => 'Sh',
		'SRD' => '&#36;',
		'SSP' => '&pound;',
		'STD' => 'Db',
		'SYP' => '&#x644;.&#x633;',
		'SZL' => 'L',
		'THB' => '&#3647;',
		'TJS' => '&#x405;&#x41c;',
		'TMT' => 'm',
		'TND' => '&#x62f;.&#x62a;',
		'TOP' => 'T&#36;',
		'TRY' => '&#8378;',
		'TTD' => '&#36;',
		'TWD' => '&#78;&#84;&#36;',
		'TZS' => 'Sh',
		'UAH' => '&#8372;',
		'UGX' => 'UGX',
		'USD' => '&#36;',
		'UYU' => '&#36;',
		'UZS' => 'UZS',
		'VEF' => 'Bs F',
		'VND' => '&#8363;',
		'VUV' => 'Vt',
		'WST' => 'T',
		'XAF' => 'Fr',
		'XCD' => '&#36;',
		'XOF' => 'Fr',
		'XPF' => 'Fr',
		'YER' => '&#xfdfc;',
		'ZAR' => '&#82;',
		'ZMW' => 'ZK',
	) );

	$currency_symbol = isset( $symbols[ $currency ] ) ? $symbols[ $currency ] : '';

	return apply_filters( 'dt_booking_currency_symbol', $currency_symbol, $currency );
}

/**
 * Get number format
 * @return number with format
 */
function dt_booking_number_format($n = 1) {

	$d = cs_get_option('price-decimal');
	
	return number_format($n, $d);
}

/**
 * Get formatted price
 * @return html
 */
function dt_booking_get_formatted_price($price = 30.55, $symbol = '$', $pos = 'left') {

	$symbol = dt_booking_get_currency_symbol();
	$pos 	= cs_get_option('currency-pos');

	switch($pos):
		case 'left':
		default:
			return $symbol.dt_booking_number_format($price);
			break;

		case 'left-with-space':
			return $symbol.' '.dt_booking_number_format($price);
			break;

		case 'right-with-space':
			return dt_booking_number_format($price).' '.$symbol;
			break;

		case 'right':
			return dt_booking_number_format($price).$symbol;
			break;
	endswitch;
}

/**
 * Get date range
 * @return dates
 */
function dt_booking_dates_range( $start_date, $end_date, $days = array() ){

    $interval = new DateInterval( 'P1D' );

    $realEnd = new DateTime( $end_date );
    $realEnd->add( $interval );

    $period = new DatePeriod( new DateTime( $start_date ), $interval, $realEnd );
    $dates = array();

    foreach ( $period as $date ) {
        $dates[] = in_array( strtolower( $date->format('l')) , $days ) ? $date->format( 'Y-m-d l' ) : '';
    }
    
    $dates = array_filter($dates);
    return $dates;
}

/**
 * Get replace values
 * @return array
 */
function dt_booking_replace( $content , $array ){
    $replace = array(
	 '[ADMIN_NAME]' => $array['admin_name'],
     '[STAFF_NAME]' => $array['staff_name'],
     '[SERVICE]' => $array['service_name'],
     '[CLIENT_NAME]' => $array['client_name'],
     '[CLIENT_PHONE]' => $array['client_phone'],
     '[CLIENT_EMAIL]' => $array['client_email'],
     '[APPOINTMENT_ID]' => $array['appointment_id'],
     '[APPOINTMENT_TIME]' => $array['appointment_time'],
     '[APPOINTMENT_DATE]' => $array['appointment_date'],
     '[APPOINTMENT_TITLE]' => $array['appointment_title'],   
     '[APPOINTMENT_BODY]' => $array['appointment_body'],
     '[AMOUNT]' => $array['amount'],
     '[COMPANY_LOGO]' => $array['company_logo'],
     '[COMPANY_NAME]' => $array['company_name'],
     '[COMPANY_PHONE]' => $array['company_phone'],
     '[COMPANY_ADDRESS]' => $array['company_address'],
     '[COMPANY_WEBSITE]' => $array['company_website']);

    return str_replace( array_keys( $replace ), array_values( $replace ), $content );
}

/**
 * Get replace values
 * @return array
 */
function dt_booking_replace_agenda( $content , $array ){
    $replace = array(
     '[STAFF_NAME]' => $array['staff_name'],
     '[TOMORROW]' => $array['tomorrow'],
     '[TOMORROW_AGENDA]' => $array['tomorrow_agenda'],
     '[COMPANY_LOGO]' => $array['company_logo'],
     '[COMPANY_NAME]' => $array['company_name'],
     '[COMPANY_PHONE]' => $array['company_phone'],
     '[COMPANY_ADDRESS]' => $array['company_address'],
     '[COMPANY_WEBSITE]' => $array['company_website']);

    return str_replace( array_keys( $replace ), array_values( $replace ), $content );
}

/**
 * Send email
 * @return mail
 */
function dt_booking_send_mail( $to, $subject, $message ){
	$sender_name =  cs_get_option('notification_sender_name');
	$sender_name = !empty($sender_name) ? $sender_name : get_option( 'blogname' );

	$sender_email = cs_get_option('notification_sender_email');
	$sender_email = !empty( $sender_email ) ? $sender_email : get_option( 'admin_email' );

	$from = $sender_name."<{$sender_email}>";

	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	$headers .= 'From: '.$from.'' . "\r\n";

	return wp_mail( $to, $subject, $message, $headers );
}