<?php

function ipad_apps_about_this_app($post){ ?>
  <?php wp_editor(get_post_meta($post->ID, 'ipad_meta_about_this_app', true), 'ipad_meta_about_this_app', array('dfw' => true, 'textarea_rows' => 15, 'tabindex' => 5) ); ?>
<?php }


function ipad_apps_possible_uses($post){ ?>
  <div id="postdivrich-possible-uses" class="postarea">
    <?php wp_editor(get_post_meta($post->ID, 'ipad_meta_possible_uses', true), 'ipad_meta_possible_uses', array('dfw' => true, 'textarea_rows' => 15, 'tabindex' => 10) ); ?>
  </div>
<?php }


function ipad_apps_recommended_by($post) { ?>
  <label class="screen-reader-text" for="ipad_meta_recommended_by"><?php _e('Recommended by') ?></label>
  <input class="p100" name="ipad_meta_recommended_by" tabindex="20" id="ipad_meta_recommended_by" value="<?php echo get_post_meta($post->ID, 'ipad_meta_recommended_by', true) // textarea_escaped ?>" />
<?php }

?>