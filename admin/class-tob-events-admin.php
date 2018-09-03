<?php
namespace Tob_Events\Admin;

use Tob_Events\Classes\Tob_Events_Custom_Post_Type;
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/MohammadTF
 * @since      1.0.0
 *
 * @package    Tob_Events
 * @subpackage Tob_Events/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Tob_Events
 * @subpackage Tob_Events/admin
 * @author     Genetech <tasneem.faizyab@genetechsolutions.com>
 */
class Tob_Events_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->add_post_types();
	}

	/**
	 * Creating post types 
	 *
	 * @return void
	 */
	
	private function add_post_types()
	{
		$event   = new Tob_Events_Custom_Post_Type( 'Event' );

		$event->setOutputMeta('list_packages'); 
		$event->add_meta_box( 
		    'List Packages'
		    		    
		);
		
 

		$package = new Tob_Events_Custom_Post_Type( 'Package' );
		$args = array("post_type"        => "event","post_status"      => "publish");
		$posts_array = get_posts($args);
		$package->add_meta_box( 
		    'Associate Event',		    
		     array(
		        'Events' => ['type'=>'dropdown','default'=>$posts_array],
	   		 )		    
		);

		$varient = new Tob_Events_Custom_Post_Type( 'Varient' );

		
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Tob_Events_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Tob_Events_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/tob-events-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Tob_Events_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Tob_Events_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/tob-events-admin.js', array( 'jquery' ), $this->version, false );

	}

}
