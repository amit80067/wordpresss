<?php
//Class definition: Privacy Class
if( !class_exists( 'DTCorePrivacy' ) ) {

	class DTCorePrivacy {

		function __construct() {

			add_action( 'init', array ( $this, 'dt_init' ) );

			add_action( 'wp_enqueue_scripts', array( $this, 'dt_privacy_footer_script' ) , 1000 );

			add_action( 'init', array( $this, 'dt_privacy_disable_google_font' ) , 1000 );

			add_action( 'wp_footer', array( $this, 'dt_privacy_print_tracking_code' ), 100 );

			add_shortcode( 'dt_sc_privacy_link', array( $this, 'dt_sc_privacy_policy_link' ) );
			add_shortcode( 'dt_sc_privacy_google_tracking', array( $this, 'dt_sc_privacy_disable_google_tracking' ) );
			add_shortcode( 'dt_sc_privacy_google_webfonts', array( $this, 'dt_sc_privacy_disable_google_webfonts' ) );
			add_shortcode( 'dt_sc_privacy_google_maps', array( $this, 'dt_sc_privacy_disable_google_maps' ) );
			add_shortcode( 'dt_sc_privacy_video_embeds', array( $this, 'dt_sc_privacy_disable_video_embeds' ) );

			add_action( 'wp_enqueue_scripts', array( $this, 'dt_privacy_enqueue_scripts' ) );

			add_shortcode ( 'dt_sc_tabs', array ( $this, 'dt_sc_tabs' ) );

			add_shortcode( 'dt_sc_tab', array( $this, 'dt_sc_tab' ) );
		}

		function dt_init() {
			// hook privacy message into commentform
			if( augury_get_option('privacy-commentform') == "true" ) {

				add_filter( 'comment_form_fields', array( $this, 'dt_privacy_comment_form_fields' ) , 10, 1 );

				add_filter( 'comment_form_default_fields', array( $this, 'dt_privacy_comment_checkbox' ) , 10, 1  );
				add_filter( 'preprocess_comment', array( $this, 'dt_privacy_verify_comment_checkbox' )  );
			}

			// hook privacy message into mailchimpform
			if( augury_get_option('privacy-subscribeform') == "true" ) {
				add_filter( 'dt_sc_mailchimp_form_elements', array( $this, 'dt_privacy_mailchimp_checkbox' ) , 10 , 2 );
			}

			// hook privacy message into login/registration forms
			if( augury_get_option('privacy-loginform') == "true" ) {
				add_action( 'login_form', array( $this, 'dt_privacy_login_extra' ) , 10 , 2 );
				add_action( 'woocommerce_login_form', array( $this, 'dt_privacy_login_extra' ) , 10 , 2 );
				add_filter( 'wp_authenticate_user', array( $this,'dt_privacy_authenticate_user_acc' ), 99999, 2);
			}
		}

		function dt_privacy_enqueue_scripts() {
			//Tabs scripts
			wp_enqueue_script ( 'jquery.tabs', plugin_dir_url ( __FILE__ ) . 'js/jquery.tabs.min.js', array('jquery'), false, true );
			wp_enqueue_script ( 'dt.privacy.script', plugin_dir_url ( __FILE__ ) . 'js/privacy.js', array (), false, true );
		}

		/* ---------------------------------------------------------------------------
		 *	Placeholder in comment field
		 * --------------------------------------------------------------------------- */
		function dt_privacy_comment_form_fields( $fields ) {

			$fields['comment'] = '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="'.esc_attr__('Comment', 'dt-elementor').'"></textarea></p>';

			return $fields;
		}

		/* ---------------------------------------------------------------------------
		 *	Appends a checkbox to the comment form fields
		 * --------------------------------------------------------------------------- */
		function dt_privacy_comment_checkbox( $fields = array() ) {

			$req = true;
			$fields = array(
				'author' => '<p class="comment-form-author">' . ( $req ? '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" placeholder="'.esc_attr__('Name *', 'dt-elementor').'" />' : '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" placeholder="'.esc_attr__('Name', 'dt-elementor').'" />' ) . '</p>',
				'email' => '<p class="comment-form-email">' . ( $req ? '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" placeholder="'.esc_attr__('Email *', 'dt-elementor').'" />' : '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" placeholder="'.esc_attr__('Email', 'dt-elementor').'" />' ) . '</p>',
				'url' => '<p class="comment-form-url">' . '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" placeholder="'.esc_attr__('Website', 'dt-elementor').'" /></p>',
			);

			$fields['comment-form-dt-privatepolicy'] = $this->dt_privacy_comment_checkbox_content();

			return $fields ;
		}

		/* ---------------------------------------------------------------------------
		 *	Creates the checkbox html to the comment form
		 * --------------------------------------------------------------------------- */
		function dt_privacy_comment_checkbox_content( $content = "", $extra_class = "" ) {

			if( empty($content) ) $content = do_shortcode( augury_get_option('privacy-commentform-msg') );

			$output = '<p class="comment-form-dt-privatepolicy '.$extra_class.'">
						<input id="comment-form-dt-privatepolicy" name="comment-form-dt-privatepolicy" type="checkbox" value="yes">
						<label for="comment-form-dt-privatepolicy">'.$content.'</label>
					  </p>';

			return $output;
		}

		/* ---------------------------------------------------------------------------
		 *	Checks if the user accepted the privacy policy in comment form
		 * --------------------------------------------------------------------------- */
		function dt_privacy_verify_comment_checkbox( $commentdata ) {

			$post_type = get_post_type( $_POST['comment_post_ID'] );

			if( $post_type != 'product' ) {

				if ( ! is_user_logged_in() && ! isset( $_POST['comment-form-dt-privatepolicy'] ) ) {
					$error_message = apply_filters( 'dt_privacy_comment_checkbox_error_message', esc_html__( 'Error: You must agree to our privacy policy to comment on this site...' , 'dt-elementor' ) );
					wp_die( $error_message );
				}
			}

		    return $commentdata;
		}

		/* ---------------------------------------------------------------------------
		 *	Checks if the user accepted the privacy policy in mailchimp form
		 * --------------------------------------------------------------------------- */
		function dt_privacy_mailchimp_checkbox( $content = "", $attrs = "" ) {

			if( empty($content) ) $content = do_shortcode( augury_get_option('privacy-subscribeform-msg') );

			$output = '<div class="dt-privacy-wrapper">';
				$output .= '<input name="dt_mc_privacy" id="dt_mc_privacy" value="true" type="checkbox" required="required"><label for="dt_mc_privacy">'.$content.'</label>';
			$output .= '</div>';

			return $output;
		}

		/* ---------------------------------------------------------------------------
		 *	Checks if the user accepted the privacy policy in login form
		 * --------------------------------------------------------------------------- */
		function dt_privacy_login_extra( $form ) {

			$content = do_shortcode( augury_get_option('privacy-loginform-msg') );
			echo ( ( $this->dt_privacy_comment_checkbox_content( $content , 'forgetmenot') ) );
		}

		/* ---------------------------------------------------------------------------
		 *	Authenticate the extra checkbox in the user login screen
		 * --------------------------------------------------------------------------- */
		function dt_privacy_authenticate_user_acc( $user, $password ) {

			// See if the checkbox #login_accept was checked
		    if ( isset( $_REQUEST['comment-form-dt-privatepolicy'] ) ) {
		        // Checkbox on, allow login
		        return $user;
		    } else {
		        // Did NOT check the box, do not allow login
		        $error = new WP_Error();
		        $error->add('did_not_accept', esc_html__( 'You must acknowledge and agree to the privacy policy' , 'dt-elementor'));
		        return $error;
		    }
		}

		/* ---------------------------------------------------------------------------
		 *	Javascript that gets appended to pages that got a privacy shortcode toggle
		 * --------------------------------------------------------------------------- */
		function dt_privacy_footer_script() {

			wp_add_inline_script( 'dtprivacy-cookie-js', "function dt_privacy_cookie_setter( cookie_name ) {
				
			var toggle = jQuery('.' + cookie_name);
			toggle.each(function()
			{
				if(document.cookie.match(cookie_name)) this.checked = false;
			});

			jQuery('.' + 'dt-switch-' + cookie_name).each(function()
			{
				this.className += ' active ';
			});

			toggle.on('click', function() {
				if(this.checked) {
					document.cookie = cookie_name + '=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
				}
				else {
					var theDate = new Date();
					var oneYearLater = new Date( theDate.getTime() + 31536000000 );
					document.cookie = cookie_name + '=true; Path=/; Expires='+oneYearLater.toGMTString()+';';
				}
			});
			};
			dt_privacy_cookie_setter('dtPrivacyGoogleTrackingDisabled');
			dt_privacy_cookie_setter('dtPrivacyGoogleWebfontsDisabled');
			dt_privacy_cookie_setter('dtPrivacyGoogleMapsDisabled');
			dt_privacy_cookie_setter('dtPrivacyVideoEmbedsDisabled'); " );
		}

		/* ---------------------------------------------------------------------------
		 *	Disable Google Font 
		 * --------------------------------------------------------------------------- */
		function dt_privacy_disable_google_font() {

			if( isset( $_COOKIE['dtPrivacyGoogleWebfontsDisabled'] ) ) {
				add_filter( 'kirki/enqueue_google_fonts', '__return_empty_array' );
			}
		}

		/* ---------------------------------------------------------------------------
		 *	Print Tracking Code
		 * --------------------------------------------------------------------------- */
		function dt_privacy_print_tracking_code() {

			$temp = augury_get_option( 'analytics-code' );

			$tracking_code = "<!-- Global site tag (gtag.js) - Google Analytics -->
			<script async src='https://www.googletagmanager.com/gtag/js?id=".$temp."'></script>
			<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());
			gtag('config', '".$temp."', { 'anonymize_ip': true });
			</script>";
			
			$enable_code = augury_get_option( 'enable-analytics-code' );

			if( !empty( $temp ) && isset( $enable_code ) ) {
				//extract UA ID from code
				$UAID = false;
				$extra_code = "";
				preg_match("!UA-[0-9]+-[0-9]+!", $tracking_code, $match);

				if(!empty($match) && isset($match[0])) $UAID = $match[0];

				//if we got a valid uaid, add the js cookie check 
				if($UAID){
				$extra_code = "
				<script>
				if(document.cookie.match(/dtPrivacyGoogleTrackingDisabled/)){ window['ga-disable-{$UAID}'] = true; }
				</script>";
				}

				echo ( ($extra_code . $tracking_code) );
			}
		}

		/**
		 * privacy policy link
		 * @return link
		 */
		function dt_sc_privacy_policy_link( $attrs = array() , $content = "") {	
	
			$page_id = get_option('wp_page_for_privacy_policy');
			$url	 = get_permalink($page_id);
			$content = !empty($content) ?  $content : get_the_title($page_id);
			$link	 = "<a href='{$url}'>{$content}</a>";
	
			return $link;
		}
	
		function dt_sc_privacy_disable_google_tracking( $attrs = array() , $content = "") {	
			$content = !empty($content) ?  $content : __('Click to enable/disable google analytics tracking.', 'dt-elementor');
			$cookie  = "dtPrivacyGoogleTrackingDisabled";
			
			$checked = ' checked="checked"';
			if( isset( $_COOKIE[$cookie] ) )
				$checked = '';
	
			$out = '<div class="dt-toggle-switch">';
				$out .= '<label>';
					$out .= '<input type="checkbox" '.$checked.' id="'.$cookie.'" name="'.$cookie.'" class="'.$cookie.'">';
					$out .= '<span>'.$content.'</span>';
				$out .= '</label>';
			$out .= '</div>';
	
			return $out;
		}
	
		function dt_sc_privacy_disable_google_webfonts( $attrs = array() , $content = "") {
			$content = !empty($content) ?  $content : __('Click to enable/disable google webfonts.', 'dt-elementor');
			$cookie  = "dtPrivacyGoogleWebfontsDisabled";
	
			$checked = ' checked="checked"';
			if( isset( $_COOKIE[$cookie] ) )
				$checked = '';
	
			$out = '<div class="dt-toggle-switch">';
				$out .= '<label>';
					$out .= '<input type="checkbox" '.$checked.' id="'.$cookie.'" name="'.$cookie.'" class="'.$cookie.'">';
					$out .= '<span>'.$content.'</span>';
				$out .= '</label>';
			$out .= '</div>';
	
			return $out;
		}
	
		function dt_sc_privacy_disable_google_maps( $attrs = array() , $content = "") {	
			$content = !empty($content) ?  $content : __('Click to enable/disable google maps.', 'dt-elementor');
			$cookie  = "dtPrivacyGoogleMapsDisabled";
	
			$checked = ' checked="checked"';
			if( isset( $_COOKIE[$cookie] ) )
				$checked = '';
	
			$out = '<div class="dt-toggle-switch">';
				$out .= '<label>';
					$out .= '<input type="checkbox" '.$checked.' id="'.$cookie.'" name="'.$cookie.'" class="'.$cookie.'">';
					$out .= '<span>'.$content.'</span>';
				$out .= '</label>';
			$out .= '</div>';
	
			return $out;
		}
	
		function dt_sc_privacy_disable_video_embeds( $attrs = array() , $content = "") {	
			$content = !empty($content) ?  $content : __('Click to enable/disable video embeds.', 'dt-elementor');
			$cookie  = "dtPrivacyVideoEmbedsDisabled";
	
			$checked = ' checked="checked"';
			if( isset( $_COOKIE[$cookie] ) )
				$checked = '';
	
			$out = '<div class="dt-toggle-switch">';
				$out .= '<label>';
					$out .= '<input type="checkbox" '.$checked.' id="'.$cookie.'" name="'.$cookie.'" class="'.$cookie.'">';
					$out .= '<span>'.$content.'</span>';
				$out .= '</label>';
			$out .= '</div>';
	
			return $out;
		}

		function dt_sc_tabs($attrs, $content = null) {
			extract ( shortcode_atts ( array (
				'type' => 'horizontal',
				'style' => 'default',
				'effect' => 'fade',
				'class' => ''
			), $attrs ) );
	
			preg_match_all( '/dt_sc_tab([^\]]+)/i', $content, $matches, PREG_OFFSET_CAPTURE );
			$tab_titles = array();
			if ( isset( $matches[1] ) ) {
				$tab_titles = $matches[1];
			}
	
			$tabs_nav = '';
			if($style == 'default')
				$tabs_nav .= "<ul class='dt-sc-tabs-{$type}'>";
			else
				$tabs_nav .= "<ul class='dt-sc-tabs-{$type}-frame'>";
	
				foreach ( $tab_titles as $tab ) {
	
					$tab_atts = shortcode_parse_atts( $tab[0] );
	
					$icon = "";

					if( isset($tab_atts['icon_type']) && $tab_atts['icon_type'] === 'custom' ){
						$icon = isset( $tab_atts['icon_class'] ) ? $tab_atts['icon_class'] : '';
					}

					$icon = !empty( $icon ) ? "<span class='".$icon."'></span>" : "";

					$tabs_nav .= '<li><a href="javascript:void(0);">'.$icon.$tab_atts['title'].'</a></li>';
				}

				$tabs_nav .= '</ul>';
	
			if($style != 'default') $style = '-frame';
			else $style = '';
	
			$a = '[dt_sc_tab class="dt-sc-tabs-'.$type.$style.'-content" ';
			$content = str_replace( '[dt_sc_tab',$a, $content);
			$out = do_shortcode( $content );

			return "<div class='dt-sc-tabs-{$type}{$style}-container {$class}' data-effect='{$effect}'>{$tabs_nav}{$out}</div>";
		}

		function dt_sc_tab( $attrs, $content = null ){
			extract ( shortcode_atts ( array (
				'class' => '' 
			), $attrs ) );	

			$content = do_shortcode( $content );

			return "<div class='$class'>".$content."</div>";
		}
	}
}

/* --------------------------------------------------------------------------------
 * Creates a modal window informing the user about the use of cookies on the site
 * Sets a cookie when the confirm button is clicked, and hides the box.
 * -------------------------------------------------------------------------------- */
if( ! function_exists( 'dt_privacy_cookie_consent' ) ) {

    function dt_privacy_cookie_consent() {

        if( augury_get_option('enable-cookie-consent') == "true" ) {

			$message = do_shortcode( augury_get_option('cookie-consent-msg') );
			$position = augury_get_option('cookie-bar-position'); ?>

            <div class="dt-cookie-consent cookiebar-hidden dt-cookiemessage-<?php echo esc_attr($position); ?>">
	            <div class="container">
    		        <p class="dt_cookie_text"><?php echo do_shortcode ( $message ); ?></p><?php

					$cookie_contents = $message;
					$cookie_contents = md5($cookie_contents);

					if(!augury_get_option( 'enable-dismiss-the-notification' ) && !augury_get_option( 'enable-link-to-another-page' ) && !augury_get_option( 'enable-open-infomodal-on-privacy-and-cookies' )) {

						echo '<a href="#" class="dt-sc-button filled small dt-cookie-consent-button dt-cookie-close-bar" data-contents="'.esc_attr($cookie_contents).'">'.esc_html__('OK', 'dt-elementor').'</a>';

					} else {

						if(augury_get_option( 'enable-dismiss-the-notification' )) {
							$label = augury_get_option( 'dismiss-the-notification-label' );
							echo '<a href="#" class="dt-sc-button filled small dt-cookie-consent-button dt-cookie-close-bar" data-contents="'.$cookie_contents.'">'.$label.'</a>';
						}

						if(augury_get_option( 'enable-link-to-another-page' )) {
							$label = augury_get_option( 'link-to-another-page-label' );
							$link = augury_get_option( 'link-to-another-page-link' );
							echo '<a href="'.esc_url($link).'" class="dt-sc-button filled small dt-cookie-consent-button dt-extra-cookie-btn" data-contents="'.$cookie_contents.'">'.$label.'</a>';
						}

						if(augury_get_option( 'enable-open-infomodal-on-privacy-and-cookies' )) {
							$label = augury_get_option( 'open-infomodal-on-privacy-and-cookies-label' );
							echo '<a href="#dt-consent-extra-info" class="dt-sc-button filled small dt-cookie-consent-button dt-extra-cookie-btn dt-cookie-info-btn">'.$label.'</a>';
						}

					}

					$extra_info = '';

					if(augury_get_option( 'enable-open-infomodal-on-privacy-and-cookies' )) {

						$heading = esc_html__( "Cookie and Privacy Settings", 'dt-elementor' );
						$contents = array(

									array(	'label'		=> esc_html__( 'How we use cookies', 'dt-elementor' ),
											'content'	=> sprintf( esc_html__( 'We may request cookies to be set on your device. We use cookies to let us know when you visit our websites, how you interact with us, to enrich your user experience, and to customize your relationship with our website. %1$s%1$sClick on the different category headings to find out more. You can also change some of your preferences. Note that blocking some types of cookies may impact your experience on our websites and the services we are able to offer.', 'dt-elementor'), '<br>' ) ),

									array(	'label'		=> esc_html__( 'Essential Website Cookies', 'dt-elementor' ),
											'content'	=> sprintf( esc_html__( 'These cookies are strictly necessary to provide you with services available through our website and to use some of its features. %1$s%1$sBecause these cookies are strictly necessary to deliver the website, you cannot refuse them without impacting how our site functions. You can block or delete them by changing your browser settings and force blocking all cookies on this website.', 'dt-elementor'), '<br>' ) ),

						);

						$analtics_check = augury_get_option( 'analytics-code' );
						if(!empty( $analtics_check ) ) {
							$contents[] = array(	'label'		=> esc_html__( 'Google Analytics Cookies', 'dt-elementor' ),
													'content'	=> sprintf( esc_html__( 'These cookies collect information that is used either in aggregate form to help us understand how our website is being used or how effective our marketing campaigns are, or to help us customize our website and application for you in order to enhance your experience. %1$s%1$sIf you do not want that we track your visist to our site you can disable tracking in your browser here: [dt_sc_privacy_google_tracking]', 'dt-elementor'), '<br>' ) );
						}

						$contents[] = array(	'label'		=> esc_html__( 'Other external services', 'dt-elementor' ),
												'content'	=> sprintf( esc_html__( 'We also use different external services like Google Webfonts, Google Maps and external Video providers. Since these providers may collect personal data like your IP address we allow you to block them here. Please be aware that this might heavily reduce the functionality and appearance of our site. Changes will take effect once you reload the page.%1$s%1$s

												Google Webfont Settings:					
												[dt_sc_privacy_google_webfonts]

												Google Map Settings:
												[dt_sc_privacy_google_maps]

												Vimeo and Youtube video embeds:
												[dt_sc_privacy_video_embeds]', 'dt-elementor' ), '<br>'
						) );

						$wp_privacy_page = get_option('wp_page_for_privacy_policy');
						if( !empty( $wp_privacy_page ) ) {
							$contents[] = array(	'label'		=> esc_html__( 'Privacy Policy', 'dt-elementor' ),
													'content'	=> sprintf( esc_html__( 'You can read about our cookies and privacy settings in detail on our Privacy Policy Page. %1$s%1$s [dt_sc_privacy_link]', 'dt-elementor' ), '<br>' ) );
						}

						if( augury_get_option('enable-custom-model-content') == "true" ) {

							$contents = augury_get_option('custom-model-content');
							$content = do_shortcode($contents);
							$heading  = str_replace("'", "&apos;", augury_get_option('custom-model-heading', $heading));

						} else {

							$content = '';
							foreach($contents as $content_block ) {
								$content .= '[dt_sc_tab title="'.$content_block['label'].'"]';
									$content .= $content_block['content'];
								$content .= '[/dt_sc_tab]';
							}

						}

						$extra_info = "<div id='dt-consent-extra-info' class='dt-inline-modal main_color zoom-anim-dialog mfp-hide'>".do_shortcode("

							<h4>{$heading}</h4>

							[dt_sc_tabs type='vertical']
								{$content}
							[/dt_sc_tabs]
							
						")."</div>";

					} ?>
                </div>
            </div><?php

		    echo do_shortcode( $extra_info );
        }
    }
    add_action('wp_footer', 'dt_privacy_cookie_consent', 3);
}