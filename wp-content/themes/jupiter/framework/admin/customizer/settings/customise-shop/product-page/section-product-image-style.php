<?php
/**
 * Add a sections: pp -> product page, s -> styles.
 *
 * @package WordPress
 * @subpackage Jupiter
 * @since 5.9.4
 */

$wp_customize->add_section(
	new MK_Section(
		$wp_customize,
		'cs_pp_s_product_image_style',
		array(
			'title'    => __( 'Product Image Style', 'mk_framework' ),
			'priority' => 10,
			'panel' => 'cs_pp_styles',
		)
	)
);

// Add settings to the section.
// Label.
$wp_customize->add_setting( 'cs_pp_s_product_image_style_test' );

$wp_customize->add_control(
	new MK_Label_Control(
		$wp_customize,
		'cs_pp_s_product_image_style_test',
		array(
			'section' => 'cs_pp_s_product_image_style',
			'column'  => 'mk-col-12',
			'label'  => 'Test Label control',
		)
	)
);
