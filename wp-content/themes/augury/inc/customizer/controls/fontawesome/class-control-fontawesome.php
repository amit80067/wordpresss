<?php
/**
 * Augury Theme Customizer Control: Fontawesome
 *
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Augury_Customize_Control_Fontawesome extends WP_Customize_Control {

	public $type       = 'dt-fontawesome';
	public $dependency = array();

	/**
	 * Enqueue control related scripts/styles.
	 */
	public function enqueue() {
		wp_enqueue_script( 'augury-fontawesome-control', AUGURY_URI . '/inc/customizer/controls/fontawesome/fontawesome.js', array( 'jquery', 'customize-base' ), AUGURY_VERSION, true );
		wp_enqueue_style( 'augury-fontawesome-control',  AUGURY_URI . '/inc/customizer/controls/fontawesome/fontawesome.css', null, AUGURY_VERSION );

		wp_enqueue_style( 'fontawesome',  AUGURY_URI . '/inc/customizer/assets/css/fontawesome-all.css', array(),AUGURY_VERSION, 'all' );
	}	

	/**
	 * Get the data to export to the client via JSON.
	 */
	public function to_json() {
		parent::to_json();

		$this->json['default'] = $this->setting->default;
		if ( isset( $this->default ) ) {
			$this->json['default'] = $this->default;
		}

		$this->json['id']     = $this->id;
		$this->json['label']  = esc_html( $this->label );
		$this->json['value']  = $this->value();

		$this->json['reset'] = esc_html__( "Reset", "augury") .' '.esc_html( $this->label );	 	

		$this->json['inputAttrs'] = '';
		foreach ( $this->input_attrs as $attr => $value ) {
			$this->json['inputAttrs'] .= $attr . '="' . esc_attr( $value ) . '" ';
		}

		$icons = array();
		foreach( Augury_Fontawesome::get_icons() as $class => $name  ) {

			$icons[$class] = $name;
		}
		$this->json['icons'] = $icons;
	}

	/**
	 * Renders the control wrapper and calls $this->render_content() for the internals.
	 */
	protected function render() {

		$id    = 'customize-control-' . str_replace( array( '[', ']' ), array( '-', '' ), $this->id );
		$class = 'customize-control customize-control-' . $this->type;

		$d_controller = $d_condition = $d_value = '';
		$dependency   = $this->dependency;
		if( !empty( $dependency ) ) {
			$d_controller = "data-controller='" . esc_attr( $dependency[0] )."'";
			$d_condition  = "data-condition='" . esc_attr( $dependency[1] )."'";
			$d_value      = "data-value='". esc_attr( $dependency[2] )."'";
		}

		printf( '<li id="%s" class="%s" %s %s %s>', esc_attr( $id ), esc_attr( $class ), $d_controller, $d_condition, $d_value );
		$this->render_content();
		echo '</li>';
	}		

	/**
	 * An Underscore (JS) template for this control's content (but not its container).
	 *
	 * Class variables for this control class are available in the `data` JS object;
	 * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
	 *
	 * @see WP_Customize_Control::print_template()
	 *
	 * @access protected
	 */
	protected function content_template() { ?>
		<span class="customize-control-title">
			<#  if ( data.label ) { #>
				<label> <span>{{{ data.label }}}</span> </label>
			<# } #>

			<# if ( data.description ) { #>
				<span class="description customize-control-description">{{{ data.description }}}</span>
			<# } #>

			<span class="item-reset desktop-reset dashicons dashicons-image-rotate" title="{{{ data.reset }}}"></span>
		</span>

		<div class="wrapper">
			<div class="selector">
				<span class="selected-icon">
					<i class="{{{ data.value }}}" data-value="{{{ data.value }}}"></i>
				</span>
				<span class="selector-button">
					<i class="fa-arrow-down fip-fa fa"></i>
				</span>
			</div>
			<div class="icons-container">
				<# _.each( data.icons, function( iconName, iconClass ) { #>
					<span class="fip-box" title="{{{ iconName }}}">
						<i class="{{{ iconClass }}}"></i>						
					</span>
				<# }); #>
			</div>
		</div>		
		<?php
	}
}