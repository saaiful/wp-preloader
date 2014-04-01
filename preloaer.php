<?php
/*
Plugin Name: WP Preloader
Plugin URI: http://saiful.im/
Description: WP Preloader will show a preloading screen for your website before all your images (including the images in CSS) are fully loaded.Use &lt;?php add_preloader(); ?&gt; after body tag To Show Preloader.
Version: 1.0.0
Author: Saiful Islam
Author URI: http://saiful.im/
*/
wp_enqueue_script("jquery");
add_action('wp_head','preloaderCSS');
function preloaderCSS()
{

$output="
<style type=\"text/css\">
body { overflow: hidden; }
#wp_preloader {
    position:fixed;
    top:0;
    left:0;
    right:0;
    bottom:0;
    background-color:#fff;
    z-index:99;
}
#wp_status {
    width:200px;
    height:200px;
    position:absolute;
    left:50%;
    top:50%; 
    background-image:url(".get_option('wp-preloaderIMG').");
    background-repeat:no-repeat;
    background-position:center;
    margin:-100px 0 0 -100px;
}
</style>";

echo $output;

}

wp_enqueue_script( 'preloaderJS', plugin_dir_url( __FILE__ ) . 'js/preloader.js' );
function add_preloader(){
	echo '<div id="wp_preloader">
    <div id="wp_status">&nbsp;</div>
</div>';
}

function wppreloader_register_settings() {
	add_option( 'wp-preloaderIMG', plugin_dir_url( __FILE__ ).'img/preloader.gif');
	register_setting( 'default', 'wp-preloaderIMG' ); 
} 
add_action( 'admin_init', 'wppreloader_register_settings' );

function wppreloader_register_options_page() {
	add_options_page('wp-preloader', 'wp-preloader', 'manage_options', 'wppreloader-options', 'wppreloader_options_page');
}
add_action('admin_menu', 'wppreloader_register_options_page');

function wppreloader_options_page(){
	echo '<div class="wrap">';
	echo '<h2>WP-Preloader Setting</h2>';
	echo '<form method="post" action="options.php">';
	echo '<table class="form-table">
				<tr valign="top">
					<th scope="row"><label for="wp-preloaderIMG">SMSDesh Username</label></th>
					<td><input type="text" id="wp-preloaderIMG" name="wp-preloaderIMG" value="'; ?><?php echo get_option('wp-preloaderIMG'); ?><?php echo '" />
</td>
				</tr>
		</table>		';
		submit_button();
	
	echo '</form></div>';
}

?>