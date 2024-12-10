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
$sitemap = esc_url(home_url('/sitemap'));
?>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>
  <header class="header">
    <div class="header__inner">
      <a href="<?php echo $home; ?>">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/logo.png" alt="ロゴ" class="header__logo">
      </a>
      <div class="header__hamburger js-hamburger" id="hamburger">
        <span></span>
        <span></span>
        <span></span>
      </div>
      <nav class="header__pc-nav pc-nav">
        <ul class="pc-nav__items">
          <?php
          $menu_items = [
            'Campaign' => $campaign,
            'About us' => $about,
            'Information' => $information,
            'Blog' => $blog,
            'Voice' => $voice,
            'Price' => $price,
            'FAQ' => $faq,
            'Contact' => $contact,
          ];
          foreach ($menu_items as $label => $link) {
            echo "<li class='pc-nav__item'>
                    <a href='$link' class='pc-nav__link'>$label<span>" . esc_html($label) . "</span></a>
                  </li>";
          }
          ?>
        </ul>
      </nav>
    </div>
    <nav class="header__sp-nav sp-nav js-sp-nav">
      <div class="sp-nav__inner">
        <div class="sp-nav__contents">
          <ul class="sp-nav__items">
            <li class="sp-nav__item sp-nav__item--main"><a href="<?php echo $campaign; ?>">キャンペーン</a></li>
            <?php
            $sp_menu_items = [
              'ライセンス取得' => $campaign_license,
              '貸切体験ダイビング' => $campaign_diving,
              'ナイトダイビング' => $campaign_fun_diving,
              '私たちについて' => $about,
              'ダイビング情報' => $information,
              'ライセンス講習' => "$information#tab1",
              '体験ダイビング' => "$information#tab3",
              'ファンダイビング' => "$information#tab2",
              'ブログ' => $blog,
              'お客様の声' => $voice,
              '料金一覧' => $price,
              'よくある質問' => $faq,
              'プライバシーポリシー' => $privacypolicy,
              '利用規約' => $terms,
              'お問い合わせ' => $contact,
              'サイトマップ' => $sitemap,
            ];
            foreach ($sp_menu_items as $label => $link) {
              echo "<li class='sp-nav__item'><a href='$link'>$label</a></li>";
            }
            ?>
          </ul>
        </div>
      </div>
    </nav>
  </header>
</body>