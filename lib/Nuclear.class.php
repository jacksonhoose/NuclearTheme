<?php
/*!
 * This is a class that provides some misc helpers
 */
class Nuclear {

	/*!
	 * Query helpers
	 */
	public static function get_posts($args = [])
	{
		$results = new WP_Query($args);

		if(!$results)
		{
			return false;
		}

		return self::get_post_meta($results->posts);

	}

	/*!
	 * takes an an array or post object and returns
	 * the post(s) with meta data
	 */
	public static function get_post_meta($posts)
	{
		if(is_array($posts))
		{
			foreach ($posts as $post) {

				$meta = get_post_custom($post->ID);

				if($meta)
				{
					$post = self::push_meta_into_post($post, $meta);
				}
			}
		}
		elseif(is_object($posts))
		{
			$meta = get_post_custom($posts->ID);

			if($meta)
			{
				$posts = self::push_meta_into_post($posts, $meta);
			}
		}

		return $posts;
	}

	/*!
	 * 	pushes values into post object
	 */
	public static function push_meta_into_post($post, $meta = [])
	{
		foreach ($meta as $key => $value) {
			$post->$key = $value;
		}

		return $post;
	}

	/*!
	 * renders an array of templates
	 */
	public static function render_template($paths)
	{
		if(!is_array($paths))
		{
			$paths = [$paths];
		}

		foreach ($paths as $path)
		{
			get_template_part($path);
		}

		return true;

	}

	/*!
	 * utility
	 *
	 * dies and dumps a variable
	 */
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
