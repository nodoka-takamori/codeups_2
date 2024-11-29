<?php
$contact = esc_url(home_url( '/contact' ) );
?>
<?php get_header(); ?>
<section class="information__mv mv">
        <div class="mv__title-wrap">
          <p class="mv__title">Information</p>
        </div>
        <picture class="mv__photo">
          <source
            srcset="<?php echo get_template_directory_uri(); ?>/dist/assets/images/common/information_mv-sp.jpg"
            media="(max-width:768px)"
          />
          <img
            src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/common/information_mv.jpg"
            alt="2匹の黄色の熱帯魚が海で泳いでいる"
          />
        </picture>
      </section>
      <?php get_template_part('breadcrumb'); ?>
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
                  src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/common/information1.jpg"
                  alt="水色の海にダイバーが5人いる"
                  loading="lazy"
                  decoding="async"
                />
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
                  src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/common/information2.jpg"
                  alt="水色の海にダイバーが5人いる"
                  loading="lazy"
                  decoding="async"
                />
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
                  src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/common/information3.jpg"
                  alt="水色の海にダイバーが5人いる"
                  loading="lazy"
                  decoding="async"
                />
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="contact page-information__contact">
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
                    referrerpolicy="no-referrer-when-downgrade"
                  ></iframe>
                </div>
              </div>
            </div>
            <div class="contact__contents-right">
              <div class="contact__title-wrap">
                <p class="contact__title">Contact</p>
                <h2 class="contact__subtitle">お問い合わせ</h2>
                <p class="contact__title-text">ご予約・お問い合わせはコチラ</p>
                <div class="contact__button">
                  <a href=<?php echo $contact; ?> class="button"
                    >Contact us<span class="arrow"></span
                  ></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <div class="button-top" id="js-button-top">
        <a href="#"
          ><img src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/common/up__arrow.svg" alt="ロゴ"
        /></a>
      </div>
<?php get_footer(); ?>