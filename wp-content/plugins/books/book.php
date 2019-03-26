<?php 

/*
PLUGIN NAME: Books
AUTHOR: John Canada
VERSION: 1.0
DESCRIPTION: Small Plugin for books 
LICENSE:GPLv2
*/

if(!defined('ABSPATH')) exit;//Prevent direct access

class book{
   
    public function __construct(){
      // add_shortcode( 'loan-system' ,array($this,'process_loan_system'));
      // add_action('wp_enqueue_scripts', array($this,'enqueue_js_css_script'));
        add_action('init', array($this,'custom_post_type')); 
        add_action('init', array($this,'create_book_tax'));
       // add_filter('pre_get_posts', array($this,'query_post_type'));

     }
  
         function enqueue_js_css_script(){
             wp_enqueue_script('loansystem-js', plugins_url('assets/js/loansystem.js',__FILE__), array('jquery'), '1.0', true);
             wp_enqueue_style('loan_system_css', plugins_url('assets/css/loansystem.css', __FILE__),array(),'1.0');
           }

//    function activate(){
//     flush_rewrite_rules();
//    }

//    function deactivate(){
//      flush_rewrite_rules();
//     }

function create_book_tax() {
	register_taxonomy(
		'genre',
		'book',
		array(
			'label' => __( 'Genre' ),
			'rewrite' => array( 'slug' => 'genre' ),
			'hierarchical' => true,
		)
	);
}


// function query_post_type($query) {
//   if( is_category() ) {
//     $post_type = get_query_var('post_type');
//     if($post_type)
//         $post_type = $post_type;
//     else
//         $post_type = array('nav_menu_item', 'post', 'books'); // don't forget nav_menu_item to allow menus to work!
//     $query->set('post_type',$post_type);
//     return $query;
//     }
// }

    function custom_post_type(){
        register_post_type('book',array(

                'public'              => true,
                'label'               =>'Books',
                'hierarchical'        => false,
                'show_ui'             => true,
                'show_in_menu'        => true,
                'show_in_nav_menus'   => true,
                'show_in_admin_bar'   => true,
                'menu_position'       => 5,
                'can_export'          => true,
                'has_archive'         => true,
                'exclude_from_search' => false,
                'publicly_queryable'  => true,
                'capability_type'     => 'page',
                'show_admin_column'   => true,
                'taxonomies'          => array( 'category' ),
                'supports'            => array( 'title', 
                                                'editor',
                                                'excerpt',
                                                'author',
                                                'thumbnail',
                                                'comments',
                                                'revisions',
                                                'custom-fields',
                                             ),
      ));
    }
 } 


 
if(class_exists('book')){
    $book=new book(); 
}

// //activate
// register_activation_hook(__FILE__,array('$lsystem','activate'));
// // deactivate
// register_deactivation_hook(__FILE__,array('$lsystem','deactivate'));
