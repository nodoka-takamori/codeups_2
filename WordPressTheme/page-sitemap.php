<?php
$home = esc_url(home_url('/'));
$campaign = esc_url(home_url('/campaign'));
$about = esc_url(home_url('/about'));
$information = esc_url(home_url('/information'));
$blog = esc_url(home_url('/blog'));
$voice = esc_url(home_url('/voice'));
$price = esc_url(home_url('/price'));
$faq = esc_url(home_url('/faq'));
$contact = esc_url(home_url('/contact'));
$privacypolicy = esc_url(home_url('/privacypolicy'));
$terms = esc_url(home_url('/terms'));
$sitemap = esc_url(home_url('/sitmap'));
?>
<?php get_header(); ?>
<section class="sitemap__mv mv">
  <div class="mv__title-wrap">
    <p class="mv__title">Site MAP</p>
  </div>
  <picture class="mv__photo">
    <source
      srcset="<?php echo get_template_directory_uri(); ?>/assets/images/common/sub_mv-sp.jpg"
      media="(max-width:768px)" />
    <img
      src="<?php echo get_template_directory_uri(); ?>/assets/images/common/sub_mv.jpg"
      alt="2匹の黄色の熱帯魚が海で泳いでいる" />
  </picture>
</section>
<?php get_template_part('inc/breadcrumb'); ?>
<section class="sitemap">
  <div class="inner">
    <div class="sitemap__nav-contents nav-menu">
      <ul class="sitemap__nav-items sitemap__nav-items--first">
        <li class="sitemap__nav-item  sitemap__nav-item--main">
          <a href=<?php echo $campaign; ?>>キャンペーン</a>
        </li>
        <li class="sitemap__nav-item"><a href=<?php echo $campaign; ?>>ライセンス取得</a></li>
        <li class="sitemap__nav-item">
          <a href=<?php echo $campaign; ?>>貸切体験ダイビング</a>
        </li>
        <li class="sitemap__nav-item"><a href=<?php echo $campaign; ?>>ナイトダイビング</a></li>
        <li class="sitemap__nav-item sitemap__nav-item--main">
          <a href=<?php echo $about; ?>>私たちについて</a>
        </li>
      </ul>
      <ul class="sitemap__nav-items sitemap__nav-items--second">
        <li class="sitemap__nav-item sitemap__nav-item--main">
          <a href=<?php echo $information; ?>>ダイビング情報</a>
        </li>
        <li class="sitemap__nav-item"><a href="<?php echo $information; ?>#tab1">ライセンス講習</a></li>
        <li class="sitemap__nav-item"><a href="<?php echo $information; ?>#tab2">体験ダイビング</a></li>
        <li class="sitemap__nav-item"><a href="<?php echo $information; ?>#tab3">ファンダイビング</a></li>
        <li class="sitemap__nav-item sitemap__nav-item--main">
          <a href=<?php echo $blog; ?>>ブログ</a>
        </li>
      </ul>
      <ul class="sitemap__nav-items sitemap__nav-items--third">
        <li class="sitemap__nav-item sitemap__nav-item--main">
          <a href=<?php echo $voice; ?>>お客様の声</a>
        </li>
        <li class="sitemap__nav-item sitemap__nav-item--main">
          <a href=<?php echo $price; ?>>料金一覧</a>
        </li>
        <li class="sitemap__nav-item"><a href="<?php echo $price; ?>#price1">ライセンス講習</a></li>
        <li class="sitemap__nav-item"><a href="<?php echo $price; ?>#price2">体験ダイビング</a></li>
        <li class="sitemap__nav-item"><a href="<?php echo $price; ?>#price3">ファンダイビング</a></li>
      </ul>
      <ul class="sitemap__nav-items sitemap__nav-items--fourth">
        <li class="sitemap__nav-item sitemap__nav-item--main">
          <a href=<?php echo $faq; ?>>よくある質問</a>
        </li>
        <li class="sitemap__nav-item sitemap__nav-item--main">
          <a href=<?php echo $privacypolicy; ?>>プライバシー<br class="is-sp" />ポリシー</a>
        </li>
        <li class="sitemap__nav-item sitemap__nav-item--main">
          <a href=<?php echo $terms; ?>>利用規約</a>
        </li>
        <li class="sitemap__nav-item sitemap__nav-item--main">
          <a href=<?php echo $contact; ?>>お問い合わせ</a>
        </li>
        <li class="sitemap__nav-item sitemap__nav-item--main">
          <a href=<?php echo $sitemap; ?>>サイトマップ</a>
        </li>
      </ul>
    </div>
  </div>
</section>
<?php get_footer(); ?>