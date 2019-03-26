<?php
/*
PLUGIN NAME: DISPLAY_POST_ANYWHERE
AUTHOR: AGAW CANADA
VERSION: 2.0
*/


add_action('wp_enqueue_scripts', 'custom_display_post_anywhere'); 

function custom_display_post_anywhere(){
	
	wp_enqueue_style('handlebar-library', plugins_url('assets/css/display_post_anywhere.css', __FILE__), array(), '1.1.35');

	// wp_enqueue_script('handlebar-template', plugins_url('assets/js/compare_table_index.js', __FILE__), array('jquery', 'angularjs-lib'), '2.3.63', false);
	// wp_localize_script( 'handlebar-template', 'ajax_object', array( 'ajax_url' => admin_url('admin-ajax.php'), 'message'=>'Welcome to ajax', 'number'=>123));

}
        add_shortcode('your-record-here','display_record');
       
        function display_record(){

           $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
           $arg=array(
               'post_type'=>'post',
              //'category_name'=>'news',
               'posts_per_page'=>2,
               'paged'=>$paged
           );
    
        $the_query=new wp_query($arg);
        
            if ( $the_query->have_posts() ) {
                echo '<ul style="list-style:none">';
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
                echo '<li><a href="#">'.get_the_post_thumbnail() . '</a></li>';
                echo '<li>' . get_the_title() . '</li>';
                echo '<li>' . get_the_excerpt() . '</li>';?>
                <hr>
                <?php
            }
                echo '</ul>';
    
                $agawlinK = 999; // need an unlikely integer
                echo paginate_links( array(
                    'base' => str_replace( $agawlinK, '%#%', esc_url( get_pagenum_link( $agawlinK ) ) ),
                    'format' => '?paged=%#%',
                    'prev_text'          => __(' << '),
                    'next_text'          => __(' >> '),
                    'current' => max( 1, get_query_var('paged') ),
                    'total' =>  $the_query->max_num_pages
                ) );
    
            wp_reset_postdata();
    
            } else {
                echo"no record found";
            }
    
            }
    

