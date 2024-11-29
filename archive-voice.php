<?php
// ホームページとお問い合わせページのURLを取得
$home = esc_url(home_url('/')); // ホームページURLを取得してエスケープ処理
$contact = esc_url(home_url('/contact')); // お問い合わせページのURLを取得してエスケープ処理
?>
<?php get_header(); ?>
<section class="voice__mv mv">
  <div class="mv__title-wrap">
    <p class="mv__title">Voice</p>
  </div>
  <picture class="mv__photo">
    <source
      srcset="<?php echo get_template_directory_uri(); ?>/dist/assets/images/common/voice_mv-sp.jpg"
      media="(max-width:768px)" />
    <img
      src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/common/voice_mv.jpg"
      alt="2匹の黄色の熱帯魚が海で泳いでいる" />
  </picture>
</section>
<!-- パンくずリスト -->
<?php get_template_part('breadcrumb'); ?>

<section class="page-voice layout-voice">
  <div class="page-voice__inner inner">
    <!-- カテゴリーリンクの表示 -->

    <div class="page-voice_tags tags">
      <?php
      // 現在のタクソノミーまたはカテゴリーIDを取得
      $current_term_id = get_queried_object_id();

      // タクソノミー "voice_category" の用語一覧を取得
      $terms = get_terms([
        'taxonomy' => 'voice_category', // カスタムタクソノミーのスラッグ
        'orderby' => 'name',           // 名前順に並び替え
        'order' => 'ASC',              // 昇順
        'hide_empty' => true,          // 投稿がないタクソノミーを非表示
      ]);

      if (!empty($terms) && !is_wp_error($terms)) :
        // 「All」リンク生成
        $all_class = (!$current_term_id || is_post_type_archive('voice')) ? 'active' : ''; // アーカイブ全体の場合
        echo sprintf(
          '<a href="%s" class="tags__item %s">All</a>',
          esc_url(get_post_type_archive_link('voice')), // カスタム投稿タイプ 'voice' のアーカイブリンク
          esc_attr($all_class)
        );

        // 各タクソノミー用語のリンク生成
        foreach ($terms as $term) {
          $term_class = ($current_term_id === $term->term_id) ? 'active' : ''; // 選択中のカテゴリー
          echo sprintf(
            '<a href="%s" class="tags__item %s">%s</a>',
            esc_url(get_term_link($term->term_id, 'voice_category')), // タクソノミー用語のリンク
            esc_attr($term_class),
            esc_html($term->name)
          );
        }
      endif;
      ?>
    </div>

    <!-- 投稿カード -->
    <div class="page-voice-card__container ">
        <div class="voice-cards">
          <?php
          // ページネーション対応のための設定
          $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

          // クエリの条件設定
          $args = array(
            'post_type' => 'voice',             // カスタム投稿タイプ 'voice'
            'posts_per_page' => 6,             // 最大表示件数
            'paged' => $paged,                 // ページネーション対応
            'orderby' => 'date',               // 日付順
            'order' => 'DESC',                 // 降順
            'tax_query' => $current_term_id ? array( // 現在のタクソノミーに関連する投稿を取得
              array(
                'taxonomy' => 'voice_category',
                'field' => 'term_id',
                'terms' => $current_term_id,
              ),
            ) : '', // 全体表示時はフィルタなし
          );

          $query = new WP_Query($args); // 投稿を取得
          if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post(); ?>

              <div class="voice-cards__item">
                <div class="voice-card">
                  <div class="voice-card__head">
                    <div class="voice-card__title-container">
                      <div class="voice-card__category-wrapper">
                        <p class="voice-card__age">
                          <?php
                          // 年齢と性別を取得
                          $age = get_field('age'); // 年齢
                          $sex = get_field('sex'); // 性別
                          echo $age ? esc_html($age) : '年齢情報なし';
                          echo ' / ';
                          echo $sex ? esc_html($sex) : '性別情報なし';
                          ?>
                        </p>
                        <div class="voice-card__category-wrap">
                          <?php
                          // カテゴリーリンクを表示
                          $categories = get_the_terms(get_the_ID(), 'voice_category');
                          if ($categories) {
                            foreach ($categories as $category) {
                              echo sprintf(
                                '<a href="%s" class="voice-card__category">%s</a>',
                                esc_url(get_term_link($category->term_id, 'voice_category')),
                                esc_html($category->name)
                              );
                            }
                          }
                          ?>
                        </div>
                      </div>
                      <h3 class="voice-card__title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                      </h3>
                    </div>
                    <div class="voice-card__img colorbox js-colorbox">
                      <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('full'); ?>
                      <?php else : ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/common/noimage.jpg" alt="noimage" class="noimage" />
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="voice-card__text-info">
                    <p>
                      <?php
                      // 投稿本文を取得
                      $content = $post->post_content;
                      // 不要なタグを削除してテキストのみ取得
                      $content = wp_strip_all_tags($content);
                      // 文字数を制限
                      if (mb_strlen($content, 'UTF-8') > 250) {
                        // mb_substr: 文字列の一部を取り出す関数
                        $content = mb_substr($content, 0, 250, 'UTF-8') . '...';
                      }
                      echo $content;
                      ?>
                    </p>
                  </div>
                </div>
              </div>


            <?php endwhile;
            wp_reset_postdata();
          else : ?>
            <p class="no-posts">お客様の声はまだありません。</p>
          <?php endif; ?>
        </div>
      </div>

    <!-- ページネーション -->
    <div class="pagination page-voice__pagination">
      <div class="pagination__wrap">
        <div class="wp-pagenavi">
          <?php
          global $wp_query;

          // 総ページ数と現在のページを取得
          $total_pages = $wp_query->max_num_pages;
          $current_page = max(1, get_query_var('paged'));

          // 前のページリンク
          if ($current_page > 1) {
            echo '<a class="previouspostslink" rel="prev" href="' . esc_url(get_pagenum_link($current_page - 1)) . '">＜</a>';
          }

          // 中央のページリンクを生成
          $pagination_links = paginate_links(array(
            'total' => $total_pages,
            'current' => $current_page,
            'type' => 'array',
            'mid_size' => 2,
            'prev_next' => false,
          ));

          if (!empty($pagination_links)) {
            foreach ($pagination_links as $link) {
              echo $link;
            }
          }

          // 次のページリンク
          if ($current_page < $total_pages) {
            echo '<a class="nextpostslink" rel="next" href="' . esc_url(get_pagenum_link($current_page + 1)) . '">＞</a>';
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</section>



<section class="contact page-voice__contact">
  <!-- 連絡先情報の表示セクション -->
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
              src="https://www.google.com/maps/embed..."
              style="border: 0"
              allowfullscreen=""
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade">
            </iframe>
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
  <a href="#">
    <img src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/common/up__arrow.svg" alt="ロゴ" />
  </a>
</div>

<?php get_footer(); // フッターのテンプレートを読み込む 
?>