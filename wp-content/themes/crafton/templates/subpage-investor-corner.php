<!--<?php if(have_rows('investor_corner')) : the_row(); ?>-->
<a class="button black black--special btn-icon" href="mailto:investor@gwclogistics.com"><?php _e('Email Us', 'gwc') ?><svg class="icon icon-arrow"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-arrow"></use></svg></a>
<div class="content" style="display: block;">
	<?php
	if(get_bloginfo("language") == 'en-GB'){
		$chart 		= 'https://charts3.equitystory.com/chart/gulfwarehousing/English/';
		$qas 		= 'https://qas5.eqs.com/gulfwarehousing/gwc_qas2017/en/table';
		$factSheet	= 'https://irpages2.equitystory.com/websites/factsheetPDF/English/1000.html?companyDirectoryName=gulfwarehousing&showHeadFoot=1&showPDF2=1';
	} else {
		$chart 		= 'https://charts3.equitystory.com/chart/gulfwarehousing/Arabic/';
		$qas 		= 'https://qas5.eqs.com/gulfwarehousing/gwc_qas2017/ar/table';
		$factSheet	= 'https://irpages2.equitystory.com/websites/factsheetPDF/Arabic/1000.html?companyDirectoryName=gulfwarehousing&showHeadFoot=1&showPDF2=1';
	}
	?>
	<div class="top-split" style="display: flex;">
		<!--div class="content--sharedata" style="width: 50%">
			<h3 class="title"><?php _e('Share Price Live', 'gwc') ?></h3>
			<?php include 'includes/sharedata.php' ?>
		</div-->
		<!--<div class="content--factsheet" style="width: 100%" >
			<h3 class="title"><?php _e('Fact Sheet', 'gwc') ?></h3>
			<div><a class="button black btn-icon link" href="<?php echo $factSheet ?>" target="_blank"><?php _e('PDF Download', 'gwc') ?> <svg class="icon icon-arrow"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-arrow"></use></svg></a></div>
		</div>-->
	</div><div class="clear" style="height: 20px;" ></div>
	<script type="text/javascript" charset="UTF-8" src="<?php echo get_template_directory_uri(); ?>/javascripts/easyXDM-2.4.19.3.min.js"></script>
	<script type="text/javascript" charset="UTF-8" src="<?php echo get_template_directory_uri(); ?>/javascripts/postMessageDocumentHeight.min.js"></script>
	<link href="<?php echo get_template_directory_uri(); ?>/stylesheets/ir.css" rel="stylesheet" type="text/css">
	<?php $rnd = rand(); ?>
	<div class="content--chart" >
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
	</div>
</div>
<?php endif; ?>
