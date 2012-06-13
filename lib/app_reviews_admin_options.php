<script type="text/javascript" >
	jQuery(document).ready(function($) {
		searchAppstore();
	});
</script>	
	
<div class="wrap">
	<div class="icon32" id="icon-options-general"><br/></div>
<h2>Select &amp; Insert from appstore</h2>

<form method='POST' name='appstore_search_form' id='appstore_search_form' action="">
	<table class="form-table">
	<tbody>
	<tr valign="top">
	<th scope="row"><label for="search_appstore_keywords">Search keywords</label></th>
	<td><input type="text" class="regular-text" value="" id="search_appstore_keywords" name="search_appstore_keywords">
	<span class="description">Enter the keywords for app search</span></td>
	</tr>

	<tr valign="top">
	<th scope="row">or</th>
	<td></td>
	</tr>

	<tr valign="top">
	<th scope="row"><label for="search_appstore_id">enter App ID</label></th>
	<td><input type="text" class="regular-text" value="" id="search_appstore_id" name="search_appstore_id">
	<span class="description">i.e: 376183339</span></td>
	</tr>

	<tr valign="top">
	<td colspan='2'><hr/></td>
	</tr>

	<tr valign="top">
	<th scope="row"><label for="search_free_apps_only">Restrict results to free apps</label></th>
	<td><input type="checkbox" class="check-box" value="" id="search_free_apps_only" name="search_free_apps_only">
	<span class="description"></span></td>
	</tr>


	</tbody></table>
	<p class="submit">
		<input type="submit" value="Search appstore" class="button-primary widget-control-save" id="appstore_search_button" name="savewidget">
		<img alt="" title="" class="ajax-feedback" src="<?php echo home_url( '/' ); ?>/wp-admin/images/wpspin_light.gif">
	</p>
</form>

<div id="apps_list" class="results">
</div>


</div>