<?php
/**
 * Add a section: pl -> product list, s -> styles.
 *
 * @package WordPress
 * @subpackage Jupiter
 * @since 5.9.4
 */

$wp_customize->add_section(
	new MK_Section(
		$wp_customize,
		'cs_pl_s_sale_badge_style',
		array(
			'title'    => __( 'Sale Badge Style', 'mk_framework' ),
			'priority' => 60,
			'panel' => 'cs_styles',
		)
	)
);

// Add settings to the section.
// Text.
$wp_customize->add_setting( 'cs_pl_s_sale_badge_style_text', array(
	'default'   => 'sale',
	'transport' => 'postMessage',
) );

$wp_customize->add_control(
	new MK_Input_Control(
		$wp_customize,
		'cs_pl_s_sale_badge_style_text',
		array(
			'section' => 'cs_pl_s_sale_badge_style',
			'column'  => 'mk-col-12',
			'text' => __( 'Text', 'mk_framework' ),
		)
	)
);

// Typography.
$wp_customize->add_setting( 'cs_pl_s_sale_badge_style_typography', array(
	'default' => array(
		'family' => 'inherit',
		'size'   => 11,
		'weight' => 700,
		'style'  => 'normal',
		'color'  => '#ffffff',
	),
	'transport' => 'postMessage',
) );

$wp_customize->add_control(
	new MK_Typography_Control(
		$wp_customize,
		'cs_pl_s_sale_badge_style_typography',
		array(
			'section' => 'cs_pl_s_sale_badge_style',
			'column'  => 'mk-col-12',
		)
	)
);

// Background color.
$wp_customize->add_setting( 'cs_pl_s_sale_badge_style_background_color', array(
	'default'   => '#da4c26',
	'transport' => 'postMessage',
) );

$wp_customize->add_control(
	new MK_Color_Control(
		$wp_customize,
		'cs_pl_s_sale_badge_style_background_color',
		array(
			'section'  => 'cs_pl_s_sale_badge_style',
			'column'   => 'mk-col-2-alt',
			'icon'     => 'mk-background-color',
		)
	)
);

// Border radius.
$wp_customize->add_setting( 'cs_pl_s_sale_badge_style_border_radius', array(
	'default'   => 0,
	'transport' => 'postMessage',
) );

$wp_customize->add_control(
	new MK_Input_Control(
		$wp_customize,
		'cs_pl_s_sale_badge_style_border_radius',
		array(
			'section' => 'cs_pl_s_sale_badge_style',
			'column'  => 'mk-col-3-alt',
			'icon' => 'mk-corner-radius',
			'unit' => __( 'px', 'mk_framework' ),
		)
	)
);

// Border width.
$wp_customize->add_setting( 'cs_pl_s_sale_badge_style_border_width', array(
	'default'   => 0,
	'transport' => 'postMessage',
) );

$wp_customize->add_control(
	new MK_Input_Control(
		$wp_customize,
		'cs_pl_s_sale_badge_style_border_width',
		array(
			'section' => 'cs_pl_s_sale_badge_style',
			'column'  => 'mk-col-3-alt',
			'icon' => 'mk-border',
			'unit' => __( 'px', 'mk_framework' ),
		)
	)
);

// Border color.
$wp_customize->add_setting( 'cs_pl_s_sale_badge_style_border_color', array(
	'default'   => '#da4c26',
	'transport' => 'postMessage',
) );

$wp_customize->add_control(
	new MK_Color_Control(
		$wp_customize,
		'cs_pl_s_sale_badge_style_border_color',
		array(
			'section'  => 'cs_pl_s_sale_badge_style',
			'column'   => 'mk-col-2-alt',
			'icon'     => 'mk-border-color',
		)
	)
);

// Divider.
$wp_customize->add_setting( 'cs_pl_s_sale_badge_style_divider' );

$wp_customize->add_control(
	new MK_Divider_Control(
		$wp_customize,
		'cs_pl_s_sale_badge_style_divider',
		array(
			'section' => 'cs_pl_s_sale_badge_style',
		)
	)
);

// Box Model.
$wp_customize->add_setting( 'cs_pl_s_sale_badge_style_box_model', array(
	'default' => array(
		'margin_top'     => 0,
		'margin_right'   => 0,
		'margin_bottom'  => 0,
		'margin_left'    => 0,
		'padding_top'    => 10,
		'padding_right'  => 20,
		'padding_bottom' => 10,
		'padding_left'   => 20,
	),
	'transport' => 'postMessage',
) );

$wp_customize->add_control(
	new MK_Box_Model_Control(
		$wp_customize,
		'cs_pl_s_sale_badge_style_box_model',
		array(
			'section' => 'cs_pl_s_sale_badge_style',
			'column'  => 'mk-col-12',
		)
	)
);
