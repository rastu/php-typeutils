<?php

/**
 * String.php
 * (c) 2014 Andreas Fernandez <a.fernandez@scripting-base.de>
 * http://www.scripting-base.de
 * Version 1.3
 *
 * is released under the MIT License http://www.opensource.org/licenses/mit-license.php
 */
class TypeUtils_String {

	/**
	 * Checks if a string starts with a specific value
	 * @param  string $haystack      The string to search in
	 * @param  string $needle        The string to be searched
	 * @param  bool   $caseSensitive Defines whether the function is case-sensitive or not
	 * @return bool
	 */
	public static function startsWith($haystack, $needle, $caseSensitive = true) {
		if(!$caseSensitive) {
			return stripos($haystack, $needle, 0) === 0;
		}

		return strpos($haystack, $needle) === 0;
	}

	/**
	 * Checks if a string ends with a specific value
	 * @param  string $haystack      The string to search in
	 * @param  string $needle        The string to be searched
	 * @param  bool   $caseSensitive Defines whether the function is case-sensitive or not
	 * @return bool
	 */
	public static function endsWith($haystack, $needle, $caseSensitive = true) {
		$position = strlen($haystack) - strlen($needle);

		if(!$caseSensitive) {
			return strripos($haystack, $needle, 0) === $position;
		}

		return strrpos($haystack, $needle, 0) === $position;
	}

	/**
	 * Trims a multiple line string into one line
	 * @param  string $str       The string to be trimmed
	 * @param  string $separator An optional separator put in between the merged lines
	 * @return string
	 */
	public static function trimToOneLine($str, $separator = '') {
		$str = str_replace(array("\r\n", "\r"), "\n", $str);
		$lines = explode("\n", $str);
		$newLines = array();

		foreach($lines as $i => $line) {
			if($line != '') {
				$newLines[] = preg_replace('/\s+/', '', $line);
			}
		}

		return implode($separator, $newLines);
	}

	/**
	 * Cuts a string and respects the word
	 * @param  string $text     The string to be cutted
	 * @param  int    $limit    Amount of maximum chars to keep
	 * @param  string $ellipsis Ellipsis string placed after the cutted string
	 * @return string
	 */
	public static function substrWordsafe($text, $limit, $ellipsis = '...') {
		if($limit <= 0 || strlen($text) <= $limit) {
			return $text;
		}

		$text = substr($text, 0, $limit);
		return preg_replace('/ [^ ]*$/', $ellipsis, $text);
	}

	/**
	 * Removes the <br> tags at the beginning of a string
	 * @param  string $string The string to be cleaned
	 * @return string
	 */
	public static function ltrimBr($string) {
		return preg_replace('/^\s*(<br\s*(\/?)>)+/', '', $string);
	}

	/**
	 * Check if the string contains whitespaces
	 * @param  string $string The string
	 * @return bool
	 */
	public static function hasWhitespaces($string) {
		return preg_match('/\s/', $string);
	}

	/**
	 * Returns the file extension
	 * @param  string $filename       File name
	 * @param  bool   $returnFilename Returns the filename if it has no extension, default is false
	 * @return string
	 */
	public static function getFileExtension($filename, $returnFilename = false) {
		// is there any extension?
		if(strpos($filename, '.') === false) {
			return $returnFilename ? $filename : '';
		}

		// split $filename by dot and return last element
		return end(explode('.', $filename));
	}

}

?>