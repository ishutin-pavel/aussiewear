<?php
add_action( 'storefront_header', 'build_top_menu', 0 );
function build_top_menu () {
  ?>
  <nav class="top-menu__wrap">
    <div class="col-full">
      <ul class="top-menu">
        <li>
          <a href="/dostavka-i-oplata/">Доставка и оплата</a>
        </li>
        <li>
          <a href="/contacts/">Контакты</a>
        </li>
          <?php require './wp-content/themes/storefront-child/blocks/social-links/social-links.php'; ?>
        <li>
          <a href="#f1__wrap" class="callBack callBack__link"><i class="fa fa-phone" aria-hidden="true"></i> <span class="callBack__text">Позвонить мне</span></a>
        </li>
        <li>
          <a href="/cart/">Корзина</a>
        </li>
        <li>
          <a href="/my-account/">Вход</a>
        </li>
      </ul>
    </div><!-- .col-full -->
  </nav>
  <?php
  require './wp-content/themes/storefront-child/blocks/popup-form/popup-form.php';
}