<?php /*
Plugin Name: Apple Appstore Reviews
Plugin URI: http://kill3rmedia.com
Description: Grabs Apple appstore apps and inset into your blog as a post.
Version:0.1a
Author: Buddhi deSilva
Author URI: http://kill3rmedia.com
License: GPL2


TODO: (Proof of concept stage)
1. Admin preferences screen with : DONE
		* Search field
		* Search button

2. Load apps from the appstore according to searched keywords 
		* Enable ajax for search button & pagination
		* Enable pagination


*/


define("PLUGIN_BASE_DIRECTORY", basename(dirname(__FILE__)));

require_once('app_reviews_admin.php');
require_once('lib/appstore_search.php');
require_once('lib/ajax_functions.php');
require_once('lib/post_functions.php');


// Register apps post format
add_action( 'init', 'new_post_type' );

function new_post_type() {
  add_post_type_support( 'app', 'post-formats' );
}



// Create the necessary taxonomies
add_action( 'init', 'build_taxonomies', 10 );

function build_taxonomies() {
  register_taxonomy( 'subject', 'post', array( 'hierarchical' => true, 'label' => 'Subject', 'query_var' => true, 'rewrite' => true ) );
  register_taxonomy( 'levels', 'post', array( 'hierarchical' => true, 'label' => 'Levels', 'query_var' => true, 'rewrite' => true ) );
  register_taxonomy( 'price', 'post', array( 'hierarchical' => true, 'label' => 'Price', 'query_var' => true, 'rewrite' => true ) );
}

?>
