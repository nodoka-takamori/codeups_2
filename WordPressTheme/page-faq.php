<?php
$home = esc_url(home_url('/'));
$contact = esc_url(home_url('/contact'));
?>
<?php get_header(); ?>
<section class="faq__mv mv">
  <div class="mv__title-wrap">
    <p class="mv__title">FAQ</p>
  </div>
  <picture class="mv__photo">
    <source
      srcset="<?php echo get_template_directory_uri(); ?>/assets/images/common/faq_mv-sp.jpg"
      media="(max-width:768px)" />
    <img
      src="<?php echo get_template_directory_uri(); ?>/assets/images/common/faq_mv.jpg"
      alt="2匹の黄色の熱帯魚が海で泳いでいる" />
  </picture>
</section>
<?php get_template_part('inc/breadcrumb'); ?>
<?php
// SCFからFAQリストを取得
$faq_list = SCF::get('faq_1');

// FAQリストが存在し、有効なFAQがあるかどうかのフラグ
$has_valid_faq = false;

// FAQのHTMLを構築する変数
$faq_html = '';

// FAQリストが空でない場合に処理を実行
if (!empty($faq_list)) {
  foreach ($faq_list as $faq) {
    // 各FAQの質問と回答を取得
    $question = $faq['question_1'] ?? '';
    $answer = $faq['answer_1'] ?? '';

    // 質問と回答の両方がある場合のみHTMLを構築
    if (!empty($question) && !empty($answer)) {
      $faq_html .= '<div class="faq-container__item faq">';
      $faq_html .= '<div class="faq__question js-faq">';
      $faq_html .= '<p>' . esc_html($question) . '</p>';
      $faq_html .= '<span></span><span></span>';
      $faq_html .= '</div>';
      $faq_html .= '<div class="faq__answer">';
      $faq_html .= '<p>' . esc_html($answer) . '</p>';
      $faq_html .= '</div>';
      $faq_html .= '</div>';

      // 有効なFAQがあることをフラグで記録
      $has_valid_faq = true;
    }
  }
}

// 有効なFAQがある場合のみセクション全体を表示
if ($has_valid_faq) :
?>
  <div class="page-faq layout-faq">
    <div class="page-faq__inner inner">
      <div class="faq-container">
        <?php echo $faq_html; // 構築したFAQのHTMLを出力 
        ?>
      </div>
    </div>
  </div>
<?php endif; ?>

<?php get_footer(); ?>