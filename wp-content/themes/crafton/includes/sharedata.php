<?php
try{
	include '_webservice.php';
?>
  <div class="sharedata">

    <div class="sharedata__value">
      <div class="sharedata__title">
        <?php _e('Last Trade', 'gwc') ?>
      </div>
      <div id="wsLastTrade" class="sharedata__number">
        <strong class="gwcblue"><?php echo $cur;?></strong>
      </div>
    </div>

    <div class="sharedata__value">
      <div class="sharedata__title">
        <?php _e('Change', 'gwc') ?>
      </div>
      <div id="wsChange" class="sharedata__number">
        <strong><?php echo $trnd;?> <?php echo $nchn;?></strong>
      </div>
    </div>

    <div class="sharedata__value">
      <div class="sharedata__title">
        <?php _e('Volume', 'gwc') ?>
      </div>
      <div id="wsVolume" class="sharedata__number">
        <strong><?php echo $vol;?></strong>
      </div>
    </div>

  </div>

<?php

//foreach ($data as $key => $value) {
    // $key is "key1", then "key2"
    // $value is "value1" then "value2"

	//echo $key.'&nbsp;&nbsp;: &nbsp;&nbsp;'.$data[$key]['_v']; echo"<br>";

//}
}

catch (Exception $ex){}
?>
