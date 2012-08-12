<?php 
function add_remove_links_advanced_metabox() {
  // Removes the built in one
  remove_meta_box('linkadvanceddiv', 'link', 'normal');
  // Adds custom one
  add_meta_box('linkadvanceddiv', 'Advanced', 'link_advanced_meta_box_extended', 'link', 'normal', 'default');
}


function thickbox_scripts() {
  add_thickbox();
}

add_action('admin_print_scripts', 'thickbox_scripts');


function link_advanced_meta_box_extended($link) {
?>

<script type="text/javascript">
  jQuery(document).ready(function() {
    var formfield;

    jQuery('#upload_image_button').click(function() {
     formfield = jQuery('#link_image');
     tb_show('','media-upload.php?type=image&amp;TB_iframe=true');
     return false;

    });

  //Sends the code to text field
  window.send_to_editor = function(text){
     imgurl = jQuery(text).attr('src');
     jQuery('#link_image_thumb').replaceWith(text);
     jQuery('#link_image').val(imgurl);
     tb_remove();
    }

  });

</script>

<table class="links-table" cellpadding="0">
  <tr>
    <th scope="row"><input id="upload_image_button" value="Select or upload image" type="button" /></label></th>
    <td>
        <input type="hidden" name="link_image" class="code" id="link_image" value="<?php echo ( isset( $link->link_image ) ? esc_attr($link->link_image) : ''); ?>" />
        <?php echo ( isset( $link->link_image ) ? '<img alt="Image updated" src="' . $link->link_image . '" id="link_image_thumb" />' : ''); ?>
    </td>
  </tr>
  <tr>
    <th scope="row"><label for="rss_uri"><?php _e('RSS Address') ?></label></th>
    <td><input name="link_rss" class="code" type="text" id="rss_uri" value="<?php echo ( isset( $link->link_rss ) ? esc_attr($link->link_rss) : ''); ?>" /></td>
  </tr>
  <tr>
    <th scope="row"><label for="link_notes"><?php _e('Notes') ?></label></th>
    <td><textarea name="link_notes" id="link_notes" rows="10"><?php echo ( isset( $link->link_notes ) ? $link->link_notes : ''); // textarea_escaped ?></textarea></td>
  </tr>
  <tr>
    <th scope="row"><label for="link_rating"><?php _e('Rating') ?></label></th>
    <td><select name="link_rating" id="link_rating" size="1">
    <?php
      for ( $r = 0; $r <= 10; $r++ ) {
        echo '<option value="' . $r . '"';
        if ( isset($link->link_rating) && $link->link_rating == $r )
          echo ' selected="selected"';
        echo('>' . $r . '</option>');
      }
    ?></select>&nbsp;<?php _e('(Leave at 0 for no rating.)') ?>
    </td>
  </tr>
</table>
<?php
}

?>