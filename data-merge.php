<?php

/**
 * Plugin Name:       data-merge
 * Plugin URI:        https://facebook.com/osmanhaider.adnan
 * Description:       Address book plugin for test.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Adnan
 * Author URI:        https://facebook.com/osmanhaider.adnan
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://facebook.com/osmanhaider.adnan
 * Text Domain:       my-basics-plugin
 * Domain Path:       /languages
 */

use Elementor\Core\Utils\Str;

if ( ! defined( 'ABSPATH' ) ) {
    die;
}

final class Ascode_Addressbook {

    const version = '1.0.0';

    private function __construct() {
        $this -> define_constants();
        $this -> make_csv_file();    
        add_action( 'plugins_loaded', [ $this, 'init_plugin' ] );
    }

    /**
     * Define essential constants 
     */
    public function define_constants() {
        define( 'ASCODE_VERSION', self::version );
    }

    public function init_plugin() {
        add_action( 'admin_menu', [ $this, 'admin_menu' ] );
    }

    function make_csv_file() {
        global $wpdb;

        $comment_data = $wpdb->get_results("SELECT
                    ID,
                    post_title,
                    comment_content,
                    comment_author,
                    comment_author_email,
                    comment_date,
                    comment_ID
                FROM
                    {$wpdb->prefix}comments AS comments
                INNER JOIN {$wpdb->prefix}posts AS post 
                    ON post.ID = comments.comment_post_ID");

        $comment_data = json_decode(json_encode($comment_data), true);

        $comment_meta = [];
        foreach( $comment_data as $key => $comments ) {
            $comment_meta = get_comment_meta($comments['comment_ID']);

            $stractured_data = [];
            foreach ($comment_meta as $key => $value) { 
                $stractured_data[$key] = $value[0];
            }

            $review_data[] = $comments + $stractured_data;
        }
       
        $file_csv = fopen('reviews.csv', 'w');
        foreach( $review_data as $key => $value ) {
            fputcsv($file_csv, $value );
        }
        fclose($file_csv);
    }

    public function admin_menu(){
        $parent_slug = 'data-fetch';
        $capabilities = 'manage_options';
        add_menu_page( 
            'Data Fetch', 
            'Data Fetch', 
            $capabilities, 
            $parent_slug, 
            [ $this , 'data_fetch' ], 
            'dashicons-format-aside' 
        );
    }

    public function data_fetch() {
        global $wpdb;

        $comment_data = $wpdb->get_results("SELECT
                    ID,
                    post_title,
                    comment_content,
                    comment_author,
                    comment_author_email,
                    comment_date,
                    comment_ID
                FROM
                    {$wpdb->prefix}comments AS comments
                INNER JOIN {$wpdb->prefix}posts AS post 
                    ON post.ID = comments.comment_post_ID");

        $comment_data = json_decode(json_encode($comment_data), true);

        $comment_meta = [];
        foreach( $comment_data as $key => $comments ) {
            $comment_meta = get_comment_meta($comments['comment_ID']);
            $stractured_data = [];
            foreach ($comment_meta as $key => $value) { 
                $stractured_data[$key] = $value[0];
            }
            $review_data[] = $comments + $stractured_data;
        }
        

        foreach($review_data as $key=>$values) {
            echo '<pre>';
            print_r($values);
            echo '</pre>';
        }
    }

    /**
     * define singleton instance 
     */
    public static function init() {
        static $instance = false;
        if( ! $instance ){
            $instance = new self();
        }
        return $instance;
    }

}

function data_merge() {
   return Ascode_Addressbook:: init();
}

//start from here
data_merge();
