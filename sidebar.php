<?php
$voice = esc_url(home_url('/voice'));
$campaign = esc_url(home_url('/campaign'));
?>
<!-- アサイド -->

<div class="aside">
  <div class="aside__title-line">
    <h2 class="aside__title">人気記事</h2>
  </div>
  <?php
  $args = [
    "post_type" => "post",
    "posts_per_page" => 3,
    "orderby" => "date",
    "order" => "DESC",
  ];
  $the_query = new WP_Query($args);
  ?>
  <?php if ($the_query->have_posts()) : ?>
    <div class="aside__container aside__article-container">
      <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
        <div class="aside__article-contents">
          <!-- 動的なリンクを追加 -->
          <a href="<?php the_permalink(); ?>" class="aside__article-block">
            <div class="aside__article-photo">
              <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('full'); ?>
              <?php else : ?>
                <img
                  src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/common/noimage.jpg"
                  alt="noimage"
                  loading="lazy"
                  decoding="async" />
              <?php endif; ?>
              <!-- <img src="/images/dummy.jpg" alt="黄色い一匹の熱帯魚" class="detail__img"> -->
            </div>
            <div class="aside__article-meta">
              <time class="aside__article-days" datetime="<?php the_time('c'); ?>"><?php the_time('Y.m/d'); ?></time>
              <h3 class="aside__article-title"><?php the_title(); ?></h3>
            </div>
          </a>
        </div>
      <?php endwhile; ?>
      <?php wp_reset_postdata(); ?>
    </div>
  <?php else : ?>
    <p>記事が投稿されていません</p>
  <?php endif; ?>
</div>

<div class="aside__voice">
  <div class="aside__title-line">
    <h2 class="aside__title">口コミ</h2>
  </div>
  <?php
  $args = [
    "post_type" => "voice",
    "posts_per_page" => 1,
    "orderby" => "date",
    "order" => "DESC",
  ];
  $the_query = new WP_Query($args);
  ?>
  <?php if ($the_query->have_posts()) : ?>
    <div class="aside__container aside__article-container">
      <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
        <div class="aside__voice-contents">
          <a href="#" class="aside__voice-block">
            <div class="aside__voice-photo">
              <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('full'); ?>
              <?php else : ?>
                <img
                  src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/common/noimage.jpg"
                  alt="noimage"
                  loading="lazy"
                  decoding="async" />
              <?php endif; ?>
              <!-- <img src="/images/dummy.jpg" alt="黄色い一匹の熱帯魚" class="detail__img"> -->
            </div>
            <div class="aside__vice-meta">
              <p class="aside__voice-age">
                <?php
                // 年齢を表示
                $age = get_field('age');
                echo $age ? esc_html($age) : '年齢情報なし';
                ?>
                <?php
                // 性別を表示
                $sex = get_field('sex');
                echo $sex ? esc_html($sex) : '性別情報なし';
                ?>
              </p>
              <!-- <p class="aside__voice-age">30代(カップル)</p> -->
              <p class="aside__voice-title">
                <?php the_title(); ?>
              </p>
            </div>
          </a>
        </div>
      <?php endwhile; ?>
      <?php wp_reset_postdata(); ?>
    </div>
  <?php else : ?>
    <p>記事が投稿されていません</p>
  <?php endif; ?>
  <div class="aside__voice-button">
    <a href=<?php echo $voice; ?> class="button">
      Viewmore<span class="arrow"></span>
    </a>
  </div>
</div>
<div class="aside__campaign">
  <div class="aside__title-line">
    <h2 class="aside__title">キャンペーン</h2>
  </div>
  <div class="aside__container aside__campaign-container">
    <div class="aside__campaign-contents">
      <?php
      // 最新のカスタム投稿（campaign）の2件を取得するクエリ
      $latest_campaign_args = array(
        'post_type' => 'campaign',
        'posts_per_page' => 2,
        'orderby' => 'date',
        'order' => 'DESC',
      );
      $latest_campaign_query = new WP_Query($latest_campaign_args);
      if ($latest_campaign_query->have_posts()) :
        while ($latest_campaign_query->have_posts()) : $latest_campaign_query->the_post();
          $campaign_link = get_permalink(); // 個別投稿ページへのリンク
      ?>
          <div
            class="aside-campaign__card campaign-card campaign-card--aside">
            <a href="<?php echo esc_url($campaign_link); ?>">
              <figure class="campaign-card__img--aside">
                <?php if (has_post_thumbnail()) : ?>
                  <source srcset="<?php the_post_thumbnail_url('full'); ?>" type="image/webp">
                  <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>のアイキャッチ画像">
                <?php else : ?>
                  <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/common/noimage.jpg')); ?>" alt="noimage">
                <?php endif; ?>
              </figure>
              <div class="campaign-card__body campaign-card__body--aside">
                <div class="campaign-card__title-container">
                  <h3 class="campaign-card__title campaign-card__title--aside">
                    <?php the_title(); ?>
                  </h3>
                </div>
                <div class="campaign-card__text-wrap campaign-card__text-wrap--aside">
                  <p class="campaign-card__text campaign-card__text--aside">
                    全部コミコミ(お一人様)
                  </p>
                  <div class="campaign-card__price-wrap campaign-card__price-wrap--aside">
                    <div class="campaign-card__subprice">
                      <span>
                        <?php $price = get_field('campaign_subprice');
                        echo '¥' . number_format($price);
                        ?>
                      </span>
                    </div>
                    <div class="campaign-card__price campaign-card__price--aside">
                      <?php $price = get_field('campaign_price');
                      echo '¥' . number_format($price); ?>
                    </div>
                  </div>
                </div>
              </div>
          </div>
    </div>
    </a>
<?php
        endwhile;
        wp_reset_postdata();
      endif;
?>
<div class="aside__campaign-button">
  <a href=<?php echo $campaign; ?> class="button">
    Viewmore<span class="arrow"></span>
  </a>
</div>
  </div>
  <div class="aside__archive">
    <div class="aside__contents aside__article">
      <div class="aside__title-line">
        <h2 class="aside__title">アーカイブ</h2>
      </div>
      <div class="aside__container aside__archive-container">
        <ul class="aside__archive-list">
          <?php
          // 年ごとのアーカイブデータを取得
          global $wpdb; // WordPressのデータベースアクセスオブジェクトを取得
          // 投稿テーブルから取得(公開済みの投稿データで降順)
          $years = $wpdb->get_results("
                SELECT DISTINCT YEAR(post_date) AS year
                FROM $wpdb->posts
                WHERE post_status = 'publish' AND post_type = 'post'
                ORDER BY year DESC
            ");
          // 取得した年データをループ処理
          foreach ($years as $year) : ?>
            <li class="aside__archive-item js-archive__toggle">
              <a href="javascript:void(0)"><?php echo esc_html($year->year); ?></a>
            </li>
            <?php
            // 月ごとのアーカイブデータを取得
            // 投稿テーブルから取得(公開済みの投稿データで降順)
            $months = $wpdb->get_results("
                    SELECT DISTINCT MONTH(post_date) AS month
                    FROM $wpdb->posts
                    WHERE YEAR(post_date) = $year->year AND post_status = 'publish' AND post_type = 'post'
                    ORDER BY month DESC
                ");
            foreach ($months as $month) :
              // 月別リンクをループ処理
              //月をリンクとして表示
              $month_link = get_month_link($year->year, $month->month);
            ?>
              <li class="aside__archive-item aside__archive-item--month">
                <a href="<?php echo esc_url($month_link); ?>">
                  <?php echo esc_html($month->month) . '月'; ?>
                </a>
              </li>
            <?php endforeach; ?>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>

  </div>
</div>
</div>
</div>
</div>
</div>