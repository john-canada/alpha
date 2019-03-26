<?php 

/*
PLUGIN NAME: Mini Loan System
AUTHOR: John Canada
VERSION: 1.0
DESCRIPTION: Small Loan System Plugin 
LICENSE:GPLv2
*/

if(!defined('ABSPATH')) exit;//Prevent direct access

class LSystem{
   
    public function __construct(){
        add_shortcode( 'loan-system' ,array($this,'process_loan_system'));
        add_action('wp_enqueue_scripts', array($this,'enqueue_js_css_script'));
        add_action('init', array($this,'create_db_table')); 

     }
  
         function enqueue_js_css_script(){
             wp_enqueue_script('loansystem-js', plugins_url('assets/js/loansystem.js',__FILE__), array('jquery'), '1.0', true);
             wp_enqueue_style('loan_system_css', plugins_url('assets/css/loansystem.css', __FILE__),array(),'1.0');
           }


    function process_loan_system($atts){
       $content='<div class="container">';
       $content.='<h2 class="heading_title">Mini Loan System</h2>';
       $content.='</div>';// end of div container
       return $content;
    }

   function activate(){
    flush_rewrite_rules();
   }

   function deactivate(){
     flush_rewrite_rules();
    }

    function create_db_table() {

        global $wpdb;
        $version = get_option( 'my_plugin_version', '1.0' );
        $charset_collate = $wpdb->get_charset_collate();
        $table_name = $wpdb->prefix . 'lsystem_loaner_table';
    
        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            lname varchar(60) NOT NULL,
            fname varchar(60) NOT NULL,
            email varchar(60) NOT NULL,
            address text(255) NOT NULL,
            Contact varchar(60) NOT NULL,
            time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
            UNIQUE KEY id (id)
        ) $charset_collate;";
    
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
                
    }

} 

if(class_exists('LSystem')){
    $lsystem=new LSystem(); 
}

//activate
//register_activation_hook(__FILE__,array('$lsystem','activate'));
// deactivate
//register_deactivation_hook(__FILE__,array('$lsystem','deactivate'));
