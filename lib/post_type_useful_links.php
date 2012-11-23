<?php
require_once('metaboxes_useful_link.php');

function ipadideas_useful_links() {
  //Options for lesson plans post type
  $labels = array(
    'name' => _x('Useful links', 'post type general name'),
    'singular_name' => _x('Useful link', 'post type singular name'),
    'add_new' => _x('Add New', 'useful link'),
    'add_new_item' => __('Add New Useful link'),
    'edit_item' => __('Edit Useful link'),
    'new_item' => __('New Useful link'),
    'all_items' => __('All Useful links'),
    'view_item' => __('View Useful link'),
    'search_items' => __('Search Useful links'),
    'not_found' =>  __('No Useful links found'),
    'not_found_in_trash' => __('No Useful links found in Trash'),
    'parent_item_colon' => '',
    'menu_name' => __('Useful links')
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'show_in_nav_menus' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'useful-links'),
    'capability_type' => 'post',
    'has_archive' => true,
    'hierarchical' => false,
    'menu_position' => 6,
    'register_meta_box_cb' => 'add_useful_links_metaboxes',
    'supports' => array( 'title', 'thumbnail')
  );
  register_post_type('useful-link',$args);
}


function add_useful_links_metaboxes() {
  add_meta_box('ipad_useful_url', 'URL', 'ipad_useful_url', 'useful-link', 'normal', 'default');
  add_meta_box('ipad_useful_description', 'Descriotion', 'ipad_useful_description', 'useful-link', 'normal', 'default');
  add_meta_box('authordiv', __('Author'), 'post_author_meta_box', 'useful-link', 'normal');
}

?>