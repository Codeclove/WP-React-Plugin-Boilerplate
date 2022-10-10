<?php
namespace Test_Plugin;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (!class_exists('\\Test_Plugin\\Test_Plugin_Deactivator')) {
/**
 * Fired during plugin deactivation
 *
 * @link       marek@codeli.sk
 * @since      1.0.0
 *
 * @package    Test_Plugin
 * @subpackage Test_Plugin/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Test_Plugin
 * @subpackage Test_Plugin/includes
 * @author     Marek Chrást <marek@codeli.sk>
 */
    class Test_Plugin_Deactivator
    {

        /**
         * Short Description. (use period)
         *
         * Long Description.
         *
         * @since    1.0.0
         */
        public static function deactivate()
        {

        }

    }
}
