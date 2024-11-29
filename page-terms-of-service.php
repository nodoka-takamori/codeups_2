<?php
$contact = esc_url(home_url('/contact'));
?>
<?php get_header(); ?>
<main>
  <section class="terms__mv mv">
    <div class="mv__title-wrap">
      <p class="mv__title">Terms of Service</p>
    </div>
    <picture class="mv__photo">
      <source
        srcset="<?php echo get_template_directory_uri(); ?>/dist/assets/images/common/sub_mv-sp.jpg"
        media="(max-width:768px)" />
      <img
        src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/common/sub_mv.jpg"
        alt="たくさんの熱帯魚と大きな珊瑚の写真" />
    </picture>
  </section>
  <?php get_template_part('breadcrumb'); ?>
  <section class="terms">
    <div class="terms__inner inner">
      <h2 class="terms__title"><?php the_title(); ?></h2>
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
          <div class="terms__text-container">
            <?php the_content(); ?>
          </div>
      <?php endwhile;
      endif; ?>
    </div>
  </section>
  <section class="contact terms-contact">
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
</main>
<?php get_footer(); ?>