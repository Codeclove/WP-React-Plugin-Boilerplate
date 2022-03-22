<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       marek@codeli.sk
 * @since      1.0.0
 *
 * @package    Test_Plugin
 * @subpackage Test_Plugin/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Test_Plugin
 * @subpackage Test_Plugin/public
 * @author     Marek Chrást <marek@codeli.sk>
 */
class Test_Plugin_Public
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
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the public-facing side of the site.
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

        wp_enqueue_style($this->plugin_name, plugin_dir_url(dirname(__FILE__)) . 'assets/css/front.css', array(), $this->version, 'all');

    }

    /**
     * Register the JavaScript for the public-facing side of the site.
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

        wp_enqueue_script($this->plugin_name, plugin_dir_url(dirname(__FILE__)) . 'assets/js/front.js', array('jquery'), $this->version, false);

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

    public function register_shortcodes()
    {
        
        add_shortcode('test-plugin-front', function() {
            return "<div id='test-plugin-front'></div>";
        });
    }

}
