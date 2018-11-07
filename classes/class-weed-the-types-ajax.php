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
     * delete post types functionality
     *
     * @return void
     */
    public function delete_post_types()
    {
        // check the nounce sent
        check_ajax_referer($this->plugin_name . 'xyz', 'security');

        $post_type = $_POST['submit_data'];

        if (!empty($post_type)) {
            $args = array(
                'post_type' => $post_type,
                'posts_per_page' => -1,
            );
            $query = new WP_Query($args);

            $i = 0;
            if ($query->have_posts()) {

                while ($query->have_posts()) : $query->the_post();
                $i++;
                $data['log'][] = "deleting the $i";

                // delete the post
                wp_delete_post(get_the_ID());

                endwhile;
                wp_reset_postdata();

                $data['response'] = "Done Deleting $post_type post types";
                $data['output'] = "Done Deleting $post_type post types";
            } else {
                $data['response'] = "The query results are empty try again!";
                $data['output'] = "The query results are empty try again!";
            }
        } else {
            $data['response'] = "The Selection is empty try again!";
            $data['output'] = "The Selection is empty try again!";
        }


        echo json_encode($data);
        // kill the scripts
        wp_die();

    }

    /**
     * delete product type functionalities
     *
     * @return void
     */
    public function delete_product_types()
    {
        // check the nounce sent
        check_ajax_referer($this->plugin_name . 'xyz', 'security');


        $product_type = $_POST['submit_data'];

        if (!empty($product_type)) {
            $args = array(
                'post_type' => 'product',
                'posts_per_page' => -1,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'product_type',
                        'field' => 'slug',
                        'terms' => "$product_type",
                    ),
                ),
            );
            $query = new WP_Query($args);

            $i = 0;
            if ($query->have_posts()) {
                while ($query->have_posts()) : $query->the_post();

                // delete the post
                wp_delete_post(get_the_ID());

                endwhile;
                wp_reset_postdata();

                $data['response'] = "Done Deleting $product_type post types";
                $data['output'] = "Done Deleting $product_type post types";
            } else {
                $data['response'] = "The query results are empty try again!";
                $data['output'] = "The query results are empty try again!";
            }
        } else {
            $data['response'] = "The Selection is empty try again!";
            $data['output'] = "The Selection is empty try again!";
        }


        echo json_encode($data);
        
        // kill the scripts
        wp_die();
    }

    /**
     * get post all types
     *
     * @return void
     */
    public function get_post_types()
    {
        // check the nounce sent
        check_ajax_referer($this->plugin_name . 'xyz', 'security');

        // empty string first
        $data = [];

        // get the product types
        $args = array(
            'public' => true,
            '_builtin' => false
        );

        $output = 'names'; // names or objects, note names is the default
        $operator = 'and'; // 'and' or 'or'

        $post_types = get_post_types($args, $output, $operator); 

        // loop
        foreach ($post_types as $slug => $name) {
            $data[] = ['slug' => $slug, 'name' => ucwords($name)];
        }

        // return the response
        $this->_return_response($data);


        // kill the scripts
        wp_die();
    }

    /**
     * get  all product types
     *
     * @return void
     */
    public function get_product_types()
    {
        // check the nounce sent
        check_ajax_referer($this->plugin_name . 'xyz', 'security');

        // empty string first
        $data = [];
        
        // get the product types
        $product_types = wc_get_product_types();

        // loop
        foreach ($product_types as $slug => $name) {
            $data[] = ['slug' => $slug, 'name' => ucwords($name)];
        }

        // return the response
        $this->_return_response($data);
        
        // kill the scripts
        wp_die();
    }

    /**
     * Transform input to json
     * 
     * @param $res - array
     * @return json
     */
    private function _return_response($res = array())
    {
        if (!empty($res) && is_array($res)) {
            echo json_encode($res);
            return true;
        }

        return false;
    }

}
