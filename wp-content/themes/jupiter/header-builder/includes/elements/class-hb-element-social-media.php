<?php
/**
 * Header Builder: HB_Element_Social_Media class.
 *
 * @package Header_Builder
 * @subpackage Elements_Generator
 * @since 5.9.0
 */

/**
 * Main class used for rendering 'Social Media' element to the front end.
 *
 * @SuppressWarnings(PHPMD.StaticAccess)
 *
 * @since 5.9.0
 * @since 5.9.4 Use $hb_customize property to load HB_Customize instance, implement some new properties,
 *              use $hb_customize property to load HB_Customize instance.
 *
 * @see HB_Element
 */
class HB_Element_Social_Media extends HB_Element {
	/**
	 * Generate markup and style for the 'Social Media' element.
	 *
	 * @since 5.9.0
	 * @since 5.9.4 Add some new properties, add $hb_customize property on constructor.
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
	 *           @type string $icons     Social networks list.
	 *           @type string $target         Target URL. Default to '_self'.
	 *           @type string $alignment      Text element horizontal aligment. Default to 'left'.
	 *           @type string $cssDisplay     Text element vertical aligment. Default to 'top'.
	 *           @type string $iconSize       Icon size. Default to 16.
	 *           @type string $iconColor      Icon color.
	 *           @type string $iconHoverColor Icon hover color.
	 *           @type string $border         Icon border color.
	 *           @type string $iconHoverBorderColor Icon hover border color.
	 *           @type string $iconBackgroundColor  Icon background color.
	 *           @type string $spaceBetweenIcons    Space between icons. Default to 10.
	 *           @type string $iconCornerRadius     Icon background border radius.
	 *           @type string $iconHoverBackgroundColor Icon background color.
	 *           @type string $padding        The element padding layout.
	 *           @type string $margin         The element margin layout.
	 *     }
	 * }
	 * @param int    $row_index     Numeric index for the row.
	 * @param int    $column_index  Numeric index for the column.
	 * @param int    $element_index Numeric index for the element.
	 * @param object $hb_customize  HB_Costumize instance.
	 */
	public function __construct( array $element, $row_index, $column_index, $element_index, $hb_customize ) {
		parent::__construct( $element, $row_index, $column_index, $element_index, $hb_customize );
		$this->icons = $this->get_option( 'icons', array() );
		$this->target = $this->get_option( 'target', '_self' );
		$this->align = $this->get_option( 'alignment', 'left' );
		$this->inline = $this->get_option( 'cssDisplay', 'inline' );
		$this->icon_size = $this->get_option( 'iconSize', 16 );
		$this->icon_color = $this->get_option( 'iconColor', array(
			'r' => 238,
			'g' => 238,
			'b' => 238,
			'a' => 1,
		) );
		$this->icon_hover_color = $this->get_option( 'iconHoverColor', array(
			'r' => 238,
			'g' => 238,
			'b' => 238,
			'a' => 1,
		) );
		$this->border_color = $this->get_option( 'border', array(
			'active' => 'top',
			'top' => array(
				'width' => 0,
				'color' => array(
					'r' => 255,
					'g' => 255,
					'b' => 255,
					'a' => 1,
				),
			),
			'right' => array(
				'width' => 0,
				'color' => array(
					'r' => 255,
					'g' => 255,
					'b' => 255,
					'a' => 1,
				),
			),
			'bottom' => array(
				'width' => 0,
				'color' => array(
					'r' => 255,
					'g' => 255,
					'b' => 255,
					'a' => 1,
				),
			),
			'left' => array(
				'width' => 0,
				'color' => array(
					'r' => 255,
					'g' => 255,
					'b' => 255,
					'a' => 1,
				),
			),
		) );
		$this->border_hover_color = $this->get_option( 'iconHoverBorderColor', array(
			'r' => 255,
			'g' => 255,
			'b' => 255,
			'a' => 0,
		) );
		$this->bg_color = $this->get_option( 'iconBackgroundColor', array(
			'r' => 238,
			'g' => 238,
			'b' => 238,
			'a' => 1,
		) );
		$this->bg_hover_color = $this->get_option( 'iconHoverBackgroundColor', array(
			'r' => 153,
			'g' => 153,
			'b' => 153,
			'a' => 1,
		) );
		$this->space = $this->get_option( 'spaceBetweenIcons', 10 );
		$this->padding = $this->get_option( 'padding', array(
			'top' => 5,
			'right' => 5,
			'bottom' => 5,
			'left' => 5,
		) );
		$this->margin = $this->get_option( 'margin', array(
			'top' => 0,
			'right' => 0,
			'bottom' => 0,
			'left' => 0,
		) );
		$this->border_radius = $this->get_option( 'iconCornerRadius', 2 );

		// Enqueue the search style and HB script.
		add_action( 'wp_enqueue_scripts', array( &$this, 'enqueue_scripts' ) );
	}

	/**
	 * Enqueue image style and HB script.
	 *
	 * @since 5.9.4
	 */
	public function enqueue_scripts() {
		wp_enqueue_style( 'hb-social-media', HB_ELEMENTS_ASSETS_URI . 'css/hb-social-media.css', array(), '5.9.4' );
	}

	/**
	 * Generate the element's markup and style for use on the front-end.
	 *
	 * @since 5.9.0
	 * @since 5.9.4 Implement some new properties.
	 *
	 * @return array {
	 *      HTML and CSS for the element, based on all its given properties and settings.
	 *
	 *      @type string $markup Element HTML code.
	 *      @type string $style Element CSS code.
	 * }
	 */
	public function get_src() {
		// Social media inline block.
		$inline = $this->hb_customize->layout->inline_block( $this->inline );

		// Social media color.
		$icon_color = $this->hb_customize->css->rgba( $this->icon_color );
		$icon_hover_color = $this->hb_customize->css->rgba( $this->icon_hover_color );

		// Social media border.
		$border = $this->hb_customize->css->border( $this->border_color );
		$border_hover_color = $this->hb_customize->css->rgba( $this->border_hover_color );

		// Social media background.
		$bg_color = $this->hb_customize->css->rgba( $this->bg_color );
		$bg_hover_color = $this->hb_customize->css->rgba( $this->bg_hover_color );

		// Burger Menu margin and padding for last item.
		$margin_last = $this->hb_customize->layout->trbl( $this->margin );

		// Burger Menu margin and padding.
		$this->margin['right'] += $this->space;
		$display = 'inline-block';
		if ( 'block' === $this->inline ) {
			$display = 'block';
			$this->margin['right'] -= $this->space;
			$this->margin['bottom'] += $this->space;
		}
		$padding = $this->hb_customize->layout->trbl( $this->padding );
		$margin  = $this->hb_customize->layout->trbl( $this->margin );

		$icon_markup = '';
		if ( ! empty( $this->icons ) ) {
			$icon_markup .= '<ul class="hb-social-network-el__list">';

			if ( ! class_exists( 'Mk_SVG_Icons' ) ) {
				require_once THEME_HELPERS . '/svg-icons.php';
			}

			$icon_markup .= $this->render_icons();

			$icon_markup .= '</ul>';
		}

		$markup = sprintf( '
			<div id="%s" class="hb-social-network-el">%s</div>',
			esc_attr( $this->id ),
			$icon_markup
		);

		$style = "
			#{$this->id} {
				text-align: {$this->align};
				{$inline}
			}
			#{$this->id} .hb-social-network-el__item {
				display: {$display};
				margin: {$margin};
			}
			#{$this->id} .hb-social-network-el__item:last-of-type {
				margin: {$margin_last};
			}
			#{$this->id} .hb-social-network-el__link {
				color: {$icon_color};
				background: {$bg_color};
				padding: {$padding};
				border-radius: {$this->border_radius}px;
				{$border}
			}
			#{$this->id} .hb-social-network-el__link:hover {
				color: {$icon_hover_color};
				background: {$bg_hover_color};
				border-color: {$border_hover_color};
			}
		";

		return compact( 'markup', 'style' );
	}

	/**
	 * Render list of elements including target, icons, and the URL.
	 *
	 * @since 5.9.4
	 *
	 * @return string Generated icons in HTML format.
	 */
	public function render_icons() {

		// Render all social media icons.
		$icon_markup = '';
		foreach ( $this->icons as $property ) {
			$class_name = $this->get_icon_class( $property['value'] );
			$icon = Mk_SVG_Icons::get_svg_icon_by_class_name( false, $class_name, $this->icon_size );

			$icon_markup .= sprintf( '
				<li class="hb-social-network-el__item">
					<a class="hb-social-network-el__link" target="%s" href="%s">
						%s
					</a>
				</li>',
				esc_attr( $this->target ),
				esc_url( $property['link'] ),
				$icon
			);
		}

		return $icon_markup;
	}

	/**
	 * Return icon class name.
	 *
	 * @since 5.9.4
	 *
	 * @param string $key Icon name.
	 * @return string Icon class name.
	 */
	public function get_icon_class( $key ) {
		$icons = array(
			'px' => '',
			'aim' => '',
			'amazon' => '',
			'apple' => 'mk-icon-apple',
			'bebo' => '',
			'behance' => 'mk-icon-behance',
			'blogger' => 'mk-moon-blogger',
			'delicious' => 'mk-icon-delicious',
			'deviantart' => 'mk-icon-deviantart',
			'digg' => 'mk-icon-digg',
			'dribbble' => 'mk-icon-dribbble',
			'dropbox' => 'mk-icon-dropbox',
			'envato' => '',
			'facebook' => 'mk-icon-facebook',
			'flickr' => 'mk-icon-flickr',
			'github' => 'mk-icon-github',
			'google' => 'mk-icon-google',
			'googleplus' => 'mk-icon-google-plus',
			'lastfm' => 'mk-icon-lastfm',
			'linkedin' => 'mk-icon-linkedin',
			'instagram' => 'mk-icon-instagram',
			'myspace' => '',
			'path' => 'mk-icon-meanpath',
			'pinterest' => 'mk-icon-pinterest',
			'reddit' => 'mk-icon-reddit',
			'rss' => 'mk-icon-rss',
			'skype' => 'mk-icon-skype',
			'stumbleupon' => 'mk-icon-stumbleupon',
			'tumblr' => 'mk-icon-tumblr',
			'twitter' => 'mk-icon-twitter',
			'vimeo' => 'mk-moon-vimeo',
			'wordpress' => 'mk-icon-wordpress',
			'yahoo' => 'mk-icon-yahoo',
			'yelp' => 'mk-icon-yelp',
			'youtube' => 'mk-icon-youtube',
			'xing' => 'mk-icon-xing',
			'imdb' => '',
			'qzone' => '',
			'renren' => 'mk-icon-renren',
			'vk' => 'mk-icon-vk',
			'wechat' => 'mk-icon-wechat',
			'weibo' => 'mk-icon-weibo',
			'whatsapp' => '',
			'soundcloud' => 'mk-icon-soundcloud',
		);

		return $icons[ $key ];
	}
}
