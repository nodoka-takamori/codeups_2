<?php
$contact = esc_url(home_url('/contact'));
?>
<?php get_header(); ?>
<section class="information__mv mv">
  <div class="mv__title-wrap">
    <p class="mv__title">Information</p>
  </div>
  <picture class="mv__photo">
    <source
      srcset="<?php echo get_template_directory_uri(); ?>/assets/images/common/information_mv-sp.jpg"
      media="(max-width:768px)" />
    <img
      src="<?php echo get_template_directory_uri(); ?>/assets/images/common/information_mv.jpg"
      alt="2匹の黄色の熱帯魚が海で泳いでいる" />
  </picture>
</section>
<?php get_template_part('inc/breadcrumb'); ?>
<section class="page-information layout-information">
  <div class="page-information__inner inner">
    <!-- タブ -->
    <div class="tab">
      <ul class="tab__btn">
        <li id="tab1" class="tab__name is-change">
          <span class="anchor">ライセンス<br class="is-sp" />講習</span>
        </li>
        <li id="tab2" class="tab__name">
          <span>ファン<br class="is-sp" />ダイビング</span>
        </li>
        <li id="tab3" class="tab__name">
          <span>体験<br class="is-sp" />ダイビング</span>
        </li>
      </ul>
      <!-- ライセンス講習 -->
      <div class="tab__content is-show">
        <div class="tab__text-wrap">
          <div class="tab__title">ライセンス講習</div>
          <div class="tab__text">
            泳げない人も、ちょっと水が苦手な人も、ダイビングを「安全に」楽しんでいただけるよう、スタッフがサポートいたします！スキューバダイビングを楽しむためには最低限の知識とスキルが要求されます。知識やスキルと言ってもそんなに難しい事ではなく、安全に楽しむ事を目的としたものです。プロダイバーの指導のもと知識とスキルを習得しCカードを取得して、ダイバーになろう！
          </div>
        </div>
        <div class="tab__photo">
          <img
            src="<?php echo get_template_directory_uri(); ?>/assets/images/common/information1.jpg"
            alt="水色の海にダイバーが5人いる"
            loading="lazy"
            decoding="async" />
        </div>
      </div>
      <!-- ファンダイビング -->
      <div class="tab__content">
        <div class="tab__text-wrap">
          <div class="tab__title">ファンダイビング</div>
          <div class="tab__text">
            ブランクダイバー、ライセンスを取り立ての方も安心！沖縄本島を代表する「青の洞窟」（真栄田岬）やケラマ諸島などメジャーなポイントはモチロンのこと、最北端「辺戸岬」や最南端の「大渡海岸」等もご用意！
          </div>
        </div>
        <div class="tab__photo">
          <img
            src="<?php echo get_template_directory_uri(); ?>/assets/images/common/information2.jpg"
            alt="水色の海にダイバーが5人いる"
            loading="lazy"
            decoding="async" />
        </div>
      </div>
      <!-- 体験ダイビング -->
      <div class="tab__content">
        <div class="tab__text-wrap">
          <div class="tab__title">体験ダイビング</div>
          <div class="tab__text">
            ブランクダイバー、ライセンスを取り立ての方も安心！沖縄本島を代表する「青の洞窟」（真栄田岬）やケラマ諸島などメジャーなポイントはモチロンのこと、最北端「辺戸岬」や最南端の「大渡海岸」等もご用意！
          </div>
        </div>
        <div class="tab__photo">
          <img
            src="<?php echo get_template_directory_uri(); ?>/assets/images/common/information3.jpg"
            alt="水色の海にダイバーが5人いる"
            loading="lazy"
            decoding="async" />
        </div>
      </div>
    </div>
  </div>
</section>
<?php get_footer(); ?>