<?php
function newAppPost($lookup_url) {
	require_once('get_remote_file.php');

	$json_result = kill3rMedia_get_remote_file($lookup_url);
	$search_result = json_decode($json_result);
	foreach ($search_result->results as $result) {

		//Mark category based on primary Genre. Or create one if the category does not exist
		// $post_main_category = find_parent_cat();
		// $post_sub_category = app_category($result->primaryGenreName, $post_main_category);
		 
		$post = array(
			'post_type' => 'ipad-app',
			'post_status' => 'draft',
			'post_title' => $result->trackName,
			// 'post_category' => array($post_main_category, $post_sub_category)
		);
		
		//Creating the post
		$post_id = wp_insert_post( $post, false );
		
		//Tagging based on categories
		// $tags = array();

		// foreach($result->genres as $genre) { // Create tags from Genre
		// 	array_push($tags, $genre);
		// }

		// if ($result->price == 0.00) { // Create free or paid tags
		// 	array_push($tags, "Free");

		// 	//Add price as a custom field
		// 	add_post_meta($post_id, 'Price', 'Free', true);

		// }
		// else {
		// 	array_push($tags, "Paid");

		// 	//Add price as a custom field
		// 	add_post_meta($post_id, 'Price', $result->currency . $result->price, true);
		// }

		// wp_set_post_tags($post_id, $tags, false); // Set post tags



		//Create taxon terms based on price tags
		$price_range = array(
			'Free' => 0.00,
			'0.1-0.99' => 0.99,
			'2-5' => 5,
			'5-10' => 10,
			'10-20' => 20,
			'20-50' => 50,
			'50-100' => 100,
			'100-500' => 500,
			'500-1000' => 1000
			);

		$price_name = '1000-or-more';

		foreach ($price_range as $slug => $value) {
			if ($result->price <= $value) {
				$price_name = $slug;
				break;
			}
		}

		wp_set_object_terms($post_id, $price_name, 'price', false);
		
		
		//Attachement inserting code goes here
		if ($result->artworkUrl60) {
			$featured_image_id = insert_image_from_url($result->artworkUrl60, $post_id);
			if ($featured_image_id) {
				update_post_meta( $post_id, '_thumbnail_id', $featured_image_id );
			}
		}
		
		// if (($app_screenshots = $result->screenshotUrls) || ($app_screenshots = $result->ipadScreenshotUrls) || ($app_screenshots = $result->iphoneScreenshotUrls)) {
		// 	$gallery_ids = array();
		// 	foreach($app_screenshots as $screenshotURL) {
		// 		$gallery_image_id = insert_image_from_url($screenshotURL, $post_id);
		// 	}	
		// }
		
		//insert gallery into content
		// $post_content = '<img src="'. wp_get_attachment_thumb_url($featured_image_id) .'" alt="'. $result->trackName .'" class="post_thumb" />';
		// $post_content .= $result->description;
		// if ($app_screenshots) {
		// 	$post_content .= '<!--more-->';
		// 	$post_content .= '<hr/>[gallery size="large" exclude="'. $featured_image_id .'"]';
		// }
		// $post_update = array(
		// 	'post_content' => $post_content,
		// 	'ID' => $post_id);
		// wp_update_post($post_update);
		
		
		//Add itunes store url as a custom field
		add_post_meta($post_id, 'itunes_store_link', $result->trackViewUrl, true);

		//sending the redirect url for editing the draft before publishing
		echo 'post.php?post='. $post_id .'&action=edit';

	}
}


function insert_image_from_url($imageurl, $post_id) {
	$uploads = wp_upload_dir();
	
	$imageurl = stripslashes($imageurl);
	$filename = wp_unique_filename( $uploads['path'], basename($imageurl), $unique_filename_callback = null );
	$wp_filetype = wp_check_filetype($filename, null );
	$fullpathfilename = $uploads['path'] . "/" . $filename;

	// try {
		if ( !substr_count($wp_filetype['type'], "image") ) {
			throw new Exception( basename($imageurl) . ' is not a valid image. ' . $wp_filetype['type']  . '' );
		}
	
		$image_string = kill3r_fetch_image($imageurl);
		$fileSaved = file_put_contents($uploads['path'] . "/" . $filename, $image_string);
		
		if ( !$fileSaved ) {
			throw new Exception("The file cannot be saved.");
		}
		
		$attachment = array(
			 'post_mime_type' => $wp_filetype['type'],
			 'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
			 'post_content' => '',
			 'post_status' => 'inherit',
			 'guid' => $uploads['url'] . "/" . $filename
		);
		$attach_id = wp_insert_attachment( $attachment, $fullpathfilename, $post_id );
		if ( !$attach_id ) {
			throw new Exception("Failed to save record into database.");
		}
		require_once(ABSPATH . "wp-admin" . '/includes/image.php');
		$attach_data = wp_generate_attachment_metadata( $attach_id, $fullpathfilename );
		wp_update_attachment_metadata( $attach_id,  $attach_data );
		
		if ($attach_id) {
			return $attach_id;
		}
	
	// } catch (Exception $e) {
	// 	$error = '<div id="message" class="error"><p>' . $e->getMessage() . '</p></div>';
	// }
}

function kill3r_fetch_image($url) {
	if ( function_exists("curl_init") ) {
		return kill3r_curl_fetch_image($url);
	} elseif ( ini_get("allow_url_fopen") ) {
		return kill3r_fopen_fetch_image($url);
	}
}

function kill3r_curl_fetch_image($url) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$image = curl_exec($ch);
	curl_close($ch);
	return $image;
}
function kill3r_fopen_fetch_image($url) {
	$image = file_get_contents($url, false, $context);
	return $image;
}

//Create app categories or returns cateogry id based on category name
// if nothing's passed the main cateogry will be created and/or returned
function app_category($cat_name = NULL, $parent_cat_id) {
	if (get_cat_ID($cat_name ) == 0) {
		return wp_create_category($cat_name, $parent_cat_id);
	}
	else {
		return get_cat_ID($cat_name);
	}
}

// function find_parent_cat() {
//   // Set the required categories
//   $main_cat = 'Resources';
//   $apps_cat = 'Education apps';  

//   if (get_cat_ID($main_cat) == 0) {
//     $main_cat_id = wp_create_category($main_cat);
//   }

//   if (get_cat_ID($apps_cat) == 0) {
//     $apps_cat_id = wp_create_category($apps_cat);
//   }

//   $main_cat_id = get_cat_ID($main_cat);
//   $apps_cat_id = get_cat_ID($apps_cat);


//   //Check if the Apps category is under resources and if not, moves it under resources
//   $categories = get_categories(array('include' => $apps_cat_id, 'exclude' => $main_cat_id, 'hide_empty' => 0 ));
//   foreach($categories as $category) {
//     if (!$category->category_parent || !($category->category_parent == $main_cat_id)) {
//       wp_update_term($category->term_id, 'category', array('parent' => $main_cat_id));
//     }
//   }
  

//   return $apps_cat_id;
// }


?>