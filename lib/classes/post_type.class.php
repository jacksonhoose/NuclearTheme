<?php

class PostType {
	/*!
	 * The singular nice name
	 * @var string
	 */
	var $name;

	/*!
	 * the pluralized nice name
	 * @var string
	 */
	var $plural;

	/*!
	 * the post types slug
	 * @var string
	 */
	var $slug;

	/*!
	 * arguments array 
	 * @var array
	 */
	var $args;

	/*!
	 * labels array
	 * @var array
	 */
	var $labels;

	public function __construct ($name, $plural, $labels = [], $args = []) 
	{
		$this->name = $name;
		$this->plural = $plural;
		$this->slug = self::get_slug($name);
		$this->labels = array_merge($this->get_default_labels(), $labels);
		$this->args = array_merge($this->get_default_args(), $args);
	}

	/*!
	 * creates the default labels using the singular and pluralized name
	 * @return array the default labels
	 */
	private function get_default_labels ()
	{
		return [
			"name" => __("{$this->name}"),
			"singular_name" => __("{$this->name}"),
			"add_new" => __("Add New {$this->name}"),
			"add_new_item" => __("Add New {$this->name}"),
			"edit_item" => __("Edit {$this->name}"),
			"new_item" => __("New {$this->name}"),
			"view_item" => __("View {$this->name}"),
			"search_items" => __("Search {$this->plural}"),
			"not_found" => __("No {$this->plural} found"),
			"not_found_in_trash" => __("No {$this->plural} found in Trash"),
			"parent_item_colon" => __("Parent {$this->name}:"),
			"menu_name" => __("{$this->plural}"),
		];
	}

	/*!
	 * creates the default arguments for registering a post type
	 * @return array the default (my defaults) for creating a posttype
	 */
	private function get_default_args ()
	{
		return [
			"label" => ucwords($this->plural),
			"hierarchical" => false,
			"taxonomies" => [],
			"public" => true,
			"show_ui" => true,
			"show_in_menu" => true,
			"show_in_admin_bar" => true,
			"menu_position" => null,
			"menu_icon" => null,
			"show_in_nav_menus" => true,
			"publicly_queryable" => true,
			"exclude_from_search" => false,
			"has_archive" => false,
			"query_var" => true,
			"can_export" => true,
			"rewrite" => ["slug" => $this->slug],
			"capability_type" => "page",
			"supports" => [ 
				"title", 
				"editor", 
			]
		];
	}

	public static function slugify ($slug)
	{
		$slug = preg_replace('~[^\\pL\d]+~u', '-', $slug);
		$slug = trim($slug, '-');
		$slug = iconv('utf-8', 'us-ascii//TRANSLIT', $slug);
		$slug = strtolower($slug);
		$slug = preg_replace('~[^-\w]+~', '', $slug);
		
		if(empty($slug))
		{
			return 'n-a';
		}

		return $slug;
	}

	public function get_slug ()
	{
		return self::slugify($this->name);
	}

	public function set_argument ($key, $property)
	{
		$this->args[$key] = $property;
	}

	public function supports ($support = [])
	{
		$this->set_argument("supports", $support);
	}

	public function archive ($archive = false)
	{
		$this->set_argument("has_archive", $archive);
	}

	public function rewrites ($rewrite)
	{
		$this->set_argument("rewrite", $rewrite);
	}

	public function capability_type ($capability = "page")
	{
		$this->set_argument("capability_type", $capability);
	}

	public function register ()
	{
		register_post_type($this->slug, $this->args);
	}

}