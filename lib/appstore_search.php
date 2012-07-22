<?php function appstoreSearch($search_url, $show_free_apps_only = 'false') {
	require_once('get_remote_file.php');
	require_once('item_display_block.php');
?>

	<script type="text/javascript" >
		jQuery(function(){
			// Initiate the adding of selected app
			appAddRequest();
			
			// Auto arrange the search result boxes
		  jQuery('#app_display_container').masonry({
		    // options
		    itemSelector : '.app_view',
		    columnWidth : 250,
				isAnimated: true,
		  });
		});
	</script>
	
	<h2>iTunes Store search results</h2>
	<div id="app_display_container">
	<?php
		$json_result = kill3rMedia_get_remote_file($search_url);
		$raw_search_result = json_decode($json_result);
		$apps_array = $raw_search_result->results;
		$displayed_apps_count = 0;
		foreach ($apps_array as $app) {
			if ($show_free_apps_only == 'false') {
				$displayed_apps_count ++;
				item_display_block($app, $raw_search_result->resultCount);
			}
			else if ($app->price == 0.00) {
				$displayed_apps_count ++;
				item_display_block($app, $raw_search_result->resultCount);
			}
		} ?>
	</div>	
	<?php 
	if ($displayed_apps_count == 0) {echo "No apps found matching your search criteria";}
} ?>