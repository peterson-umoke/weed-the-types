<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/peterson-umoke
 * @since             1.0.0
 * @package           Weed_The_Types
 *
 * @wordpress-plugin
 * Plugin Name:       Weed The Types
 * Plugin URI:        https://github.com/peterson-umoke/weed-the-types
 * Description:       This is a plugin that is used to delete unwanted post types and product types
 * Version:           1.0.0
 * Author:            Peterson Umoke Nwachukwu
 * Author URI:        https://github.com/peterson-umoke
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       weed-the-types
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('PLUGIN_NAME_VERSION', '1.0.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-weed-the-types-activator.php
 */
function activate_weed_the_types()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-weed-the-types-activator.php';
	Weed_The_Types_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-weed-the-types-deactivator.php
 */
function deactivate_weed_the_types()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-weed-the-types-deactivator.php';
	Weed_The_Types_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_weed_the_types');
register_deactivation_hook(__FILE__, 'deactivate_weed_the_types');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'vendor/autoload.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_weed_the_types()
{

	$plugin = new Weed_The_Types();
	$plugin->run();

}
run_weed_the_types();
