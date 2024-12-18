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
      srcset="<?php echo get_template_directory_uri(); ?>/assets/images/common/voice_mv-sp.jpg"
      media="(max-width:768px)" />
    <img
      src="<?php echo get_template_directory_uri(); ?>/assets/images/common/voice_mv.jpg"
      alt="2匹の黄色の熱帯魚が海で泳いでいる" />
  </picture>
</section>
<!-- パンくずリスト -->
<?php get_template_part('inc/breadcrumb'); ?>

<section class="page-voice layout-voice">
  <div class="page-voice__inner inner">

    <!-- タグ部分: カテゴリー一覧を表示 -->
    <div class="page-voice_tags tags">
      <?php
      // 現在のタクソノミーまたはカテゴリーIDを取得
      $current_term_id = get_queried_object_id();

      // タクソノミー "voice_category" の用語一覧を取得
      $terms = get_terms([
        'taxonomy' => 'voice_category', // タクソノミー名
        'orderby' => 'name',           // 名前順に並び替え
        'order' => 'ASC',              // 昇順
        'hide_empty' => true,          // 投稿がないタクソノミーを非表示
      ]);

      // カテゴリーが存在し、エラーでない場合に表示
      if (!empty($terms) && !is_wp_error($terms)) :
        // 現在のページが「すべてのキャンペーン」ページの場合、'active'クラスを付与
        $all_class = (!$current_term_id || is_post_type_archive('voice')) ? 'active' : ''; ?>
        
        <!-- 'All'リンク: すべてのキャンペーンページへのリンク -->
        <a href="<?php echo esc_url(get_post_type_archive_link('campaign')); ?>" class="tags__item <?php echo esc_attr($all_class); ?>">All</a>

        <!-- 各カテゴリーリンクを表示 -->
        <?php foreach ($terms as $term) :
          // 現在のカテゴリーに'is-active'クラスを付与
          $term_class = is_tax('voice_category', $term->term_id) ? 'is-active' : '';
        ?>
          <a href="<?php echo esc_url(get_term_link($term->term_id, 'voice_category')); ?>" class="tags__item <?php echo esc_attr($term_class); ?>">
            <?php echo esc_html($term->name); ?> <!-- カテゴリー名を表示 -->
          </a>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>

    <!-- 投稿カード -->
    <div class="page-voice-card__container">
      <div class="voice-cards">
        <?php if (have_posts()) : ?>
          <?php while (have_posts()) : the_post(); ?>
            <div class="voice-cards__item">
              <div class="voice-card">
                <div class="voice-card__head">
                  <div class="voice-card__title-container">
                    <div class="voice-card__category-wrapper">
                      <p class="voice-card__age">
                        <?php
                        $age = get_field('age'); // 年齢
                        $sex = get_field('sex'); // 性別
                        echo $age ? esc_html($age) : '年齢情報なし';
                        if ($sex) {
                          echo ' (' . esc_html($sex) . ')';
                        } else {
                          echo ' (性別情報なし)';
                        }
                        ?>
                      </p>
                      <div class="voice-card__category-wrap">
                        <?php
                        $categories = get_the_terms(get_the_ID(), 'voice_category');
                        if ($categories) {
                          foreach ($categories as $category) {
                            echo '<span class="voice-card__category">' . esc_html($category->name) . '</span>';
                          }
                        }
                        ?>
                      </div>
                    </div>
                    <h3 class="voice-card__title"><?php the_title(); ?></h3>
                  </div>
                  <div class="voice-card__img colorbox js-colorbox">
                    <?php if (has_post_thumbnail()) : ?>
                      <?php the_post_thumbnail('full'); ?>
                    <?php else : ?>
                      <img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/noimage.jpg" alt="noimage" class="noimage" />
                    <?php endif; ?>
                  </div>
                </div>
                <div class="voice-card__text-info">
                  <p>
                    <?php
                    $content = wp_strip_all_tags(get_the_content());
                    echo mb_strlen($content, 'UTF-8') > 250
                      ? mb_substr($content, 0, 250, 'UTF-8') . '...'
                      : $content;
                    ?>
                  </p>
                </div>
              </div>
            </div>
          <?php endwhile;
          wp_reset_postdata(); ?>
        <?php else : ?>
          <p class="no-posts">お客様の声はまだありません。</p>
        <?php endif; ?>
      </div>
    </div>



    <!-- ページネーション -->
    <div class="pagination page-voice__pagination">
      <div class="pagination__wrap">
        <div class="wp-pagenavi">
          <?php wp_pagenavi(); ?>
        </div>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); // フッターのテンプレートを読み込む
?>