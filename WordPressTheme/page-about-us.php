<?php
$home = esc_url(home_url('/'));
$contact = esc_url(home_url('/contact'));
?>
<?php get_header(); ?>
<section class="about__mv mv">
  <div class="mv__title-wrap">
    <p class="mv__title">About us</p>
  </div>
  <picture class="mv__photo">
    <source
      srcset="<?php echo get_template_directory_uri(); ?>/assets/images/common/about_mv-sp.jpg"
      media="(max-width:768px)" />
    <img
      src="<?php echo get_template_directory_uri(); ?>/assets/images/common/about_mv.jpg"
      alt="2匹の黄色の熱帯魚が海で泳いでいる" />
  </picture>
</section>
<?php get_template_part('inc/breadcrumb'); ?>
<section class="page-about about">
  <div class="layout-about">
    <div class="page-about__inner inner">
      <div class="about__photo-container about__photo-container--sub">
        <div class="about__photo-wrap">
          <img
            src="<?php echo get_template_directory_uri(); ?>/assets/images/common/about_2.jpg"
            alt="黄色の２匹の魚が泳いでいる"
            class="about__photo2 about__photo2--sub" />
          <img
            src="<?php echo get_template_directory_uri(); ?>/assets/images/common/about_1.jpg"
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

<?php
// SCFからギャラリー画像リストを取得
$gallery_photos = SCF::get('gallery_photos', get_the_ID());

// 画像が1枚以上あるかどうかを確認するためのフラグ
$has_image = false;

// 繰り返しフィールドが空でないかをチェック
if (!empty($gallery_photos)) {
  // ギャラリー画像リスト内の各フィールドを確認
  foreach ($gallery_photos as $photo) {
    if (!empty($photo['gallery_photo_pc']) ) {
      $has_image = true; // 画像が1枚でもあればフラグをtrueに
      break; // チェックが終わったらループを終了
    }
  }
}

// 画像がある場合のみセクションを表示
if ($has_image) :
?>
  <section class="gallery layout-gallery">
    <div class="gallery__inner inner">
      <div class="about__title section-header">
        <p class="section-header__title">Gallery</p>
        <h2 class="section-header__subtitle">フォト</h2>
      </div>
      <div class="gallery__photo-container">
        <?php
        // ギャラリー画像リストをループで処理
        foreach ($gallery_photos as $photo) :
          // 各画像のPC用URLとSP用URLを取得
          $photo_pc = wp_get_attachment_image_url($photo['gallery_photo_pc'], 'full');
          $photo_sp = wp_get_attachment_image_url($photo['gallery_photo_sp'], 'full');

          // 画像がない場合はスキップ
          if (empty($photo_pc) && empty($photo_sp)) {
            continue;
          }
        ?>
          <picture class="gallery__photo">
            <source srcset="<?php echo esc_url($photo_sp); ?>" media="(max-width:768px)" />
            <img src="<?php echo esc_url($photo_pc); ?>" alt="ギャラリー画像" />
          </picture>
        <?php endforeach; ?>
      </div>
    </div>
    <!-- モーダル -->
    <div id="js-modal" class="modal js-sp-nav">
      <div class="modal__content">
        <img id="js-modal-img" src="" alt="拡大画像" class="modal__image" />
      </div>
    </div>
  </section>
<?php endif; ?>



<?php get_footer(); ?>