<?php
require_once('lesson_ideas_metaboxes.php');


function ipadideas_lesson_ideas() {
  //Options for lesson plans post type
  $labels = array(
    'name' => _x('Lesson ideas', 'post type general name'),
    'singular_name' => _x('Lesson idea', 'post type singular name'),
    'add_new' => _x('Add New', 'lesson idea'),
    'add_new_item' => __('Add New Lesson idea'),
    'edit_item' => __('Edit Lesson idea'),
    'new_item' => __('New Lesson idea'),
    'all_items' => __('All Lesson ideas'),
    'view_item' => __('View Lesson idea'),
    'search_items' => __('Search Lesson ideas'),
    'not_found' =>  __('No lesson ideas found'),
    'not_found_in_trash' => __('No lesson ideas found in Trash'), 
    'parent_item_colon' => '',
    'menu_name' => __('Lesson ideas')
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true,
    'show_in_nav_menus' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'lesson-ideas'),
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => 5,
    'register_meta_box_cb' => 'add_lesson_ideas_metaboxes',
    'supports' => array( 'title', 'thumbnail')
  ); 
  register_post_type('lesson-idea',$args);
  register_taxonomy_for_object_type('subject', 'lesson-idea');
  register_taxonomy_for_object_type('levels', 'lesson-idea');
}


function add_lesson_ideas_metaboxes() {
  wp_enqueue_style('ipad_ieas_meta_css', WP_PLUGIN_URL."/".PLUGIN_BASE_DIRECTORY . '/css/meta.css');
  
  add_meta_box('ipad_lesson_objectives', 'Lesson objectives', 'ipad_lesson_objectives', 'lesson-idea', 'normal', 'default');
  add_meta_box('ipad_lesson_procedure', 'Lesson procedure', 'ipad_lesson_procedure', 'lesson-idea', 'normal', 'default');
  add_meta_box('ipadideas_meta_field_contributors', 'Lesson contributors', 'ipadideas_meta_field_contributors', 'lesson-idea', 'normal', 'default');

  add_meta_box('authordiv', __('Author'), 'post_author_meta_box', 'lesson-idea', 'normal');
}

?>