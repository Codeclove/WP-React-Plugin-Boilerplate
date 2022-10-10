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
	<input
			id="<?php echo esc_attr( $args['label_for'] ); ?>"
			type="text"
			name="test_plugin_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
			value= "<?php echo isset($options[ $args['label_for'] ]) ? $options[ $args['label_for']] : '';  ?>"
	/>
    <?php if($args['label_for'] === 'test_plugin_input_field' ) :?>
    <p class="description">Popis poľa</p>
        <?php endif; ?>

	<?php
