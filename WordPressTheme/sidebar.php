<?php
$voice = esc_url(home_url('/voice'));
$campaign = esc_url(home_url('/campaign'));
?>
<!-- アサイド -->
<aside class="aside">
  <div class="aside__article">
    <div class="aside__title-line">
      <h2 class="aside__title">人気記事</h2>
    </div>
    <!-- 最新の投稿3件を取得する -->
    <?php
    $args = [
      "posts_per_page" => 3,
    ];
    $the_query = new WP_Query($args);
    ?>
    <?php if ($the_query->have_posts()) : ?>
      <div class="aside__container aside__article-container">
        <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
          <div class="aside__article-contents">
            <a href="<?php the_permalink(); ?>" class="aside__article-block">
              <div class="aside__article-photo">
                <?php if (has_post_thumbnail()) : ?>
                  <?php the_post_thumbnail('full'); ?>
                <?php else : ?>
                  <img
                    src="<?php echo get_template_directory_uri(); ?>/assets/images/common/noimage.jpg"
                    alt="noimage"
                    loading="lazy"
                    decoding="async" />
                <?php endif; ?>
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
    <!-- 最新の投稿2件を取得する -->
    <?php
    $args = [
      "post_type" => "voice",
      "posts_per_page" => 1,
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
                    src="<?php echo get_template_directory_uri(); ?>/assets/images/common/noimage.jpg"
                    alt="noimage"
                    loading="lazy"
                    decoding="async" />
                <?php endif; ?>
              </div>
              <div class="aside__voice-meta">
                <p class="aside__voice-age">
                  <?php
                  // 年齢と性別を取得
                  $age = get_field('age'); // 年齢
                  $sex = get_field('sex'); // 性別
                  echo $age ? esc_html($age) : '年齢情報なし';

                  // 性別がある場合のみ括弧で囲んで表示
                  if ($sex) {
                    echo ' (' . esc_html($sex) . ')';
                  } else {
                    echo ' (性別情報なし)';
                  }
                  ?>
                </p>
                <p class="aside__voice-title"><?php the_title(); ?></p>
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
      <a href="<?php echo $voice; ?>" class="button">
        Viewmore<span class="arrow"></span>
      </a>
    </div>
  </div>

  <div class="aside__campaign">
    <div class="aside__title-line">
      <h2 class="aside__title">キャンペーン</h2>
    </div>
    <!-- 最新の投稿2件を取得する -->
    <?php
    $latest_campaign_query = new WP_Query([
      'post_type' => 'campaign',
      'posts_per_page' => 2,
    ]);

    if ($latest_campaign_query->have_posts()) :
      while ($latest_campaign_query->have_posts()) : $latest_campaign_query->the_post();
    ?>
        <div class="aside__container aside__campaign-container">

          <a href="<?php echo esc_url($campaign); ?>" class="campaign-card campaign-card--aside">
            <div class="campaign-card__img--aside">
              <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('full'); ?>
              <?php else : ?>
                <img
                  src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/common/noimage.jpg"
                  alt="noimage"
                  class="noimage"
                  loading="lazy"
                  decoding="async" />
              <?php endif; ?>
            </div>
            <div class="campaign-card__body campaign-card__body--aside">
              <h3 class="campaign-card__title campaign-card__title--aside"><?php the_title(); ?></h3>
              <div class="campaign-card__text-wrap campaign-card__text-wrap--aside">
                <p class=" campaign-card__text campaign-card__text--aside">全部コミコミ(お一人様)</p>
                <div class="campaign-card__price-wrap campaign-card__price-wrap--aside">
                  <?php
                  // サブプライスの処理
                  $subprice = get_field('campaign_subprice');
                  $subprice_class = empty($subprice) ? 'is-hidden' : ''; // サブプライスがない場合にクラスを付与
                  ?>
                  <div class="campaign-card__subprice campaign-card__subprice--aside <?php echo $subprice_class; ?>">
                    <?php if (!empty($subprice)) : ?>
                      <span>
                        <?php echo '¥' . number_format($subprice); ?>
                      </span>
                    <?php endif; ?>
                  </div>
                  <?php
                  // プライスの処理
                  $price = get_field('campaign_price');
                  $price_class = empty($price) ? 'is-hidden' : ''; // プライスがない場合にクラスを付与
                  ?>
                  <div class="campaign-card__price <?php echo $price_class; ?>">
                    <?php if (!empty($price)) : ?>
                      <?php echo '¥' . number_format($price); ?>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </a>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
      <?php endif; ?>
        </div>
        <div class="aside__campaign-button">
          <a href="<?php echo $campaign; ?>" class="button">
            Viewmore<span class="arrow"></span>
          </a>
        </div>
  </div>

  <div class="aside__archive">
    <div class="aside__title-line">
      <h2 class="aside__title">アーカイブ</h2>
    </div>
    <div class="aside__container aside__archive-container">
      <ul class="aside__archive-list">
        <?php
        global $wpdb;
        $years = $wpdb->get_results("
            SELECT DISTINCT YEAR(post_date) AS year
            FROM $wpdb->posts
            WHERE post_status = 'publish' AND post_type = 'post'
            ORDER BY year DESC
        ");
        foreach ($years as $year) :
          $months = $wpdb->get_results("
              SELECT DISTINCT MONTH(post_date) AS month
              FROM $wpdb->posts
              WHERE YEAR(post_date) = $year->year AND post_status = 'publish' AND post_type = 'post'
              ORDER BY month DESC
          ");
        ?>
          <li class="aside__archive-item js-archive__toggle">
            <a href="javascript:void(0)"><?php echo esc_html($year->year); ?></a>
          </li>
          <?php foreach ($months as $month) : ?>
            <li class="aside__archive-item aside__archive-item--month">
              <a href="<?php echo esc_url(get_month_link($year->year, $month->month)); ?>">
                <?php echo esc_html($month->month) . '月'; ?>
              </a>
            </li>
          <?php endforeach; ?>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</aside>