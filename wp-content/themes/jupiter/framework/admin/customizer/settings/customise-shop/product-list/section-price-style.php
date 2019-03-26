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
		'cs_pl_s_price_style',
		array(
			'title'    => __( 'Regular Price Style', 'mk_framework' ),
			'priority' => 30,
			'panel' => 'cs_styles',
		)
	)
);

// Add settings to the section.
// Typography.
$wp_customize->add_setting( 'cs_pl_s_price_style_typography', array(
	'default' => array(
		'family' => 'inherit',
		'size'   => 18,
		'weight' => 700,
		'style'  => 'normal',
		'color'  => '#252525',
	),
	'transport' => 'postMessage',
) );

$wp_customize->add_control(
	new MK_Typography_Control(
		$wp_customize,
		'cs_pl_s_price_style_typography',
		array(
			'section' => 'cs_pl_s_price_style',
			'column'  => 'mk-col-12',
		)
	)
);

// Divider.
$wp_customize->add_setting( 'cs_pl_s_price_style_divider' );

$wp_customize->add_control(
	new MK_Divider_Control(
		$wp_customize,
		'cs_pl_s_price_style_divider',
		array(
			'section' => 'cs_pl_s_price_style',
		)
	)
);

// Box Model.
$wp_customize->add_setting( 'cs_pl_s_price_style_box_model', array(
	'default' => array(
		'margin_top'     => 0,
		'margin_right'   => 0,
		'margin_bottom'  => 0,
		'margin_left'    => 0,
		'padding_top'    => 0,
		'padding_right'  => 0,
		'padding_bottom' => 0,
		'padding_left'   => 0,
	),
	'transport' => 'postMessage',
) );

$wp_customize->add_control(
	new MK_Box_Model_Control(
		$wp_customize,
		'cs_pl_s_price_style_box_model',
		array(
			'section' => 'cs_pl_s_price_style',
			'column'  => 'mk-col-12',
		)
	)
);
