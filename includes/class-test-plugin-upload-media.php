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

        /**
         * __construct
         *
         * @param  array $files
         * @param  integer $post_id
         * @param  string|null $custom_dir
         * @return void
         */
        public function __construct($files, $post_id, $custom_dir = null)
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

        /**
         * Upload files
         *
         * @return array|object - uploaded files / WP_error
         */
        public function upload()
        {

            if (isset($this->custom_dir)) {
                //Change uploads directory
                add_filter('upload_dir', array($this, 'change_uploads_dir'));
            }

            foreach ($this->files as $file_key => $file_value) {

                if ($file_value['name'] !== '') {
                    if (!function_exists('wp_generate_attachment_metadata')) {

                        require_once ABSPATH . "wp-admin" . '/includes/image.php';
                        require_once ABSPATH . "wp-admin" . '/includes/file.php';
                        require_once ABSPATH . "wp-admin" . '/includes/media.php';
                    }

      

                    if ($file_value) {
                        $newupload = media_handle_upload($file_key, $this->post_id);
                        $attachment_url = wp_get_attachment_url($newupload);
                        $attachment_thumb_url = wp_attachment_is_image($newupload) ? wp_get_attachment_thumb_url($newupload) : 'file';

                        if (is_wp_error($newupload)) {
                            return $newupload;
                        }

                        $this->response[] = array(
                            'media_id' => $newupload,
                            'media_url'=> $attachment_url,
                            'media_thumb_url' => $attachment_thumb_url
                        );
                    }
                }

            }
            if (isset($this->custom_dir)) {
                //Change upload directory to default
                remove_filter('upload_dir', array($this, 'change_uploads_dir'));
            }

            return $this->response;
        }

    }
}
