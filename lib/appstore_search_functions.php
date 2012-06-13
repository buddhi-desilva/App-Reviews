<?php
function appstoreSearch($search_url) { ?>
	
	<script type="text/javascript" >
		jQuery(document).ready(function($) {	
			appAddRequest();
		});		
	</script>
	
	<h2>Apple Appstore search results</h2>
	<div id="app_display_container">
	<?php
	$json_result = kill3rMedia_get_remote_file($search_url);
	$search_result = json_decode($json_result);
	foreach ($search_result->results as $result) { ?>
		<div class="app_view <?php if (count($search_result->results) == 1) {echo 'single_item';} ?>">
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
	} ?>
	</div>
	<script type="text/javascript" charset="utf-8">
		jQuery(function(){
		  jQuery('#app_display_container').masonry({
		    // options
		    itemSelector : '.app_view',
		    columnWidth : 250,
				isAnimated: true,
		  });
		});
	</script>
	
	
<?php
}

function newAppPost($lookup_url) { ?>
	
	<?php
	$json_result = kill3rMedia_get_remote_file($lookup_url);
	$search_result = json_decode($json_result);
	foreach ($search_result->results as $result) {
		//Mark category based on primary Genre. Or create one if the category does not exist
		$post_main_category = app_category();
		$post_sub_category = app_category($result->primaryGenreName, $post_main_category);
		 
		$post = array(
			'post_type' => 'post',
			'post_status' => 'draft',
			'post_title' => $result->trackName,
			'post_category' => array($post_main_category, $post_sub_category)
		);
		
		//Creating the post
		$post_id = wp_insert_post( $post, false );
		
		//Tagging based on categories
		$tags = array();

		foreach($result->genres as $genre) { // Create tags from Genre
			array_push($tags, $genre);
		}

		if ($result->price == 0.00) { // Create free or paid tags
			array_push($tags, "Free");
		}
		else {
			array_push($tags, "Paid");
		}
		
		wp_set_post_tags($post_id, $tags, false); // Set post tags
		
		
		//Attachement inserting code goes here
		if ($result->artworkUrl60) {
			$featured_image_id = insert_image_from_url($result->artworkUrl60, $post_id);
			if ($featured_image_id) {
				update_post_meta( $post_id, '_thumbnail_id', $featured_image_id );
			}
		}
		
		if (($app_screenshots = $result->screenshotUrls) || ($app_screenshots = $result->ipadScreenshotUrls) || ($app_screenshots = $result->iphoneScreenshotUrls)) {
			$gallery_ids = array();
			foreach($app_screenshots as $screenshotURL) {
				$gallery_image_id = insert_image_from_url($screenshotURL, $post_id);
			}	
		}
		
		//insert gallery into content
		$post_content = '<img src="'. wp_get_attachment_thumb_url($featured_image_id) .'" alt="'. $result->trackName .'" class="post_thumb" />';
		$post_content .= $result->description;
		if ($app_screenshots) {
			$post_content .= '<hr/>[gallery size="large" exclude="'. $featured_image_id .'"]';
		}
		$post_update = array(
			'post_content' => $post_content,
			'ID' => $post_id);
		wp_update_post($post_update);
		
		
		//Add itunes store url as a custom field for future use
		add_post_meta($post_id, 'itunes_store_link', $result->trackViewUrl, true);		

		//sending the redirect url for editing the draft before publishing
		echo 'post.php?post='. $post_id .'&action=edit';

	}
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