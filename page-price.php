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
      srcset="<?php echo get_template_directory_uri(); ?>/dist/assets/images/common/price_mv-sp.jpg"
      media="(max-width:768px)" />
    <img
      src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/common/price_mv.jpg"
      alt="2匹の黄色の熱帯魚が海で泳いでいる" />
  </picture>
</section>
<?php get_template_part('breadcrumb'); ?>
<div class="page-price layout-price">
  <div class="page-price__inner inner">
    <div class="page-price__container price-lists">
      <div class="price-lists__item price-list">
        <?php
        // 単一フィールド 'table_title1' を取得
        $table_title1 = SCF::get('table_title1');
        // 繰り返しフィールド 'prices_1' を取得
        $prices = SCF::get('prices_1');

        // 'table_title1'が設定されている場合、タイトルを出力
        if (!empty($table_title1)) :
        ?>
          <h2 id="price1" class="price-list__title">
            <?php echo esc_html($table_title1); ?>
          </h2>
        <?php
        endif;
        // 繰り返しフィールド 'prices_1' が空でない場合のみテーブルを表示
        if (!empty($prices)) :
        ?>
          <table class="price-list__table">
            <tbody>
              <?php foreach ($prices as $price_item) : ?>
                <tr>
                  <td class="price-list__sub-title">
                    <!-- コースの名前を表示 (text_1) -->
                    <?php
                    // 管理画面で改行した箇所に <br class="is-sp"> を付与
                    $text = $price_item['text_1']; // フィールドの値を取得
                    $formatted_text = str_replace("\n", '<br class="is-sp">', esc_html($text)); // 改行を <br class="is-sp"> に置換
                    echo $formatted_text; // フォーマット済みのテキストを出力
                    ?>
                  </td>
                  <td class="price__price">
                    <!-- 金額を表示 (price_1) -->
                    <?php echo esc_html($price_item['price_1']); ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        <?php endif; ?>
      </div>
      <div class="price-lists__item price-list">
        <?php
        // 単一フィールド 'table_title2' を取得
        $table_title2 = SCF::get('table_title2');
        // 繰り返しフィールド 'prices_2' を取得
        $prices = SCF::get('prices_2');
        // 'table_title2'が設定されている場合、タイトルを出力
        if (!empty($table_title2)) :
        ?>
          <h2 id="price2" class="price-list__title">
            <?php echo esc_html($table_title2); ?>
          </h2>
        <?php
        endif;
        // 繰り返しフィールド 'prices_2' が空でない場合のみテーブルを表示
        if (!empty($prices)) :
        ?>
          <table class="price-list__table">
            <tbody>
              <?php foreach ($prices as $price_item) : ?>
                <tr>
                  <td class="price-list__sub-title">
                    <!-- コースの名前を表示 (text_2) -->
                    <?php
                    // 管理画面で改行した箇所に <br class="is-sp"> を付与
                    $text = $price_item['text_2']; // フィールドの値を取得
                    $formatted_text = str_replace("\n", '<br class="is-sp">', esc_html($text)); // 改行を <br class="is-sp"> に置換
                    echo $formatted_text; // フォーマット済みのテキストを出力
                    ?>
                  </td>
                  <td class="price__price">
                    <!-- 金額を表示 (price_2) -->
                    <?php echo esc_html($price_item['price_2']); ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        <?php endif; ?>
      </div>
      <div class="price-lists__item price-list">
        <?php
        // 単一フィールド 'table_title3' を取得
        $table_title3 = SCF::get('table_title3');
        // 繰り返しフィールド 'prices_3' を取得
        $prices = SCF::get('prices_3');
        // 'table_title3'が設定されている場合、タイトルを出力
        if (!empty($table_title3)) :
        ?>
          <h2 id="price3" class="price-list__title">
            <?php echo esc_html($table_title3); ?>
          </h2>
        <?php
        endif;
        // 繰り返しフィールド 'prices_3' が空でない場合のみテーブルを表示
        if (!empty($prices)) :
        ?>
          <table class="price-list__table">
            <tbody>
              <?php foreach ($prices as $price_item) : ?>
                <tr>
                  <td class="price-list__sub-title">
                    <!-- コースの名前を表示 (text_3) -->
                    <?php
                    // 管理画面で改行した箇所に <br class="is-sp"> を付与
                    $text = $price_item['text_3']; // フィールドの値を取得
                    $formatted_text = str_replace("\n", '<br class="is-sp">', esc_html($text)); // 改行を <br class="is-sp"> に置換
                    echo $formatted_text; // フォーマット済みのテキストを出力
                    ?>
                  </td>
                  <td class="price__price">
                    <!-- 金額を表示 (price_3) -->
                    <?php echo esc_html($price_item['price_3']); ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        <?php endif; ?>
      </div>
      <div class="price-lists__item price-list">
        <?php
        // 単一フィールド 'table_title4' を取得
        $table_title4 = SCF::get('table_title4');
        // 繰り返しフィールド 'prices_4' を取得
        $prices = SCF::get('prices_4');
        // 'table_title4'が設定されている場合、タイトルを出力
        if (!empty($table_title4)) :
        ?>
          <h2 id="price4" class="price-list__title">
            <?php echo esc_html($table_title4); ?>
          </h2>
        <?php
        endif;
        // 繰り返しフィールド 'prices_4' が空でない場合のみテーブルを表示
        if (!empty($prices)) :
        ?>
          <table class="price-list__table">
            <tbody>
              <?php foreach ($prices as $price_item) : ?>
                <tr>
                  <td class="price-list__sub-title">
                    <!-- コースの名前を表示 (text_4) -->
                    <?php
                    // 管理画面で改行した箇所に <br class="is-sp"> を付与
                    $text = $price_item['text_4']; // フィールドの値を取得
                    $formatted_text = str_replace("\n", '<br class="is-sp">', esc_html($text)); // 改行を <br class="is-sp"> に置換
                    echo $formatted_text; // フォーマット済みのテキストを出力
                    ?>
                  </td>
                  <td class="price__price">
                    <!-- 金額を表示 (price_4) -->
                    <?php echo esc_html($price_item['price_4']); ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<section class="contact page-price__contact">
  <div class="inner">
    <div class="contact__container">
      <div class="contact__contents-left">
        <div class="contact__logo">
          <img src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/common/logo_blue.svg" alt="ロゴ" />
        </div>
        <div class="contact__address-wrap">
          <div class="contact__address">
            <p>沖縄県那覇市1-1</p>
            <p>TEL:0120-000-0000</p>
            <p>営業時間:8:30-19:00</p>
            <p>定休日:毎週火曜日</p>
          </div>
          <div class="contact__address-map">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d57393.969626622005!2d127.6275265342976!3d26.196615752174797!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x34e5681e893b714d%3A0xa5360835fe2d83b8!2z54Cs6ZW35bO2IOOCpuODn-OCq-OCuOODhuODqeOCuQ!5e0!3m2!1sja!2sjp!4v1725201731353!5m2!1sja!2sjp"
              style="border: 0"
              allowfullscreen=""
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
        </div>
      </div>
      <div class="contact__contents-right">
        <div class="contact__title-wrap">
          <p class="contact__title">Contact</p>
          <h2 class="contact__subtitle">お問い合わせ</h2>
          <p class="contact__title-text">ご予約・お問い合わせはコチラ</p>
          <div class="contact__button">
            <a href=<?php echo $contact; ?> class="button">Contact us<span class="arrow"></span></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="button-top" id="js-button-top">
  <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/common/up__arrow.svg" alt="ロゴ" /></a>
</div>
<?php get_footer(); ?>