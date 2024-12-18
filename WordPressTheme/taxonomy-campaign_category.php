<?php
$home = esc_url(home_url('/'));
$contact = esc_url(home_url('/contact'));
?>
<?php get_header(); ?>
<section class="campaign__mv mv">
    <div class="mv__title-wrap">
        <p class="mv__title">Campaign</p>
    </div>
    <picture class="mv__photo">
        <source
            srcset="<?php echo get_template_directory_uri(); ?>/assets/images/common/campaign_mv-sp.jpg"
            media="(max-width:768px)" />
        <img
            src="<?php echo get_template_directory_uri(); ?>/assets/images/common/campaign_mv.jpg"
            alt="2匹の黄色の熱帯魚が海で泳いでいる" />
    </picture>
</section>
<?php get_template_part('inc/breadcrumb'); ?>

<section class="page-campaign layout-campaign">
    <div class="page-campaign__inner inner">

        <!-- タグ部分: カテゴリー一覧を表示 -->
        <div class="page-campaign_tags tags">
            <?php
            // 現在のタクソノミーまたはカテゴリーIDを取得
            $current_term_id = get_queried_object_id();

            // タクソノミー "campaign_category" の用語一覧を取得
            $terms = get_terms([
                'taxonomy' => 'campaign_category', // カスタムタクソノミーのスラッグ
                'orderby' => 'name',           // 名前順に並び替え
                'order' => 'ASC',              // 昇順
                'hide_empty' => true,          // 投稿がないタクソノミーを非表示
            ]);
            ?>
            <?php if (!empty($terms) && !is_wp_error($terms)) : ?>
                <!-- 「すべての投稿(ALL)」用のリンク -->
                <?php
                // 全ての投稿が選択されているかどうか判定してアクティブクラスを付与
                $all_class = (!$current_term_id || is_post_type_archive('campaign')) ? 'active' : '';
                ?>
                <a href="<?php echo esc_url(get_post_type_archive_link('campaign')); ?>" class="tags__item <?php echo esc_attr($all_class); ?>">
                    ALL
                </a>

                <!-- 各タクソノミー用語のリンクを生成 -->
                <?php foreach ($terms as $term) : ?>
                    <?php
                    // 現在表示しているタクソノミー用語の場合にアクティブクラスを付与
                    $term_class = ($current_term_id === $term->term_id) ? 'active' : '';
                    ?>
                    <a href="<?php echo esc_url(get_term_link($term->term_id, 'campaign_category')); ?>" class="tags__item <?php echo esc_attr($term_class); ?>">
                        <?php echo esc_html($term->name); ?>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>



        <!-- 投稿カード部分: キャンペーン一覧を表示 -->
        <div class="page-campaign__cards campaign-cards">
            <div class="campaign-cards__inner">
                <?php
                // 投稿がある場合の処理
                if (have_posts()) :
                    while (have_posts()) : the_post();
                ?>
                        <!-- キャンペーンカード -->
                        <div class="campaign-card campaign-card--big">
                            <!-- 画像部分 -->
                            <div class="campaign-card__img">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('full'); ?> <!-- アイキャッチ画像を表示 -->
                                <?php else : ?>
                                    <!-- アイキャッチがない場合の代替画像 -->
                                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/common/noimage.jpg" alt="noimage" class="noimage" loading="lazy" decoding="async" />
                                <?php endif; ?>
                            </div>

                            <!-- カード本文部分 -->
                            <div class="campaign-card__body campaign-card__body--big">
                                <div class="campaign-card__title-container">
                                    <!-- カテゴリー表示 -->
                                    <div class="campaign-card__category-wrap">
                                        <?php
                                        // 投稿に関連付けられたカテゴリーを取得
                                        $post_terms = get_the_terms(get_the_ID(), 'campaign_category');
                                        if (!empty($post_terms) && !is_wp_error($post_terms)) :
                                            foreach ($post_terms as $post_term) : ?>
                                                <div class="campaign-card__category"><?php echo esc_html($post_term->name); ?></div>
                                        <?php endforeach;
                                        endif; ?>
                                    </div>
                                    <!-- キャンペーンタイトル -->
                                    <h3 class="campaign-card__title campaign-card__title--big">
                                        <?php the_title(); ?>
                                    </h3>
                                </div>

                                <!-- 価格・詳細部分 -->
                                <div class="campaign-card__text-wrap campaign-card__text-wrap--big">
                                    <p class="campaign-card__text">全部コミコミ(お一人様)</p>
                                    <div class="campaign-card__price-wrap campaign-card__price-wrap--big">
                                        <?php
                                        // サブプライス（オプション価格）の取得と表示
                                        $subprice = get_field('campaign_subprice');
                                        // $subprice が空ではない場合
                                        if (!empty($subprice)) : ?>
                                            <div class="campaign-card__subprice campaign-card__subprice--big">
                                                <span><?php echo '¥' . number_format($subprice); ?></span>
                                            </div>
                                        <?php endif;
                                        // メインプライス（価格）の取得と表示
                                        $price = get_field('campaign_price');
                                        // $price が空ではない場合
                                        if (!empty($price)) : ?>
                                            <div class="campaign-card__price">
                                                <?php echo '¥' . number_format($price); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- 内容の抜粋と詳細情報 -->
                                    <div class="campaign-card__text-wrapper campaign-card__text-wrapper--big">
                                        <div class="campaign-card__text-info">
                                            <p>
                                                <?php
                                                // 投稿本文を取得し、200文字に切り詰めて表示
                                                $content = wp_strip_all_tags(get_the_content());
                                                echo mb_strlen($content, 'UTF-8') > 200
                                                    ? mb_substr($content, 0, 200, 'UTF-8') . '...'
                                                    : $content;
                                                ?>
                                            </p>
                                        </div>
                                        <p class="campaign-card__day"><?php the_field('campaign_day'); ?></p>
                                        <p class="campaign-card__contact-info">ご予約・お問い合わせはコチラ</p>
                                        <div class="campaign-card__button">
                                            <!-- お問い合わせボタン -->
                                            <a href="<?php echo esc_url($contact); ?>" class="button">Contact us<span class="arrow"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile;
                else : ?>
                    <!-- 投稿がない場合のメッセージ -->
                    <p>キャンペーンはありません。</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- ページネーション -->
        <div class="pagination page-campaign__pagination">
            <div class="pagination__wrap">
                <div class="wp-pagenavi">
                    <?php wp_pagenavi(); ?> <!-- ページネーション表示 -->
                </div>
            </div>
        </div>
    </div>
</section>





<?php get_footer(); ?>