<?php
$home = esc_url(home_url('/'));
$contact = esc_url(home_url('/contact'));
?>
<?php get_header(); ?>
<section class="campaign__mv mv">
  <div class="mv__title-wrap">
    <p class="mv__title">Campaign</p>
  </div>
  <picture class="mv__photo">
    <source
      srcset="<?php echo get_template_directory_uri(); ?>/dist/assets/images/common/campaign_mv-sp.jpg"
      media="(max-width:768px)" />
    <img
      src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/common/campaign_mv.jpg"
      alt="2匹の黄色の熱帯魚が海で泳いでいる" />
  </picture>
</section>
<!-- パンくずリスト -->
<?php get_template_part('breadcrumb'); ?>

<section class="page-campaign layout-campaign">
  <div class="page-campaign__inner inner">
    <!-- カテゴリーリンクの表示 -->
    <div class="page-campaign_tags tags">
      <?php
      // 現在のタクソノミーまたはカテゴリーIDを取得
      $current_term_id = get_queried_object_id();

      // タクソノミー "campaign_category" の用語一覧を取得
      $terms = get_terms([
        'taxonomy' => 'campaign_category', // タクソノミーのスラッグ
        'orderby' => 'name',              // 名前順
        'order' => 'ASC',                 // 昇順
        'hide_empty' => true,             // 投稿がないタクソノミーを非表示
      ]);

      if (!empty($terms) && !is_wp_error($terms)) :
        // 「All」リンク生成
        $all_class = (!$current_term_id || is_post_type_archive('campaign')) ? 'active' : ''; // アーカイブ全体の場合
        echo sprintf(
          '<a href="%s" class="tags__item %s">All</a>',
          esc_url(get_post_type_archive_link('campaign')), // カスタム投稿タイプ 'campaign' のアーカイブリンク
          esc_attr($all_class)
        );

        // 各タクソノミー用語のリンク生成
        foreach ($terms as $term) {
          $term_class = ($current_term_id === $term->term_id) ? 'active' : ''; // 選択中のカテゴリー
          echo sprintf(
            '<a href="%s" class="tags__item %s">%s</a>',
            esc_url(get_term_link($term->term_id, 'campaign_category')), // タクソノミー用語のリンク
            esc_attr($term_class),
            esc_html($term->name)
          );
        }
      endif;
      ?>
    </div>

    <!-- 投稿カード -->
    <div class="page-campaign__cards campaign-cards">
      <div class="campaign-cards__inner">
        <?php
        // ページネーション対応のための設定
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        // 投稿クエリの設定
        $args = array(
          'post_type' => 'campaign',        // カスタム投稿タイプ 'campaign'
          'posts_per_page' => 4,           // 表示する投稿数
          'paged' => $paged,                 // ページネーション対応
          'orderby' => 'date',             // 並び順
          'order' => 'DESC',               // 降順
          'tax_query' => $current_term_id ? array(
            array(
              'taxonomy' => 'campaign_category', // タクソノミー
              'field' => 'term_id',              // 現在の用語IDでフィルタ
              'terms' => $current_term_id,
            )
          ) : '', // 全ての投稿を表示する場合は条件を設定しない
        );

        $query = new WP_Query($args); // 投稿を取得
        if ($query->have_posts()) :
          while ($query->have_posts()) : $query->the_post(); ?>

            <div class="campaign-card campaign-card--big">
              <div class="campaign-card__img">
                <?php if (has_post_thumbnail()) : ?>
                  <?php the_post_thumbnail('full'); ?>
                <?php else : ?>
                  <img
                    src="<?php echo esc_url(get_template_directory_uri()); ?>/dist/assets/images/common/noimage.jpg"
                    alt="noimage"
                    class="noimage"
                    loading="lazy"
                    decoding="async" />
                <?php endif; ?>
              </div>
              <div class="campaign-card__body campaign-card__body--big">
                <div class="campaign-card__title-container">
                  <div class="campaign-card__category-wrap">
                    <?php
                    // 現在の投稿に関連するカテゴリーを取得
                    $post_terms = get_the_terms(get_the_ID(), 'campaign_category');
                    if (!empty($post_terms) && !is_wp_error($post_terms)) {
                      foreach ($post_terms as $post_term) {
                        echo sprintf(
                          '<div class="campaign-card__category">%s</div>',
                          esc_html($post_term->name) // カテゴリー名を表示
                        );
                      }
                    }
                    ?>
                  </div>
                  <h3 class="campaign-card__title campaign-card__title--big">
                    <a href="<?php the_permalink(); ?>">
                      <?php the_title(); ?>
                    </a>
                  </h3>
                </div>
                <div class="campaign-card__text-wrap campaign-card__text-wrap--big">
                  <p class="campaign-card__text">全部コミコミ(お一人様)</p>
                  <div class="campaign-card__price-wrap campaign-card__price-wrap--big">
                    <div class="campaign-card__subprice campaign-card__subprice--big">
                      <span>
                        <?php
                        $subprice = get_field('campaign_subprice');
                        echo '¥' . number_format($subprice);
                        ?>
                      </span>
                    </div>
                    <div class="campaign-card__price">
                      <?php
                      $price = get_field('campaign_price');
                      echo '¥' . number_format($price);
                      ?>
                    </div>
                  </div>
                  <div class="campaign-card__text-wrapper campaign-card__text-wrapper--big">
                    <div class="campaign-card__text-info">
                      <p>
                        <?php
                        // 投稿本文を取得
                        $content = $post->post_content;
                        // 文字数を制限
                        if (mb_strlen($content, 'UTF-8') > 200) {
                          // mb_substr: 文字列の一部を取り出す関数
                          $content = mb_substr($content, 0, 200, 'UTF-8') . '...';
                        }
                        echo $content;
                        ?>
                      </p>
                    </div>
                    <p class="campaign-card__day">
                      <?php the_field('campaign_day'); ?>
                    </p>
                    <p class="campaign-card__contact-info">
                      ご予約・お問い合わせはコチラ
                    </p>
                    <div class="campaign-card__button">
                      <a href="<?php echo esc_url($contact); ?>" class="button">
                        Contact us<span class="arrow"></span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php endwhile;
          wp_reset_postdata();
        else : ?>
          <p>キャンペーンが見つかりませんでした。</p>
        <?php endif; ?>
      </div>
    </div>

    <!-- ページネーション -->
    <div class="pagination page-campaign__pagination">
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




<section class="contact page-campaign__contact">
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