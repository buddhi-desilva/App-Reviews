<?php
require_once('metaboxes_case_study.php');

function ipadideas_case_studies() {
  //Options for lesson plans post type
  $labels = array(
    'name' => _x('Case studies', 'post type general name'),
    'singular_name' => _x('Case study', 'post type singular name'),
    'add_new' => _x('Add New', 'case study'),
    'add_new_item' => __('Add new case study'),
    'edit_item' => __('Edit case study'),
    'new_item' => __('New case study'),
    'all_items' => __('All case study'),
    'view_item' => __('View case study'),
    'search_items' => __('Search case studies'),
    'not_found' =>  __('No case studies found'),
    'not_found_in_trash' => __('No case studies found in Trash'), 
    'parent_item_colon' => '',
    'menu_name' => __('Case studies')
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true,
    'show_in_nav_menus' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'case-studies'),
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => 5,
    'register_meta_box_cb' => 'add_case_studies_metaboxes',
    'supports' => array( 'title', 'thumbnail')
  );
  register_post_type('case-study',$args);

  register_taxonomy_for_object_type('subject', 'case-study');
  register_taxonomy_for_object_type('levels', 'case-study');
}

function add_case_studies_metaboxes() {  
  add_meta_box('ipad_case_studies_apps_used', 'Apps used', 'ipad_meta_apps_used', 'case-study', 'normal', 'default');
  add_meta_box('ipad_case_studies_details', 'Abstract', 'ipad_case_studies_details', 'case-study', 'normal', 'default');
  add_meta_box('ipad_case_studies_more_info', 'For more info', 'ipad_case_studies_more_info', 'case-study', 'normal', 'default');

  add_meta_box('authordiv', __('Author'), 'post_author_meta_box', 'case-study', 'normal');
}


?>