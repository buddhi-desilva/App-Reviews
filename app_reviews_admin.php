<?php
// Register admin header
add_action('admin_head', 'app_reviews_admin_register_head');
//
function app_reviews_admin_register_head() { ?>
	<script type="text/javascript" src="<?php echo WP_PLUGIN_URL."/".PLUGIN_BASE_DIRECTORY ?>/js/jquery.form.js"></script>
	<script type="text/javascript" src="<?php echo WP_PLUGIN_URL."/".PLUGIN_BASE_DIRECTORY ?>/js/scripts.js"></script>
	<script type="text/javascript" src="<?php echo WP_PLUGIN_URL."/".PLUGIN_BASE_DIRECTORY ?>/js/jquery.masonry.min.js"></script>
	<link href="<?php echo WP_PLUGIN_URL."/".PLUGIN_BASE_DIRECTORY ?>/css/admin.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo WP_PLUGIN_URL."/".PLUGIN_BASE_DIRECTORY ?>/css/admin.css" rel="stylesheet" type="text/css"/>
<?php }


//Register the menu
add_action( 'admin_menu', 'app_reviews_menu' );
//
function app_reviews_menu() {
	add_menu_page( 'App Reviews Options', 'App Reviews', 'edit_pages', 'app_reviews', 'app_reviews_admin_options');
}

function app_reviews_admin_options() {
	if ( !current_user_can( 'edit_pages' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	require_once('lib/app_reviews_admin_options.php');
}

add_action('wp_ajax_appstore_search', 'appstore_search_callback');
add_action('wp_ajax_new_app_post', 'new_app_post_callback');

?>