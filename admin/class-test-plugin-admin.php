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

        //WP rest api authentification
        wp_localize_script($this->plugin_name, 'wpApiSettings', array(
            'root' => esc_url_raw(rest_url()),
            'nonce' => wp_create_nonce('wp_rest'),
            'user' => wp_get_current_user(),
            'post_id' => get_the_ID(),
        ));

    }

    public function register_cpt()
    {
        $cpt = new TestPlugin\CPT;
        $cpt->init();
    }

    public function register_metaboxes()
    {
        $metabox = new TestPlugin\Meta_Box(['custom-posts'], 'Metabox title');
        $metabox->add();
    }
    public function register_cpt_metas()
    {

        $args = array(
            array(
                'meta_key' => 'new_meta',
                'type' => 'string',
            ),
        );

        $cpt_metas = new TestPlugin\PostMetas('custom-posts', 'Metas for custom posts');
        $cpt_metas->register_metas($args);

    }

    public function add_menu_item()
    {

        /**
         * Adds a submenu page under a custom post type parent.
         */

        add_submenu_page(
            'edit.php?post_type=custom-posts',
            __('Page title', 'test-plugin'),
            __('Submenu name', 'test-plugin'),
            'manage_options',
            'react-settings',
        );

        /**
         * Add the top level menu page.
         */

        add_menu_page(
            __('React settings', 'test-plugin'), //Page title
            __('React settings', 'test-plugin'), //Menu title
            'manage_options',
            'react-settings',
            function () {require_once plugin_dir_path(dirname(__FILE__)) . 'admin/partials/test-plugin-admin-display.php';},
        );

    }

    public function register_endpoints()
    {
        register_rest_route($this->plugin_name . '/v1', '/admin-settings', array(
            array(
                'methods' => 'GET',
                'callback' => array($this, 'admin_settings_get_route'),
                'permission_callback' => function () {
                    return current_user_can('manage_options');
                },

            ),
            array(
                'methods' => 'POST',
                'callback' => array($this, 'admin_settings_post_route'),
                'permission_callback' => function () {
                    return current_user_can('manage_options');
                },

            ),
        ));

        //Media upload
        register_rest_route($this->plugin_name . '/v1', '/media', array(
            'methods' => 'POST',
            'callback' => array($this, 'upload_custom_media'),
            'permission_callback' => function () {
                return current_user_can('manage_options');
            },
        ));

    }

    public function admin_settings_get_route()
    {
        $data = get_option($this->plugin_name . 'settings');

        if (!$data) {
            $data = "empty";
        }

        return $data;
    }

    public function admin_settings_post_route(WP_REST_Request $request)
    {

        //Get react data
        $data = $request->get_json_params();
        if (!$data) {
            return new WP_Error( 'no_posts', __('No post found'), array( 'status' => 404 ) );
        }

        update_option($this->plugin_name . 'settings', $data);
        $data = get_option($this->plugin_name . 'settings');

        return $data;

    }

    /**
     * Upload media to custom directory
     *
     * @param array $request parameters
     * @return string|null Object about media
     */
    public function upload_custom_media(WP_REST_Request $request)
    {
        global $post;
        $files = $request->get_file_params();
        $post_id = $request->get_param('post_id');

        $upload_media = new TestPlugin\UploadMedia($files, $post_id, 'priecinok');
        $response = $upload_media->upload();

        return $response;

    }

}
