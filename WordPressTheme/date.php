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
    <p class="mv__title"><?php the_archive_title(); ?></p>
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
        <?php if (have_posts()): ?>
          <?php while (have_posts()): the_post(); ?>
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
                    $content = $post->post_content;
                    if (mb_strlen($content, 'UTF-8') > 110) {
                      $content = mb_substr($content, 0, 110, 'UTF-8') . '...';
                    }
                    $content = strip_tags($content);
                    echo $content;
                    ?>
                  </p>
                </div>
              </a>
            </div>
          <?php endwhile; ?>
        <?php endif; ?>
      </div>

      <!-- ページネーション -->
      <div class="pagination page-blog__pagination">
        <div class="pagination__wrap">
          <div class="wp-pagenavi">
            <?php
            global $wp_query;
            $total_pages = $wp_query->max_num_pages;
            $current_page = max(1, get_query_var('paged'));

            if ($current_page > 1) {
              echo '<a class="previouspostslink" rel="prev" href="' . esc_url(get_pagenum_link($current_page - 1)) . '">＜</a>';
            }

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

<?php get_footer(); ?>