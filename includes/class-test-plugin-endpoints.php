<?php

namespace Test_Plugin;
use Test_Plugin\Test_Plugin_Upload_Media;
use Test_Plugin\Test_Plugin_Upload_File;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (!class_exists('\\Test_Plugin\\Test_Plugin_Endpoints')) {

    if (!defined('ABSPATH')) {
        exit; // Exit if accessed directly
    }

    class Test_Plugin_Endpoints
    {

        public static $plugin_name;

        public static function register_routes($plugin_name)
        {
            self::$plugin_name = $plugin_name;
            register_rest_route(self::$plugin_name . '/v1', '/data', array(
                array(
                    'methods' => 'GET',
                    'callback' => array(self::class, 'admin_settings_get_route'),
                    'permission_callback' => '__return_true',
                ),
                array(
                    'methods' => 'POST',
                    'callback' => array(self::class, 'admin_settings_post_route'),
                    'permission_callback' => function () {
                        return current_user_can('manage_options');
                    },
                ),
            ));

            //Media upload
            register_rest_route(self::$plugin_name . '/v1', '/media', array(
                'methods' => 'POST',
                'callback' => array(self::class, 'upload_custom_media'),
                'permission_callback' => function () {
                    return current_user_can('manage_options');
                },
            ));
        }

        public static function admin_settings_get_route()
        {
            $data = get_option(self::$plugin_name . 'settings');

            if (!$data) {
                $data = "empty";
            }

            return $data;
        }

        public static function admin_settings_post_route(\WP_REST_Request $request)
        {

            //Get react data
            $data = $request->get_json_params();
            if (!$data) {
                return new \WP_Error('no_data', __('No data found'), array('status' => 404));
            }

            $updated = update_option(self::$plugin_name . 'settings', $data);
            $data = get_option(self::$plugin_name . 'settings');

            return $data;

        }

        /**
         * Upload media to custom directory
         *
         * @param object $request parameters
         * @return string|null Object about media
         */
        public static function upload_custom_media(\WP_REST_Request $request)
        {
            global $post;
            $files = $request->get_file_params();
            $post_id = $request->get_param('post_id');

            $upload_media = new Test_Plugin_Upload_Media($files, $post_id, 'priecinok');
            $response = $upload_media->upload();

            return $response;

        }

        /**
         * Upload file to custom directory
         *
         * @param object $request parameters
         * @return string|null Object about media
         */
        public function upload_file(\WP_REST_Request $request)
        {
            $files = $request->get_file_params();

            $upload_media = new Test_Plugin_Upload_File($files, 'custom-directory');
            $response = $upload_media->upload();

            return $response;

        }
    }

}
