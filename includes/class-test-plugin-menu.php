<?php
namespace Test_Plugin;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (!class_exists('\\Test_Plugin\\Test_Plugin_Menu')) {

    class Test_Plugin_Menu
    {
        public static function register_menu_items()
        {

        /**
         * Adds a submenu page under a custom post type parent.
         */

        // add_submenu_page(
        //     'edit.php?post_type=custom-posts',
        //     __('Page title', 'test-plugin'),
        //     __('Submenu name', 'test-plugin'),
        //     'manage_options',
        //     'test-plugin',
        //     function () {require_once TEST_PLUGIN_DIR . 'admin/partials/test-plugin-admin-settings.php';},
        // );

        /**
         * Add the top level menu page.
         */

        add_menu_page(
            __('Plugin settings', 'test-plugin'), //Page title
            __('Plugin settings', 'test-plugin'), //Menu title
            'manage_options',
            'test-plugin',
            function () {require_once TEST_PLUGIN_DIR . 'admin/partials/test-plugin-settings-page.php';},
        );
        }
    }
}
