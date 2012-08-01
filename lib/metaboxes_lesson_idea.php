<?php
require_once('metaboxes_common.php');

function ipad_lesson_objectives($post) { ?>
  <label class="screen-reader-text" for="ipad_meta_objective"><?php _e('Lesson objective') ?></label><textarea rows="4" class="p100" name="ipad_meta_objective" tabindex="10" id="ipad_meta_objective"><?php echo get_post_meta($post->ID, 'ipad_meta_objective', true) // textarea_escaped ?></textarea>
<?php }


function ipad_lesson_procedure($post) { ?>
  <div id="postdivrich-lesson-procedure" class="postarea">
    <?php wp_editor(get_post_meta($post->ID, 'ipad_meta_lesson-procedure', true), 'ipad_meta_lesson-procedure', array('dfw' => true, 'textarea_rows' => 15, 'tabindex' => 15) ); ?>
  </div>
<?php }


function ipad_lesson_contributors($post) { ?>
  <label class="screen-reader-text" for="ipad_meta_contributors"><?php _e('Contributors') ?></label>
  <input class="p100" name="ipad_meta_contributors" tabindex="20" id="ipad_meta_contributors" value="<?php echo get_post_meta($post->ID, 'ipad_meta_contributors', true) // textarea_escaped ?>" />
<?php }

?>