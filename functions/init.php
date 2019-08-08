<?php
// header内・不必要なリンクの削除
remove_action( 'wp_head', 'wp_generator' ); // Wordpress version
remove_action( 'wp_head', 'wp_shortlink_wp_head' ); // post shortcode URL
remove_action( 'wp_head', 'print_emoji_detection_script', 7 ); // 絵文字 CSS
remove_action( 'wp_print_styles', 'print_emoji_styles' ); // 絵文字 Jacascript
remove_action( 'wp_head', 'rsd_link' ); // Really Simple Discovery
remove_action( 'wp_head', 'wlwmanifest_link' ); // Windows Live Writer
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' ); // 前後の記事 link URL
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'feed_links_extra', 3 );
add_theme_support('post-thumbnails');

add_action('init', 'register_blog_cat_custom_post');
function register_blog_cat_custom_post() {
    register_taxonomy(
        'project',
        'post',
        array(
            'hierarchical' => false,
            'label' => 'project',
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => true,
            'singular_label' => 'project'
        )
    );
}

// カスタムメニュー
add_action( 'init', 'my_custom_menus' );
function my_custom_menus() {
    register_nav_menus(
        array(
            'primary-menu' => __( 'ヘッダー用メニュー', 'default' ),
            'secondary-menu' => __( 'フッター用メニュー', 'default' ),
            'smartphone-menu' => __( 'スマートフォン用メニュー', 'default' )
        )
    );
}

add_action('admin_print_scripts', 'admin_add_script');
function admin_add_script() {
    $direc = get_bloginfo( 'template_directory' );
    wp_enqueue_script( 'admin_script', $direc .'/js/admin.js' );
    wp_enqueue_script( 'thickbox' );
}
add_action('admin_head' , 'admin_add_style');
function admin_add_style() {
    $direc = get_bloginfo('template_directory');
    wp_enqueue_style( 'admin-style', $direc .'/css/admin-style.css', array(), false, 'all' );
}

// 投稿画面の項目を非表示にする
add_action('admin_menu','remove_default_post_screen_metaboxes');
function remove_default_post_screen_metaboxes() {
    if (!current_user_can('level_10')) { // level10以下のユーザーの場合メニューをremoveする
        remove_meta_box( 'postcustom','post','normal' ); // カスタムフィールド
        remove_meta_box( 'postexcerpt','post','normal' ); // 抜粋
        //remove_meta_box( 'commentstatusdiv','post','normal' ); // ディスカッション
        remove_meta_box( 'commentsdiv','post','normal' ); // コメント
        remove_meta_box( 'trackbacksdiv','post','normal' ); // トラックバック
        remove_meta_box( 'authordiv','post','normal' ); // 作成者
        //remove_meta_box( 'slugdiv','post','normal' ); // スラッグ
        remove_meta_box( 'revisionsdiv','post','normal' ); // リビジョン
    }
}
// 初期設定メニュー追加
add_action( 'admin_enqueue_scripts', 'load_admin_things' );
function load_admin_things() {
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    wp_enqueue_style('thickbox');
}
add_action('admin_menu', 'initial_setting_menu');
function initial_setting_menu() {
  add_menu_page('各種設定', '各種設定', 'manage_options', 'initial_setting_menu', 'banner_options_page', '', 1);
  add_action( 'admin_init', 'register_or_setting','admin-head');
}
function register_or_setting() {
  //コアから取得
  register_setting( 'register_initialize-group', 'blogname' );
  register_setting( 'register_initialize-group', 'blogdescription' );
  //トップページのメタタグの設定
  register_setting( 'register_initialize-group', 'meta_keywords' );

  //Googleツールの設定
  register_setting( 'register_initialize-group', 'ga_tracking_code' );
  register_setting( 'register_initialize-group', 'webmaster_tool' );

  //.htaccessを更新させる必要がある
  flush_rewrite_rules( true );
}

   
function banner_options_page() {
?>
<div class="wrap">
  <h2>初期設定</h2>
  <form method="post" action="options.php" enctype="multipart/form-data" encoding="multipart/form-data">
  <?php
    settings_fields( 'register_initialize-group' );
    do_settings_sections( 'register_initialize-group' );
  ?>
    <div class="metabox-holder">
    <div id="toppage_meta_setting" class="postbox " >
    <h3 class='hndle'><span>トップページのメタタグの設定</span></h3>
      <div class="inside">
        <div class="main">
          <p class="setting_description">ここではトップページのタイトルとメタタグの設定を行います。</p>

          <h4>トップページタイトル</h4>
          <p><input type="text" id="blogname" class="regular-text" name="blogname" value="<?php echo get_option('blogname'); ?>"></p>
          <p class="setting_description"><small>トップページのタイトルを入力して下さい。ここに入力した内容が検索エンジンにも表示されるようになります。<br>効果的なタイトルのつけ方を知りたい方は、『<a href="http://bazubu.com/what-is-best-for-wp-title-22931.html" target="_blank">WordPressのタイトルの付け方</a>』をご覧ください。</small></p>

          <h4>トップページの説明（メタディスクリプション）</h4>
          <textarea id="blogdescription" class="regular-text" name="blogdescription" rows="5" cols="60"><?php echo get_option('blogdescription'); ?></textarea>
          <p class="setting_description"><small>トップページの説明文を全角８０文字以内で入力してください。ここに入力した内容が検索エンジンのディスクリプション欄に表示されるようになります。具体的には、『<a href="" target="_blank">メタディスクリプションとは</a>をご覧ください。』</small></p>

          <h4>メタキーワード</h4>
          <input type="text" id="meta_keywords" class="regular-text" name="meta_keywords" value="<?php echo get_option('meta_keywords'); ?>">
          <p class="setting_description"><small>トップページで対策したいキーワードを入力して下さい。メタキーワードは現在SEOには影響力はありませんが、キーワードに対する理解を深めるためにも、メタキーワードは常に意識しておきましょう。</small></p>

        </div>
      </div>
    </div>
    </div>

    <div class="metabox-holder">
    <div id="google_tools" class="postbox " >
    <h3 class='hndle'><span>Googleツールの設定</span></h3>
      <div class="inside">
        <div class="main">
          <p class="setting_description">Googleアナリティクス・Googleウェブマスターツールの設定を行います。サイトの効果計測やメンテナンスに必要なので必ず設定しましょう。設定の前に、それぞれのアカウントを取得しておきましょう。</p>

          <h4>Googleアナリティクスの設定</h4>
          <textarea name="ga_tracking_code" rows="10" cols="60" id="ga_tracking_code" class="cmb_textarea_code"><?php echo get_option('ga_tracking_code'); ?></textarea>
          <p class="setting_description"><small>Googleアナリティクスのコードを入力して下さい。</small></p>

          <h4>Googleウェブマスターツールの設定</h4>
          <textarea name="webmaster_tool" rows="10" cols="60" id="webmaster_tool" class="cmb_textarea_code"><?php echo get_option('webmaster_tool'); ?></textarea>
          <p class="setting_description"><small>Googleウェブマスターツールのコードを入力してください。</small></p>
        </div>
      </div>
    </div>
    </div>

    <?php submit_button(); ?>
  </form>
</div>
<?php
}

/**
 * 初期画面設定でデフォルト値を設定する
 *
 * get_optionで指定したオプション自体が存在しない場合はfalseが返る
 * update_optionの「1」はtrueで有効にするという意味
 */
// add_action( 'load-toplevel_page_initial_setting_menu', 'bzb_set_default_value' );
// function bzb_set_default_value() {

//   // 「ソーシャルボタン個別表示設定」： デフォルトでlike,tweet, googleplus,hatenaのボタンを有効にする
//   if (false === get_option('show_like_button')) {
//     update_option('show_like_button', 1);
//   }
//   if (false === get_option('show_tweet_button')) {
//     update_option('show_tweet_button', 1);
//   }
//   if (false === get_option('show_google_button')) {
//     update_option('show_google_button', 1);
//   }
//   if (false === get_option('show_hatena_button')) {
//     update_option('show_hatena_button', 1);
//   }

// }
?>
