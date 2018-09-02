<?php

class WP_Supports
{
    protected $list_support = [    	
								'title',
								'editor', //(content)
								'author',
								'thumbnail',// (featured image) (current theme must also support Post Thumbnails)
								'excerpt',
								'trackbacks',
								'custom-fields',// (see Custom_Fields, aka meta-data)
								'comments', //(also will see comment count balloon on edit screen)
								'revisions',// (will store revisions)
								'page-attributes',// (template and menu order) (hierarchical must be true)
								'post-formats', //(see Post_Formats)
						    ];
    
    public function show_list()
    {
        return $this->list_support;
    }
    public function add_item($item)
    {
        $this->list_support[] = item;
    }
    public function remove_item($item)
    {
        if($i = array_search($item, $this->list_support) !== FALSE)
        {
            unset($this->list_support[$i]);
            array_values($this->list_support);
            return $i;
        }
        return false;
    }
}
