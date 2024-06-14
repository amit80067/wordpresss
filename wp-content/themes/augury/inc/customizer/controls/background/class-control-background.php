<?php
/**
 * Augury Theme Customizer Control: Background Field
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Augury_Customize_Control_Background extends WP_Customize_Control {

	public $type       = 'dt-background';
	
	public $dependency = array();

	/**
	 * Enqueue control related scripts/styles.
	 */
	public function enqueue() {
		wp_enqueue_style( 'augury-background-control',  AUGURY_URI . '/inc/customizer/controls/background/background.css', null, AUGURY_VERSION );
		wp_enqueue_script( 'augury-background-control', AUGURY_URI . '/inc/customizer/controls/background/background.js', array( 'jquery', 'customize-base' ), AUGURY_VERSION, true );
		wp_localize_script( 'augury-background-control',
			'dtthemeCustomizerControlBackground', array(
				'placeholder'  => esc_html__( 'No file selected', 'augury' ),
				'lessSettings' => esc_html__( 'Less Settings', 'augury' ),
				'moreSettings' => esc_html__( 'More Settings', 'augury' ),
			)
		);		
	}

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @see WP_Customize_Control::to_json()
	 */
	public function to_json() {
		parent::to_json();

		$this->json['default'] = $this->setting->default;
		if ( isset( $this->default ) ) {
			$this->json['default'] = $this->default;
		}
		$this->json['value'] = $this->value();
		$this->json['id']    = $this->id;
		$this->json['label'] = esc_html( $this->label );
		$this->json['link']  = $this->get_link();


		$this->json['inputAttrs'] = '';
		foreach ( $this->input_attrs as $attr => $value ) {
			$this->json['inputAttrs'] .= $attr . '="' . esc_attr( $value ) . '" ';
		}
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
	protected function content_template() {
		?>
		<label>
			<span class="customize-control-title">{{{ data.label }}}</span>
			<# if ( data.description ) { #><span class="description customize-control-description">{{{ data.description }}}</span><# } #>
		</label>

		<div class="background-wrapper">

			<!-- background-color -->
			<div class="background-color">
				<h4><?php esc_html_e( 'Background Color', 'augury' ); ?></h4>
				<input type="text" data-default-color="{{ data.default['background-color'] }}" data-alpha="true" value="{{ data.value['background-color'] }}" class="dt-color-control"/>
			</div>

			<!-- background-image -->
			<div class="background-image">
				<h4><?php esc_html_e( 'Background Image', 'augury' ); ?></h4>
				<div class="attachment-media-view background-image-upload">
					<# if ( data.value['background-image'] ) { #>
						<div class="thumbnail thumbnail-image"><img src="{{ data.value['background-image'] }}" /></div>
					<# } else { #>
						<div class="placeholder"><?php esc_html_e( 'No File Selected', 'augury' ); ?></div>
					<# } #>
					<div class="actions">
						<button class="button background-image-upload-remove-button<# if ( ! data.value['background-image'] ) { #> hidden <# } #>">
							<?php esc_attr_e( 'Remove', 'augury' ); ?>
						</button>
						<button type="button" class="button background-image-upload-button"><?php esc_attr_e( 'Select File', 'augury' ); ?></button>

						<# if ( data.value['background-image'] ) { #>
							<a href="javascript:void(0);" class="more-settings" data-direction="up">
								<span class="message"><?php esc_html_e( 'Less Settings', 'augury' ); ?></span> 
								<span class="icon">↑</span>
							</a>
						<# } else { #>
							<a href="javascript:void(0);" class="more-settings" data-direction="down">
								<span class="message"><?php esc_html_e( 'More Settings', 'augury' ); ?></span>
								<span class="icon">↓</span>
							</a>
						<# } #>
					</div>
				</div>
			</div>

			<!-- background-repeat -->
			<div class="background-repeat">
				<select {{{ data.inputAttrs }}}>
					<option value="no-repeat"<# if ( 'no-repeat' === data.value['background-repeat'] ) { #> selected <# } #>>
						<?php esc_html_e( 'No Repeat', 'augury' ); ?>
					</option>
					<option value="repeat"<# if ( 'repeat' === data.value['background-repeat'] ) { #> selected <# } #>>
						<?php esc_html_e( 'Repeat All', 'augury' ); ?>
					</option>
					<option value="repeat-x"<# if ( 'repeat-x' === data.value['background-repeat'] ) { #> selected <# } #>>
						<?php esc_html_e( 'Repeat Horizontally', 'augury' ); ?>
					</option>
					<option value="repeat-y"<# if ( 'repeat-y' === data.value['background-repeat'] ) { #> selected <# } #>>
						<?php esc_html_e( 'Repeat Vertically', 'augury' ); ?>
					</option>
				</select>
			</div>

			<!-- background-position -->
			<div class="background-position">
				<select {{{ data.inputAttrs }}}>
					<option value="left top"<# if ( 'left top' === data.value['background-position'] ) { #> selected <# } #>>
						<?php esc_html_e( 'Left Top', 'augury' ); ?>
					</option>
					<option value="left center"<# if ( 'left center' === data.value['background-position'] ) { #> selected <# } #>>
						<?php esc_html_e( 'Left Center', 'augury' ); ?>
					</option>
					<option value="left bottom"<# if ( 'left bottom' === data.value['background-position'] ) { #> selected <# } #>>
						<?php esc_html_e( 'Left Bottom', 'augury' ); ?>
					</option>
					<option value="right top"<# if ( 'right top' === data.value['background-position'] ) { #> selected <# } #>>
						<?php esc_html_e( 'Right Top', 'augury' ); ?>
					</option>
					<option value="right center"<# if ( 'right center' === data.value['background-position'] ) { #> selected <# } #>>
						<?php esc_html_e( 'Right Center', 'augury' ); ?>
					</option>
					<option value="right bottom"<# if ( 'right bottom' === data.value['background-position'] ) { #> selected <# } #>>
						<?php esc_html_e( 'Right Bottom', 'augury' ); ?>
					</option>
					<option value="center top"<# if ( 'center top' === data.value['background-position'] ) { #> selected <# } #>>
						<?php esc_html_e( 'Center Top', 'augury' ); ?>
					</option>
					<option value="center center"<# if ( 'center center' === data.value['background-position'] ) { #> selected <# } #>>
						<?php esc_html_e( 'Center Center', 'augury' ); ?>
					</option>
					<option value="center bottom"<# if ( 'center bottom' === data.value['background-position'] ) { #> selected <# } #>>
						<?php esc_html_e( 'Center Bottom', 'augury' ); ?>
					</option>
				</select>
			</div>

			<!-- background-size -->
			<div class="background-size">
				<h4><?php esc_html_e( 'Background Size', 'augury' ); ?></h4>
				<div class="buttonset">
					<input {{{ data.inputAttrs }}} class="switch-input screen-reader-text" type="radio" value="cover" name="_customize-bg-{{{ data.id }}}-size"
						id="{{ data.id }}cover" <# if ( 'cover' === data.value['background-size'] ) { #> checked="checked" <# } #>>
						<label class="switch-label switch-label-<# if ( 'cover' === data.value['background-size'] ) { #>on <# } else { #>off<# } #>" for="{{ data.id }}cover"><?php esc_html_e( 'Cover', 'augury' ); ?></label>
					</input>
					<input {{{ data.inputAttrs }}} class="switch-input screen-reader-text" type="radio" value="contain" name="_customize-bg-{{{ data.id }}}-size" 
						id="{{ data.id }}contain" <# if ( 'contain' === data.value['background-size'] ) { #> checked="checked" <# } #>>
						<label class="switch-label switch-label-<# if ( 'contain' === data.value['background-size'] ) { #>on <# } else { #>off<# } #>" for="{{ data.id }}contain"><?php esc_html_e( 'Contain', 'augury' ); ?></label>
					</input>
					<input {{{ data.inputAttrs }}} class="switch-input screen-reader-text" type="radio" value="auto" name="_customize-bg-{{{ data.id }}}-size" 
						id="{{ data.id }}auto" <# if ( 'auto' === data.value['background-size'] ) { #> checked="checked" <# } #>>
						<label class="switch-label switch-label-<# if ( 'auto' === data.value['background-size'] ) { #>on <# } else { #>off<# } #>" for="{{ data.id }}auto"><?php esc_html_e( 'Auto', 'augury' ); ?></label>
					</input>
				</div>
			</div>

			<!-- background-attachment -->
			<div class="background-attachment">
				<h4><?php esc_html_e( 'Background Attachment', 'augury' ); ?></h4>
				<div class="buttonset">
					<input {{{ data.inputAttrs }}} class="switch-input screen-reader-text" type="radio" value="inherit" name="_customize-bg-{{{ data.id }}}-attachment" id="{{ data.id }}inherit" <# if ( 'inherit' === data.value['background-attachment'] ) { #> checked="checked" <# } #>>
						<label class="switch-label switch-label-<# if ( 'inherit' === data.value['background-attachment'] ) { #>on <# } else { #>off<# } #>" for="{{ data.id }}inherit"><?php esc_html_e( 'Inherit', 'augury' ); ?></label>
					</input>
					<input {{{ data.inputAttrs }}} class="switch-input screen-reader-text" type="radio" value="scroll" name="_customize-bg-{{{ data.id }}}-attachment" id="{{ data.id }}scroll" <# if ( 'scroll' === data.value['background-attachment'] ) { #> checked="checked" <# } #>>
						<label class="switch-label switch-label-<# if ( 'scroll' === data.value['background-attachment'] ) { #>on <# } else { #>off<# } #>" for="{{ data.id }}scroll"><?php esc_html_e( 'Scroll', 'augury' ); ?></label>
					</input>
					<input {{{ data.inputAttrs }}} class="switch-input screen-reader-text" type="radio" value="fixed" name="_customize-bg-{{{ data.id }}}-attachment" id="{{ data.id }}fixed" <# if ( 'fixed' === data.value['background-attachment'] ) { #> checked="checked" <# } #>>
						<label class="switch-label switch-label-<# if ( 'fixed' === data.value['background-attachment'] ) { #>on <# } else { #>off<# } #>" for="{{ data.id }}fixed"><?php esc_html_e( 'Fixed', 'augury' ); ?></label>
					</input>
				</div>
			</div>

			<input class="background-hidden-value" type="hidden" {{{ data.link }}}>
		</div>
		<?php
	}			
}