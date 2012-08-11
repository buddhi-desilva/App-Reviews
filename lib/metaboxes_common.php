<?php
add_action( 'admin_head', 'LocalAppsSearchMetaboxAdminHead');
add_action('wp_ajax_local_appsearch', 'MetaAjaxAppSearch');

function LocalAppsSearchMetaboxAdminHead() { ?>

  <script type="text/javascript">
  jQuery(document).ready( function($) {
    $('#local-apps-search').click( function () {
      var data = {
        action: 'local_appsearch',
        s: $('#widget-container-taxonomy-search #s').val(),
        subject: $('#widget-container-taxonomy-search #subject').val(),
        level: $('#widget-container-taxonomy-search #levels').val(),
        price: $('#widget-container-taxonomy-search #price').val(),
        post_type: $('#widget-container-taxonomy-search #post_type').val(),
        post_id: $('input#post_ID').val()
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
  
function ipad_meta_apps_used($post) { ?>

  <input type="hidden" name="ipad_meta_apps_used" id="ipad_meta_apps_used" value="<?php echo get_post_meta($post->ID, 'ipad_meta_apps_used', true) // textarea_escaped ?>" />

  <div id="widget-container-taxonomy-search">
    <ul>
      <li class="search">
        <input type="text" class="field" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'twentyeleven' ); ?>" />
      </li>
      <li class="label">Subject</li>
      <li class="taxon-field"><?php echo taxonomy_dropdown('subject', ' all '); ?></li>
      <li class="label">Levels</li>
      <li class="taxon-field"><?php echo taxonomy_dropdown('levels', ' all '); ?></li>
      <li class="label">Price</li>
      <li class="taxon-field"><?php echo taxonomy_dropdown('price', ' all '); ?></li>
      <li class="search-button">
        <button type="button" id="local-apps-search" class="button-primary" name="local-apps-search">search</button>
        <input type="hidden" id="post_type" name="post_type" value="ipad-app">
      </li>
    </ul>
  </div>
  <div id="all_apps">
    <div id="app_results"></div>
    <div id="slected_apps">
      <?php if (get_post_meta($post->ID, 'ipad_meta_apps_used', true)) { ?>
        <h3>Selected apps</h3>
        <script type="text/javascript">
          jQuery(document).ready( function() {
            toggle_select_apps('slected_apps', 'ipad_app_selected', 'selected', 'remove_only', 'ipad_meta_apps_used');
          });
        </script>
        <?php
        $selected_apps = explode(',', get_post_meta($post->ID, 'ipad_meta_apps_used', true));
        $ipad_apps_query = new WP_Query( array( 'post_type' => 'ipad-app', 'post__in' => $selected_apps ) );
        foreach ($ipad_apps_query->posts as $ipad_app) { ?>
          <span class="ipad_app_selected" rel="remove_only" id="<?php echo $ipad_app->ID ?>">
              <?php echo $ipad_app->post_title ?>
          </span>
        <?php } ?>
      <?php } ?>
    </div>
  </div>

<?php
}

function MetaAjaxAppSearch() {
  $ipad_apps_query = new WP_Query(
    array(
      's' => $_POST['s'],
      'post_type' => $_POST['post_type'],
      'subject' => $_POST['subject'],
      'levels' => $_POST['levels'],
      'price' => $_POST['price'],
      'post__not_in' => explode(',', get_post_meta($_POST['post_id'], 'ipad_meta_apps_used', true)), // do not include the selected apps
      'posts_per_page' => 12
    )
  ); ?>

  <script type="text/javascript">
    jQuery(document).ready( function() {
      toggle_select_apps('app_results', 'ipad_app', 'selected', 'remove_only', 'ipad_meta_apps_used');
    });
  </script>


  <?php if ($ipad_apps_query->posts) { ?>
    <h3>Click to select the apps</h3>
    <?php foreach ($ipad_apps_query->posts as $ipad_app) { ?>
      <div class="ipad_app" id="<?php echo $ipad_app->ID ?>">
          <?php echo get_the_post_thumbnail( $ipad_app->ID, 'thumb', array('class' => 'post_thumb')); ?>
          <div class="title"><?php echo $ipad_app->post_title ?></div>
      </div>
    <?php }
  }
  else { ?>
    <div class="updated"><p>No apps found or you've selected all the available apps</p></div>
  <?php }

  // return print_r($posts);

  die();
}

?>