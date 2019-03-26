<?php 
/*
PLUGIN NAME: Load more post
AUTHOR: John Canada
VERSION: 1.0
DESCRIPTION: Small plugin to load more post;
*/

if(!defined('ABSPATH')) exit; // prevent access directly

class load_more_post{

        function __construct(){
            add_action('wp_enqueue_scripts',array($this, 'enqueue_script_load_more_post'));
        }
    
        function enqueue_script_load_more_post(){
            wp_enqueue_script('load_more_post', plugins_url('template/js/load_more_post.js', __FILE__), array('jquery'), '1.0', false);  
            wp_localize_script('load_more_post','magicalData', array('siteURL'=>get_site_URL()));
        }
}

new load_more_post();