<?php
require_once('metaboxes_common.php');

function ipad_success_stories_details($post) {
  wp_editor(get_post_meta($post->ID, 'ipad_meta_abstract', true), 'ipad_meta_abstract', array('dfw' => true, 'textarea_rows' => 20, 'tabindex' => 10) );
}


function ipad_success_stories_more_info($post) { ?>
  <label for="ipad_meta_info_school"><?php _e('School') ?></label>
  <input class="p100" name="ipad_meta_info_school" tabindex="25" id="ipad_meta_info_school" value="<?php echo get_post_meta($post->ID, 'ipad_meta_info_school', true)?>" />
  
  <label for="ipad_meta_info_name"><?php _e('Name') ?></label>
  <input class="p100" name="ipad_meta_info_name" tabindex="25" id="ipad_meta_info_name" value="<?php echo get_post_meta($post->ID, 'ipad_meta_info_name', true)?>" />
  
  <label for="ipad_meta_info_email"><?php _e('Email') ?></label>
  <input class="p100" name="ipad_meta_info_email" tabindex="25" id="ipad_meta_info_email" value="<?php echo get_post_meta($post->ID, 'ipad_meta_info_email', true)?>" />
<?php }

?>