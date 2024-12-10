<?php
$contact = esc_url(home_url('/contact'));
?>
<?php get_header(); ?>
<main>
  <section class="privacypolicy__mv mv">
    <div class="mv__title-wrap">
      <p class="mv__title">PrivacyPolicy</p>
    </div>
    <picture class="mv__photo">
      <source
        srcset="<?php echo get_template_directory_uri(); ?>/assets/images/common/sub_mv-sp.jpg"
        media="(max-width:768px)" />
      <img
        src="<?php echo get_template_directory_uri(); ?>/assets/images/common/sub_mv.jpg"
        alt="2匹の黄色の熱帯魚が海で泳いでいる" />
    </picture>
  </section>
  <?php get_template_part('inc/breadcrumb'); ?>
  <section class="privacypolicy">
    <div class="privacypolicy__inner inner">
      <h2 class="privacypolicy__title"><?php the_title(); ?></h2>
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
          <div class="privacypolicy__text-container">
            <?php the_content(); ?>
          </div>
      <?php endwhile;
      endif; ?>
    </div>
  </section>
</main>
<?php get_footer(); ?>