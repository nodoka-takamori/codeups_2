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
?>

<?php if (!empty($faq_list)) : ?>
  <div class="page-faq layout-faq">
    <div class="page-faq__inner inner">
      <div class="faq-container">
        <?php foreach ($faq_list as $faq) :
          // 各FAQの質問と回答を取得
          $question = $faq['question_1'] ?? '';
          $answer = $faq['answer_1'] ?? '';

          // 質問と回答が存在する場合のみ表示
          if (!empty($question) && !empty($answer)) : ?>
            <div class="faq-container__item faq">
              <div class="faq__question js-faq">
                <p><?php echo esc_html($question); ?></p>
                <span></span><span></span>
              </div>
              <div class="faq__answer">
                <p><?php echo esc_html($answer); ?></p>
              </div>
            </div>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
<?php endif; ?>

<?php get_footer(); ?>