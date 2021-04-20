<?php
/*
Template Name: Contact Page
*/
global $wp;
$current_url = home_url(add_query_arg(array(), $wp->request));

get_header('color');
?>

<section class="head-info">
  <ul class="breadcrumbs">
    <li><a href="<?= home_url() ?>"><?php _e('Home', 'gwc') ?></a></li>
    <li><?php _e('Contact', 'gwc') ?></li>
    <li class="active"><?php the_title() ?></li>
  </ul>
  <h1><?php the_title() ?></h1>
  <p style="padding: 15px 50px 15px 32px; text-transform: none; letter-spacing: 2px;"><?= _e('For job related inquiries, please contact us through our career page.', 'gwc') ?></p>
</section>

<section class="contact">
  <?php
  $args = array(
    'post_type' => 'address',
    'paged' => 1,
    'posts_per_page' => -1,
    'orderby' => array('meta_value' => 'DESC', 'title' => 'ASC'),
    'meta_key' => 'is_headquarter'
  );
  $myquery = new WP_Query($args);
  $selected = null;
  $country_id = isset($_REQUEST['country']) ? intval($_REQUEST['country']) : -1;

  if (!$myquery->have_posts()) :
    $args = array(
      'post_type' => 'address',
      'paged' => 1,
      'lang' => 'en',
      'posts_per_page' => -1,
      'orderby' => array('meta_value' => 'DESC', 'title' => 'ASC'),
      'meta_key' => 'is_headquarter'
    );
    $myquery = new WP_Query($args);
  endif;

  if ($myquery->have_posts()) :
  ?>

<?php
    $json = file_get_contents(__DIR__ . '/../phone.json');
    $phones = json_decode($json, true);

    $url = 'https://webto.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8';
    $headers = get_headers($url);
    ?>

    <form class="contactForm" action="<?= $headers ? $url : '?sent=1&error=1#contact_form' ?>" method="POST">
      <div class="contactForm__waypoint" id="contact_form"></div>

      <input type=hidden name='captcha_settings' value='{"keyname":"GWC","fallback":"false","orgId":"00D0Y000001jYxw","ts":""}'>
      <input type=hidden name="oid" value="00D0Y000001jYxw">
      <input type=hidden name="retURL" value="<?= $current_url ?>?sent=1#contact_form">

      <!--<h3><?= _e('Contact us', 'gwc') ?></h3>-->
      <div class="contactForm__inputs">
        <div class="contactForm__inputContainer contactForm__inputContainer--split">
          <label for="first_name" class="contactForm__label"><?= _e('First name', 'gwc') ?></label>
          <input type="text" id="first_name" name="first_name" class="contactForm__input">
          <span class="contactForm__errorMsg"><?= _e('Field required', 'gwc') ?></span>

          <label for="last_name" class="contactForm__label"><?= _e('Last name', 'gwc') ?></label>
          <input type="text" id="last_name" name="last_name" class="contactForm__input">
          <span class="contactForm__errorMsg"><?= _e('Field required', 'gwc') ?></span>
        </div>

        <div class="contactForm__inputContainer">
          <label for="phone_prefix" class="contactForm__label">
            <?= _e('Telephone', 'gwc') ?>
          </label>

          <div id="phone-container" class="contactForm__input contactForm__input--container">
            <select id="phone_prefix" class="contactForm__select" style="width: 100%" data-placeholder="<?= _e('Search by country or phone code', 'gwc') ?>">
              <?php foreach ($phones as $key => $value) : ?>
                <option value="<?= $value['dial_code'] ?>" data-prefix="<?= $value['code'] ?>" <?= $value['code'] == 'QA' ? 'selected' : '' ?>><?= $value['name'] ?><?= $value['dial_code'] ?></option>
              <?php endforeach; ?>
            </select>

            <div class="contactForm__phoneInputs">
              <span id="prefix_display" class="contactForm__inputDummy"></span>
              <input type="text" id="phone_number" name="phone_number" class="contactForm__input contactForm__input--inner" pattern="^(?=.*[0-9])[- 0-9]+$">
            </div>
          </div>
          <span class="contactForm__errorMsg"><?= _e('Enter valid phone number', 'gwc') ?></span>
          <input type="hidden" name="phone" id="phone">
        </div>

        <div class="contactForm__inputContainer">
          <label for="email" class="contactForm__label">
            <?= _e('E-mail', 'gwc') ?>
          </label>
          <input type="email" id="email" name="email" class="contactForm__input" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
          <span class="contactForm__errorMsg"><?= _e('Enter valid e-mail address', 'gwc') ?></span>
        </div>

<div class="contactForm__inputContainer">
          <label for="company" class="contactForm__label"><?= _e('Company', 'gwc') ?></label>
          <input type="text" id="company" name="company" class="contactForm__input" >
          <span class="contactForm__errorMsg"><?= _e('Field required', 'gwc') ?></span>
          </div>
          
          
        <div class="contactForm__inputContainer contactForm__inputContainer--large">
          <label for="description" class="contactForm__label">
            <?= _e('Message/Requirement', 'gwc') ?>
          </label>
          <textarea name="description" id="description" class="contactForm__input"></textarea>
          <span class="contactForm__errorMsg"><?= _e('Field required', 'gwc') ?></span>
        </div>

        <p hidden>
          <select id="lead_source" name="lead_source">
            <option value="Website">Website</option>
          </select>
        </p>

        <div class="contactForm__captcha">
          <script src="https://www.google.com/recaptcha/api.js?hl=<?= substr(get_locale(), 0, 2) ?>" async defer></script>
          <script>
            function timestamp() {
              var response = document.getElementById("g-recaptcha-response");
              if (response == null || response.value.trim() == "") {
                var elems = JSON.parse(document.getElementsByName("captcha_settings")[0].value);
                elems["ts"] = JSON.stringify(new Date().getTime());
                document.getElementsByName("captcha_settings")[0].value = JSON.stringify(elems);
              }
            }
            setInterval(timestamp, 500);
          </script>
          <div class="g-recaptcha" data-sitekey="6Leu6swZAAAAAPt-yFNgJzBHWrnMmE3hgSr1ipnL"></div>
        </div>

        <button id="submit" type="submit" class="button black contactForm__button"><?= _e('Send Message', 'gwc') ?></button>
      </div>

      <?php
      $url_components = parse_url($_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI]);
      parse_str($url_components['query'], $params);
      ?>

      <div class="contactForm__feedback">
        <div class="contactForm__feedbackInner">
          <h3>
            <?php if (!$params['error']) : ?>
              <?= _e('Thank you. Your information has been submitted.', 'gwc') ?>
            <?php else : ?>
              <?= _e('There was a problem when sending your message. Try again later.', 'gwc') ?>
            <?php endif; ?>
          </h3>
        </div>
      </div>
    </form>


    <div class="contact__details">

      <div class="contact__address">
        <form class="contact__location">
          <label><?php _e('Location', 'gwc') ?></label>
          <div class="country-select ddlist">
            <input type="hidden" name="country" value="">
            <button class="button white btn-icon">
              <span><?php _e('Select', 'gwc') ?></span>
              <svg class="icon icon-arrow">
                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-arrow"></use>
              </svg>
            </button>
            <ul>
              <?php
              while ($myquery->have_posts()) : $myquery->the_post();
                if ($post->ID === $country_id) $selected = $post;
              ?>
                <li data-value="<?= $post->ID ?>"><?php the_title() ?></li>
              <?php
              endwhile;
              ?>
            </ul>
          </div>
        </form>

        <?php
        if (empty($selected)) :
          $myquery->rewind_posts();
          $myquery->the_post();
          $selected = $post;
        endif;

        $post = $selected;
        $myquery->setup_postdata($post);
        ?>
        <div class="details">
          <?php if (get_field('is_headquarter')) : ?>
            <h3><?php _e('Headquarter', 'gwc') ?></h3>
          <?php elseif ($category = get_field('entity_category')) : ?>
            <h3><?= $category ?></h3>
          <?php endif; ?>
          <div class="title"><?php the_field('entity_name') ?></div>
          <?php the_field('details') ?>

          <?php if ($mailto = get_field('mailto')) : ?>
            <div class="hint">
              <?php _e('E-mail', 'gwc') ?>
              <a class="button white btn-icon" href="mailto:<?= $mailto ?>"><?php _e('Message us', 'gwc') ?><svg class="icon icon-arrow">
                  <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-arrow"></use>
                </svg></a>
            </div>
          <?php endif; ?>
        </div>
      </div>
      <div class="contact__map">
        <div class="map-header">
          <div class="title"><?php _e('GWC', 'gwc') ?></div><svg class="icon icon-map">
            <use xlink:href="#icon-map"></use>
          </svg><span><?php _e('on map', 'gwc') ?></span>
          <a class="button link jsViewLarger"><?php _e('View larger', 'gwc') ?></a>
        </div>

        <?php
        $coords = get_field('map_location');
        if (!isset($coords['lat']) || !isset($coords['lng'])) :
          $coords = array('lat' => 25.2893291, 'lng' => 51.4594189);
        endif;
        ?>
        <div id="map" class="jsMap" data-lat="<?= $coords['lat'] ?>" data-lng="<?= $coords['lng'] ?>"></div>
        <div style="margin-top:15px;"> </div>
      </div>
    <?php else : ?>
      <div>
        <div class="map-header">
          <div class="title"><?php _e('Not found any addresses', 'gwc') ?></div>
        </div>
      </div>
    <?php endif; ?>
    
    </div>

    
</section>

<?php
get_footer();
