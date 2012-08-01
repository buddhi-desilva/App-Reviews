<?php
require_once('metaboxes_success_story.php');

function ipadideas_success_stories() {
  //Options for lesson plans post type
  $labels = array(
    'name' => _x('Success stories', 'post type general name'),
    'singular_name' => _x('Success story', 'post type singular name'),
    'add_new' => _x('Add New', 'success story'),
    'add_new_item' => __('Add new success story'),
    'edit_item' => __('Edit success story'),
    'new_item' => __('New success story'),
    'all_items' => __('All success stories'),
    'view_item' => __('View success story'),
    'search_items' => __('Search success stories'),
    'not_found' =>  __('No success stories found'),
    'not_found_in_trash' => __('No success stories found in Trash'), 
    'parent_item_colon' => '',
    'menu_name' => __('Success stories')
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true,
    'show_in_nav_menus' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'success-stories'),
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => 5,
    'register_meta_box_cb' => 'add_success_stories_metaboxes',
    'supports' => array( 'title', 'thumbnail')
  );
  register_post_type('success-story',$args);

  register_taxonomy_for_object_type('subject', 'success-story');
  register_taxonomy_for_object_type('levels', 'success-story');
}

function add_success_stories_metaboxes() {  
  add_meta_box('ipad_success_stories_apps_used', 'Apps used', 'ipad_meta_apps_used', 'success-story', 'normal', 'default');
  add_meta_box('ipad_success_stories_details', 'Abstract', 'ipad_success_stories_details', 'success-story', 'normal', 'default');
  add_meta_box('ipad_success_stories_more_info', 'For more info', 'ipad_success_stories_more_info', 'success-story', 'normal', 'default');

  add_meta_box('authordiv', __('Author'), 'post_author_meta_box', 'success-story', 'normal');
}


?>