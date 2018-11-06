<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://github.com/peterson-umoke
 * @since      1.0.0
 *
 * @package    Weed_The_Types
 * @subpackage Weed_The_Types/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Weed_The_Types
 * @subpackage Weed_The_Types/includes
 * @author     Peterson Umoke Nwachukwu <umoke10@hotmail.com>
 */
class Weed_The_Types_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'weed-the-types',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
