<?php
$home = esc_url(home_url( '/' ) );
$contact = esc_url(home_url( '/contact' ) );
?>
<?php get_header(); ?>
<section class="about__mv mv">
  <div class="mv__title-wrap">
    <p class="mv__title">About us</p>
  </div>
  <picture class="mv__photo">
    <source
      srcset="<?php echo get_template_directory_uri(); ?>/dist/assets/images/common/about_mv-sp.jpg"
      media="(max-width:768px)" />
    <img
      src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/common/about_mv.jpg"
      alt="2匹の黄色の熱帯魚が海で泳いでいる" />
  </picture>
</section>
<?php get_template_part('breadcrumb'); ?>
<section class="page-about about">
  <div class="layout-about">
    <div class="page-about__inner inner">
      <div class="about__photo-container about__photo-container--sub">
        <div class="about__photo-wrap">
          <img
            src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/common/about_2.jpg"
            alt="黄色の２匹の魚が泳いでいる"
            class="about__photo2 about__photo2--sub" />
          <img
            src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/common/about_1.jpg"
            alt="青い空と赤い屋根の上にシーサーが置いてある"
            class="about__photo1 about__photo1--sub" />
        </div>
        <div class="about__text-contents about__text-contents--sub">
          <div class="about__text-title about__text-title--sub">
            Dive into<br />
            the Ocean
          </div>
          <div class="about__text-wrap">
            <p class="about__text about__text--sub">
              ここにテキストが入ります。ここにテキストが入りま<br
                class="is-pc" />
              す。ここにテキストが入ります。ここにテキストが入り<br
                class="is-pc" />
              ます。<br />
              ここにテキストが入ります。ここにテキストが入りま<br
                class="is-pc" />
              す。ここにテキストが入ります。ここにテキストが入り<br
                class="is-pc" />
              ます。ここにテキスト
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- ギャラリー -->
<section class="gallery layout-gallery">
  <div class="gallery__inner inner">
    <div class="about__title section-header">
      <p class="section-header__title">Gallery</p>
      <h2 class="section-header__subtitle">フォト</h2>
    </div>
    <div class="gallery__photo-container">
      <?php
      // SCFからギャラリー画像のリストを取得
      $gallery_photos = SCF::get('gallery_photos');
      if ($gallery_photos) :
        foreach ($gallery_photos as $photo) :
          // 画像IDからURLを取得
          $photo_pc = wp_get_attachment_image_url($photo['gallery_photo_pc'], 'full');
          $photo_sp = wp_get_attachment_image_url($photo['gallery_photo_sp'], 'full');
      ?>
          <picture class="gallery__photo">
            <source srcset="<?php echo esc_url($photo_sp); ?>" media="(max-width:768px)" />
            <img src="<?php echo esc_url($photo_pc); ?>" alt="ギャラリー画像" />
          </picture>
      <?php
        endforeach;
      else :
        echo '<p>ギャラリー画像は現在ございません。</p>';
      endif;
      ?>
    </div>
  </div>
  <!-- モーダル -->
  <div id="js-modal" class="modal js-sp-nav">
    <div class="modal__content">
      <img id="js-modal-img" src="" alt="拡大画像" class="modal__image" />
    </div>
  </div>
</section>
<section class="contact page-about__contact">
  <div class="inner">
    <div class="contact__container">
      <div class="contact__contents-left">
        <div class="contact__logo">
          <img src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/common/logo_blue.svg" alt="ロゴ" />
        </div>
        <div class="contact__address-wrap">
          <div class="contact__address">
            <p>沖縄県那覇市1-1</p>
            <p>TEL:0120-000-0000</p>
            <p>営業時間:8:30-19:00</p>
            <p>定休日:毎週火曜日</p>
          </div>
          <div class="contact__address-map">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d57393.969626622005!2d127.6275265342976!3d26.196615752174797!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x34e5681e893b714d%3A0xa5360835fe2d83b8!2z54Cs6ZW35bO2IOOCpuODn-OCq-OCuOODhuODqeOCuQ!5e0!3m2!1sja!2sjp!4v1725201731353!5m2!1sja!2sjp"
              style="border: 0"
              allowfullscreen=""
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
        </div>
      </div>
      <div class="contact__contents-right">
        <div class="contact__title-wrap">
          <p class="contact__title">Contact</p>
          <h2 class="contact__subtitle">お問い合わせ</h2>
          <p class="contact__title-text">ご予約・お問い合わせはコチラ</p>
          <div class="contact__button">
            <a href=<?php echo $contact; ?> class="button">Contact us<span class="arrow"></span></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="button-top" id="js-button-top">
  <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/common/up__arrow.svg" alt="ロゴ" /></a>
</div>
<?php get_footer(); ?>