<?php
function appstore_search_callback() {
	global $wpdb; // this is how you get access to the database

	if (!empty($_POST)) {		
	
		if (!empty($_POST['appstore_id'])) {
			appstoreSearch(lookup_by_id_url($_POST['appstore_id']));
		}
		else if (!empty($_POST['appstore_keywords'])) {
			appstoreSearch(search_by_term_url($_POST['appstore_keywords']), $_POST['free_apps_only']);
		}
		else {
			?>
				<h2 class="error"><b>No search criteria were given</b> (Please try again)</h2>
			<?php
		}
	}

	die(); // this is required to return a proper result
}

function new_app_post_callback() {
	global $wpdb;

	if (empty($_POST) || empty($_POST['app_id'])) {
		?>

			<h2 class="error"><b>No app id found..</b> Please search again</h2>

		<?php
	}
	else {
		newAppPost(lookup_by_id_url($_POST['app_id']));
	}

	die(); // this is required to return a proper result
}

function search_by_term_url($terms) {
	$search_criteria = array(
		'country_code' => 'SG',
		'media' => 'software',
		'entity' => 'iPadSoftware',
		'limit' => 25,
		'lang' => 'en',
		'explicit' => 'No'
		);
	$search_criteria['term'] = $terms;
	$search_str = http_build_query($search_criteria);
	$search_url = 'http://itunes.apple.com/search?' . $search_str;
	return $search_url;
}

function lookup_by_id_url($app_id) {
	$lookup_criteria = array();
	$lookup_criteria['id'] = $app_id;
	$search_str = http_build_query($lookup_criteria);
	$lookup_url = 'http://itunes.apple.com/lookup?' . $search_str;
	return $lookup_url;
}

?>