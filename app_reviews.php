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
require_once('lib/appstore_search_functions.php');
require_once('lib/ajax_functions.php');
require_once('lib/post_functions.php');

?>
