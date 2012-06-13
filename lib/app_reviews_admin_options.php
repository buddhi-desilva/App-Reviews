<script type="text/javascript" >
	jQuery(document).ready(function($) {
		searchAppstore();
	});
</script>	
	
<div class="wrap">
	<div class="icon32" id="icon-options-app-reviews"><br/></div>
<h2>Select &amp; Insert from appstore</h2>

<form method='POST' name='appstore_search_form' id='appstore_search_form' action="">
	<table class="form-table" id="appstore_search_form_table">
	<tbody>
	<tr valign="top">
		<th scope="row">
			<label for="search_appstore_keywords">Search keywords</label>
		</th>
		<td>
			<input type="text" class="regular-text" value="" id="search_appstore_keywords" name="search_appstore_keywords"><br/>
			<span class="description">Enter the keywords for app search</span>
		</td>
		<th scope="row">
			<label for="search_appstore_id">or enter the App ID</label>
		</th>
		<td>
			<input type="text" class="regular-text" value="" id="search_appstore_id" name="search_appstore_id"><br/>
			<span class="description">i.e: 376183339</span>
		</td>

		<th scope="row" class="long_label">
			<label for="search_free_apps_only">Free apps only</label>
		</th>
		<td>
			<input type="checkbox" class="check-box" value="yes" id="search_free_apps_only" name="search_free_apps_only">
		</td>

		<td valign="top" class="submit_button">
				<input type="submit" value="Search appstore" class="button-primary widget-control-save" id="appstore_search_button" name="savewidget">
				<img alt="" title="" class="ajax-feedback" src="<?php echo home_url( '/' ); ?>/wp-admin/images/wpspin_light.gif">
		</td>
	</tr>
	</tbody></table>
</form>

<div id="apps_list" class="results">
</div>


</div>