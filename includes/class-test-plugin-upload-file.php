<?php
namespace Test_Plugin;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (!class_exists('\\Test_Plugin\\Test_Plugin_UploadFile')) {

    class Test_Plugin_UploadFile
    {

        public $files;
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
        public function __construct($files, $custom_dir = null)
        {
            $this->files = $files;
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

                    if (!function_exists('wp_handle_upload')) {
                        require_once ABSPATH . 'wp-admin/includes/file.php';
                    }

                    if ($file_value) {

                        $path_to_file = wp_upload_dir()['path'] . '/' . $file_value['name'];
                        //Delete if file with this name exists
                        wp_delete_file($path_to_file);
                        $newupload = wp_handle_upload($file_value, array('test_form' => false));

                        if (is_wp_error($newupload)) {
                            return $newupload;
                        }

                        $this->response[] = array(
                            'file_url' => array_key_exists('url', $newupload) ? $newupload['url'] : '',
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
