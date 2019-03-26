<?php
/**
 * Header Builder: HB_Element_Logo class.
 *
 * @package Header_Builder
 * @subpackage Elements_Generator
 * @since 5.9.0
 */

/**
 * Main class used for rendering 'Logo' element to the front end.
 *
 * @since 5.9.0 Introduced.
 * @since 5.9.3 Remove get_direction function, add alignment, and make inline properties.
 * @since 5.9.4 Use $hb_customize property to load HB_Customize instance.
 *
 * @see HB_Element
 */
class HB_Element_Logo extends HB_Element {
	/**
	 * Constructor.
	 *
	 * @since 5.9.0
	 * @since 5.9.4 Add $hb_customize property on constructor.
	 *
	 * @param array  $element {
	 *     The data to transform into HTML/CSS.
	 *
	 *     @type string $type
	 *     @type string $caption
	 *     @type string $id
	 *     @type string $category
	 *     @type array $options {
	 *           Array of element CSS properties and other settings.
	 *
	 *           @type string $width        The width of the logo. Defaults to 48.
	 *           @type string $height       The height of the logo. Defaults to 48.
	 *           @type string $linkHomepage Link the logo to Homepage. Defaults to false.
	 *           @type string $margin       The margin of the logo. Defaults to 0px.
	 *           @type string $padding      The padding of the logo. Defaults to 0px.
	 *           @type string $alignment    The logo alignment of the logo. Defaults to auto.
	 *           @type string $cssDisplay   The logo display. Defaults to block.
	 *     }
	 * }
	 * @param int    $row_index     Numeric index for the row.
	 * @param int    $column_index  Numeric index for the column.
	 * @param int    $element_index Numeric index for the element.
	 * @param object $hb_customize  HB_Costumize instance.
	 */
	public function __construct( array $element, $row_index, $column_index, $element_index, $hb_customize ) {
		parent::__construct( $element, $row_index, $column_index, $element_index, $hb_customize );

		// Declare properties value.
		$this->width   = $this->get_option( 'width', 200 );
		$this->height  = $this->get_option( 'height', 'auto' );
		$this->padding = $this->get_option( 'padding', array(
			'top'    => 0,
			'right'  => 0,
			'bottom' => 0,
			'left'   => 0,
		) );
		$this->margin  = $this->get_option( 'margin', array(
			'top'    => 0,
			'right'  => 0,
			'bottom' => 0,
			'left'   => 0,
		) );
		$this->image_src     = $this->get_logo_src();
		$this->description   = get_bloginfo( 'description' );
		$this->link_homepage = $this->get_option( 'linkHomepage', true );
		$this->align   = $this->get_option( 'alignment', 'left' );
		$this->inline  = $this->get_option( 'cssDisplay', 'block' );

		// Enqueue the search style and HB script.
		add_action( 'wp_enqueue_scripts', array( &$this, 'enqueue_scripts' ) );

	}

	/**
	 * Enqueue image style and HB script.
	 *
	 * @since 5.9.3
	 */
	public function enqueue_scripts() {
		wp_enqueue_style( 'hb-image', HB_ELEMENTS_ASSETS_URI . 'css/hb-image.css', array(), '5.9.3' );
	}

	/**
	 * Generate the element's markup and style for use on the front-end.
	 *
	 * @since 5.9.0
	 * @since 5.9.3 Add alignment and make inline properties.
	 *
	 * @return array {
	 *      HTML and CSS for the element, based on all its given properties and settings.
	 *
	 *      @type string $markup Element HTML code.
	 *      @type string $style Element CSS code.
	 * }
	 */
	public function get_src() {
		// Logo link homepage.
		$link = '';
		if ( true === $this->link_homepage ) {
			$link = $this->hb_customize->attributes->get_attr( 'href', get_home_url() );
		}

		// Logo width.
		$width = $this->hb_customize->attributes->get_height_width( 'width', $this->width );
		$width_attr  = $width['attr'];
		$width_style = $width['style'];

		// Logo height.
		$height = $this->hb_customize->attributes->get_height_width( 'height', $this->height );
		$height_attr  = $height['attr'];
		$height_style = $height['style'];

		// Logo Margin and Padding.
		$padding = $this->hb_customize->layout->trbl( $this->padding );
		$margin  = $this->hb_customize->layout->trbl( $this->margin );

		// Logo inline block.
		$inline = $this->hb_customize->layout->inline_block( $this->inline );

		$markup = sprintf( '
			<div id="%s" class="hb-image-el hb-logo-el">
				<a %s class="hb-image-el__link">
					<img class="hb-image-el__image" title="%s" alt="%s" src="%s" %s %s />
				</a>
			</div>',
			esc_attr( $this->id ),
			$link,
			esc_attr( $this->description ),
			esc_attr( $this->description ),
			esc_url( $this->image_src ),
			$width_attr,
			$height_attr
		);

		$style = "
			#{$this->id} {
				text-align: {$this->align};
				margin: {$margin};
				padding: {$padding};
				{$inline}
			}
		";

		// Logo default value if user didn't set any value of width/height.
		if ( ! empty( $width_style ) || ! empty( $height_style ) ) {
			$style .= "
			#{$this->id} .hb-image-el__image {
				{$height_style}
				{$width_style}
			}";
		}

		return compact( 'markup', 'style' );
	}

	/**
	 * Temporary solution to get the logo image. There are several.
	 *
	 * @since 5.9.0
	 *
	 * @return string Logo image source URL.
	 */
	private function get_logo_src() {

		$options  = get_option( THEME_OPTIONS );

		$logo_src = THEME_IMAGES . '/jupiter-logo.png';
		if ( ! empty( $options['logo'] ) ) {
			$logo_src = $options['logo'];
		}

		return $logo_src;
	}

}
