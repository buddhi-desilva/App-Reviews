<?php 
function taxonomy_dropdown($taxonomy_name, $label_name = '- select -') {
  $terms = get_terms($taxonomy_name);
  
  $select_tag = '<select class="postform" id="'. $taxonomy_name .'" name="' . $taxonomy_name . '">';
  $select_tag .= '<option value="">' . $label_name . '</option>';

  if (count($terms) > 0) {
    foreach ($terms as $term) {
      $select_tag .= '<option valeu="' . $term->slug . '">' . $term->name . '</option>';
    }
  }
  else {
    $select_tag .= '<option valeu="">-</option>';
  }
  $select_tag .= '</select>';
  return $select_tag;
}
?>