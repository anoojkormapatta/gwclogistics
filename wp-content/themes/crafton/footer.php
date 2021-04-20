		<footer>
			<div class="logo"></div>
			<div class="content">
				<div class="column">
					<?php
					$args = array(
							'post_type' => 'address',
							'posts_per_page' => 1,
							'page' => 1,
							'meta_value' => 1,
							'meta_key'  => 'is_headquarter',
					);
					$aquery = new WP_Query($args);

					if($aquery->have_posts()) : $aquery->the_post();
					?>
						<div class="title"><?php _e('GWC headquarter', 'gwc') ?></div>
						<?php the_field('details') ?>
						<br />
					<?php endif; ?>
					<div class="show-map"><a href="<?php ($pid = pll_get_post(371)) ? the_permalink($pid) : '#' ?>"><svg class="icon icon-map"><use xlink:href="#icon-map"></use></svg><?php _e('Show on map', 'gwc') ?></a></div>
				</div>

				<?php do_action('footer_menu'); ?>
			</div>
			<div class="annotations-content">
				<div class="column">
					<div class="annotations">
						<?php $policyId = pll_get_post(3023); ?>
						<div><?=  str_replace('{{Y}}', date('Y'), __('©{{Y}} GWC. All Rights Reserved', 'gwc')) ?><?php if($policyId) : ?><span class="privacy-policy"><a href="<?php the_permalink($policyId) ?>"><?= get_the_title($policyId) ?></a></span><?php endif; ?></div>
					</div>
				</div>
				<div class="column">
					<a class="jsSocial-it">
						<div class="social">
							<?php _e('Social media', 'gwc') ?> <svg class="icon icon-arrow-up"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-arrow-up"></use></svg>
						</div>
					</a>
					<a class="jsGo-top"><?php _e('Top', 'gwc') ?></a>
				</div>
			</div>
		</footer>

		<div class="social-wrapper hidden">
			<div class="social-platform">
				<?php if($social = get_custom('facebook')) : ?>
				<a href="<?= $social ?>" target="_blank" class="button white"><svg class="icon icon-facebook"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-facebook"></use></svg>Facebook</a>
				<?php endif; ?>
				<?php if($social = get_custom('twitter')) : ?>
				<a href="<?= $social ?>" target="_blank" class="button white"><svg class="icon icon-twitter"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-twitter"></use></svg>Twitter</a>
				<?php endif; ?>
				<?php if($social = get_custom('youtube')) : ?>
				<a href="<?= $social ?>" target="_blank" class="button white"><svg class="icon icon-youtube"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-youtube"></use></svg>Youtube</a>
				<?php endif; ?>
				<?php if($social = get_custom('googleplus')) : ?>
				<a href="<?= $social ?>" target="_blank" class="button white"><svg class="icon icon-google-plus"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-google-plus"></use></svg>Google+</a>
				<?php endif; ?>
				<?php if($social = get_custom('instagram')) : ?>
				<a href="<?= $social ?>" target="_blank" class="button white"><svg class="icon icon-instagram"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-instagram"></use></svg>Instagram</a>
				<?php endif; ?>
				<?php if($social = get_custom('linkedin')) : ?>
				<a href="<?= $social ?>" target="_blank" class="button white"><svg class="icon icon-linkedin"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-linkedin"></use></svg>LinkedIn</a>
				<?php endif; ?>
			</div>
		</div>

		<div class="youtubeFrame"></div>
		<div class="youtubeClose"></div>

		<!--[if lte IE 9]>
	      <div class="ieLayer">
	      	<?php _e('Your browser is not supported.', 'gwc') ?><br>
	      	<?php _e('Please use a newer version of IE or Google Chrome, Mozilla Firefox.', 'gwc') ?>
	      </div>
	   <![endif]-->

		<script src="https://www.youtube.com/iframe_api"></script>
		<script>document.templateUrl = "<?php bloginfo('template_url'); ?>";</script>
		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/javascripts/script.js?v=2016-12-19"></script>
		<?php if(is_page(371) || is_page(pll_get_post(371))) : ?>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCI-3LoCijYhHFXqG40GYBcI2TKmGQV1LM&callback=initMap&language=<?= pll_current_language() ?>"></script>
      	<?php endif; ?>
      	
      	<?php if($_SERVER["SERVER_NAME"] == 'gwclogistics.com') : ?>

		<script>
  		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  		ga('create', 'UA-10260758-5', 'auto');
  		ga('send', 'pageview');

		</script>
	
	      	<div id="fb-root"></div>
			<script>
				window.fbAsyncInit = function() {
				    FB.init({
				      appId      : '330319030685380',
				      xfbml      : true,
				      version    : 'v2.8'
				    });
				  };
		
				  (function(d, s, id){
				     var js, fjs = d.getElementsByTagName(s)[0];
				     if (d.getElementById(id)) {return;}
				     js = d.createElement(s); js.id = id;
				     js.src = "//connect.facebook.net/<?= pll_current_language() ?>/sdk.js";
				     fjs.parentNode.insertBefore(js, fjs);
				   }(document, 'script', 'facebook-jssdk'));
			</script>
		
		<?php endif; ?>
	</body>
</html>
