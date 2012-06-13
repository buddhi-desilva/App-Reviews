function appAddRequest() {
	jQuery('.app_link_button').click(function() {
		app_id = jQuery(this).attr("id");
		var data = {
			action: 'new_app_post',
			app_id: app_id
		};
		
		jQuery.post(ajaxurl, data, function(response) {
				window.location.replace(response);
		});
		return false;
	});
};

function searchAppstore() {
	jQuery("#appstore_search_form").submit(function() {
		
		appstore_keywords = jQuery('#search_appstore_keywords').val();
		appstore_id = jQuery('#search_appstore_id').val();
		free_apps_only = jQuery('#search_free_apps_only').is(':checked');
		var data = {
			action: 'appstore_search',
			appstore_id: appstore_id,
			appstore_keywords: appstore_keywords,
			free_apps_only: free_apps_only
		};

		jQuery.post(ajaxurl, data, function(response) {
				jQuery('#apps_list').html(response);
		});
		return false;
	});
};