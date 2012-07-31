<?php function item_display_block($result, $result_ount) { ?>
<div class="app_view <?php if ($result_ount == 1) {echo 'single_item';} ?>">
  <div class="app_title">
    <h3>
      <?php echo $result->trackName ?>
      <span class='app_price'>
        <?php  if ($result->price == 0.00) { // Create free or paid tags
          echo "(Free app)";
        }
        else {
          echo '(Price: ' . $result->currency . $result->price . ')';
          
        } ?>
      </span>
    </h3>
  </div>
  <p>
    <div class="button_area">
      <img src="<?php echo $result->artworkUrl60 ?>" />
      <button id="<?php echo $result->trackId ?>" class="button-primary app_link_button">Add</button>
    </div>
    <div class='ratings'>
      <?php echo 'Average user rating: <b>' . $result->averageUserRatingForCurrentVersion . '</b>'; ?>
    </div>
    <?php echo $result->description; ?>
  </p>
  <div class="genre">
    <b>Genre(s): </b>
    <?php
    echo implode(", ", $result->genres);
    ?>
  </div>
</div>

<?php
}
?>