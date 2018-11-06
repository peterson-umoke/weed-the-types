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
class Weed_The_Types_Ajax
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
     * Transform input to json
     * 
     * @param $res - array
     * @return json
     */
    private function _return_response($res = array())
    {
        return json_encode($res);
    }

    public function delete_post_types()
    {

    }


    public function delete_product_types()
    {

    }

}
