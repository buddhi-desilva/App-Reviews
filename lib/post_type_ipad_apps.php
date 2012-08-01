<?php
require_once('metaboxes_ipad_app.php');

function ipadideas_ipad_apps() {
  //Options for lesson plans post type
  $labels = array(
    'name' => _x('iPad apps', 'post type general name'),
    'singular_name' => _x('iPad app', 'post type singular name'),
    'add_new' => _x('Add New', 'iPad app'),
    'add_new_item' => __('Add New iPad app'),
    'edit_item' => __('Edit iPad app'),
    'new_item' => __('New iPad app'),
    'all_items' => __('All iPad apps'),
    'view_item' => __('View iPad app'),
    'search_items' => __('Search iPad apps'),
    'not_found' =>  __('No iPad apps found'),
    'not_found_in_trash' => __('No iPad apps found in Trash'), 
    'parent_item_colon' => '',
    'menu_name' => __('iPad apps')
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true,
    'show_in_nav_menus' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'ipad-apps'),
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => 5,
    'register_meta_box_cb' => 'add_ipad_apps_metaboxes',
    'supports' => array( 'title', 'thumbnail')
  );
  register_post_type('ipad-app',$args);

  register_taxonomy_for_object_type('subject', 'ipad-app');
  register_taxonomy_for_object_type('levels', 'ipad-app');
  register_taxonomy_for_object_type('price', 'ipad-app');
}

function add_ipad_apps_metaboxes() {  
  add_meta_box('ipad_apps_about_this_app', 'About this app', 'ipad_apps_about_this_app', 'ipad-app', 'normal', 'default');
  add_meta_box('ipad_apps_possible_uses', 'Possible uses', 'ipad_apps_possible_uses', 'ipad-app', 'normal', 'default');
  add_meta_box('ipad_apps_recommended_by', 'Recommended by', 'ipad_apps_recommended_by', 'ipad-app', 'normal', 'default');

  add_meta_box('authordiv', __('Author'), 'post_author_meta_box', 'ipad-app', 'normal');
}


?>