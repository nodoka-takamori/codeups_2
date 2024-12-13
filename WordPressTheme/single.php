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
      srcset="<?php echo get_template_directory_uri(); ?>/assets/images/common/blog_mv-sp.jpg"
      media="(max-width:768px)" />
    <img
      src="<?php echo get_template_directory_uri(); ?>/assets/images/common/blog_mv.jpg"
      alt="2匹の黄色の熱帯魚が海で泳いでいる" />
  </picture>
</section>

<?php get_template_part('inc/breadcrumb'); ?>

<div class="page-blog layout-sub__blog">
  <div class="page-blog__inner page-blog__inner--sub inner">
    <section class="page-blog__main page-blog__main--sub">
      <div class="page-blog__container">
        <?php
        // メインループの開始
        if (have_posts()) :
          while (have_posts()) :
            the_post();
        ?>
            <div class="page-blog__contents">
              <time datetime="<?php the_time('c'); ?>"><?php the_time('Y.m/d'); ?></time>
              <h1 class="page-blog__title"><?php the_title(); ?></h1>

              <?php if (has_post_thumbnail()) : ?>
                <div class="page-blog__photo">
                  <?php the_post_thumbnail(); ?>
                </div>
              <?php endif; ?>

              <div class="page-blog__content">
                <?php the_content(); ?>
              </div>
            </div>
        <?php
          endwhile;
        endif;
        ?>
        <div class="pagination page-blog__pagination--sub">
          <?php previous_post_link('%link', '＜'); ?>
          <?php next_post_link('%link', '＞'); ?>
        </div>
      </div>
    </section>

    <aside class="page-blog__aside aside">
      <?php get_sidebar(); ?>
    </aside>
  </div>
</div>

<?php get_footer(); ?>