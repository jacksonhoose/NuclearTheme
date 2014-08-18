<?php

/*!
 * This is a class that provides some misc helpers
 */

class Nuclear {

	/*!
	 *	Exectures at WP Query and returns posts with meta data
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
	 * aliases to other classes
	 */
	public static function breadcrumbs($breadcrumb_class = 'breadcrumbs', $current_class = 'active')
	{
		return Breadcrumbs::generate($breadcrumb_class, $current_class);
	}

	public static function pagination($tag = 'ul', $classes = 'pagination list-unstyled list-inline')
	{
		return Pagination::generate($tag, $classes);
	}

}
