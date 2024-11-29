<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="format-detection" content="telephone=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <meta name="format-detection" content="telephone=no" />
  <meta name="robots" content="noindex" />

  <?php if (is_404()) : ?>
    <meta http-equiv="refresh" content=" 5; url=<?php echo esc_url(home_url("")); ?>">
  <?php endif; ?>
  <?php wp_head(); ?>
</head>

<?php
$home = esc_url(home_url('/'));
$campaign = esc_url(home_url('/campaign'));
$campaign_fun_diving = esc_url(home_url('/campaign_category/fundiving/'));
$campaign_license = esc_url(home_url('/campaign_category/license/'));
$campaign_diving = esc_url(home_url('/campaign_category/diving/'));
$about = esc_url(home_url('/about-us'));
$information = esc_url(home_url('/information'));
$blog = esc_url(home_url('/blog'));
$voice = esc_url(home_url('/voice'));
$price = esc_url(home_url('/price'));
$faq = esc_url(home_url('/faq'));
$contact = esc_url(home_url('/contact'));
$privacypolicy = esc_url(home_url('/privacypolicy'));
$terms = esc_url(home_url('/terms-of-service'));
?>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>
  <header class="header">
    <div class="header__inner">
      <a href=<?php echo $home; ?>>
        <img src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/common/logo.png"
          alt="ロゴ"
          class="header__logo" /></a>
      <div class="header__hamburger js-hamburger" id="hamburger">
        <span></span>
        <span></span>
        <span></span>
      </div>
      <nav class="header__pc-nav pc-nav">
        <ul class="pc-nav__items">
          <li class="pc-nav__item">
            <a href=<?php echo $campaign; ?> class="pc-nav__link">Campaign<span>キャンペーン</span></a>
          </li>
          <li class="pc-nav__item">
            <a href=<?php echo $about; ?> class="pc-nav__link">About us<span>私たちについて</span></a>
          </li>
          <li class="pc-nav__item">
            <a href=<?php echo $information; ?> class="pc-nav__link">Information<span>ダイビング情報</span></a>
          </li>
          <li class="pc-nav__item">
            <a href=<?php echo $blog; ?> class="pc-nav__link">Blog<span>ブログ</span></a>
          </li>
          <li class="pc-nav__item">
            <a href=<?php echo $voice; ?> class="pc-nav__link">Voice<span>お客様の声</span></a>
          </li>
          <li class="pc-nav__item">
            <a href=<?php echo $price; ?> class="pc-nav__link">Price<span>料金一覧</span></a>
          </li>
          <li class="pc-nav__item">
            <a href=<?php echo $faq; ?> class="pc-nav__link">FAQ<span>よくある質問</span></a>
          </li>
          <li class="pc-nav__item">
            <a href=<?php echo $contact; ?> class="pc-nav__link">Contact<span>お問い合わせ</span></a>
          </li>
        </ul>
      </nav>
    </div>
    <nav class="header__sp-nav sp-nav js-sp-nav">
      <div class="sp-nav__inner">
        <div class="sp-nav__contents">
          <ul class="sp-nav__items">
            <li class="sp-nav__item sp-nav__item--main">
              <a href=<?php echo $campaign; ?>>キャンペーン</a>
            </li>
            <li class="sp-nav__item"><a href=<?php echo $campaign_license; ?>>ライセンス取得</a></li>
            <li class="sp-nav__item"><a href=<?php echo $campaign_diving; ?>>貸切体験ダイビング</a></li>
            <li class="sp-nav__item"><a href=<?php echo $campaign_fun_diving; ?>>ナイトダイビング</a></li>
            <li class="sp-nav__item sp-nav__item--main">
              <a href=<?php echo $about; ?>>私たちについて</a>
            </li>
            <li class="sp-nav__item sp-nav__item--main">
              <a href=<?php echo $information; ?>>ダイビング情報</a>
            </li>
            <li class="sp-nav__item"><a href="<?php echo $information; ?>#tab1">ライセンス講習</a></li>
            <li class="sp-nav__item"><a href="<?php echo $information; ?>#tab3">体験ダイビング</a></li>
            <li class="sp-nav__item"><a href="<?php echo $information; ?>#tab2">ファンダイビング</a></li>
            <li class="sp-nav__item sp-nav__item--main">
              <a href=<?php echo $blog; ?>>ブログ</a>
            </li>
          </ul>
          <ul class="sp-nav__items">
            <li class="sp-nav__item sp-nav__item--main">
              <a href=<?php echo $voice; ?>>お客様の声</a>
            </li>
            <li class="sp-nav__item sp-nav__item--main">
              <a href=<?php echo $price; ?>>料金一覧</a>
            </li>
            <li class="sp-nav__item"><a href="<?php echo $price; ?>#price1">ライセンス講習</a></li>
            <li class="sp-nav__item"><a href="<?php echo $price; ?>#price2">体験ダイビング</a></li>
            <li class="sp-nav__item"><a href="<?php echo $price; ?>#price3">ファンダイビング</a></li>
            <li class="sp-nav__item sp-nav__item--main">
              <a href="./pages/faq.html">よくある質問</a>
            </li>
            <li class="sp-nav__item sp-nav__item--main">
              <a href=<?php echo $privacypolicy; ?>>プライバシー<br />
                ポリシー</a>
            </li>
            <li class="sp-nav__item sp-nav__item--main">
              <a href=<?php echo $terms; ?>>利用規約</a>
            </li>
            <li class="sp-nav__item sp-nav__item--main">
              <a href=<?php echo $contact; ?>>お問い合わせ</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>