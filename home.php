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
      srcset="<?php echo get_template_directory_uri(); ?>/dist/assets/images/common/blog_mv-sp.jpg"
      media="(max-width:768px)" />
    <img
      src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/common/blog_mv.jpg"
      alt="2匹の黄色の熱帯魚が海で泳いでいる" />
  </picture>
</section>
<?php get_template_part('breadcrumb'); ?>
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
                      src="<?php echo esc_url(get_template_directory_uri()); ?>/dist/assets/images/common/noimage.jpg"
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
            <?php
            global $wp_query;
            // 総ページ数を取得
            $total_pages = $wp_query->max_num_pages;
            // 現在のページ番号を取得
            $current_page = max(1, get_query_var('paged'));
            // 前のページリンクを表示
            if ($current_page > 1) {
              echo '<a class="previouspostslink" rel="prev" href="' . esc_url(get_pagenum_link($current_page - 1)) . '">＜</a>';
            }
            // ページ番号のリンクを生成
            $pagination_links = paginate_links(array(
              'total' => $total_pages, // 総ページ数
              'current' => $current_page, // 現在のページ
              'type' => 'array', // 配列形式でリンクを取得
              'mid_size' => 2, // 現在のページの前後に表示するリンク数
              'prev_next' => false, // 前後リンクを非表示にする
            ));
            // 生成したページリンクをループで表示
            if (!empty($pagination_links)) {
              foreach ($pagination_links as $link) {
                echo $link;
              }
            }
            // 次のページリンクを表示
            if ($current_page < $total_pages) {
              echo '<a class="nextpostslink" rel="next" href="' . esc_url(get_pagenum_link($current_page + 1)) . '">＞</a>';
            }
            ?>
          </div>
        </div>
      </div>
    </section>

    <!-- アサイド -->
    <aside class="page-blog__aside aside">
      <?php get_sidebar(); ?>
    </aside>
  </div>
</div>


<!-- コンタクトセクション -->
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
  <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/common/up__arrow.svg" alt="ロゴ" /></a>
</div>
<?php get_footer(); ?>