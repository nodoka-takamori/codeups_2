<?php
function my_setup()
{
    add_theme_support('post-thumbnails'); // アイキャッチ画像を有効化
    add_theme_support('automatic-feed-links'); // 投稿とコメントのRSSフィードのリンクを有効化
    add_theme_support('title-tag'); // titleタグ自動生成
    add_theme_support('html5', array( // HTML5による出力
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
}
add_action('after_setup_theme', 'my_setup');

/* CSSとJavaScriptの読み込み */
function my_script_init()
{
    // WordPressに含まれているjQueryを読み込まない
    wp_deregister_script('jquery');

    // Googleフォントの読み込み
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Gotu&family=Lato:wght@400;700&family=Noto+Sans+JP:wght@400;500;700&display=swap', array(), null);

    // メインCSSの読み込み
    // wp_enqueue_style(
    //     'main-css',
    //     get_template_directory_uri() . '/assets/css/style.css',
    //     array(),
    //     filemtime(get_template_directory() . '/assets/css/style.css')
    // );
    wp_enqueue_style(
        'main-css',
        get_theme_file_uri('/assets/css/style.css'),
        array(),
        filemtime(get_theme_file_path('/assets/css/style.css'))
    );

    // jQueryの再登録
    wp_register_script('jquery', '//code.jquery.com/jquery-3.6.0.min.js', array(), '3.6.0', true);
    wp_enqueue_script('jquery');

    // Swiperの読み込み
    wp_enqueue_style(
        'swiper-css',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
        array(),
        '11.1.9'
    );
    wp_enqueue_script(
        'swiper-js',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
        array(),
        '11.0.0',
        true
    );

    // メインJavaScriptの読み込み
    wp_enqueue_script(
        'main-js',
        get_template_directory_uri() . '/assets/js/script.js',
        array('jquery', 'swiper-js'),
        filemtime(get_template_directory() . '/assets/js/script.js'),
        true
    );
}
add_action('wp_enqueue_scripts', 'my_script_init', 10);

// Contact Form 7で自動挿入されるPタグ、brタグを削除
add_filter('wpcf7_autop_or_not', 'wpcf7_autop_return_false');
function wpcf7_autop_return_false()
{
    return false;
}

// 投稿の表示件数を変更する
function change_posts_per_page($query)
{
    // 管理画面やメインクエリでない場合は何もしない
    if (is_admin() || ! $query->is_main_query()) {
        return;
    }

    // カスタム投稿タイプ「campaign」のアーカイブページ
    if ($query->is_post_type_archive('campaign')) {
        $query->set('posts_per_page', 4); // 表示件数を4件に設定
    }

    // カスタム投稿タイプ「voice」のアーカイブページ
    if ($query->is_post_type_archive('voice')) {
        $query->set('posts_per_page', 6); // 表示件数を6件に設定
    }
}
add_action('pre_get_posts', 'change_posts_per_page');

function Change_menulabel()
{
    global $menu;
    global $submenu;
    $name = 'ブログ';
    $menu[5][0] = $name;
    $submenu['edit.php'][5][0] = $name . '一覧';
    $submenu['edit.php'][10][0] = '新しい' . $name;
}
function Change_objectlabel()
{
    global $wp_post_types;
    $name = 'ブログ';
    $labels = &$wp_post_types['post']->labels;
    $labels->name = $name;
    $labels->singular_name = $name;
    $labels->add_new = _x('追加', $name);
    $labels->add_new_item = $name . 'の新規追加';
    $labels->edit_item = $name . 'の編集';
    $labels->new_item = '新規' . $name;
    $labels->view_item = $name . 'を表示';
    $labels->search_items = $name . 'を検索';
    $labels->not_found = $name . 'が見つかりませんでした';
    $labels->not_found_in_trash = 'ゴミ箱に' . $name . 'は見つかりませんでした';
}
add_action('init', 'Change_objectlabel');
add_action('admin_menu', 'Change_menulabel');

// ダッシュボードにオリジナルウィジェットを追加する
add_action('wp_dashboard_setup', 'my_dashboard_widgets');
function my_dashboard_widgets()
{
    wp_add_dashboard_widget('my_theme_options_widget', '固定ページのリンク', 'my_dashboard_widget_function');
}
// ダッシュボードのオリジナルウィジェット内に情報を掲載する
function my_dashboard_widget_function()
{
    // 管理画面に表示される内容を以下に書く
    echo '<ul class="custom_widget">
            <li><a href="post.php?post=9&action=edit"><div class="dashicons dashicons-format-image"></div><p>TOPページ<br>【画像変更】</p></a></li>
            <li><a href="post.php?post=16&action=edit"><div class="dashicons dashicons-format-image"></div><p>私たちについて<br>【モーダル変更】</p></a></li>
            <li><a href="post-new.php"><div class="dashicons dashicons-edit"></div><p>ブログ<br>【投稿追加】</p></a></li>
            <li><a href="post-new.php?post_type=campaign"><div class="dashicons dashicons-edit"></div><p>キャンペーン<br>【投稿追加】</p></a></li>
            <li><a href="post-new.php?post_type=voice"><div class="dashicons dashicons-edit"></div><p>お客様の声<br>【投稿追加】</p></a></li>
            <li><a href="post.php?post=18&action=edit"><div class="dashicons dashicons-edit"></div><p>料金一覧<br>【料金変更】</p></a></li>
            <li><a href="edit.php?post_type=page"><div class="dashicons dashicons-clipboard"></div><p>固定ページ一覧</p></a></li>
        </ul>';
}
// ダッシュボードにスタイルシートを読み込む
function custom_admin_enqueue()
{
    wp_enqueue_style('custom_admin_enqueue', get_stylesheet_directory_uri() . '/my-widgets.css');
}
add_action('admin_enqueue_scripts', 'custom_admin_enqueue');

// キャンペーン投稿タイトルを取得するショートコードを定義
function populate_campaign_titles()
{
    // WP_Query設定
    $args = array(
        'post_type' => 'campaign',                // 投稿タイプを指定（キャンペーン投稿の投稿タイプに変更）
        'posts_per_page' => -1,              // 全件取得
        'tax_query' => array(                // タクソノミー条件
            array(
                'taxonomy' => 'campaign_category', // タクソノミー名
                'field'    => 'slug',             // スラッグで一致
                'terms'    => 'campaign_category', // 対象スラッグを指定
            ),
        ),
    );

    $query = new WP_Query($args); // 投稿データを取得
    $options = []; // ドロップダウンオプション用配列

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            // 投稿タイトルを配列に追加
            $options[] = get_the_title();
        }
    }
    wp_reset_postdata(); // クエリをリセット

    // 配列からオプションHTMLを生成
    $html = '<select name="campaign-titles">';
    foreach ($options as $option) {
        $html .= sprintf('<option value="%s">%s</option>', esc_attr($option), esc_html($option));
    }
    $html .= '</select>';

    return $html;
}
add_shortcode('campaign_titles_dropdown', 'populate_campaign_titles');


// the_archive_title「月: 」や「年: 」などのいらない文字を削除
add_filter('get_the_archive_title', function ($title) {
    if (is_day()) {
        $title = get_the_date('Y年n月j日'); // 年月日を「2024年8月31日」の形式で表示
    } elseif (is_month()) {
        $title = get_the_date('Y年n月'); // 年月を「2024年8月」の形式で表示
    } elseif (is_year()) {
        $title = get_the_date('Y年'); // 年を「2024年」の形式で表示
    }
    return $title;
});