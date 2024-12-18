<?php
$home = esc_url(home_url('/'));
$contact = esc_url(home_url('/contact'));
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
<?php get_template_part('inc/breadcrumb'); ?>
<section class="page-voice layout-voice">
  <div class="page-voice__inner inner">
    <!-- タグ -->
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
      ?>
      <?php if (!empty($terms) && !is_wp_error($terms)) : ?>
        <!-- 「すべての投稿(ALL)」用のリンク -->
        <?php
        // 全ての投稿が選択されているかどうか判定してアクティブクラスを付与
        $all_class = (!$current_term_id || is_post_type_archive('voice')) ? 'active' : '';
        ?>
        <a href="<?php echo esc_url(get_post_type_archive_link('voice')); ?>" class="tags__item <?php echo esc_attr($all_class); ?>">
          ALL
        </a>

        <!-- 各タクソノミー用語のリンクを生成 -->
        <?php foreach ($terms as $term) : ?>
          <?php
          // 現在表示しているタクソノミー用語の場合にアクティブクラスを付与
          $term_class = ($current_term_id === $term->term_id) ? 'active' : '';
          ?>
          <a href="<?php echo esc_url(get_term_link($term->term_id, 'voice_category')); ?>" class="tags__item <?php echo esc_attr($term_class); ?>">
            <?php echo esc_html($term->name); ?>
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
    <div class="pagination page-blog__pagination">
      <div class="pagination__wrap">
        <div class="wp-pagenavi">
          <?php wp_pagenavi(); ?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php get_footer(); ?>