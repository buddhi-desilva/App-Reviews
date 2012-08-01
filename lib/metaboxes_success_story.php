<?php
require_once('metaboxes_common.php');

function ipad_success_stories_details($post) { ?>
  <label for="ipad_meta_abstract"><?php _e('Abstract') ?></label>
  <textarea rows="2" class="p100" name="ipad_meta_abstract" tabindex="10" id="ipad_meta_abstract"><?php echo get_post_meta($post->ID, 'ipad_meta_abstract', true) ?></textarea>

  <label for="ipad_meta_motivation"><?php _e('Motivation') ?></label>
  <textarea rows="2" class="p100" name="ipad_meta_motivation" tabindex="10" id="ipad_meta_motivation"><?php echo get_post_meta($post->ID, 'ipad_meta_motivation', true) ?></textarea>


  <label for="ipad_meta_problem_statement"><?php _e('Problem statement') ?></label>
  <textarea rows="2" class="p100" name="ipad_meta_problem_statement" tabindex="10" id="ipad_meta_problem_statement"><?php echo get_post_meta($post->ID, 'ipad_meta_problem_statement', true) ?></textarea>

  <label for="ipad_meta_approach"><?php _e('Approach') ?></label>
  <textarea rows="2" class="p100" name="ipad_meta_approach" tabindex="10" id="ipad_meta_approach"><?php echo get_post_meta($post->ID, 'ipad_meta_approach', true) ?></textarea>

  <label for="ipad_meta_results"><?php _e('Results') ?></label>
  <textarea rows="2" class="p100" name="ipad_meta_results" tabindex="10" id="ipad_meta_results"><?php echo get_post_meta($post->ID, 'ipad_meta_results', true) ?></textarea>

  <label for="ipad_meta_conclusions"><?php _e('Conclusions') ?></label>
  <textarea rows="2" class="p100" name="ipad_meta_conclusions" tabindex="10" id="ipad_meta_conclusions"><?php echo get_post_meta($post->ID, 'ipad_meta_conclusions', true) ?></textarea>

<?php }


function ipad_success_stories_more_info($post) { ?>
  <label for="ipad_meta_info_school"><?php _e('School') ?></label>
  <input class="p100" name="ipad_meta_info_school" tabindex="25" id="ipad_meta_info_school" value="<?php echo get_post_meta($post->ID, 'ipad_meta_info_school', true)?>" />
  
  <label for="ipad_meta_info_name"><?php _e('Name') ?></label>
  <input class="p100" name="ipad_meta_info_name" tabindex="25" id="ipad_meta_info_name" value="<?php echo get_post_meta($post->ID, 'ipad_meta_info_name', true)?>" />
  
  <label for="ipad_meta_info_email"><?php _e('Email') ?></label>
  <input class="p100" name="ipad_meta_info_email" tabindex="25" id="ipad_meta_info_email" value="<?php echo get_post_meta($post->ID, 'ipad_meta_info_email', true)?>" />
<?php }

?>