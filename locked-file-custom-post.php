<?php
function lf_register_post_type(){

	$singular = 'Certificate';
	$plural = 'Certificates';
	$slug = str_replace( ' ', '_', strtolower( $singular ) );

	$labels = array(
		'name' 			=> $plural,
		'singular_name' 	=> $singular,
		'add_new' 		=> 'Add New',
		'add_new_item'  	=> 'Add New ' . $singular,
		'edit'		        => 'Edit',
		'edit_item'	        => 'Edit ' . $singular,
		'new_item'	        => 'New ' . $singular,
		'view' 			=> 'View ' . $singular,
		'view_item' 		=> 'View ' . $singular,
		'search_term'   	=> 'Search ' . $plural,
		'parent' 		=> 'Parent ' . $singular,
		'not_found' 		=> 'No ' . $plural .' found',
		'not_found_in_trash' 	=> 'No ' . $plural .' in Trash'
		);

	$args = array(
		'labels'              => $labels,
	        'public'              => true,
	        'publicly_queryable'  => true,
	        'exclude_from_search' => false,
	        'show_in_nav_menus'   => false,
	        'show_ui'             => true,
	        'show_in_menu'        => true,
	        'show_in_admin_bar'   => true,
	        'menu_position'       => 10,
	        'menu_icon'           => 'dashicons-book-alt',
	        'can_export'          => true,
	        'delete_with_user'    => false,
	        'hierarchical'        => false,
	        'has_archive'         => true,
	        'query_var'           => true,
	        'capability_type'     => 'post',
	        'map_meta_cap'        => true,
	        'rewrite'             => array( 
	        	'slug' => $slug,
	        	'with_front' => true,
	        	'pages' => true,
	        	'feeds' => true,

	        ),
	        'supports'            => array( 
	        	'title'
	        )
	);
	register_post_type('lockedfiles',$args);
}
add_action('init','lf_register_post_type');



  add_filter('enter_title_here', 'my_title_place_holder' , 20 , 2 );
    function my_title_place_holder($title , $post){

        if( $post->post_type == 'lockedfiles' ){
            $my_title = "Enter Student Id";
            return $my_title;
        }

        return $title;

    }
function generatePass(){

echo wp_generate_password( 8, false );
	wp_die();

}
add_action('wp_ajax_generatePass', 'generatePass');
add_action('wp_ajax_nopriv_generatePass', 'generatePass');

