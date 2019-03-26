<?php
/**
 * Customizer Settings Fields: Section Add to Cart Button Style.
 *
 * Prefix: pl -> product list, s -> styles.
 *
 * @package Jupiter
 * @subpackage MK_Customizer
 * @since 5.9.4
 */

// Section.
$wp_customize->add_section(
	new MK_Section(
		$wp_customize,
		'cs_pl_s_add_to_cart_style',
		array(
			'title'    => __( 'Add to Cart Button Style', 'mk_framework' ),
			'priority' => 70,
			'panel' => 'cs_styles',
		)
	)
);

// Text.
$wp_customize->add_setting( 'cs_pl_s_add_to_cart_style_text', array(
	'default' => __( 'Add to Cart', 'mk_framework' ),
	'transport' => 'postMessage',
) );

$wp_customize->add_control(
	new MK_Input_Control(
		$wp_customize,
		'cs_pl_s_add_to_cart_style_text',
		array(
			'section' => 'cs_pl_s_add_to_cart_style',
			'column'  => 'mk-col-8',
			'text' => __( 'Text', 'mk_framework' ),
		)
	)
);

// Show Icon.
$wp_customize->add_setting( 'cs_pl_s_add_to_cart_style_show_icon', array(
	'default' => 'true',
	'transport' => 'postMessage',
) );

$wp_customize->add_control(
	new MK_Toggle_Control(
		$wp_customize,
		'cs_pl_s_add_to_cart_style_show_icon',
		array(
			'section' => 'cs_pl_s_add_to_cart_style',
			'column'  => 'mk-col-4',
			'sublabel' => __( 'Show Icon', 'mk_framework' ),
		)
	)
);

// Typography.
$wp_customize->add_setting( 'cs_pl_s_add_to_cart_style_typography', array(
	'default' => array(
		'family' => 'inherit',
		'size' => 12, // Inherited from assets/stylesheet/plugins/min/woocommerce.css.
		'weight' => 700, // Inherited from assets/stylesheet/plugins/min/woocommerce.css.
		'style' => 'normal',
		'color' => '#fff', // Inherited from assets/stylesheet/plugins/min/woocommerce.css.
	),
	'transport' => 'postMessage',
) );

$wp_customize->add_control(
	new MK_Typography_Control(
		$wp_customize,
		'cs_pl_s_add_to_cart_style_typography',
		array(
			'section' => 'cs_pl_s_add_to_cart_style',
			'column'  => 'mk-col-12',
		)
	)
);

// Background Color.
$wp_customize->add_setting( 'cs_pl_s_add_to_cart_style_bg_color', array(
	'default'   => 'rgba(0,0,0,.9)',
	'transport' => 'postMessage',
) );

$wp_customize->add_control(
	new MK_Color_Control(
		$wp_customize,
		'cs_pl_s_add_to_cart_style_bg_color',
		array(
			'section'  => 'cs_pl_s_add_to_cart_style',
			'column'   => 'mk-col-2-alt',
			'icon'     => 'mk-background-color',
		)
	)
);

// Corner Radius.
$wp_customize->add_setting( 'cs_pl_s_add_to_cart_style_corner_radius', array(
	'default'   => 0, // Inherited from assets/stylesheet/plugins/min/woocommerce.css.
	'transport' => 'postMessage',
) );

$wp_customize->add_control(
	new MK_Input_Control(
		$wp_customize,
		'cs_pl_s_add_to_cart_style_corner_radius',
		array(
			'section'  => 'cs_pl_s_add_to_cart_style',
			'column'   => 'mk-col-3-alt',
			'icon'     => 'mk-corner-radius',
			'unit'     => 'px',
		)
	)
);

// Border.
$wp_customize->add_setting( 'cs_pl_s_add_to_cart_style_border', array(
	'default'   => 0, // Inherited from assets/stylesheet/plugins/min/woocommerce.css.
	'transport' => 'postMessage',
) );

$wp_customize->add_control(
	new MK_Input_Control(
		$wp_customize,
		'cs_pl_s_add_to_cart_style_border',
		array(
			'section'  => 'cs_pl_s_add_to_cart_style',
			'column'   => 'mk-col-3-alt',
			'icon'     => 'mk-border',
			'unit'     => 'px',
		)
	)
);

// Border Color.
$wp_customize->add_setting( 'cs_pl_s_add_to_cart_style_border_color', array(
	'default'   => '#ffffff', // Inherited from assets/stylesheet/plugins/min/woocommerce.css.
	'transport' => 'postMessage',
) );

$wp_customize->add_control(
	new MK_Color_Control(
		$wp_customize,
		'cs_pl_s_add_to_cart_style_border_color',
		array(
			'section'  => 'cs_pl_s_add_to_cart_style',
			'column'   => 'mk-col-2-alt',
			'icon'     => 'mk-border-color',
		)
	)
);

// Divider 1.
$wp_customize->add_setting( 'cs_pl_s_add_to_cart_divider_1' );

$wp_customize->add_control(
	new MK_Divider_Control(
		$wp_customize,
		'cs_pl_s_add_to_cart_divider_1',
		array(
			'section' => 'cs_pl_s_add_to_cart_style',
		)
	)
);

// Hover Label.
$wp_customize->add_setting( 'cs_pl_s_add_to_cart_label' );

$wp_customize->add_control(
	new MK_Label_Control(
		$wp_customize,
		'cs_pl_s_add_to_cart_label',
		array(
			'section' => 'cs_pl_s_add_to_cart_style',
			'label' => __( 'Hover Style', 'mk_framework' ),
		)
	)
);

// Font Color Hover.
$wp_customize->add_setting( 'cs_pl_s_add_to_cart_style_color_hover', array(
	'default'   => '#ffffff', // Inherited from assets/stylesheet/plugins/min/woocommerce.css.
	'transport' => 'postMessage',
) );

$wp_customize->add_control(
	new MK_Color_Control(
		$wp_customize,
		'cs_pl_s_add_to_cart_style_color_hover',
		array(
			'section'  => 'cs_pl_s_add_to_cart_style',
			'column'   => 'mk-col-2-alt',
			'icon'     => 'mk-font-color',
		)
	)
);

// Background Color Hover.
$wp_customize->add_setting( 'cs_pl_s_add_to_cart_style_bg_color_hover', array(
	'default'   => 'rgba(0,0,0,.9)', // Inherited from assets/stylesheet/plugins/min/woocommerce.css.
	'transport' => 'postMessage',
) );

$wp_customize->add_control(
	new MK_Color_Control(
		$wp_customize,
		'cs_pl_s_add_to_cart_style_bg_color_hover',
		array(
			'section'  => 'cs_pl_s_add_to_cart_style',
			'column'   => 'mk-col-2-alt',
			'icon'     => 'mk-background-color',
		)
	)
);

// Border Color Hover.
$wp_customize->add_setting( 'cs_pl_s_add_to_cart_style_border_color_hover', array(
	'default'   => '#ffffff', // Inherited from assets/stylesheet/plugins/min/woocommerce.css.
	'transport' => 'postMessage',
) );

$wp_customize->add_control(
	new MK_Color_Control(
		$wp_customize,
		'cs_pl_s_add_to_cart_style_border_color_hover',
		array(
			'section'  => 'cs_pl_s_add_to_cart_style',
			'column'   => 'mk-col-2-alt',
			'icon'     => 'mk-border-color',
		)
	)
);

// Divider 2.
$wp_customize->add_setting( 'cs_pl_s_add_to_cart_divider_2' );

$wp_customize->add_control(
	new MK_Divider_Control(
		$wp_customize,
		'cs_pl_s_add_to_cart_divider_2',
		array(
			'section' => 'cs_pl_s_add_to_cart_style',
		)
	)
);

// Box Model.
$wp_customize->add_setting( 'cs_pl_s_add_to_cart_style_box_model', array(
	'default' => array(
		'margin_top' => 0,
		'margin_right' => 0,
		'margin_bottom' => 0,
		'margin_left' => 0,
		'padding_top' => 0,
		'padding_right' => 0,
		'padding_bottom' => 0,
		'padding_left' => 0,
	),
	'transport' => 'postMessage',
) );

$wp_customize->add_control(
	new MK_Box_Model_Control(
		$wp_customize,
		'cs_pl_s_add_to_cart_style_box_model',
		array(
			'section' => 'cs_pl_s_add_to_cart_style',
			'column'  => 'mk-col-12',
		)
	)
);

