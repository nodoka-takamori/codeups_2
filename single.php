<?php
$home = esc_url(home_url('/'));
$contact = esc_url(home_url('/contact'));
?>
<?php get_header(); ?>
<section class="blog__mv mv">
  <div class="mv__title-wrap">
    <p class="mv__title">Blog</p>
  </div>
  <picture class="mv__photo">
    <source
      srcset="<?php echo get_template_directory_uri(); ?>/dist/assets/images/common/blog_mv-sp.jpg"
      media="(max-width:768px)" />
    <img
      src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/common/blog_mv.jpg"
      alt="2匹の黄色の熱帯魚が海で泳いでいる" />
  </picture>
</section>
<?php get_template_part('breadcrumb'); ?>
<div class="page-blog layout-sub__blog">
  <div class="page-blog__inner page-blog__inner--sub inner">
    <section class="page-blog__main page-blog__main--sub">
      <div class="page-blog__container">
        <?php
        // メインループの開始
        // 現在のクエリで投稿が存在するか確認
        if (have_posts()) :
          while (have_posts()) :
            // ループの中で現在の投稿をセットアップ
            the_post();
        ?>
            <div class="page-blog__contents">
              <!-- 投稿の日付を表示 -->
              <time datetime="<?php the_time('c'); ?>"><?php the_time('Y.m/d'); ?></time>

              <!-- 投稿のタイトルを表示 -->
              <h1 class="page-blog__title"><?php the_title(); ?></h1>

              <!-- 投稿にアイキャッチ画像が設定されている場合 -->
              <?php if (has_post_thumbnail()) : ?>
                <div class="page-blog__photo">
                  <!-- アイキャッチ画像を表示 -->
                  <?php the_post_thumbnail(); ?>
                </div>
              <?php endif; ?>

              <!-- 投稿の本文を表示 -->
              <div class="page-blog__content">
                <?php the_content(); ?>
              </div>
            </div>
        <?php
          // メインループの終了
          endwhile;
        endif;
        ?>
        <!-- ページネーションの開始 -->
        <div class="pagination page-blog__pagination--sub">
          <!-- 前の投稿へのリンク -->
          <?php previous_post_link('%link', '＜'); ?>

          <!-- 次の投稿へのリンク -->
          <?php next_post_link('%link', '＞'); ?>
        </div>
    </section>

    <!-- サイドバーの表示 -->
    <aside class="page-blog__aside aside">
      <?php get_sidebar(); // サイドバーのテンプレートを呼び出し 
      ?>
    </aside>
  </div>
</div>


</div>
<section class="contact page-blog__contact">
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
  <a href=<?php echo $home; ?>><img src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/common/up__arrow.svg" alt="ロゴ" /></a>
</div>
<?php get_footer(); ?>