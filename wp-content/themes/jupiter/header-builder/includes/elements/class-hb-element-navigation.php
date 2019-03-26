<?php
/**
 * Header Builder: HB_Element_Navigation class.
 *
 * All PHPMD warnings are suppressed because some of these codes only temporary solution. We have
 * separated branch to fix all these issues. Can't merge it yet because we have so many changes
 * and potentially make some conflicts.
 *
 * @package Header_Builder
 * @subpackage Elements_Generator
 * @since 5.9.0
 */

/**
 * Main class used for rendering 'Navigation' element to the front end.
 *
 * @since 5.9.0
 * @since 5.9.1 Add new default value and create basic structure.
 * @since 5.9.2 Refactor full basic structure and enqueue assets.
 * @since 5.9.3 Add alignment and make inline properties.
 * @since 5.9.4 Simplify enqueue font family by using $hb_tags->enqueue_fonts() function, use
 *              $hb_customize property to load HB_Customize instance.
 *
 * @see HB_Element
 *
 * @SuppressWarnings(PHPMD)
 */
class HB_Element_Navigation extends HB_Element {

	/**
	 * Z-index of menus.
	 *
	 * @var integer
	 */
	static $tid = 0;

	/**
	 * Generate markup and style for the 'Navigation' element.
	 *
	 * @since 5.9.0
	 * @since 5.9.1 Add new default values.
	 * @since 5.9.3 Update the default values.
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
	 *           @type string $menu
	 *           @type string $padding
	 *           @type string $margin
	 *           @type string $textFontFamily
	 *           @type string $textWeight
	 *           @type string $textSize
	 *           @type string $textColor
	 *           @type string $textBackgroundColor
	 *           @type string $textHoverColor
	 *           @type string $textHoverBackgroundColor
	 *           @type string $subMenuTextHoverColor
	 *           @type string $subMenuTextHoverBackgroundColor
	 *           @type string $subMenuTextWeight
	 *           @type string $subMenuTextSize
	 *           @type string $subMenuTextColor
	 *           @type string $subMenuTextBackgroundColor
	 *           @type string $border
	 *           @type string $textHoverBorder
	 *           @type string $alignment
	 *           @type string $cssDisplay
	 *           @type string $textCornerRadius
	 *           @type string $hoverStyle
	 *     }
	 * }
	 * @param int    $row_index     Numeric index for the row.
	 * @param int    $column_index  Numeric index for the column.
	 * @param int    $element_index Numeric index for the element.
	 * @param object $hb_customize  HB_Costumize instance.
	 */
	public function __construct( array $element, $row_index, $column_index, $element_index, $hb_customize ) {
		parent::__construct( $element, $row_index, $column_index, $element_index, $hb_customize );
		self::$tid++;

		// Declare properties value.
		$this->menu = $this->get_option( 'menu', 'navigation-preview' );
		$this->padding = $this->get_option( 'padding', array(
			'top' => 10,
			'right' => 20,
			'bottom' => 10,
			'left' => 20,
		) );
		$this->margin  = $this->get_option( 'margin', array(
			'top' => 0,
			'right' => 0,
			'bottom' => 0,
			'left' => 0,
		) );
		$this->font_family = $this->get_option( 'textFontFamily', array(
			'value' => 'Open+Sans',
			'type' => 'google',
			'label' => 'Open Sans',
		) );
		$this->text_weight = $this->get_option( 'textWeight', 400 );
		$this->text_size   = $this->get_option( 'textSize', 13 );
		$this->text_color  = $this->get_option( 'textColor', array(
			'r' => 34,
			'g' => 34,
			'b' => 34,
			'a' => 1,
		) );
		$this->text_bg_color = $this->get_option( 'textBackgroundColor', array(
			'r' => 255,
			'g' => 255,
			'b' => 255,
			'a' => 0,
		) );
		$this->text_hover_color    = $this->get_option( 'textHoverColor', array(
			'r' => 68,
			'g' => 68,
			'b' => 68,
			'a' => 1,
		) );
		$this->text_hover_bg_color = $this->get_option( 'textHoverBackgroundColor', array(
			'r' => 179,
			'g' => 229,
			'b' => 252,
			'a' => 1,
		) );
		$this->sub_text_hover_color    = $this->get_option( 'subMenuTextHoverColor', array(
			'r' => 68,
			'g' => 68,
			'b' => 68,
			'a' => 1,
		) );
		$this->sub_text_hover_bg_color = $this->get_option( 'subMenuTextHoverBackgroundColor', array(
			'r' => 179,
			'g' => 229,
			'b' => 252,
			'a' => 1,
		) );
		$this->sub_text_weight = $this->get_option( 'subMenuTextWeight', 400 );
		$this->sub_text_size   = $this->get_option( 'subMenuTextSize', 12 );
		$this->sub_text_color  = $this->get_option( 'subMenuTextColor', array(
			'r' => 85,
			'g' => 85,
			'b' => 85,
			'a' => 1,
		) );
		$this->sub_bg_color    = $this->get_option( 'subMenuTextBackgroundColor', array(
			'r' => 255,
			'g' => 255,
			'b' => 255,
			'a' => 1,
		) );
		$this->menu_border  = $this->get_option( 'border', array(
			'top' => array(
				'width' => 2,
				'color' => array(
					'r' => 129,
					'g' => 212,
					'b' => 250,
					'a' => 1,
				),
			),
			'right' => array(
				'width' => 2,
				'color' => array(
					'r' => 129,
					'g' => 212,
					'b' => 250,
					'a' => 1,
				),
			),
			'bottom' => array(
				'width' => 2,
				'color' => array(
					'r' => 129,
					'g' => 212,
					'b' => 250,
					'a' => 1,
				),
			),
			'left' => array(
				'width' => 2,
				'color' => array(
					'r' => 129,
					'g' => 212,
					'b' => 250,
					'a' => 1,
				),
			),
		) );
		$this->menu_border_hover  = $this->get_option( 'textHoverBorder', array(
			'top' => array(
				'width' => 2,
				'color' => array(
					'r' => 129,
					'g' => 212,
					'b' => 250,
					'a' => 1,
				),
			),
			'right' => array(
				'width' => 2,
				'color' => array(
					'r' => 129,
					'g' => 212,
					'b' => 250,
					'a' => 1,
				),
			),
			'bottom' => array(
				'width' => 2,
				'color' => array(
					'r' => 129,
					'g' => 212,
					'b' => 250,
					'a' => 1,
				),
			),
			'left' => array(
				'width' => 2,
				'color' => array(
					'r' => 129,
					'g' => 212,
					'b' => 250,
					'a' => 1,
				),
			),
		) );
		$this->align   = $this->get_option( 'alignment', 'left' );
		$this->inline  = $this->get_option( 'cssDisplay', 'block' );
		$this->menu_radius = $this->get_option( 'textCornerRadius', 6 );
		$this->hover_style = $this->get_option( 'hoverStyle', 1 );

		add_action( 'wp_enqueue_scripts', array( &$this, 'enqueue_scripts' ) );
	}

	/**
	 * Enqueue fonts for navigation.
	 *
	 * @since 5.9.2
	 * @since 5.9.4 Simplify enqueue font family by using $hb_tags->enqueue_fonts() function.
	 */
	public function enqueue_scripts() {
		$this->hb_customize->tags->enqueue_fonts( 'navigation', $this->font_family, $this->text_weight );
		wp_enqueue_style( 'hb-navigation', HB_ELEMENTS_ASSETS_URI . 'css/hb-navigation.css', array(), '5.9.2' );
		wp_enqueue_script( 'hb-navigation-scripts', HB_ELEMENTS_ASSETS_URI . 'js/hb-navigation-scripts.js', array( 'jquery' ), '5.9.2', true );
		wp_enqueue_script( 'hb-navigation', HB_ELEMENTS_ASSETS_URI . 'js/hb-navigation.js', array( 'jquery' ), '5.9.2', true );
	}

	/**
	 * Generate the element's markup and style for use on the front-end.
	 *
	 * @since 5.9.0
	 * @since 5.9.1 Create basic structure.
	 * @since 5.9.2 Refactor full structure.
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
		// Properties.
		$menu = $this->menu;
		$menu_hover_style = $this->hover_style;

		// Style - Menu.
		$menu_text_font_family = '';
		if ( ! empty( $this->font_family['label'] ) ) {
			$menu_text_font_family = 'font-family: ' . $this->font_family['label'] . ';';
		}
		$menu_text_weight = $this->text_weight;
		$menu_text_size   = $this->text_size;
		$menu_text_color  = $this->hb_customize->css->rgba( $this->text_color );
		$menu_text_background_color = $this->hb_customize->css->background( $this->hb_customize->transforms->background_layers( array( $this->text_bg_color ) ) );

		// Style - Menu Hover Settings.
		$menu_text_hover_color = $this->hb_customize->css->rgba( $this->text_hover_color );
		$menu_text_hover_background_color = $this->hb_customize->css->background( $this->hb_customize->transforms->background_layers( array( $this->text_hover_bg_color ) ) );
		$menu_text_border_settings = $this->hb_customize->css->border( $this->menu_border );
		$menu_text_hover_border_settings  = $this->hb_customize->css->border( $this->menu_border_hover );
		$menu_text_corner_radius   = $this->menu_radius;

		// Style - Sub Menu.
		$sub_menu_text_color  = $this->hb_customize->css->rgba( $this->sub_text_color );
		$sub_menu_text_weight = $this->sub_text_weight;
		$sub_menu_text_background_color = $this->hb_customize->css->background( $this->hb_customize->transforms->background_layers( array( $this->sub_bg_color ) ) );
		$sub_menu_text_size   = $this->sub_text_size;

		// Style - Sub Menu Hover Settings.
		$sub_menu_text_hover_color = $this->hb_customize->css->rgba( $this->sub_text_hover_color );
		$sub_menu_text_hover_background_color = $this->hb_customize->css->background( $this->hb_customize->transforms->background_layers( array( $this->sub_text_hover_bg_color ) ) );

		// Layout.
		$menu_padding = $this->hb_customize->layout->trbl( $this->padding );
		$menu_margin  = $this->hb_customize->layout->trbl( $this->margin );

		$sub_menu_offset_left = $this->margin['left'] . 'px';

		// Set z-index position.
		$z_index = 301 - self::$tid;

		// Set inline block.
		$inline = $this->hb_customize->layout->inline_block( $this->inline );

		if ( 'navigation-preview' === $menu ) {
			$menu = '<nav class="hb-navigation hb-js-nav">
				<ul class="hb-navigation-ul dropdownJavascript">
					<li class="menu-item current-menu-item current_page_item hb-no-mega-menu">
						<a href="#" class="menu-item-link hb-js-smooth-scroll">Current Menu</a>
					</li>
					<li class="menu-item hb-has-mega-menu">
						<a href="#" class="menu-item-link hb-js-smooth-scroll">Menu</a>
					</li>
					<li class="menu-item menu-item-has-children hb-no-mega-menu">
						<a href="#" class="menu-item-link hb-js-smooth-scroll">Menu</a>
						<ul class="sub-menu">
							<li class="menu-item"><a href="#" class="menu-item-link hb-js-smooth-scroll">Menu</a></li>
							<li class="menu-item"><a href="#" class="menu-item-link hb-js-smooth-scroll">Menu</a></li>
						</ul>
					</li>
				</ul>
			</nav>';
		} else {
			if ( isset( $_GET['header-builder'] ) && 'preview' === $_GET['header-builder'] ) { // WPCS: XSS ok, CSRF ok.
				add_filter( 'wp_nav_menu', 'hb_active_current_menu_item' );
			}
			$menu = wp_nav_menu( array(
				'menu' => $menu,
				'container' => 'nav',
				'container_class' => 'hb-navigation hb-js-main-nav',
				'menu_class' => 'hb-navigation-ul',
				'echo' => false,
				'fallback_cb' => 'mk_link_to_menu_editor',
				'walker' => new hb_main_menu,
			) );
			remove_filter( 'wp_nav_menu', 'hb_active_current_menu_item' );
		}
		$markup = sprintf( '
			<div id="%s" class="hb-nav-container hb-menu-hover-style-%s">
				%s
			</div>',
			esc_attr( $this->id ),
			esc_attr( $menu_hover_style ),
			$menu
		);

		$style = "
			/* COMMON STYLES */
			#{$this->id}.hb-nav-container {
				{$menu_text_font_family}
				z-index: {$z_index};
				text-align: {$this->align};
				{$inline}
			}

			/* Main menu */
			#{$this->id} .hb-navigation-ul > li.menu-item > a.menu-item-link {
				color: {$menu_text_color};
				padding: {$menu_padding};
				font-size: {$menu_text_size}px;
				font-weight: {$menu_text_weight};
				margin: {$menu_margin};
			}

			/* Hover Style 1 */
			#{$this->id}.hb-menu-hover-style-1 .hb-navigation-ul > li.menu-item > a.menu-item-link {
				margin: auto;
			}
			#{$this->id}.hb-menu-hover-style-1 .hb-navigation-ul > li.menu-item {
				margin: {$menu_margin};
			}
			#{$this->id}.hb-menu-hover-style-1 .hb-navigation-ul>li.menu-item:before {
				{$menu_text_background_color}
			}
			#{$this->id}.hb-menu-hover-style-1 .hb-navigation-ul > li.menu-item > a.menu-item-link:hover,
			#{$this->id}.hb-menu-hover-style-1 .hb-navigation-ul > li.menu-item:hover > a.menu-item-link,
			#{$this->id}.hb-menu-hover-style-1 .hb-navigation-ul > li.current-menu-item > a.menu-item-link,
			#{$this->id}.hb-menu-hover-style-1 .hb-navigation-ul > li.current-menu-ancestor > a.menu-item-link {
				color: {$menu_text_hover_color};
			}
			#{$this->id}.hb-menu-hover-style-1 .hb-navigation-ul > li.dropdownOpen:before,
			#{$this->id}.hb-menu-hover-style-1 .hb-navigation-ul > li.active:before,
			#{$this->id}.hb-menu-hover-style-1 .hb-navigation-ul > li.open:before,
			#{$this->id}.hb-menu-hover-style-1 .hb-navigation-ul > li.menu-item:hover:before,
			#{$this->id}.hb-menu-hover-style-1 .hb-navigation-ul > li.current-menu-item:before,
			#{$this->id}.hb-menu-hover-style-1 .hb-navigation-ul > li.current-menu-ancestor:before {
				{$menu_text_hover_background_color}
			}

			/* Hover Style 2 */
			#{$this->id}.hb-menu-hover-style-2 .hb-navigation-ul>li.menu-item>a {
				{$menu_text_background_color}
			}
			#{$this->id}.hb-menu-hover-style-2 .hb-navigation-ul > li.menu-item > a.menu-item-link:hover,
			#{$this->id}.hb-menu-hover-style-2 .hb-navigation-ul > li.menu-item:hover > a.menu-item-link,
			#{$this->id}.hb-menu-hover-style-2 .hb-navigation-ul > li.current-menu-item > a.menu-item-link,
			#{$this->id}.hb-menu-hover-style-2 .hb-navigation-ul > li.current-menu-ancestor > a.menu-item-link {
				color: {$menu_text_hover_color};
				{$menu_text_hover_background_color}
			}

			/* Hover Style 3 */
			#{$this->id}.hb-menu-hover-style-3 .hb-navigation-ul>li.menu-item>a {
				{$menu_text_background_color}
				{$menu_text_border_settings}
				border-radius: {$menu_text_corner_radius}px;
			}
			#{$this->id}.hb-menu-hover-style-3 .hb-navigation-ul > li.menu-item > a.menu-item-link:hover,
			#{$this->id}.hb-menu-hover-style-3 .hb-navigation-ul > li.menu-item:hover > a.menu-item-link,
			#{$this->id}.hb-menu-hover-style-3 .hb-navigation-ul > li.menu-item:hover > a.menu-item-link,
			#{$this->id}.hb-menu-hover-style-3 .hb-navigation-ul > li.current-menu-item > a.menu-item-link,
			#{$this->id}.hb-menu-hover-style-3 .hb-navigation-ul > li.current-menu-ancestor > a.menu-item-link {
				color: {$menu_text_hover_color};
				{$menu_text_hover_background_color};
				{$menu_text_hover_border_settings};
			}

			/* Hover Style 4 */
			#{$this->id}.hb-menu-hover-style-4 .hb-navigation-ul>li.menu-item>a.menu-item-link:after {
				{$menu_text_background_color}
			}
			#{$this->id}.hb-menu-hover-style-4 .hb-navigation-ul>li.menu-item:hover>a.menu-item-link,
			#{$this->id}.hb-menu-hover-style-4 .hb-navigation-ul>li.current-menu-ancestor>a.menu-item-link,
			#{$this->id}.hb-menu-hover-style-4 .hb-navigation-ul>li.current-menu-item>a.menu-item-link {
				color: {$menu_text_hover_color};
			}
			#{$this->id}.hb-menu-hover-style-4 .hb-navigation-ul>li.menu-item:hover>a.menu-item-link::after,
			#{$this->id}.hb-menu-hover-style-4 .hb-navigation-ul>li.current-menu-ancestor>a.menu-item-link:after,
			#{$this->id}.hb-menu-hover-style-4 .hb-navigation-ul>li.current-menu-item>a.menu-item-link:after {
				{$menu_text_hover_background_color}
			}

			/* Sub menu */
			#{$this->id} .hb-navigation ul.sub-menu a.menu-item-link {
				color: {$sub_menu_text_color};
				font-size: {$sub_menu_text_size}px;
				font-weight: {$sub_menu_text_weight};
			}
			#{$this->id} .hb-navigation li.hb-no-mega-menu ul.sub-menu {
				{$sub_menu_text_background_color}
			}

			#{$this->id} .hb-navigation-ul > li.hb-no-mega-menu > ul.sub-menu {
				left: {$sub_menu_offset_left};
			}

			#{$this->id} .hb-navigation ul.sub-menu a.menu-item-link:hover,
			#{$this->id} .hb-navigation-ul ul.sub-menu li.current-menu-item > a.menu-item-link,
			#{$this->id} .hb-navigation-ul ul.sub-menu li.current-menu-parent > a.menu-item-link {
				{$sub_menu_text_hover_background_color}
				color: {$sub_menu_text_hover_color};
			}
		";
		return compact( 'markup', 'style' );
	}

}
