<?php
$home = esc_url(home_url('/'));
$campaign = esc_url(home_url('/campaign'));
$about = esc_url(home_url('/about'));
$information = esc_url(home_url('/information'));
$blog = esc_url(home_url('/blog'));
$voice = esc_url(home_url('/voice'));
$price = esc_url(home_url('/price/'));
$faq = esc_url(home_url('/faq'));
$contact = esc_url(home_url('/contact'));
?>
<?php get_header(); ?>
<main>
  <section class="fv">
    <div class="fv__inner">
      <div class="fv__title-wrap">
        <h1 class="fv__title">DIVING</h1>
        <p class="fv__subtitle">into the ocean</p>
      </div>
      <div class="fv__image">
        <div class="swiper js-fv-Swiper">
          <div class="swiper-wrapper">
            <?php
            $mv_images = SCF::get('mainview', get_the_ID());
            //  データが存在する場合に処理を進める
            if ($mv_images) :
              $counter = 0; // カウンター変数（未使用だが、必要なら使うために準備）
              // 繰り返しフィールドの中身を1件ずつループ処理
              foreach ($mv_images as $image) :
                // SP版画像のURLを取得
                $image_url_sp = wp_get_attachment_image_src($image['sp_img'], 'full')[0];
                // PC版画像のURLを取得
                $image_url_pc = wp_get_attachment_image_src($image['pc_img'], 'full')[0];
                // PC版画像の代替テキスト（alt属性値）を取得
                $image_alt = get_post_meta($image['pc_img'], '_wp_attachment_image_alt', true);
            ?>
                <!-- ここから1つのスライドのHTML出力 -->
                <div class="swiper-slide">
                  <picture class="fv__img">
                    <?php if (!empty($image['sp_img']) && !empty($image['pc_img'])) : ?>
                      <!-- SP版の画像（最大幅767px以下で表示） -->
                      <source
                        media="(max-width: 767px)"
                        srcset="<?php echo esc_url($image_url_sp); ?>"
                        width="375"
                        height="667">
                      <!-- PC版の画像（それ以外の幅で表示） -->
                      <img
                        src="<?php echo esc_url($image_url_pc); ?>"
                        alt="<?php echo esc_attr($image_alt); ?>"
                        width="1440"
                        height="768">
                  </picture>
                </div>
            <?php
                    endif; // SP版およびPC版の画像が両方設定されている場合の条件終了
                  endforeach; // 繰り返し処理終了
                else : // 画像が設定されていない場合の処理
            ?>
            <p>スライド画像が設定されていません。</p>
          <?php endif; ?> <!-- 繰り返しフィールドデータの有無を確認する条件終了 -->

          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- キャンペーンセクション -->
  <section class="campaign top-campaign">
    <div class="inner">
      <div class="campaign__title-wrap">
        <div class="campaign__title section-header">
          <p class="section-header__title">Campaign</p>
          <h2 class="section-header__subtitle">キャンペーン</h2>
        </div>
        <!-- swiperボタン -->
        <div class="campaign-swiper__button">
          <div
            class="campaign-swiper__button--prev swiper-button-prev"></div>
          <div
            class="campaign-swiper__button--next swiper-button-next"></div>
        </div>
      </div>
      <div class="campaign__swiper swiper js-campaign-Swiper">
        <div class="swiper-wrapper">
          <?php
          // 最新のカスタム投稿（campaign）の8件を取得するクエリ
          $latest_campaign_query = new WP_Query([
            'post_type' => 'campaign',
            'posts_per_page' => 8,
          ]);

          if ($latest_campaign_query->have_posts()) :
            while ($latest_campaign_query->have_posts()) : $latest_campaign_query->the_post();

              // 投稿に関連するキャンペーンカテゴリーのタームを取得
              $post_terms = get_the_terms(get_the_ID(), 'campaign_category');

              // タクソノミーページへのリンク
              $campaign_link = !empty($post_terms) ? get_term_link($post_terms[0]) : '#'; // 最初のカテゴリーのリンクを取得
          ?>
              <div class="swiper-slide campaign__swiper-slide">
                <a href="<?php echo esc_url($campaign_link); ?>" class="campaign-card__layout">
                  <picture class="campaign-card__img">
                    <?php if (has_post_thumbnail()) : ?>
                      <source srcset="<?php the_post_thumbnail_url('full'); ?>" type="image/webp">
                      <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>のアイキャッチ画像">
                    <?php else : ?>
                      <img src="<?php echo esc_url(get_theme_file_uri('assets/images/common/noimage.jpg')); ?>" alt="noimage" class="noimage">
                    <?php endif; ?>
                  </picture>
                  <div class="campaign-card__body">
                    <div class="campaign-card__title-container">
                      <div class="campaign-card__category-wrap">
                        <?php
                        if (!empty($post_terms)) {
                          foreach ($post_terms as $post_term) {
                            echo '<div class="campaign-card__category">' . esc_html($post_term->name) . '</div>';
                          }
                        }
                        ?>
                      </div>
                      <h3 class="campaign-card__title">
                        <?php the_title(); ?>
                      </h3>
                    </div>
                    <div class="campaign-card__text-wrap">
                      <p class="campaign-card__text">全部コミコミ(お一人様)</p>
                      <div class="campaign-card__price-wrap">
                        <?php
                        // サブプライスの処理
                        $subprice = get_field('campaign_subprice');
                        $subprice_class = empty($subprice) ? 'is-hidden' : ''; // サブプライスがない場合にクラスを付与
                        ?>
                        <div class="campaign-card__subprice campaign-card__subprice--big <?php echo $subprice_class; ?>">
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
              </div>
          <?php
            endwhile;
            wp_reset_postdata();
          endif;
          ?>
        </div>
      </div>
    </div>
    <div class="campaign__button">
      <a href=<?php echo $campaign; ?> class="button">Viewmore<span class="arrow"></span></a>
    </div>
  </section>
  <!-- aboutセクション -->
  <section class="about top-about">
    <div class="inner">
      <div class="about__title section-header">
        <p class="section-header__title">About us</p>
        <h2 class="section-header__subtitle">私たちについて</h2>
      </div>
      <div class="about__photo-container">
        <div class="about__photo-wrap">
          <img
            src="<?php echo get_template_directory_uri(); ?>/assets/images/common/about_2.jpg"
            alt="黄色の２匹の魚が泳いでいる"
            class="about__photo2" />
          <img
            src="<?php echo get_template_directory_uri(); ?>/assets/images/common/about_1.jpg"
            alt="青い空と赤い屋根の上にシーサーが置いてある"
            class="about__photo1" />
        </div>
        <div class="about__text-contents">
          <div class="about__text-title">
            Dive into<br />
            the Ocean
          </div>
          <div class="about__text-wrap">
            <p class="about__text">
              ここにテキストが入ります。ここにテキストが入りま<br
                class="is-pc" />
              す。ここにテキストが入ります。ここにテキストが入り<br
                class="is-pc" />
              ます。<br />
              ここにテキストが入ります。ここにテキストが入りま<br
                class="is-pc" />
              す。ここにテキストが入ります。ここにテキストが入り<br
                class="is-pc" />
              ます。ここにテキスト
            </p>
            <div class="about__button">
              <a href=<?php echo $about; ?> class="button">Viewmore<span class="arrow"></span></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- informationセクション -->
  <section class="information top-information">
    <div class="inner">
      <div class="information__title section-header">
        <p class="section-header__title">Information</p>
        <h2 class="section-header__subtitle">ダイビング情報</h2>
      </div>
      <div class="information__container top-information__container">
        <div class="information__photo-wrap">
          <picture class="information__photo colorbox js-colorbox">
            <source
              srcset="<?php echo get_template_directory_uri(); ?>/assets/images/common/information_sp.jpg"
              media="(max-width:768px)" />
            <img
              src="<?php echo get_template_directory_uri(); ?>/assets/images/common/information.jpg"
              alt="海底の珊瑚と黄色の熱帯魚" />
          </picture>
        </div>
        <div class="information__text-wrap">
          <h3 class="information__text-title">ライセンス講習</h3>
          <p class="information__text">
            当店はダイビングライセンス（Cカード）世界最大の教育機関PADIの「正規店」として店舗登録されています。<br />正規登録店として、安心安全に初めての方でも安心安全にライセンス取得をサポート致します。
          </p>
          <div class="information__button">
            <a href=<?php echo $information; ?> class="button">Viewmore<span class="arrow"></span></a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- blogセクション -->
  <section class="blog top-blog">
    <div class="blog__inner inner">
      <div class="blog__title section-header">
        <p class="section-header__title section-header__title--wh">Blog</p>
        <h2 class="section-header__subtitle section-header__subtitle--wh">
          ブログ
        </h2>
      </div>
      <div class="blog__wrap blog-cards">
        <?php
        // 最新の投稿3件を取得する
        $latest_posts_query = new WP_Query([
          'posts_per_page' => 3, // 表示する投稿数を3件に設定
        ]);

        if ($latest_posts_query->have_posts()) :
          while ($latest_posts_query->have_posts()) : $latest_posts_query->the_post();
        ?>
            <div class="blog-cards__item">
              <a href="<?php the_permalink(); ?>" class="blog-card">
                <figure class="blog-card__img">
                  <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('full'); ?>
                  <?php else : ?>
                    <img
                      src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/common/noimage.jpg"
                      alt="noimage"
                      loading="lazy"
                      decoding="async" />
                  <?php endif; ?>
                </figure>
                <div class="blog-card__body">
                  <div class="blog-card__meta">
                    <time datetime="<?php the_time('c'); ?>"><?php the_time('Y.m/d'); ?></time>
                    <h3 class="blog-card__title"><?php the_title(); ?></h3>
                  </div>
                  <p class="blog-card__text">
                    <?php
                    $content = get_the_content();
                    $content = wp_strip_all_tags($content); // HTMLタグを除去
                    if (mb_strlen($content, 'UTF-8') > 90) {
                      $content = mb_substr($content, 0, 90, 'UTF-8') . '...';
                    }
                    echo esc_html($content);
                    ?>
                  </p>
                </div>
              </a>
            </div>
        <?php endwhile;
          wp_reset_postdata(); // クエリをリセット
        endif;
        ?>
      </div>
    </div>
    <div class="blog__button">
      <a href=<?php echo $blog; ?> class="button">Viewmore<span class="arrow"></span></a>
    </div>
  </section>
  <!-- voiceセクション -->
  <section class="voice top-voice">
    <div class="inner">
      <div class="voice__title section-header">
        <p class="section-header__title">Voice</p>
        <h2 class="section-header__subtitle">お客様の声</h2>
      </div>
      <div class="voice-card__container">
        <div class="voice-cards">
          <?php
          // 最新の投稿2件を取得する
          $latest_posts_query = new WP_Query([
            'post_type' => 'voice',   // カスタム投稿タイプ 'voice' を指定
            'posts_per_page' => 2, // 表示する投稿数を2件に設定
          ]);
          if ($latest_posts_query->have_posts()) :
            while ($latest_posts_query->have_posts()) : $latest_posts_query->the_post();
          ?>
              <div class="voice-cards__item">
                <a href="<?php echo $voice; ?> " class="voice-card"> <!-- 投稿のリンクを出力 -->
                  <div class="voice-card__head">
                    <div class="voice-card__title-container">
                      <div class="voice-card__category-wrapper">
                        <p class="voice-card__age">
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
                        <div class="voice-card__category-wrap">
                          <?php
                          // カテゴリーを表示
                          $categories = get_the_terms(get_the_ID(), 'voice_category'); // カスタムタクソノミー 'voice_category' のカテゴリを取得
                          if (!empty($categories)) { // カテゴリーが存在する場合のみ処理を実行
                            foreach ($categories as $category) { // 複数のカテゴリがある場合、それぞれの名前をループで出力
                              echo '<p class="voice-card__category">' . esc_html($category->name) . '</p>'; // カテゴリ名を出力
                            }
                          }
                          ?>
                        </div>
                      </div>
                      <h3 class="voice-card__title">
                        <?php the_title(); // 投稿タイトルを出力
                        ?>
                      </h3>
                    </div>
                    <div class="voice-card__img colorbox js-colorbox">
                      <?php if (has_post_thumbnail()) : // 投稿にサムネイル画像がある場合
                      ?>
                        <?php the_post_thumbnail('full'); // サムネイル画像をフルサイズで表示
                        ?>
                      <?php else : // サムネイル画像がない場合
                      ?>
                        <img
                          src="<?php echo get_template_directory_uri(); ?>/assets/images/common/noimage.jpg"
                          alt="noimage"
                          loading="lazy"
                          decoding="async" />
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="voice-card__body">
                    <p class="voice-card__text">
                      <?php
                      // 投稿本文を取得して220文字以内にトリム
                      $content = get_the_content(); // 投稿の本文を取得
                      $content = wp_strip_all_tags($content); // HTMLタグをすべて削除
                      if (mb_strlen($content, 'UTF-8') > 220) { // 本文が220文字を超える場合
                        $content = mb_substr($content, 0, 220, 'UTF-8') . '...'; // 220文字に切り取って省略記号を付与
                      }
                      echo esc_html($content); // 整形後の本文を出力
                      ?>
                    </p>
                  </div>
                </a>
              </div>
            <?php endwhile; // 投稿ループ終了
            wp_reset_postdata(); // クエリをリセットしてグローバル変数を元に戻す
          else : // 投稿が存在しない場合
            ?>
            <p class="no-posts">お客様の声はまだありません。</p> <!-- 投稿がない場合のメッセージを表示 -->
          <?php endif; ?>
        </div>
      </div>
      <div class="voice__button">
        <a href=<?php echo $voice; ?> class="button">Viewmore<span class="arrow"></span></a> <!-- カスタム投稿タイプ 'voice' のアーカイブページリンクを生成 -->
      </div>
    </div>
  </section>
  <!-- priceセクション -->
  <section class="price top-price">
    <div class="inner">
      <div class="price__title section-header">
        <p class="section-header__title">Price</p>
        <h2 class="section-header__subtitle">料金一覧</h2>
      </div>
      <div class="price__container">
        <div class="price__contents price-lists">
          <?php
          // SCFから繰り返しフィールドのデータを取得
          for ($i = 1; $i <= 10; $i++) {
            // テーブルタイトルと価格データを取得
            $table_title = SCF::get("table_title{$i}", 18); // '18'は投稿ID、必要に応じて変更
            $prices = SCF::get("prices_{$i}", 18);
            // タイトルがない場合、このテーブルをスキップ（表示しない）
            if (empty($table_title)) {
              continue;
            }
          ?>
            <div class="price__lists-items">
              <h2 id="price<?php echo $i; ?>" class="price__list-title">
                <?php echo esc_html($table_title); ?>
              </h2>
              <?php
              // 価格データが存在する場合のみテーブルを表示
              if (!empty($prices)) :
              ?>
                <dl class="price__list">
                  <?php
                  foreach ($prices as $price_item) {
                    // 各項目のテキストと価格を取得
                    $text = $price_item["text_{$i}"] ?? '';
                    $price = $price_item["price_{$i}"] ?? '';
                    // テキストまたは価格が空の場合、この行をスキップ（表示しない）
                    if (empty($text) || empty($price)) {
                      continue;
                    }
                  ?>
                    <div class="price__list-item">
                      <dt>
                        <?php
                        // テキストフィールドを取得し改行を置換
                        $formatted_text = str_replace("\n", '<br class="is-sp">', esc_html($text));
                        echo $formatted_text;
                        ?>
                      </dt>
                      <dd>
                        <?php echo esc_html($price); ?>
                      </dd>
                    </div>
                  <?php
                  }
                  ?>
                </dl>
              <?php endif; ?>
            </div>
          <?php
          } // for文の終了
          ?>
        </div>
        <div class="price__photo colorbox js-colorbox">
          <picture>
            <source
              srcset="<?php echo get_template_directory_uri(); ?>/assets/images/common/price_sp.jpg"
              media="(max-width:767px)" />
            <img
              src="<?php echo get_template_directory_uri(); ?>/assets/images/common/price.jpg"
              alt="大きな珊瑚と小さな赤い熱帯魚がたくさんいる" />
          </picture>
        </div>
      </div>

      <div class="price__button">
        <a href="<?php echo esc_url($price); ?>" class="button">Viewmore<span class="arrow"></span></a>
      </div>
    </div>
  </section>

</main>
<?php get_footer(); ?>