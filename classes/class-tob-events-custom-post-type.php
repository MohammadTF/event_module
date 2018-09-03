<?php
namespace Tob_Events\Classes;

use Tob_Events\Helper\Tob_Events_String;

/**
How to Use:
include('custom-post-type.php');
 
$book = new Custom_Post_Type( 'Book' );
$book->add_taxonomy( 'category' );
$book->add_taxonomy( 'author' );
 
$book->add_meta_box( 
    'Book Info', 
    array(
        'Year' => 'text',
        'Genre' => 'text'
    )
);
 
$book->add_meta_box( 
    'Author Info', 
    array(
        'Name' => 'text',
        'Nationality' => 'text',
        'Birthday' => 'text'
    )
);
*/
class Tob_Events_Custom_Post_Type
{
    public $post_type_name;
    public $post_type_args   = [];
	public $post_type_labels = [];
	public $custom_fields    = [];
	public $table_columns    = [];
	public $single_template  = '';
     
    /* Class constructor */
    public function __construct($name,$args = array(), $labels = array() )
    {
		

          // Set some important variables
	    $this->post_type_name        = Tob_Events_String::uglify($name);
	    $this->post_type_args        = $args;
	    $this->post_type_labels      = $labels;
	    $this->single_template       = $this->setSingleTemplate('single-'.$post_type_name.'.php');
	     
	    // Add action to register the post type, if the post type does not already exist
	    if( ! post_type_exists( $this->post_type_name ) )
	    {
			 // Register the post type
			add_action( 'init', array( &$this, 'register_post_type' ) );

			add_filter( 'template_include', array(&$this,'include_template_function'), 1 );
			// Admin set post columns
			add_filter( 'manage_edit-'.$this->post_type_name.'_columns',        array($this, 'set_columns'), 10, 1) ;
			// Admin edit post columns
			add_action( 'manage_'.$this->post_type_name.'_posts_custom_column', array($this, 'edit_columns'), 10, 2 );
	
	    }
	     
	    // Listen for the save post hook
	    $this->save();
    }
	
	public function setSingleTemplate($template_path)
	{
		$this->single_template = $template_path;
		return $this;
	}

	public function getSingleTemplate()
	{
		return $this->single_template;
	}

    /* Method which registers the post type */
    public function register_post_type()
    {
    	//Capitilize the words and make it plural
	    $name       = Tob_Events_String::beautify( $this->post_type_name ) ;
	    $plural     = Tob_Events_String::pluralize( $name );
	     
	    // We set the default labels based on the post type name and plural. We overwrite them with the given labels.
	    $labels = array_merge(
	     
	        // Default
	        array(
	            'name'                  => _x( $plural, 'post type general name' ),
	            'singular_name'         => _x( $name, 'post type singular name' ),
	            'add_new'               => _x( 'Add New', strtolower( $name ) ),
	            'add_new_item'          => __( 'Add New ' . $name ),
	            'edit_item'             => __( 'Edit ' . $name ),
	            'new_item'              => __( 'New ' . $name ),
	            'all_items'             => __( 'All ' . $plural ),
	            'view_item'             => __( 'View ' . $name ),
	            'search_items'          => __( 'Search ' . $plural ),
	            'not_found'             => __( 'No ' . strtolower( $plural ) . ' found'),
	            'not_found_in_trash'    => __( 'No ' . strtolower( $plural ) . ' found in Trash'), 
	            'parent_item_colon'     => '',
	            'menu_name'             => $plural
	        ),
	         
	        // Given labels
	        $this->post_type_labels
	         
	    );
	     
	    // Same principle as the labels. We set some defaults and overwrite them with the given arguments.
	    $args = array_merge(
	     
	        // Default
	        array(
	            'label'                 => $plural,
	            'labels'                => $labels,
	            'public'                => true,
	            'show_ui'               => true,
	            'supports'              => array( 'title', 'editor' ),
	            'show_in_nav_menus'     => true,
	            '_builtin'              => false,
	        ),
	         
	        // Given args
	        $this->post_type_args
	         
	    );
	     
	    // Register the post type
	    register_post_type( $this->post_type_name, $args );
         
	}

	public function setTableColumns($table_columns)
	{
		// $new_columns = array(
		// 	'publisher' => __('Publisher', 'ThemeName'),
		// 	'book_author' => __('Book Author', 'ThemeName'),
		// );
		if(ArrayHelper::is_assoc($table_columns))
		{
			$this->table_columns = $table_columns;
		}
		return $this;
	}
	public function getTableColumns()
	{
		return $this->table_columns;
	}
	 /**
     * @param $columns
     * @return mixed
     *
     * Choose the columns you want in
     * the admin table for this post
     */
    public function set_columns($columns) {
        //  return $columns;
        // Set/unset post type table columns here
        
        return array_merge($columns, $this->getTableColumns());
	}
	
	
	
    /**
	 * TODO dynamic this function
     * @param $column
     * @param $post_id
     *
     * Edit the contents of each column in
     * the admin table for this post
     */
    public function edit_columns($column, $post_id) {

		switch ( $column ) {
			case 'book_author': // col name
				$terms = get_the_term_list( $post_id, 'book_author', '', ',', '' ); // met key and value
				if ( is_string( $terms ) ) {
					echo $terms;
				} else {
					_e( 'Unable to get author(s)', 'your_text_domain' );
				}
				break;
	
			case 'publisher':
				echo get_post_meta( $post_id, 'publisher', true ); 
				break;
		}
        // Post type table column content code here
    }

     
    /* Method to attach the taxonomy to the post type */
    public function add_taxonomy($name, $args = array(), $labels = array())
    {
        if( ! empty( $name ) )
	    {
	        // We need to know the post type name, so the new taxonomy can be attached to it.
	        $post_type_name = $this->post_type_name;
	 
	        // Taxonomy properties
	        $taxonomy_name      = Tob_Events_String::uglify( $name ) ;
	        $taxonomy_labels    = $labels;
	        $taxonomy_args      = $args;
	 
	        if( ! taxonomy_exists( $taxonomy_name ) )
			{
			    /* Create taxonomy and attach it to the object type (post type) */
			    add_action( 'init',
				    function() use( $taxonomy_name, $post_type_name )
				    {
				        register_taxonomy_for_object_type( $taxonomy_name, $post_type_name );
				    }
				);
			}
			else
			{
			    /* The taxonomy already exists. We are going to attach the existing taxonomy to the object type (post type) */
			    //Capitilize the words and make it plural
				$name       = Tob_Events_String::beautify( $name );
				$plural     = Tob_Events_String::pluralize( $name );
				 
				// Default labels, overwrite them with the given labels.
				$labels = array_merge(
				 
				    // Default
				    array(
				        'name'                  => _x( $plural, 'taxonomy general name' ),
				        'singular_name'         => _x( $name, 'taxonomy singular name' ),
				        'search_items'          => __( 'Search ' . $plural ),
				        'all_items'             => __( 'All ' . $plural ),
				        'parent_item'           => __( 'Parent ' . $name ),
				        'parent_item_colon'     => __( 'Parent ' . $name . ':' ),
				        'edit_item'             => __( 'Edit ' . $name ),
				        'update_item'           => __( 'Update ' . $name ),
				        'add_new_item'          => __( 'Add New ' . $name ),
				        'new_item_name'         => __( 'New ' . $name . ' Name' ),
				        'menu_name'             => __( $name ),
				    ),
				 
				    // Given labels
				    $taxonomy_labels
				 
				);
				 
				// Default arguments, overwritten with the given arguments
				$args = array_merge(
				 
				    // Default
				    array(
				        'label'                 => $plural,
				        'labels'                => $labels,
				        'public'                => true,
				        'show_ui'               => true,
				        'show_in_nav_menus'     => true,
				        '_builtin'              => false,
				    ),
				 
				    // Given
				    $taxonomy_args
				 
				);
				 
				// Add the taxonomy to the post type
				add_action( 'init',
				    function() use( $taxonomy_name, $post_type_name, $args )
				    {
				        register_taxonomy( $taxonomy_name, $post_type_name, $args );
				    }
				);
			}
	    }
	}
	
	public function include_template_function( $template_path ) {
		if ( get_post_type() == $this->post_type_name) {
			if ( is_single() ) {
				// checks if the file exists in the theme first,
				// otherwise serve the file from the plugin
				if ( $theme_file = locate_template( array ( $this->getSingleTemplate() ) ) ) {
					$template_path = $theme_file;
				} else {
					$template_path = plugin_dir_path( __FILE__ ) . '/'.$this->getSingleTemplate();
				}
			}
		}
		return $template_path;
	}
     
    /* Attaches meta boxes to the post type */
    public function add_meta_box($title, $fields = array(), $context = 'normal', $priority = 'default')
    {
    	if( ! empty( $title ) )
	    {
	        // We need to know the Post Type name again
	        $post_type_name = $this->post_type_name;
	 
	        // Meta variables
	        $box_id         = Tob_Events_String::uglify( $title ) ;
	        $box_title      = Tob_Events_String::beautify( $title );
	        $box_context    = $context;
	        $box_priority   = $priority;
	         
	        // Make the fields global
	        
			$this->$custom_fields[$title] = $fields;
			
		
			
	        add_action( 'admin_init',
			    function() use( $box_id, $box_title, $post_type_name, $box_context, $box_priority, $fields )
			    {
			        add_meta_box(
			            $box_id,
			            $box_title,
			           array(&$this,'renderMetaBox'),
			            $post_type_name,
			            $box_context,
			            $box_priority,
			            array( $fields )
			        );
			    }
			);
	    }
         
    }
	
	public function renderMetaBox($post, $data )
	{
		
			global $post;
			 
			// Nonce field for some validation
			wp_nonce_field( plugin_basename( __FILE__ ), 'custom_post_type' );
			 
			// Get all inputs from $data
			$this->$custom_fields = $data['args'][0];
			 
			// Get the saved values
			$meta = get_post_custom( $post->ID );
			 
			// Check the array and loop through it
			if( ! empty( $this->$custom_fields ) )
			{
				/* Loop through $this->$custom_fields */
				foreach( $this->$custom_fields as $label => $type )
				{

					
					$field_id_name  = strtolower( str_replace( ' ', '_', $data['id'] ) ) . '_' . strtolower( str_replace( ' ', '_', $label ) );
					 
					echo '<label for="' . $field_id_name . '">' . $label . '</label><input type="text" name="custom_meta[' . $field_id_name . ']" id="' . $field_id_name . '" value="' . $meta[$field_id_name][0] . '" />';
				}
			}
		 
		
	}
    /* Listens for when the post type being saved */
    public function save()
    {
    	 $post_type_name = $this->post_type_name;
 
		    add_action( 'save_post',
		        function() use( $post_type_name )
		        {
		            // Deny the WordPress autosave function
		            if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
		 
		            if ( ! wp_verify_nonce( $_POST['custom_post_type'], plugin_basename(__FILE__) ) ) return;
		         
		            global $post;
		             
		            if( isset( $_POST ) && isset( $post->ID ) && get_post_type( $post->ID ) == $post_type_name )
		            {
		                
		                 
		                // Loop through each meta box
		                foreach( $this->$custom_fields as $title => $fields )
		                {
		                    // Loop through all fields
		                    foreach( $fields as $label => $type )
		                    {
		                        $field_id_name  = strtolower( str_replace( ' ', '_', $title ) ) . '_' . strtolower( str_replace( ' ', '_', $label ) );
		                         
		                        update_post_meta( $post->ID, $field_id_name, $_POST['custom_meta'][$field_id_name] );
		                    }
		                 
		                }
		            }
		        }
		    );
         
    }
    
}