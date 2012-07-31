<?php

add_action( 'add_meta_boxes', 'SearchMetaBoxSetup');
add_action( 'admin_head', 'LocalAppsSearchMetaboxAdminHead');
add_action('wp_ajax_local_appsearch', 'MetaAjaxCallback');



function LocalAppsSearchMetaboxAdminHead()
{
  ?>

  <script type="text/javascript">
  jQuery(document).ready( function($) {
    $('#local-apps-search').click( function () {
      var data = {
        action: 'local_appsearch',
        s: $('#widget-container-taxonomy-search #s').val(),
        subject: $('#widget-container-taxonomy-search #subject').val(),
        level: $('#widget-container-taxonomy-search #levels').val(),
        price: $('#widget-container-taxonomy-search #price').val(),
        post_type: $('#widget-container-taxonomy-search #post_type').val()
      };
      $.post(ajaxurl, data, function(response) {
        if ( response == 'fail' ) {
          $('#app_results').html('<h2>An error occured. Please try again...</h2>');
        } else {
          $('#app_results').html(response);
        }
      });
    });
  });
  </script>
  <?php
}

function SearchMetaBoxSetup()
{
  add_meta_box( 
    'apps_used',
    'Apps used',
    'AppsSearchMetaBox',
    'lesson-idea',
    'normal',
    'high'
  );
}
  
function AppsSearchMetaBox()
{    
  ?>
  <div id="widget-container-taxonomy-search">
    <ul>
      <li class="search">
        <input type="text" class="field" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'twentyeleven' ); ?>" />
      </li>
      <li class="label">Subject</li>
      <li class="taxon-field"><?php echo taxonomy_dropdown('subject'); ?></li>
      <li class="label">Level</li>
      <li class="taxon-field"><?php echo taxonomy_dropdown('levels'); ?></li>
      <li class="label">Price</li>
      <li class="taxon-field"><?php echo taxonomy_dropdown('price'); ?></li>
      <li class="search-button">
        <button type="button" id="local-apps-search" class="button-primary" name="local-apps-search">search</button>
        <input type="hidden" id="post_type" name="post_type" value="ipad-app">
      </li>
    </ul>
  </div>
  <div id="all_apps">
    <div id="app_results"></div>
    <div id="slected_apps"></div>
  </div>
  
  <input id="ipad_meta_used_apps" name="ipad_meta_used_apps" value="">



  <?php
}

function MetaAjaxCallback()
{

  $ipad_apps_query = new WP_Query(
    array(
      's' => $_POST['s'],
      'post_type' => $_POST['post_type'],
      'subject' => $_POST['subject'],
      'levels' => $_POST['levels'],
      'price' => $_POST['price'],
    )
  ); ?>

  <script type="text/javascript">
    jQuery(document).ready( function() {
      toggle_select_apps('app_results', 'ipad_app', 'selected', 'remove_only', 'ipad_meta_used_apps');
    });
  </script>

  <h3>Click to select the apps</h3>
  <?php foreach ($ipad_apps_query->posts as $ipad_app) { ?>
    <div class="ipad_app" id="<?php echo $ipad_app->ID ?>">
        <?php echo get_the_post_thumbnail( $ipad_app->ID, 'thumb', array('class' => 'post_thumb')); ?>
        <div class="title"><?php echo $ipad_app->post_title ?></div>
    </div>
  <?php }

  // return print_r($posts);

  die();
}







function ipad_lesson_objectives($post){
?>
  <label class="screen-reader-text" for="ipad_meta_objective"><?php _e('Lesson objective') ?></label><textarea rows="1" class="p100" name="ipad_meta_objective" tabindex="1" id="ipad_meta_objective"><?php echo get_post_meta($post->ID, 'ipad_meta_objective', true) // textarea_escaped ?></textarea>
<?php
}

function ipad_lesson_procedure($post){
?>
  <div id="postdivrich-lesson-procedure" class="postarea">
    <?php wp_editor(get_post_meta($post->ID, 'ipad_meta_lesson-procedure', true), 'ipad_meta_lesson-procedure', array('dfw' => true, 'textarea_rows' => 15, 'tabindex' => 5) ); ?>
  </div>
<?php
}

function ipadideas_meta_field_contributors($post) {
?>
  <label class="screen-reader-text" for="ipad_meta_contributors"><?php _e('Contributors') ?></label>
  <input class="p100" name="ipad_meta_contributors" tabindex="7" id="ipad_meta_contributors" value="<?php echo get_post_meta($post->ID, 'ipad_meta_contributors', true) // textarea_escaped ?>" />
<?php
}
?>