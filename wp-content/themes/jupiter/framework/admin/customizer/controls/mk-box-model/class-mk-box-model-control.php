<?php
/**
 * Customize API: MK_Box_Model_Control class
 *
 * @package Jupiter
 * @subpackage MK_Customizer
 * @since 5.9.4
 */

/**
 * Customize Box Model Control class.
 *
 * @since 5.9.4
 *
 * @see MK_Control
 */
class MK_Box_Model_Control extends MK_Control {

	/**
	 * Control type
	 *
	 * @var string $type
	 */
	public $type = 'mk-box-model';

	/**
	 * Enqueue control related scripts/styles.
	 */
	public function enqueue() {
		wp_enqueue_style( $this->type . '-control', THEME_CUSTOMIZER_URI . '/controls/' . $this->type . '/styles.css' );
		wp_enqueue_script( $this->type . '-control', THEME_CUSTOMIZER_URI . '/controls/' . $this->type . '/scripts.js' );
	}

	/**
	 * Render the control's content.
	 */
	public function render_content() {
		$current_value = mk_maybe_json_decode( $this->value() );
		?>
		<div class="mk-control-wrap mk-control-box-model">
			<div class="mk-box-model">
				<div class="mk-box-model-margin">
					<span class="mk-box-model-margin-title"><?php esc_html_e( 'Margin', 'mk_framework' ); ?></span>
					<?php
					$margins = array(
						'margin_top',
						'margin_right',
						'margin_bottom',
						'margin_left',
					);
					foreach ( $margins as $margin ) {
						$this->render_input( array(
							'link' => $this->id . '-' . $margin,
							'input_attrs' => array(
								'name' => $margin,
								'class' => 'mk-box-model-' . str_replace( '_', '-', $margin ) . '-val',
							),
							'value' => isset( $current_value->{$margin} ) ? $current_value->{$margin} : '',
						) );
					}
					?>
					<div class="mk-box-model-padding">
						<span class="mk-box-model-padding-title"><?php esc_html_e( 'Padding', 'mk_framework' ); ?></span>
						<?php
						$paddings = array(
							'padding_top',
							'padding_right',
							'padding_bottom',
							'padding_left',
						);
						foreach ( $paddings as $padding ) {
							$this->render_input( array(
								'link' => $this->id . '-' . $padding,
								'input_attrs' => array(
									'name' => $padding,
									'class' => 'mk-box-model-' . str_replace( '_', '-', $padding ) . '-val',
								),
								'value' => isset( $current_value->{$padding} ) ? $current_value->{$padding} : '',
							) );
						}
						?>
					</div>
				</div>
			</div>
			<input class="mk-box-model-value" type="hidden" value="<?php echo esc_attr( mk_maybe_json_encode( $this->value() ) ); ?>" <?php $this->link(); ?> />
		</div>
		<?php
	}
}
