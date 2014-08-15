<?php
/*!
 * utility class
 */

class Util {

	public static function dd($data)
	{
		die(print_r($data));
	}

	/*!
	 * wrap something in an HTML tag
	 */
	public static function wrap_in_html($code, $tag, $attr = null)
	{
		$attributes = '';

		if(!is_null($attr))
		{
			foreach ($attr as $key => $value) 
			{
				$attributes .= ' ' . $key . '="' . $value . '"';
			}
		}

		return '<' . $tag . $attributes . '>' . $code . '</' . $tag . '>'; 
	}

	/*!
	 * make a link
	 */
	public static function link($uri, $text, $target = '_self')
	{
		if(is_int($uri))
		{
			$uri = get_permalink($uri);
		}

		return '<a href="' . $uri . '" title="Permalink to ' . $text .'" target="' . $target . '">' . $text . '</a>';
	}

}