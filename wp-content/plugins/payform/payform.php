<?php
/*
Plugin Name: PayForm
Version: 2.0
Plugin URI: http://payform.me/
Author: PayForm
Description: Embed a payment form anywhere on your WordPress site
*/

if (!isset($payform_for_wordpress)) {
  $payform_for_wordpress = array('base');
} else {
  $payform_for_wordpress[] = 'base';
}

add_action( 'admin_menu', 'payform_base_info_menu' );

function payform_base_info_menu(){

  $page_title = 'PayForm';
  $menu_title = 'PayForm';
  $capability = 'manage_options';
  $menu_slug  = 'payform-base-info';
  $function   = 'payform_base_info_page';
  $icon_url   = 'dashicons-media-code';
  $position   = 30.1;

  add_menu_page( $page_title,
                 $menu_title, 
                 $capability, 
                 $menu_slug, 
                 $function, 
                 $icon_url, 
                 $position );
}

function payform_base_info_page(){
  if (isset($_POST['payform_wave2_id'])) {
    update_option('payform_wave2_id', $_POST['payform_wave2_id']);
  }
  ?>
  <div style="margin-top: 50px;">
    <img src="https://payform.me/wp-content/themes/payform-1/images/logo.png" height="50">
    <h3>Start using PayForm in Wordpress</h3>
    <p>Start using PayForm to insert payment forms in Wordpress is very easy. Just follow these steps:</p>
    <p>
      <b>&middot;</b> If you don't have an account, <b>visit <a href="https://payform.me/" target="_new">PayForm.me</a></b> to create your account.
    </p>
    <p>
      <b>&middot;</b> In your <b><a href="https://app.payform.me/dashboard/" target="_new">PayForm Dashboard</a></b>, go to <b>Settings / Integrations / Wordpress</b>
    </p>
    <p>
      <b>&middot;</b> Copy and paste the <b>integration key</b> in the following box. <b>Do not share this integration key.</b>
    </p>
    <br>
    <form method="post">
      <input maxlength="36" type="password" name="payform_wave2_id" placeholder="xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx" value="<?php echo get_option('payform_wave2_id');?>" style="width: 270px"><button>Save Integration Key</button>
    </form>
  </div>
  <?php
}


function payform_base_embed_settings_link($links) { 
  $support = '<a target="_new" href="https://support.payform.me/">Support</a>'; 
  array_unshift($links, $support); 
  $howto_link = '<a href="admin.php?page=payform-base-info">Use plugin</a>';
  array_unshift($links, $howto_link); 
  return $links; 
}
$plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$plugin", 'payform_base_embed_settings_link');


if (!function_exists('payform_embed_content_filter')) {

  function payform_embed_content_filter( $content ) {
    $search = "(\[payform=([A-Za-z0-9]+)\])";
    $content = preg_replace($search,"<div class='payform_wp_container'><span class='payform_wp' payform_id='$1'></span></div>",$content);
      return $content;
  }
  add_filter( 'the_content', 'payform_embed_content_filter' );

  function payform_embed_enqueue_script() {   
      wp_enqueue_script( 'payform_embed_script', plugin_dir_url( __FILE__ ) . 'js/payform.js', array( 'jquery' ) );
  }
  add_action('wp_enqueue_scripts', 'payform_embed_enqueue_script');

  function payform_embed_admin_enqueue_script() {   
      wp_enqueue_script( 'payform_embed_script', plugin_dir_url( __FILE__ ) . 'js/editor.js', array( 'jquery' ) );
  }
  add_action('admin_enqueue_scripts', 'payform_embed_admin_enqueue_script');

  function payform_embed_button() {
    global $payform_for_wordpress;
    $available_string = implode(",", $payform_for_wordpress);
    ?>
    <div id="payform-popup" style="position: absolute; top: 48px; width: 300px; z-index: 999; height: 200px; display: none; background: white; border: 1px solid gray;"> 
      <iframe src="https://app.payform.me/wordpress/wave2_forms/<?php echo get_option('payform_wave2_id');?>?return_url=<?php echo urlencode(admin_url('admin.php?page=payform-base-info'));?>" style="position: absolute; top: 0px; left:0px; width: 100%; height: 100%; border: 0px;"></iframe>
    </div>
    <?php
    echo '<button type="button" id="add-payform" class="button" data-available="'.$available_string.'"><img src="https://i.imgur.com/UPuhR1V.png" width="20" style="position:relative; top: -2px;">Add PayForm</button>';
  }
  add_action('media_buttons', 'payform_embed_button');

}
