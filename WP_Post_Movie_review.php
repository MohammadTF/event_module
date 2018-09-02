<?php

class WP_Post_Movie_review
{
	public $_post_title    = 'Movie';
	public $_post_type     = 'movies_review';
	public $_extra_options = [];
	public $_labels		   = [];
	public $_supports      = [];
	public $_listTaxs      = [];
	public $_isPublic      = true;
	public $_hasArchive    = true;
	public $_menuPosition  = 15;
	public $_menuIco       = '';

	public function __construct()
	{
		
		$this->set_extra_options();
		add_action( 'init', array(&this,'create_movie_review' ));
	}

	public function create_movie_review()
	{
		register_post_type($this->_post_type,$this->get_extra_options());
	}

	public function set_labels($arr)
	{
		$_default = array(
	                'name' => $this->_post_title. ' Reviews',
	                'singular_name' => $this->_post_title. ' Review',
	                'add_new' => 'Add New',
	                'add_new_item' => 'Add New '. $this->_post_title .' Review',
	                'edit' => 'Edit',
	                'edit_item' => 'Edit '.$this->_post_title.' Review',
	                'new_item' => 'New '.$this->_post_title.' Review',
	                'view' => 'View',
	                'view_item' => 'View '.$this->_post_title.' Review',
	                'search_items' => 'Search '.$this->_post_title.' Reviews',
	                'not_found' => 'No '.$this->_post_title.' Reviews found',
	                'not_found_in_trash' => 'No '.$this->_post_title.' Reviews found in Trash',
	                'parent' => 'Parent '.$this->_post_title.' Review'
	            );

		return array_merge($_default,$arr)

	}

	public function set_extra_options()
	{
		$this->set_labels();
	}

	public function get_extra_options()
	{
		return $this->_extra_options;
	}
}