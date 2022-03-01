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

    }

    public function add_settings_page()
    {

        $customWPMenu = new WordPressMenu(array(
            'slug' => 'wpmenu',
            'title' => 'WP Menu',
            'desc' => 'Settings for theme custom WordPress Menu',
            'icon' => 'dashicons-welcome-widgets-menus',
            'function' => array($this, 'settings_page'),
            'position' => 99,
        ));
    }

    public function settings_page()
    {
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/partials/test-plugin-admin-display.php';
    }

}
