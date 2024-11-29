<?php
$home = esc_url(home_url( '/' ) );
?>
<?php get_header(); ?>
<main>
<?php
$home = esc_url(home_url( '/' ) );?>
      <section class="notfound layout-notfound">
      <?php get_template_part('breadcrumb'); ?>
        <div class="notfound__layout">
          <div class="notfound__inner inner">
            <div class="notfound__text-wrap">
              <h2 class="notfound__title">404</h2>
              <p class="notfound__text">
                申し訳ありません。<br />
                お探しのページが見つかりません。
              </p>
              <div class="notfound__button">
                <a href=<?php echo $home; ?> class="button__white"
                  >Page TOP<span class="arrow__white"></span
                ></a>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
<?php get_footer(); ?>