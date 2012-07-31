<?php
/*
Plugin Name: Apple Appstore Reviews
Plugin URI: http://bespokecoding.co
Description: Grabs Apple appstore apps and inset into your blog as a post.
Version:2.0a
Author: Buddhi deSilva
Author URI: http://bespokecoding.co
License: GPL2
*/


define("PLUGIN_BASE_DIRECTORY", basename(dirname(__FILE__)));

require_once('app_reviews_admin.php');
require_once('lib/appstore_search.php');
require_once('lib/ajax_functions.php');
require_once('lib/post_functions.php');
require_once('lib/taxonomy_dropdown.php');

//Custom post type archives in the menu
require_once('lib/custom-post-type-archive-menu-links.php');


// Create the necessary taxonomies
add_action( 'init', 'build_taxonomies', 10 );
function build_taxonomies() { // Build basic taxonomies
  register_taxonomy( 'subject', null, array( 'hierarchical' => true, 'label' => 'Subject', 'query_var' => true, 'rewrite' => true ) );
  register_taxonomy( 'levels', null, array( 'hierarchical' => true, 'label' => 'Levels', 'query_var' => true, 'rewrite' => true ) );
  register_taxonomy( 'price', null, array( 'hierarchical' => true, 'label' => 'Price', 'query_var' => true, 'rewrite' => true, 'show_ui' => false ) );
}


// Add lesson iPad apps post type
require_once('lib/post_type_ipad_apps.php');
add_action( 'init', 'ipadideas_ipad_apps', 20 );

// Add lesson ideas post type
require_once('lib/post_type_lesson_ideas.php');
add_action( 'init', 'ipadideas_lesson_ideas', 20 );


function iPadIdeasSearchFilter($query) {
  $post_type = $_GET['type'];
  if ($post_type) {
    $query->set('post_type', $post_type);
  }
  return $query;
};
add_filter('pre_get_posts','iPadIdeasSearchFilter');



//Hook the metabox save function
add_action('save_post', 'ipad_ideas_metabox_save');

function ipad_ideas_metabox_save( $post_id ) { // saving the post meta box field

  if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
  // if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;
  if( !current_user_can( 'edit_post' ) ) return;
  
  $ipad_ideas_metabox_field_keys = preg_grep( '!^ipad_meta_!', array_keys( $_POST ));
  foreach ($ipad_ideas_metabox_field_keys as $key) {
    if( isset( $_POST[$key] ) )  
      update_post_meta( $post_id, $key, $_POST[$key]);
  }
}

?>
