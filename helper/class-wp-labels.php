<?php

class WPLabel{

	protected $name;
	protected $singular_name;
	protected $add_new;
	protected $add_new_item;
	protected $edit;
	protected $edit_item;
	protected $new_item;
	protected $view;
	protected $view_item;
	protected $search_items;
	protected $not_found;
	protected $not_found_in_trash;
	protected $parent;

	public function __construct($post_type)
	{
		$beautify_name = StringHelper::beautify($post_type);

		$this->setName($beautify_name);
		$this->setSingularName($beautify_name);

		$this->setAddNew('Add');
		$this->setAddNewItem('Add New '.$beautify_name);

		$this->setEdit('Edit');
		$this->setEditItem('Edit '.$beautify_name);

		$this->setNewItem('New '.$beautify_name);

		$this->setView('View');
		$this->setViewItem('View '.$beautify_name);
		
		$this->setSearchItems('Search '.$beautify_name);

		$this->setNotFound('No '.$beautify_name.' found');
		$this->setNotFoundInTrash('No '.$beautify_name. ' found in Trash.');

		$this->setParent('Parent '.$beautify_name);
	}

    public function get()
    {
        return get_object_vars($this);        
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSingularName()
    {
        return $this->singular_name;
    }

    /**
     * @param mixed $singular_name
     *
     * @return self
     */
    public function setSingularName($singular_name)
    {
        $this->singular_name = $singular_name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAddNew()
    {
        return $this->add_new;
    }

    /**
     * @param mixed $add_new
     *
     * @return self
     */
    public function setAddNew($add_new)
    {
        $this->add_new = $add_new;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAddNewItem()
    {
        return $this->add_new_item;
    }

    /**
     * @param mixed $add_new_item
     *
     * @return self
     */
    public function setAddNewItem($add_new_item)
    {
        $this->add_new_item = $add_new_item;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEdit()
    {
        return $this->edit;
    }

    /**
     * @param mixed $edit
     *
     * @return self
     */
    public function setEdit($edit)
    {
        $this->edit = $edit;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEditItem()
    {
        return $this->edit_item;
    }

    /**
     * @param mixed $edit_item
     *
     * @return self
     */
    public function setEditItem($edit_item)
    {
        $this->edit_item = $edit_item;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNewItem()
    {
        return $this->new_item;
    }

    /**
     * @param mixed $new_item
     *
     * @return self
     */
    public function setNewItem($new_item)
    {
        $this->new_item = $new_item;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * @param mixed $view
     *
     * @return self
     */
    public function setView($view)
    {
        $this->view = $view;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getViewItem()
    {
        return $this->view_item;
    }

    /**
     * @param mixed $view_item
     *
     * @return self
     */
    public function setViewItem($view_item)
    {
        $this->view_item = $view_item;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSearchItems()
    {
        return $this->search_items;
    }

    /**
     * @param mixed $search_items
     *
     * @return self
     */
    public function setSearchItems($search_items)
    {
        $this->search_items = $search_items;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNotFound()
    {
        return $this->not_found;
    }

    /**
     * @param mixed $not_found
     *
     * @return self
     */
    public function setNotFound($not_found)
    {
        $this->not_found = $not_found;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNotFoundInTrash()
    {
        return $this->not_found_in_trash;
    }

    /**
     * @param mixed $not_found_in_trash
     *
     * @return self
     */
    public function setNotFoundInTrash($not_found_in_trash)
    {
        $this->not_found_in_trash = $not_found_in_trash;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param mixed $parent
     *
     * @return self
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

        return $this;
    }
}

/*




*/