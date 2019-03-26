<?php
/**
 * Array helper functions.
 *
 * @package Header_Builder
 * @subpackage Utility
 * @since 5.9.0
 */

if ( ! function_exists( 'array_safe_get' ) ) :
	/**
	 * Safely get an item from an associative array using an array key,
	 * and provide a default value if key does not exist.
	 *
	 * @since 5.9.0
	 *
	 * @param array  $arr Array of any conceivable structure.
	 * @param string $key Array key to use in retrieving value.
	 * @param mixed  $default Default value to provide in case key is not in array.
	 * @param mixed  $overrides An array of return values to be overwritten by defaul value.
	 * @return mixed Any value or another array.
	 */
	function array_safe_get( array $arr, $key, $default = null, $overrides = '' ) {
		$output = array_key_exists( (string) $key, $arr ) ? $arr[ $key ] : $default;

		if ( ! is_array( $overrides ) ) {
			$overrides = array( $overrides );
		}

		return in_array( $output, $overrides, true ) ? $default : $output;
	}
endif;

if ( ! function_exists( 'array_shallow_sum_values' ) ) :
	/**
	 * Count 2 arrays with the same key.
	 *
	 * @since 5.9.0
	 *
	 * @param array $array1 Any associative array.
	 * @param array $array2 Any associative array.
	 *
	 * @return array Copy of $array1 with values from $array2 added to it.
	 */
	function array_shallow_sum_values( array $array1 = array(), array $array2 = array() ) {
		$sum = array();

		foreach ( $array1 as $key => $value ) {
			$sum[ $key ] = floatval( $value ) + floatval( $array2[ $key ] );
		}

		return $sum;
	}
endif;
