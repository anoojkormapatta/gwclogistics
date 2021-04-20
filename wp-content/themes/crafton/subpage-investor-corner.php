<?php if(have_rows('investor_corner')) : the_row(); ?>
<div class="content" style="display: block;">
	<?php
	if(get_bloginfo("language") == 'en-GB'){
		$chart 		= 'https://charts3.equitystory.com/chart/gulfwarehousing/English/';
		$qas 		= 'https://qas5.eqs.com/gulfwarehousing/gwc_qas2017/en/table';
		$factSheet	= 'http://gwclogistics.com/wp-content/uploads/2019/02/GWC_Fact_sheet_31_2018_EN.pdf';
	} else {
		$chart 		= 'https://charts3.equitystory.com/chart/gulfwarehousing/Arabic/';
		$qas 		= 'https://qas5.eqs.com/gulfwarehousing/gwc_qas2017/ar/table';
		$factSheet	= '';
	}
	?>
	<div class="content--factsheet" style="width: 50%" >
	<div style="margin-top:20px;"><a class="button black btn-icon link" href="mailto:investor@gwclogistics.com" style="margin-left:20px;"><?php _e('Message us', 'gwc') ?><svg class="icon icon-arrow"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-arrow"></use></svg></a></div>
</div>
	<div class="top-split" style="display: flex;">
		<div class="content--factsheet" style="width: 50%" >
			<!--<h3 class="title"><?php _e('Fact Sheet', 'gwc') ?></h3>-->
			<div style="margin-top:20px;"><a class="button black btn-icon link" href="<?php echo $factSheet ?>" target="_blank" style="margin-left:20px;">
				<?php _e('Factsheet Download', 'gwc') ?>
			<svg class="icon icon-arrow"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-arrow"></use></svg></a></div>
		</div>
</div>

</div>
	<div class="top-split" style="display: flex;">
		<div class="content--sharedata" style="width: 100%">
			<h3 class="title"><?php _e('Share Price Live', 'gwc') ?></h3>
			<?php include 'includes/sharedata.php' ?>
		</div>
	</div>
<div class="clear" style="height: 20px;" ></div>



<div class="top-split" style="display: flex;">
<div class="content--factsheet" style="width:100%">
	
	 </div>

	<div class="clear" style="height: 20px;" ></div>

	<!--<script type="text/javascript" charset="UTF-8" src="<?php echo get_template_directory_uri(); ?>/javascripts/easyXDM-2.4.19.3.min.js"></script>
	<script type="text/javascript" charset="UTF-8" src="<?php echo get_template_directory_uri(); ?>/javascripts/postMessageDocumentHeight.min.js"></script>
	<link href="<?php echo get_template_directory_uri(); ?>/stylesheets/ir.css" rel="stylesheet" type="text/css">
	<span class="content" style="display: block;"><span class="content" style="display: block;">-->
	<?php $rnd = rand(); ?>
	</span></span>
	<!--<div class="content--chart" >
	  <h3 class="title"><?php _e('Smart Chart', 'gwc') ?></h3>
	    <div id="embedded_chart_<?php echo $rnd ?>" class="eqs-iframe-tools"></div>
	    <script>
	        (function(global) {
	            var transport = new easyXDM.Socket({
	                remote: '<?php echo $chart ?>',
	                //swf: 'easyxdm.swf',
	                container: 'embedded_chart_<?php echo $rnd ?>',
	                onMessage: function(message, origin) {
	                    this.container.getElementsByTagName('iframe')[0].style.height = message + 'px';
	                    this.container.getElementsByTagName('iframe')[0].scrolling = 'no';
	                }
	            });

	        })();
	    </script>
	</div>
	<?php $rnd = rand(); ?>
	<div class="content--qas" >
		<h3 class="title"><?php _e('Quick Analyser', 'gwc') ?></h3>
	    <div id="embedded_qas_<?php echo $rnd ?>" class="eqs-iframe-tools"></div>
	    <script>
	        (function(global) {
	            var transport = new easyXDM.Socket({
	                remote: '<?php echo $qas ?>',
	                //swf: 'easyxdm.swf',
	                container: 'embedded_qas_<?php echo $rnd ?>',
	                onMessage: function(message, origin) {
	                    this.container.getElementsByTagName('iframe')[0].style.height = message + 'px';
	                    this.container.getElementsByTagName('iframe')[0].scrolling = 'no';
	                }
	            });

	        })();
	    </script>
	</div>-->
</div>
<?php endif; ?>
