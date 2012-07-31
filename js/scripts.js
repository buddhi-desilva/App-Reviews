function appAddRequest() {
	jQuery('.app_link_button').click(function() {
		// Indicates the user the item selected and prevents user from clicking multiple times
		jQuery('.app_link_button').attr("disabled", "disabled");
		jQuery('.app_view').addClass("disabled");
		jQuery(this).parent().parent().each(function(index){
			jQuery(this).removeClass("disabled");
			jQuery(this).find("h3:first").addClass('ajax_spinner_title');
		});
				
		//Ajax stuff
		app_id = jQuery(this).attr("id");
		var data = {
			action: 'new_app_post',
			app_id: app_id
		};
		jQuery.post(ajaxurl, data, function(response) {
			}).success(function(response) {
				window.location.replace(response);
			})
			.error(function() {
				alert('Error.. Please try again!');
				jQuery('.app_link_button').removeAttr('disabled');
				jQuery('.app_view').removeClass("disabled");
				jQuery("h3.ajax_spinner_title").removeClass('ajax_spinner_title');
			});
			
		return false;
	});
};


function searchAppstore() {
	jQuery("#appstore_search_form").submit(function() {
		jQuery('#appstore_search_button').parent().addClass('ajax_spinner_search_button');
		
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
			
		}).success(function(response) {
					jQuery('#appstore_search_button').parent().removeClass('ajax_spinner_search_button');
					jQuery('#apps_list').html(response);
				})
			.error(function() { 
					alert('Error.. Please try again!');
				});
		return false;
	});
};


function toggle_select_apps(container_id, item_class, set_class, remove_rel_value, hidden_field) {
	var selected_items = new Array();
	hidden_field_value = jQuery('input[name="'+ hidden_field +'"]').val();
	if (hidden_field_value) {
		selected_items = hidden_field_value.split(',');
	}

	jQuery('#'+container_id + " > " + '.' + item_class).click(function(){

		// alert(selected_items);

		item_id = jQuery(this).attr('id');
		item_location = selected_items.indexOf(item_id);

		if (item_location === -1) {
			selected_items.push(item_id);
			jQuery('input[name="'+ hidden_field +'"]').val(selected_items.toString());
			jQuery(this).addClass(set_class);
		}
		else {
			selected_items.splice(item_location,1);
			jQuery('input[name="'+ hidden_field +'"]').val(selected_items.toString());
			if (jQuery(this).attr('rel') == remove_rel_value) {
				jQuery(this).remove();
			}
			else {
				jQuery(this).removeClass(set_class);
			}

		}

		
	});
}