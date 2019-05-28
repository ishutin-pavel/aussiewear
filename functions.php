<?php

/**
 * Storefront automatically loads the core CSS even if using a child theme as it is more efficient
 * than @importing it in the child theme style.css file.
 *
 * Uncomment the line below if you'd like to disable the Storefront Core CSS.
 *
 * If you don't plan to dequeue the Storefront Core CSS you can remove the subsequent line and as well
 * as the sf_child_theme_dequeue_style() function declaration.
 */
//add_action( 'wp_enqueue_scripts', 'sf_child_theme_dequeue_style', 999 );

/**
 * Dequeue the Storefront Parent theme core CSS
 */
function sf_child_theme_dequeue_style() {
    wp_dequeue_style( 'storefront-style' );
    wp_dequeue_style( 'storefront-woocommerce-style' );
}


/**
 * Note: DO NOT! alter or remove the code above this text and only add your custom PHP functions below this text.
 */

function sf_child_theme_scripts() {
  wp_enqueue_style( 'font-awesome-5', '//use.fontawesome.com/releases/v5.8.2/css/fontawesome.css' );
  wp_enqueue_style( 'font-awesome-5-brands', '//use.fontawesome.com/releases/v5.8.2/css/brands.css' );
  wp_enqueue_script( 'slick', get_stylesheet_directory_uri() . '/js/slick.min.js', array('jquery'), '1.9.0', true );
  wp_enqueue_script( 'magnific-popup-js', get_stylesheet_directory_uri() . '/js/jquery.magnific-popup.js', array('jquery'), '1.1.0', true );
  wp_enqueue_script( 'jquery-inputmask', get_stylesheet_directory_uri() . '/js/jquery.inputmask.bundle.js', array('jquery'), '4', true );
  wp_enqueue_script( 'main-js', get_stylesheet_directory_uri() . '/js/main.js', array('jquery'), '20180528', true );
  wp_enqueue_script( 'lazysizes', get_stylesheet_directory_uri() . '/js/lazysizes.min.js', array('jquery'), '4.1.6', true );
}
add_action( 'wp_enqueue_scripts', 'sf_child_theme_scripts' );



//Top menu
require_once 'blocks/top-menu/top-menu.php';


/*
 * Отключаем функции:
*/
add_action( 'after_setup_theme', 'art_removes_action' );
function art_removes_action() {
  remove_action( 'storefront_header', 'storefront_product_search', 40 ); //убираем поиск
  //remove_action( 'storefront_header', 'storefront_header_cart', 60 ); //убираем корзину
  remove_action( 'storefront_homepage', 'storefront_homepage_header', 10 );//убираем заголовок "Главная" на главной
  remove_action( 'homepage', 'storefront_popular_products', 50 ); //убираем "Популярные" товары на главной
  remove_action( 'homepage', 'storefront_best_selling_products', 70 ); //убираем товары "Лучшая цена"" с главной
  remove_action( 'homepage', 'storefront_product_categories', 20 ); //убираем "Категории товаров" с главной
  remove_action( 'homepage', 'storefront_recent_products', 30 ); //убираем "Категории товаров" с главной
}


/*
 * Footer - изменение копирайта "Работает на Storefront и WooCommerce"
*/
function storefront_credit() {
  ?>
  <div class="site-info">
    <?php echo esc_html( apply_filters( 'storefront_copyright_text', $content = '&copy; ' . get_bloginfo( 'name' ) . ' ' . date( 'Y' ) ) ); ?>
    <?php if ( apply_filters( 'storefront_credit_link', true ) ) { ?>
    <br />
      <?php
      if ( apply_filters( 'storefront_privacy_policy_link', true ) && function_exists( 'the_privacy_policy_link' ) ) {
        the_privacy_policy_link( '', '<span role="separator" aria-hidden="true"></span>' );
      }
      ?>
      <?php echo '<span>' . get_bloginfo( 'description' ) . '</span>'; ?>
    <?php } ?>
  </div><!-- .site-info -->
  <?php
}


/*
 * Оформление заказа
*/
// Необязательные поля
add_filter( 'woocommerce_billing_fields', 'custom_override_checkout_fields', 10, 1 );

function custom_override_checkout_fields( $fields ) {
  $fields['billing_email']['required'] = false; //Email не обязательно
  $fields['billing_last_name']['required'] = false; //Фамилия не обязательно
  unset($fields['billing_email']);
  return $fields;
}


// Удаляем поля
//This filter is applied to all billing and shipping default fields
//Этот фильтр применяется и к полям выставления счетов и к доставке
add_filter( 'woocommerce_default_address_fields' , 'custom_override_default_address_fields' );

function custom_override_default_address_fields( $address_fields ) {
    $address_fields['address_1']['placeholder'] = 'Полный адрес для отдела доставки';
    unset($address_fields['country']);
    unset($address_fields['city']);
    unset($address_fields['state']);
    unset($address_fields['postcode']);

    return $address_fields;
}

/*
 * Header
*/
function sf_location() {
  ?>
  <div class="location-n-clock">
    <div class="location">
      <span class="img"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 19"><path fill="#131313" fill-rule="evenodd" d="M7.07.125c1.055 0 1.998.182 2.83.545a6.07 6.07 0 0 1 2.101 1.485 6.483 6.483 0 0 1 1.3 2.189 7.74 7.74 0 0 1 .449 2.636c0 .938-.185 1.896-.554 2.874-.369.979-.835 1.94-1.397 2.883a26.296 26.296 0 0 1-1.828 2.681 50.75 50.75 0 0 1-1.846 2.25c0 .012-.088.09-.264.237a.932.932 0 0 1-.615.22h-.053a.923.923 0 0 1-.624-.22c-.17-.146-.255-.225-.255-.237-.609-.703-1.268-1.47-1.977-2.303a26.239 26.239 0 0 1-1.969-2.628A17.222 17.222 0 0 1 .856 9.898C.452 8.926.25 7.953.25 6.98c0-.925.182-1.804.545-2.636A7.135 7.135 0 0 1 2.27 2.155 6.98 6.98 0 0 1 4.442.67 6.457 6.457 0 0 1 7.07.125zm.211 16.787a40.42 40.42 0 0 0 2.338-2.918 23.994 23.994 0 0 0 1.67-2.628c.445-.826.78-1.605 1.002-2.338.223-.732.334-1.415.334-2.048 0-.714-.108-1.415-.325-2.1a5.265 5.265 0 0 0-1.01-1.837 5.052 5.052 0 0 0-1.732-1.3C8.86 1.413 8.03 1.25 7.07 1.25c-.773 0-1.506.152-2.197.457a5.82 5.82 0 0 0-1.81 1.24 5.977 5.977 0 0 0-1.231 1.827 5.45 5.45 0 0 0-.457 2.206c0 .833.176 1.676.527 2.532.352.855.797 1.696 1.336 2.522.54.826 1.131 1.623 1.776 2.39a244.51 244.51 0 0 0 1.828 2.154l.299.334.07.07a.288.288 0 0 1 .044-.035c.017-.011.026-.023.026-.035zM7.018 3.518a3.24 3.24 0 0 1 2.39.993c.656.662.985 1.456.985 2.382 0 .937-.329 1.734-.985 2.39-.656.656-1.453.985-2.39.985-.926 0-1.72-.329-2.382-.985a3.24 3.24 0 0 1-.993-2.39c0-.926.33-1.72.993-2.382.662-.662 1.456-.993 2.382-.993zm0 5.625c.62 0 1.148-.223 1.582-.668.433-.446.65-.979.65-1.6 0-.621-.22-1.151-.66-1.59-.439-.44-.969-.66-1.59-.66-.621 0-1.151.22-1.59.66-.44.439-.66.969-.66 1.59 0 .621.223 1.154.668 1.6.445.445.978.668 1.6.668z"></path></svg></span>
      <div class="text">Москва, МО</div></div>
    <div class="clock">
      <span class="img"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill="#191919" fill-rule="evenodd" d="M10 0c1.38 0 2.679.26 3.896.781A10.035 10.035 0 0 1 17.08 2.92a10.035 10.035 0 0 1 2.139 3.184A9.801 9.801 0 0 1 20 10c0 1.38-.26 2.679-.781 3.896a10.035 10.035 0 0 1-2.139 3.184 10.035 10.035 0 0 1-3.184 2.139A9.801 9.801 0 0 1 10 20c-1.38 0-2.679-.26-3.896-.781A10.035 10.035 0 0 1 2.92 17.08 10.035 10.035 0 0 1 .78 13.896 9.801 9.801 0 0 1 0 10c0-1.38.26-2.679.781-3.896A10.035 10.035 0 0 1 2.92 2.92 10.035 10.035 0 0 1 6.104.78 9.801 9.801 0 0 1 10 0zm0 18.77a8.44 8.44 0 0 0 3.408-.694 8.83 8.83 0 0 0 2.774-1.885 9.035 9.035 0 0 0 1.875-2.783A8.44 8.44 0 0 0 18.75 10a8.44 8.44 0 0 0-.693-3.408 8.914 8.914 0 0 0-1.875-2.774 8.914 8.914 0 0 0-2.774-1.875A8.44 8.44 0 0 0 10 1.25a8.44 8.44 0 0 0-3.408.693 8.914 8.914 0 0 0-2.774 1.875 8.914 8.914 0 0 0-1.875 2.774A8.44 8.44 0 0 0 1.25 10c0 1.21.231 2.347.693 3.408a9.035 9.035 0 0 0 1.875 2.783 8.83 8.83 0 0 0 2.774 1.885A8.44 8.44 0 0 0 10 18.77zm.625-9.024l2.95 2.95a.596.596 0 0 1 .175.439.596.596 0 0 1-.176.44.567.567 0 0 1-.44.195.567.567 0 0 1-.439-.196L9.59 10.488c0-.013-.003-.023-.01-.029l-.01-.01a.485.485 0 0 1-.146-.195.654.654 0 0 1-.049-.254V3.75a.6.6 0 0 1 .186-.44.6.6 0 0 1 .439-.185.6.6 0 0 1 .44.186.6.6 0 0 1 .185.439v5.996z"></path></svg></span>
      <div class="text">пн-вс 10:00-20:00</div>
    </div>
  </div><!-- .location-n-clock -->
  <div class="phone">
    <a href="tel:+79853620134" class="phone__link whatsapp">+7 (985) 362-01-34</a>
    <a href="tel:+79853620134" class="phone__link">+7 (985) 508-97-84 </a>
    <div class="phone-callback">
      <a href="#f1__wrap" class="phone-callback__link callBack__link">Обратный звонок</a>
    </div>
  </div>
  <?php
}

add_action( 'storefront_header', 'sf_location', 40 );


/*
 * Tags - Home Page
*/
add_action( 'homepage', 'storefront_homepage_tags', 5 );
function storefront_homepage_tags() {
  require_once 'blocks/home-tags/home-tags.php';
}

/*
 * LOOKBOOK - Home Page
*/
add_action( 'homepage', 'storefront_homepage_lookbook', 65 );
function storefront_homepage_lookbook() {
  require_once 'blocks/home-lookbook/home-lookbook.php';
}

