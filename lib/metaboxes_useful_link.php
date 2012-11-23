<?php function ipad_useful_description($post) { ?>
  <div id="postdivrich-useful-description" class="postarea">
    <?php wp_editor(get_post_meta($post->ID, 'ipad_meta_useful_description', true), 'ipad_meta_useful_description', array('dfw' => true, 'textarea_rows' => 15, 'tabindex' => 15) ); ?>
  </div>
<?php }

function ipad_useful_url($post) { ?>
  <label class="screen-reader-text" for="ipad_meta_useful_url"><?php _e('URL') ?></label>
  <input class="p100" name="ipad_meta_useful_url" tabindex="20" id="ipad_meta_useful_url" value="<?php echo get_post_meta($post->ID, 'ipad_meta_useful_url', true) // textarea_escaped ?>" />
<?php } ?>