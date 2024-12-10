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
      srcset="<?php echo get_template_directory_uri(); ?>/assets/images/common/campaign_mv-sp.jpg"
      media="(max-width:768px)" />
    <img
      src="<?php echo get_template_directory_uri(); ?>/assets/images/common/campaign_mv.jpg"
      alt="2匹の黄色の熱帯魚が海で泳いでいる" />
  </picture>
</section>
<!-- パンくずリスト -->
<?php get_template_part('inc/breadcrumb'); ?>

<section class="page-campaign layout-campaign">
  <div class="page-campaign__inner inner">
    <!-- カテゴリーリンクの表示 -->
    <div class="page-campaign_tags tags">
      <?php
      // 現在のタクソノミーまたはカテゴリーIDを取得
      $current_term_id = get_queried_object_id();

      // タクソノミー "campaign_category" の用語一覧を取得
      $terms = get_terms([
        'taxonomy' => 'campaign_category',
        'orderby' => 'name',
        'order' => 'ASC',
        'hide_empty' => true,
      ]);

      if (!empty($terms) && !is_wp_error($terms)) :
        // 「All」リンク生成
        $all_class = (!$current_term_id || is_post_type_archive('campaign')) ? 'active' : '';
        echo sprintf(
          '<a href="%s" class="tags__item %s">All</a>',
          esc_url(get_post_type_archive_link('campaign')),
          esc_attr($all_class)
        );

        // 各タクソノミー用語のリンク生成
        foreach ($terms as $term) {
          $term_class = ($current_term_id === $term->term_id) ? 'active' : '';
          echo sprintf(
            '<a href="%s" class="tags__item %s">%s</a>',
            esc_url(get_term_link($term->term_id, 'campaign_category')),
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
        // メインループの開始
        // 投稿が存在するかを確認
        if (have_posts()) : ?>
          <?php
          // 投稿が存在する間、ループを繰り返す
          while (have_posts()) : the_post(); // 現在の投稿データをセットアップ
          ?>
            <div class="campaign-card campaign-card--big">
              <div class="campaign-card__img">
                <?php if (has_post_thumbnail()) : //投稿にアイキャッチ画像が設定されているか確認
                ?>
                  <?php the_post_thumbnail('full'); //// アイキャッチ画像を表示
                  ?>
                <?php else : ?>
                  <!-- 画像がない場合のデフォルト画像 -->
                  <img
                    src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/common/noimage.jpg"
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
                    $post_terms = get_the_terms(get_the_ID(), 'campaign_category');
                    if (!empty($post_terms) && !is_wp_error($post_terms)) {
                      foreach ($post_terms as $post_term) {
                        echo sprintf(
                          '<div class="campaign-card__category">%s</div>',
                          esc_html($post_term->name)
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
                        $content = get_the_content();
                        if (mb_strlen($content, 'UTF-8') > 200) {
                          $content = mb_substr($content, 0, 200, 'UTF-8') . '...';
                        }
                        echo esc_html($content);
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
          <?php endwhile; // メインループの終了
          ?>
        <?php else : ?>
          <!-- 投稿がない場合の表示 -->
          <p>キャンペーンが見つかりませんでした。</p>
        <?php endif; ?>
      </div>
    </div>

    <!-- ページネーション -->
    <div class="pagination page-campaign__pagination">
      <div class="pagination__wrap">
        <div class="wp-pagenavi">
          <?php
          the_posts_pagination([
            'prev_text' => '＜',
            'next_text' => '＞',
            'mid_size' => 2,
          ]);
          ?>
        </div>
      </div>
    </div>
  </div>
</section>


<?php get_footer(); ?>