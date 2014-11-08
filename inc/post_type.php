<?
function create_gallery() {
	$labels = array(
		'name'                => 'Gallery',
		'singular_name'       => 'Gallery',
		'menu_name'           => 'Gallery',
		'parent_item_colon'   => 'Parent Gallery:',
		'all_items'           => 'All Gallery Items',
		'view_item'           => 'View Galleries',
		'add_new_item'        => 'Add New Gallery',
		'add_new'             => 'New Gallery',
		'edit_item'           => 'Edit Gallery',
		'update_item'         => 'Update Gallery',
		'search_items'        => 'Search Galleries',
		'not_found'           => 'No Galleries found',
		'not_found_in_trash'  => 'No Gallery found in Trash',
	);

	$args = array(
		'label'               => 'Galleries',
		'description'         => 'Gallery post type',
		'labels'              => $labels,
		'supports'            => array( 'title', 'excerpt', 'thumbnail', 'revisions', 'page-attributes', 'editor'),
		'hierarchical'        => true,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 6,
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => false,
		'capability_type'     => 'page',
		'menu_icon' => plugins_url( 'gm_icon_bw.png', __FILE__ ),
		'rewrite'            => array( 'slug' => 'galleries' ),
	);

	register_post_type( 'gallery', $args );
}

// Hook into the 'init' action
add_action( 'init', 'create_gallery', 0 );

  // Custom image size for Gaslamp Portfolio pages

  add_image_size('gallery-thumb', 720, 460, true);

?>