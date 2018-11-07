<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/peterson-umoke
 * @since      1.0.0
 *
 * @package    Weed_The_Types
 * @subpackage Weed_The_Types/classes
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Weed_The_Types
 * @subpackage Weed_The_Types/admin
 * @author     Peterson Umoke Nwachukwu <umoke10@hotmail.com>
 */
class Weed_The_Types_Menu
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Add the menu to the navbar
     * 
     * @return void
     */
    public function register_menus()
    {
        $parent_name = $this->plugin_name . "-weed-types";
        add_menu_page('Weed The Types', 'Weed The Types', 'manage_options', $parent_name, null, 'dashicons-trash', 11);
        add_submenu_page($parent_name, 'Weed Product Types', 'Weed Product Types', 'manage_options', $this->plugin_name . '-product-types', array($this, 'delete_product_types'));
        add_submenu_page($parent_name, 'Weed Post Types', 'Weed Post Types', 'manage_options', $this->plugin_name . '-post-types', array($this, 'delete_post_types'));
        remove_submenu_page($parent_name, $parent_name);
    }

    /**
     * require the file for delete post types
     *
     * @return void
     */
    public function delete_post_types()
    {
        require_once WTT_DIR . "/templates/delete_post_posts.php";
    }


    /**
     * require the file that delete poroduct types
     *
     * @return void
     */
    public function delete_product_types()
    {
        require_once WTT_DIR . "/templates/delete_product_types.php";
    }

}
