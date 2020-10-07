<?php
/*
Plugin Name: Tris Locked Cerificate
Description: A Plugin for password pretected files for user
Version:     1.0.0
Author:      Trina Haque
Author URI:  https://trinahaque.wordpress.com/
*/
if( !defined('ABSPATH') ){
	exit;
}

require_once ( plugin_dir_path(__FILE__) . 'locked-file-custom-post.php' );
require_once ( plugin_dir_path(__FILE__) . 'locked-file-meta.php' );
require_once ( plugin_dir_path(__FILE__) . 'locked-file-shortcode.php' );


function lf_admin_enqueue_scripts() {
	global $pagenow, $typenow;
	
	if ( $typenow == 'lockedfiles') {
		wp_enqueue_style( 'lf-admin-css', plugins_url( 'css/lf-admin.css', __FILE__ ) );
	}


	if ( ($pagenow == 'post.php' || $pagenow == 'post-new.php') && $typenow == 'lockedfiles' ) {
		wp_enqueue_media();
		wp_enqueue_script( 'lf-admin-js', plugins_url( 'js/admin-js.js', __FILE__ ), array(), true );
		

	}


}
add_action( 'admin_enqueue_scripts', 'lf_admin_enqueue_scripts' );

function lf_enqueue_scripts() {
	wp_enqueue_style( 'lf-style', plugins_url( 'css/lf-style.css', __FILE__ ), array(), '3.0.3' );
	wp_enqueue_script( 'lf-main-js', plugins_url( 'js/main-js.js', __FILE__ ), array('jquery'), true );
}
add_action( 'wp_enqueue_scripts', 'lf_enqueue_scripts' );







function remove_yoast_metabox_reservations(){
	
    remove_meta_box('wpseo_meta', 'lockedfiles', 'normal');

}

add_action( 'add_meta_boxes', 'remove_yoast_metabox_reservations',11 );