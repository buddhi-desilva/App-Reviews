<?php function appstoreSearch($search_url, $show_free_apps_only = 'false') { ?>
	
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

<?php function item_display_block($result, $result_ount) { ?>
<div class="app_view <?php if ($result_ount == 1) {echo 'single_item';} ?>">
	<div class="app_title">
		<h3>
			<?php echo $result->trackName ?>
			<span class='app_price'>
				<?php  if ($result->price == 0.00) { // Create free or paid tags
					echo "(Free app)";
				}
				else {
					echo '(Price: ' . $result->currency . $result->price . ')';
				} ?>
			</span>
		</h3>
	</div>
	<p>
		<div class="button_area">
			<img src="<?php echo $result->artworkUrl60 ?>" />
			<button id="<?php echo $result->trackId ?>" class="button-primary app_link_button">Add</button>
		</div>
		<div class='ratings'>
			<?php echo 'Average user rating: <b>' . $result->averageUserRatingForCurrentVersion . '</b>'; ?>
		</div>
		<?php echo $result->description; ?>
	</p>
	<div class="genre">
		<b>Genre(s): </b>
		<?php
		echo implode(", ", $result->genres);
		?>
	</div>
</div>

<?php
}

function kill3rMedia_get_remote_file($url) 
{ 
    if (ini_get('allow_url_fopen')) { 
        return @file_get_contents($url); 
    } 
    elseif (function_exists('curl_init')) { 
        $c = curl_init($url); 
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($c, CURLOPT_HEADER, 0); 
        $file = curl_exec($c); 
        curl_close($c); 
        return $file; 
    } 
    else { 
        die('Could not access file from remoteserver!'); 
    } 
} 


?>