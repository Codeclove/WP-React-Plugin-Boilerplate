<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       marek@codeli.sk
 * @since      1.0.0
 *
 * @package    Test_Plugin
 * @subpackage Test_Plugin/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Test_Plugin
 * @subpackage Test_Plugin/admin
 * @author     Marek Chrást <marek@codeli.sk>
 */
class Test_Plugin_Admin
{

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
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Test_Plugin_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Test_Plugin_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style($this->plugin_name, plugin_dir_url(dirname(__FILE__)) . 'assets/css/admin.css', array(), $this->version, 'all');

    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Test_Plugin_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Test_Plugin_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script($this->plugin_name, plugin_dir_url(dirname(__FILE__)) . 'assets/js/admin.js', array('jquery'), $this->version, false);

        //wp_localize_script($this->plugin_name, 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));

        //WP Rest Api data
        wp_localize_script($this->plugin_name, 'wpApiSettings', array(
            'root' => esc_url_raw(rest_url()),
            'nonce' => wp_create_nonce('wp_rest'),
            'user' => wp_get_current_user(),
            'post_id' => get_the_ID(),
            't' => array(
                'meta_label' => __('Meta label', 'test-plugin'),
                'other_name' => __('Other name', 'test-plugin'),
            ),
        ));

    }

    public function register_cpt()
    {
        //Custom post types
        Test_Plugin\Test_Plugin_CPT::init();
        Test_Plugin\Test_Plugin_Post_Metas::init();
    }

    public function register_metaboxes()
    {

        //Metaboxes
        $metabox = new Test_Plugin\Test_Plugin_Meta_Box(['custom-posts'], __('Metabox title', 'test-plugin'));
        $metabox->add();
    }

    public function register_routes() {
        Test_Plugin\Test_Plugin_Endpoints::register_routes($this->plugin_name);
    }

    public function register_menu_items()
    {

        Test_Plugin\Test_Plugin_Menu::register_menu_items();

    }

    public function register_settings()
    {
       Test_Plugin\Test_Plugin_Settings::register_settings();
    }

  
}
