<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       marek@codeli.sk
 * @since      1.0.0
 *
 * @package    Test_Plugin
 * @subpackage Test_Plugin/admin/partials
 */

// Get the value of the setting we've registered with register_setting()
$options = get_option( 'test_plugin_options' );
?>
<select
        id="<?php echo esc_attr( $args['label_for'] ); ?>"
        name="test_plugin_options[<?php echo esc_attr( $args['label_for'] ); ?>]">
    <option value="white" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'white', false ) ) : ( '' ); ?>>
        white
    </option>
     <option value="black" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'black', false ) ) : ( '' ); ?>>
        black
    </option>
</select>
<p class="description">Popis poľa</p>