<?php
$contact = esc_url(home_url('/contact'));
?>
<?php get_header(); ?>
<section class="price__mv mv">
  <div class="mv__title-wrap">
    <p class="mv__title">Price</p>
  </div>
  <picture class="mv__photo">
    <source
      srcset="<?php echo get_template_directory_uri(); ?>/assets/images/common/price_mv-sp.jpg"
      media="(max-width:768px)" />
    <img
      src="<?php echo get_template_directory_uri(); ?>/assets/images/common/price_mv.jpg"
      alt="2匹の黄色の熱帯魚が海で泳いでいる" />
  </picture>
</section>
<?php get_template_part('inc/breadcrumb'); ?>
<div class="page-price layout-price">
  <div class="page-price__inner inner">
    <div class="page-price__container price-lists">
      <?php
      // 繰り返し対象のテーブルデータをループで処理
      for ($i = 1; $i <= 4; $i++) {
        // 単一フィールドと繰り返しフィールドの取得
        $table_title = SCF::get("table_title{$i}");
        $prices = SCF::get("prices_{$i}");

        // タイトルが設定されている場合は出力
        if (!empty($table_title)) :
      ?>
          <div class="price-lists__item price-list">
            <h2 id="price<?php echo $i; ?>" class="price-list__title">
              <?php echo esc_html($table_title); ?>
            </h2>
            <?php
            // 繰り返しフィールドが空でない場合はテーブルを出力
            if (!empty($prices)) :
            ?>
              <table class="price-list__table">
                <tbody>
                  <?php foreach ($prices as $price_item) : ?>
                    <tr>
                      <td class="price-list__sub-title">
                        <?php
                        // テキストフィールドを取得し改行を置換
                        $text = $price_item["text_{$i}"];
                        $formatted_text = str_replace("\n", '<br class="is-sp">', esc_html($text));
                        echo $formatted_text;
                        ?>
                      </td>
                      <td class="price__price">
                        <?php echo esc_html($price_item["price_{$i}"]); ?>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            <?php endif; ?>
          </div>
      <?php
        endif;
      }
      ?>
    </div>
  </div>

</div>

<?php get_footer(); ?>