<?php
$voice = esc_url(home_url('/voice'));
?>
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
<div class="page-blog layout-blog">
  <div class="page-blog__inner inner">
    <!-- メイン -->
    <section class="page-blog__main">
      <div class="blog-cards blog-cards--sub">
        <?php
        // メインループの開始
        // 投稿が存在するかを確認
        if (have_posts()):
          // 投稿が存在する間、ループを繰り返す
          while (have_posts()):
            the_post(); // 現在の投稿データをセットアップ
        ?>
            <div class="blog-cards__item">
              <!-- 投稿へのリンク -->
              <a href="<?php the_permalink(); ?>" class="blog-card">
                <figure class="blog-card__img">
                  <?php
                  // 投稿にアイキャッチ画像が設定されているか確認
                  if (has_post_thumbnail()) :
                    // アイキャッチ画像を表示
                    the_post_thumbnail('full');
                  else :
                  ?>
                    <!-- 画像がない場合のデフォルト画像 -->
                    <img
                      src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/common/noimage.jpg"
                      alt="noimage"
                      class="noimage"
                      loading="lazy"
                      decoding="async"
                      width="200" height="100" />
                  <?php endif; ?>
                </figure>
                <div class="blog-card__body">
                  <div class="blog-card__meta">
                    <!-- 投稿の公開日を表示 -->
                    <time datetime="<?php the_time('c'); ?>"><?php the_time('Y.m/d'); ?></time>
                    <!-- 投稿タイトルを表示 -->
                    <h3 class="blog-card__title"><?php the_title(); ?></h3>
                  </div>
                  <!-- 投稿の抜粋テキストを生成して表示 -->
                  <p class="blog-card__text">
                    <?php
                    // 投稿本文を取得
                    $content = get_the_content();
                    // 不要なHTMLタグを削除
                    $content = wp_strip_all_tags($content);
                    // 文字数を制限（90文字以上の場合「...」を追加）
                    if (mb_strlen($content, 'UTF-8') > 90) {
                      $content = mb_substr($content, 0, 90, 'UTF-8') . '...';
                    }
                    // 整形済みの本文を出力
                    echo esc_html($content);
                    ?>
                  </p>
                </div>
              </a>
            </div>
          <?php
          endwhile; // メインループの終了
        else:
          ?>
          <!-- 投稿がない場合の表示 -->
          <p>投稿がありません。</p>
        <?php endif; ?>
      </div>

      <!-- ページネーション -->
      <div class="pagination page-blog__pagination">
        <div class="pagination__wrap">
          <div class="wp-pagenavi">
            <?php wp_pagenavi(); ?>
          </div>
        </div>
      </div>
    </section>

    <!-- アサイド -->
    <div class="page-blog__aside">
      <?php get_sidebar(); ?>
    </div>
  </div>
</div>
<?php get_footer(); ?>