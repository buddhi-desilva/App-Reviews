<?php
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
function app_category($cat_name = NULL, $parent_cat_id = NULL	) {
	if ($cat_name == NULL) {
		$cat_name = 'iOS Software';
	}
	if (get_cat_ID($cat_name ) == 0) {
		if ($parent_cat_id == NULL) {
			return wp_create_category($cat_name);
		}
		else {
			return wp_create_category($cat_name, $parent_cat_id);
		}
	}
	else {
		return get_cat_ID($cat_name);
	}
}


?>