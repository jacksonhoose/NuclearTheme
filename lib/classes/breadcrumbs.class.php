<?php

class Breadcrumbs {
	private static $post;
	private static $breadcrumb_class;
	private static $current_class;
	private static $crumbs = [];

	public static function generate($breadcrumb_class = 'breadcrumbs', $current_class = 'active')
	{
		/*!
		 * import global post and save variables on class
		 */
		global $post;
		self::$post = $post;
		self::$breadcrumb_class = $breadcrumb_class;
		self::$current_class = ['class' => $current_class];

		/*!
		 * always show the home link as the first crumb
		 */
		self::get_home_crumbs();

		/*!
		 * if it isnt home get the type of page its on
		 */
		if(!is_home(self::$post->ID))
		{
			if(is_search(self::$post->ID))
			{
				self::get_search_crumbs();
			}
			elseif(is_404(self::$post->ID))
			{
				self::get_404_crumbs();
			}
			elseif(is_page(self::$post->ID))
			{
				self::get_page_crumbs();
			}
			elseif(is_single(self::$post->ID))
			{
				self::get_single_crumbs();
			}
		}

		/*!
		 * wrap the <li>'s in a <ul> and apply the appropriate classes
		 */
		return self::wrap_list(self::$crumbs);
	}

	private static function get_home_crumbs()
	{
		self::$crumbs[] = self::get_link_list_item(get_home_url(self::$post->ID), 'Home');
	}

	private static function get_search_crumbs()
	{
		self::$crumbs[] = self::get_link_list_item(get_search_link(), 'Search Results For: ' . get_search_query(), self::$current_class);
	}

	private static function get_404_crumbs()
	{
		self::$crumbs[] = Util::wrap_in_html('404 Not Found', 'li', self::$current_class);
	}

	private static function get_single_crumbs()
	{
		self::$crumbs[] = self::get_link_list_item(self::$post->ID, null, self::$current_class);
	}

	private static function get_page_crumbs()
	{
		/*!
		 * do ancestors
		 */
		if(self::$post->post_parent)
		{
			$anc = get_post_ancestors(self::$post->ID);
			$anc = array_reverse($anc);
			
			foreach ($anc as $ancestor) 
			{
				self::$crumbs[] = self::get_link_list_item($ancestor);
			}
		}
		/*!
		 * do current
		 */
		self::$crumbs[] = self::get_link_list_item(self::$post->ID, null, self::$current_class);
	}

	private static function get_link_list_item($id, $title = null, $current = [])
	{
		if(is_null($title))
		{
			$title = get_the_title($id);
		}

		return Util::wrap_in_html(Util::link($id, $title), 'li', $current);
	}

	private static function wrap_list($content, $tag = 'ul', $attrs = ['class' => 'list-unstyled list-inline breadcrumbs'])
	{
		if(is_array($content))
		{
			$content = implode('', $content);
		}

		return Util::wrap_in_html($content, $tag, $attrs);
	}

}