<?php

class Pagination {
	private static $tag;
	private static $classes;

	public static function generate($tag = 'ul', $classes = 'pagination list-unstyled list inline')
	{
		global $wp_query;

		self::$tag = $tag;
		self::$classes = $classes;

		$prev_arrow = is_rtl() ? '&rarr;' : '&larr;';
		$next_arrow = is_rtl() ? '&larr;' : '&rarr;';
		$large = 999999999;
		$total = $wp_query->max_num_pages;

		if($total > 1)
		{
			if(!$current_page = get_query_var('paged'))
			{
				$current_page = 1;
			}
			
			if(get_option('permalink_structure')) 
			{
				$format = 'page/%#%/';
			} 
			else 
			{
				$format = '&paged=%#%';
			}

			return self::format_html(paginate_links([
				'base'	=> str_replace($large, '%#%', esc_url(get_pagenum_link($large))),
				'format'	=> $format,
				'current' => max(1, get_query_var('paged')),
				'total' => $total,
				'mid_size' => 3,
				'type' => 'array',
				'prev_text'	=> $prev_arrow,
				'next_text'	=> $next_arrow,
			]));
		}
	}

	private static function format_html($pagination = [])
	{
		$html = '';

		foreach ($pagination as $page) 
		{
			$html .= Util::wrap_in_html($page, 'li');	
		}

		return Util::wrap_in_html($html, self::$tag, ['class' => self::$classes]);
	}

}