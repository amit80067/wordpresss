<?php
/**
 * Augury Theme Customizer Control: description
 *
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Augury_Customize_Control_Description extends WP_Customize_Control {

	// Control's Type.
	public $type       = 'dt-description';
	
	// Control's caption attribute.
	public $help       = '';
	
	public $dependency = array();	

	/**
	 * Enqueue control related scripts/styles.
	 * 
	 */
	public function enqueue() {

		wp_enqueue_style( 'augury-description-control',  AUGURY_URI . '/inc/customizer/controls/description/description.css', null, AUGURY_VERSION );
	}	

	/**
	 * Get the data to export to the client via JSON.
	 *
	 */
	public function to_json() {
		parent::to_json();

		$this->json['help'] = $this->help;
	}

	/**
	 * Renders the control wrapper and calls $this->render_content() for the internals.
	 *
	 * @since 3.4.0
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
	 * Render a JS template for the content of the dt-description control
	 * 
	 */
	protected function content_template() {
		?>
		<label class="customizer-text">
			<# if ( data.label ) { #>
				<span class="customize-control-title">{{{ data.label }}}</span>
			<# } #>
			<# if ( data.help ) { #>
				<span class="dt-description">{{{ data.help }}}</span>			
			<# } #>
			<# if ( data.description ) { #>
				<span class="description customize-control-description">{{{ data.description }}}</span>
			<# } #>
		</label>
		<?php
	}
}