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
      srcset="<?php echo get_template_directory_uri(); ?>/assets/images/common/blog_mv-sp.jpg"
      media="(max-width:768px)" />
    <img
      src="<?php echo get_template_directory_uri(); ?>/assets/images/common/blog_mv.jpg"
      alt="2匹の黄色の熱帯魚が海で泳いでいる" />
  </picture>
</section>
<?php get_template_part('inc/breadcrumb'); ?>
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
<?php get_footer(); ?>