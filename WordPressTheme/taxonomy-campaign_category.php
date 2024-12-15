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
        <!-- タグ -->
        <div class="page-campaign_tags tags">
            <?php
            // 現在のタクソノミーまたはカテゴリーIDを取得
            $current_term_id = get_queried_object_id();
            $terms = get_terms([
                'taxonomy' => 'campaign_category',
                'orderby' => 'name',
                'order' => 'ASC',
                'hide_empty' => true,
            ]);

            if (!empty($terms) && !is_wp_error($terms)) :
                $all_class = (!$current_term_id || is_post_type_archive('campaign')) ? 'active' : '';
                echo sprintf(
                    '<a href="%s" class="tags__item %s">All</a>',
                    esc_url(get_post_type_archive_link('campaign')),
                    esc_attr($all_class)
                );

                foreach ($terms as $term) {
                    $term_class = ($current_term_id === $term->term_id) ? 'active' : ''; // 選択中のカテゴリーにクラスを付与
                    echo sprintf(
                        '<a href="%s" class="tags__item %s">%s</a>',
                        esc_url(get_term_link($term->term_id, 'campaign_category')),
                        esc_attr($term_class),
                        esc_html($term->name)
                    );
                }
            endif;
            ?>
        </div>

        <!-- 投稿カード -->
        <div class="page-campaign__cards campaign-cards">
            <div class="campaign-cards__inner">
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <div class="campaign-card campaign-card--big">
                            <div class="campaign-card__img">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('full'); ?>
                                <?php else : ?>
                                    <img
                                        src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/common/noimage.jpg"
                                        alt="noimage"
                                        class="noimage"
                                        loading="lazy"
                                        decoding="async" />
                                <?php endif; ?>
                            </div>
                            <div class="campaign-card__body campaign-card__body--big">
                                <div class="campaign-card__title-container">
                                    <div class="campaign-card__category-wrap">
                                        <?php
                                        $post_terms = get_the_terms(get_the_ID(), 'campaign_category');
                                        if (!empty($post_terms) && !is_wp_error($post_terms)) {
                                            foreach ($post_terms as $post_term) {
                                                echo sprintf(
                                                    '<div class="campaign-card__category">%s</div>',
                                                    esc_html($post_term->name)
                                                );
                                            }
                                        }
                                        ?>
                                    </div>
                                    <h3 class="campaign-card__title campaign-card__title--big">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>
                                </div>
                                <div class="campaign-card__text-wrap campaign-card__text-wrap--big">
                                    <p class="campaign-card__text">全部コミコミ(お一人様)</p>
                                    <div class="campaign-card__price-wrap campaign-card__price-wrap--big">
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
                                    <div class="campaign-card__text-wrapper campaign-card__text-wrapper--big">
                                        <div class="campaign-card__text-info">
                                            <p>
                                                <?php
                                                $content = wp_strip_all_tags(get_the_content());
                                                echo mb_strlen($content, 'UTF-8') > 200
                                                    ? mb_substr($content, 0, 200, 'UTF-8') . '...'
                                                    : $content;
                                                ?>
                                            </p>
                                        </div>
                                        <p class="campaign-card__day">
                                            <?php the_field('campaign_day'); ?>
                                        </p>
                                        <p class="campaign-card__contact-info">
                                            ご予約・お問い合わせはコチラ
                                        </p>
                                        <div class="campaign-card__button">
                                            <a href="<?php echo esc_url($contact); ?>" class="button">
                                                Contact us<span class="arrow"></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else : ?>
                    <p>キャンペーンが見つかりませんでした。</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- ページネーション -->
        <div class="pagination page-campaign__pagination">
            <div class="pagination__wrap">
                <div class="wp-pagenavi">
                    <?php wp_pagenavi(); ?>
                </div>
            </div>
        </div>
    </div>
</section>





<?php get_footer(); ?>