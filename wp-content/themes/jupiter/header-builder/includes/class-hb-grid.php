<?php
/**
 * Header Builder: Elements Generator, HB_Grid class.
 *
 * For use in front end integration with Jupiter.
 *
 * @author Mehdi Shojaei <mehdi@artbees.net>
 *
 * @package Header_Builder
 * @subpackage Elements_Generator
 * @since 5.9.0
 * @since 5.9.4 Add parameters on HB_Grid declaration.
 */

/**
 * Takes JSON saved in database and output HTML and CSS on the front end.
 *
 * @SuppressWarnings(PHPMD)
 *
 * Warnings: get_src will be refactor later.
 *
 * @since 5.9.0
 * @since 5.9.3 Add make inline and alignment property.
 *
 * We won't declare Mk_Header_Builder to be a singleton, as we might eventually find ourselves
 * needing different instances of it.
 */
class HB_Grid {
	/**
	 * Stores array data from JSON retrieved from options table.
	 *
	 * @since 5.9.0
	 * @access protected
	 * @var array $model The 'model' stored in 'artbees_header_builder' option.
	 */
	protected $model;

	/**
	 * Stores markup for all available data in $model.
	 *
	 * @since 5.9.0
	 * @access protected
	 * @var string $header_markup HTML output.
	 */
	protected $header_markup;

	/**
	 * Stores styles for all available data in $model.
	 *
	 * @since 5.9.0
	 * @access protected
	 * @var string $header_style CSS output.
	 */
	protected $header_style;

	/**
	 * HB_ customize class instances store in $hb_customize.
	 *
	 * @since 5.9.4
	 * @access private
	 * @var array $hb_customize Array list of HB_ customize instances.
	 */
	private $hb_customize;

	/**
	 * Constructor.
	 *
	 * @since 5.9.0
	 * @since 5.9.4 Add $hb_customize as constructor parameter to load HB customize class instances.
	 *
	 * @param object $hb_customize HB_Costumize instances.
	 */
	public function __construct( $hb_customize ) {
		$option = get_option( 'artbees_header_builder' );
		$option = json_decode( $option, true );
		$model = isset( $option['model'] ) ? $option['model'] : array();

		$this->model = $model;
		$this->hb_customize = $hb_customize;

		// Otherwise, throw an error if this file is missing.
		if ( ! class_exists( 'Mk_Header_Builder' ) ) {
			require_once( HB_INCLUDES_DIR . '/elements/class-hb-element.php' );
		}

		$output = $this->get_src( 'desktop' );

		$this->header_markup = $output['markup'];
		$this->header_style = $output['style'];
	}

	/**
	 * Output header builder markup on front-end.
	 *
	 * @since 5.9.0
	 */
	public function render_markup() {
		echo $this->markup(); // WPCS: XSS OK.
	}

	/**
	 * Output header builder styles on front-end.
	 *
	 * @since 5.9.0
	 */
	public function render_style() {
		echo $this->style(); // WPCS: XSS OK.
	}

	/**
	 * Return header builder styles on front-end.
	 *
	 * @since 5.9.0
	 */
	public function style() {
		return $this->header_style;
	}

	/**
	 * Return header builder markup on front-end.
	 *
	 * @since 5.9.0
	 */
	public function markup() {
		return $this->header_markup;
	}

	/**
	 * Output the header builder front end to Jupiter.
	 *
	 * @since 5.9.0
	 *
	 * @see get_device_src()
	 *
	 * @param string|array $devices List of devices to render. Accetps string values of
	 *     'desktop', 'tablet', 'mobile' or an array containing any combination of these values.
	 *     When 'all' is provided, it will be the equivalent of array('desktop', 'tablet', 'mobile').
	 * @return array {
	 *     @type string $markup Stringified HTML.
	 *     @type string $style Stringified CSS.
	 * }
	 */
	public function get_src( $devices = 'all' ) {
		$markup = '';
		$style = '';
		$accepted_device_list = array( 'desktop', 'tablet', 'mobile' );

		if ( 'all' === $devices ) {
			$devices = $accepted_device_list;
		}

		$devices = array_intersect( (array) $devices, $accepted_device_list );

		if ( empty( $devices ) ) {
			return compact( 'markup', 'style' );
		}

		foreach ( $devices as $device_name ) {
			$rendered = $this->get_device_src( $device_name );

			$markup .= sprintf( '<div class="%s">', esc_attr( "hb-device hb-$device_name" ) );
			$markup .= $rendered['markup'];
			$markup .= '</div>';

			$style .= $rendered['style'];
		}

		return compact( 'markup', 'style' );
	}

	/**
	 * Output the header builder front-end set for a specific device.
	 *
	 * @since 5.9.0
	 *
	 * @see get_row_src()
	 *
	 * @param string $device_name Device name. Accepts 'desktop', 'tablet', 'mobile'.
	 * @return array {
	 *     @type string $markup Stringified HTML.
	 *     @type string $style Stringified CSS.
	 * }
	 */
	public function get_device_src( $device_name ) {
		$device_model = array_safe_get( $this->model, $device_name, array() );

		$current_device_model = array_safe_get( $device_model, 'present', array() );

		$rows = array_safe_get( $current_device_model, 'rows', array() );
		$options = array_safe_get( $current_device_model, 'options', array() );
		$fullwidth = array_safe_get( $options, 'fullWidth', false );

		$markup = '';
		$style = '';

		foreach ( $rows as $row_index => $row_model ) {
			$rendered = $this->get_row_src( $row_model, $row_index, $fullwidth );

			$markup .= $rendered['markup'];
			$style .= $rendered['style'];
		}

		$markup .= '';

		return compact( 'markup', 'style' );
	}

	/**
	 * Output the header builder front-end set for a specific row.
	 *
	 * @since 5.9.0
	 * @since 5.9.4 Add $hb_customize property on row constructor.
	 *
	 * @see get_column_src()
	 *
	 * @param array  $row {
	 *     The data to transform into a single row of columns in the front-end.
	 *
	 *     @type string $type Type of element. Value of 'Row'.
	 *     @type string $caption Caption of element. Value of 'Row'.
	 *     @type string $category Category of element. Value of 'Row'.
	 *     @type string $id Unique ID for this element.
	 *     @type array $columns Array of columns, each containing an array of its own elements.
	 * }
	 * @param string $row_index Numeric index for the row.
	 * @param string $fullwidth Type of the row container width.
	 * @return array {
	 *     @type string $markup Stringified HTML.
	 *     @type string $style Stringified CSS.
	 * }
	 */
	public function get_row_src( array $row, $row_index, $fullwidth ) {
		$style = '';
		$markup = '';
		$columns = array_safe_get( $row, 'columns', array(
			array(
				'width' => 12,
			),
		) );

		if ( empty( $columns ) || ! is_numeric( $row_index ) ) {
			return compact( 'markup', 'style' );
		}

		// Gather the column content.
		$markup_content = '';
		$style_content = '';
		foreach ( $columns as $column_index => $column_model ) {
			$rendered = $this->get_column_src( $column_model, $row_index, $column_index );

			$markup_content .= $rendered['markup'];
			$style_content  .= $rendered['style'];
		}

		// Construct dynamic class name from element type.
		$for_class = sanitize_key( array_safe_get( $row, 'type' ) );
		$for_file  = sanitize_key( array_safe_get( $row, 'type' ) );

		$class_name = 'HB_Element_' . ucwords( $for_class );
		$class_file = HB_INCLUDES_DIR . '/elements/class-hb-element-' . strtolower( $for_file ) . '.php';

		// Render row markup and style.
		$rendered = array();
		if ( ! class_exists( $class_name ) ) {
			if ( ! file_exists( $class_file ) ) {
				return compact( 'markup','style' );
			}

			include_once( $class_file );
		}

		$instance = new $class_name( $row, $row_index, $markup_content, $this->hb_customize );
		$rendered = $instance->get_src();

		// Set the markup and style values.
		$markup = sprintf(
			'<div id="%s" class="hb-row %s hb-equal-height-columns">
				<div class="%s">
				%s
				</div>
				<div class="clearfix"></div>
			</div>',
			array_safe_get( $row, 'id', '' ),
			esc_attr( 'hb-row-' . $row_index ),
			esc_attr( 'hb-container' . ( $fullwidth ? '-fluid' : '' ) ),
			$markup_content
		);
		$style  = $rendered['style'];

		// Then merge with current content and style of columns.
		$style .= $style_content;

		return compact( 'markup', 'style' );
	}

	/**
	 * Output the header builder front-end set for a specific column.
	 *
	 * @since 5.9.0
	 * @since 5.9.3 Build inline container for make inline and alignment property.
	 * @since 5.9.4 Add $hb_customize property on column constructor.
	 *
	 * @see get_element_src()
	 *
	 * @param array  $column {
	 *     The data to transform into a single column in the front-end.
	 *
	 *     @type string $type Type of element. Value of 'Row'.
	 * }
	 * @param string $row_index    Numeric index for the row.
	 * @param string $column_index Numeric index for the column.
	 * @return array {
	 *     @type string $markup Stringified HTML.
	 *     @type string $style Stringified CSS.
	 * }
	 */
	public function get_column_src( array $column, $row_index, $column_index ) {
		$elements = array_safe_get( $column, 'elements', array() );
		$markup = '';
		$style = '';

		if ( ! is_numeric( $row_index ) || ! is_numeric( $column_index ) ) {
			return  compact( 'markup', 'style' );
		}

		// Variables declaration for inline container.
		$inline_container = false;
		$column_content = '';
		$inline_element = array(
			'left' => '',
			'center' => '',
			'right' => '',
		);
		$count_elements = count( $elements );

		foreach ( $elements as $element_index => $element_model ) {
			// Reduce element numbers on each iteration.
			--$count_elements;
			$rendered = $this->get_element_src( $element_model, $row_index, $column_index, $element_index );

			$style .= $rendered['style'];

			// MANDATORY: Check display is exist or not.
			$element_display = ! empty( $element_model['options']['cssDisplay'] ) ? $element_model['options']['cssDisplay'] : 'block';

			// MANDATORY: If display is inline.
			if ( 'inline' === $element_display ) {
				$element_align = ! empty( $element_model['options']['alignment'] ) ? $element_model['options']['alignment'] : 'left';
				$element_align = ( 'initial' === $element_align ) ? 'left' : $element_align;

				// Save element with inline to $inline_element base on alignment.
				$inline_element[ $element_align ] .= $rendered['markup'];

				// Clear recent markup.
				$rendered['markup'] = '';
				$inline_container = true;
			}

			// MANDATORY: If inline container exist, place all the elements, and close container.
			if ( true === $inline_container && ( 'block' === $element_display || $count_elements <= 0 ) ) {
				// Inline container is exist, place all the elements, and close container.
				$column_content .= $this->set_inline_container( $inline_element );

				// Close container and set inline_container is false (closed).
				$inline_container = false;
				$inline_element   = array(
					'left' => '',
					'center' => '',
					'right' => '',
				);
			}

			$column_content .= $rendered['markup'];
		}// End foreach().

		// Check vertical alignment.
		$vertical_align = ( ! empty( $column['options']['verticalAlignment'] ) ) ? $column['options']['verticalAlignment'] : 'middle';

		$markup = sprintf( '
			<div class="hb-col-md-%s hb-col-align__%s" id="%s">
				<div class="hb-col-container">%s</div>
			</div>',
			$column['width'],
			$vertical_align,
			$column['id'],
			$column_content
		);

		$markup_content = '';
		$style_content = '';
		// Construct dynamic class name from element type.
		$for_class = sanitize_key( array_safe_get( $column, 'category' ) );
		$for_file  = sanitize_key( array_safe_get( $column, 'category' ) );

		$class_name = 'HB_Element_' . ucwords( $for_class );
		$class_file = HB_INCLUDES_DIR . '/elements/class-hb-element-' . strtolower( $for_file ) . '.php';

		// Render row markup and style.
		$rendered = array();
		if ( ! class_exists( $class_name ) ) {
			if ( ! file_exists( $class_file ) ) {
				return compact( 'markup','style' );
			}

			include_once( $class_file );
		}

		$instance = new $class_name( $column, $column_index, $markup_content, $this->hb_customize );
		$rendered = $instance->get_src();
		$style_content  .= $rendered['style'];

		// Then merge with current content and style of columns.
		$style .= $style_content;

		return compact( 'markup', 'style' );
	}

	/**
	 * Output the header builder front-end set for a specific element type.
	 *
	 * @since 5.9.0
	 * @since 5.9.4 Add $hb_customize property on elements constructor.
	 *
	 * @param array  $element {
	 *     The data to transform into a single column in the front-end.
	 *
	 *     @type string $type Type of element. Value of 'Row'.
	 *
	 * }
	 * @param string $row_index     Nth row to render (0 indexed).
	 * @param string $column_index  Nth column to render (0 indexed).
	 * @param string $element_index Nth column to render (0 indexed).
	 * @return array {
	 *     @type string $markup Stringified HTML.
	 *     @type string $style Stringified CSS.
	 * }
	 */
	public function get_element_src( array $element, $row_index, $column_index, $element_index ) {
		$style = '';
		$markup = '';

		if ( ! isset( $element['type'] ) ||
			! is_string( $element['type'] ) ||
			! is_numeric( $row_index ) ||
			! is_numeric( $column_index ) ||
			! is_numeric( $element_index ) ) {
			return compact( 'markup', 'style' );
		}

		// Construct dynamic class name from element type.
		$for_class = str_replace( '-', '_', sanitize_key( $element['type'] ) );
		$for_file = str_replace( '_', '-', sanitize_key( $element['type'] ) );

		$class_name = 'HB_Element_' . ucwords( $for_class, '_' );
		$class_file = HB_INCLUDES_DIR . '/elements/class-hb-element-' . strtolower( $for_file ) . '.php';

		if ( ! class_exists( $class_name ) ) {
			if ( ! file_exists( $class_file ) ) {
				return compact( 'markup','style' );
			}

			include_once( $class_file );
		}

		$element_instance = new $class_name( $element, $row_index, $column_index, $element_index, $this->hb_customize );

		return $element_instance->get_src();
	}

	/**
	 * Set inline container.
	 *
	 * @since 5.9.3
	 * @since 5.9.4 Check if the center container is not empty but both of the side are empty.
	 *
	 * @param array $inline_element Inline content.
	 */
	public function set_inline_container( $inline_element ) {
		// Default container.
		$left_container = '<div class="hb-inline-container__left">' . $inline_element['left'] . '</div>';
		$right_container = '<div class="hb-inline-container__right">' . $inline_element['right'] . '</div>';
		$center_container = '<div class="hb-inline-container__center">' . $inline_element['center'] . '</div>';

		// Remove center if it's empty. Also check both of left and right side.
		if ( empty( $inline_element['center'] ) ) {
			$center_container = '';

			if ( empty( $inline_element['left'] ) ) {
				$left_container = '';
			}

			if ( empty( $inline_element['right'] ) ) {
				$right_container = '';
			}
		}

		// Clear left and right when both of them are empty and center is not empty.
		if ( empty( $inline_element['left'] ) && empty( $inline_element['right'] ) ) {
			$left_container = '';
			$right_container = '';
		}

		$column_content = sprintf( '
			<div class="hb-inline-container">%s %s %s</div>',
			$left_container,
			$center_container,
			$right_container
		);

		return $column_content;
	}
}

// @todo This HB_Grid should be declared only once.
new HB_Grid( new HB_Customize() );
