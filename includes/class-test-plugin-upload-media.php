<?php
namespace TestPlugin;

/**
 * File where we define CPT, Taxonomies etc.
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (!class_exists('\\TestPlugin\\UploadMedia')) {

    class UploadMedia
    {

        public $files;
        public $post_id;
        public $custom_dir;
        public $response = [];

        public function __construct($files, $post_id, $custom_dir)
        {

            $this->files = $files;
            $this->post_id = $post_id;
            $this->custom_dir = $custom_dir;

        }

        public function change_uploads_dir($dir_data)
        {
            $custom_dir = $this->custom_dir;
            $dir_data['path'] = $dir_data['basedir'] . '/' . $custom_dir;
            $dir_data['url'] = $dir_data['baseurl'] . '/' . $custom_dir;
            $dir_data['subdir'] = '/' . $custom_dir;
            return $dir_data;
        }

        public function upload()
        {

            foreach ($this->files as $file_key => $file_value) {

                if ($file_value['name'] !== '') {
                    if (!function_exists('wp_generate_attachment_metadata')) {

                        require_once ABSPATH . "wp-admin" . '/includes/image.php';
                        require_once ABSPATH . "wp-admin" . '/includes/file.php';
                        require_once ABSPATH . "wp-admin" . '/includes/media.php';
                    }

                    if ($file_value) {
                        $this->response[$file_key]['media_id'] = $newupload = media_handle_upload($file_key, $this->post_id);
                        $this->response[$file_key]['media_url'] = $attachment_url = wp_get_attachment_url($newupload);
                    }
                }

            }

            return $this->response;
        }

    }
}
