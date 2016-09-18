<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('strIn')) {
	function strIn($needle,$haystack) {
		$haystack = explode(",",$haystack);
		return in_array( $needle, $haystack ) ? 1 : 0;
	}
}