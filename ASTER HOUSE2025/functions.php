<?php

function theme_enqueue_assets() {
  // CSS
	wp_enqueue_style(
		'reset-style',
		get_template_directory_uri() . '/css/reset.css',
		array(),
		filemtime( get_template_directory() . '/css/reset.css' )
	);
	wp_enqueue_style(
		'common-style',
		get_template_directory_uri() . '/css/common.css',
		array( 'reset-style' ),
		filemtime( get_template_directory() . '/css/common.css' )
	);
	wp_enqueue_style(
		'theme-style',
		get_template_directory_uri() . '/css/style.css',
		array( 'common-style' ),
		filemtime( get_template_directory() . '/css/style.css' )
	);
	wp_enqueue_style(
		'tab-style',
		get_template_directory_uri() . '/css/tab.css',
		array( 'theme-style' ),
		filemtime( get_template_directory() . '/css/tab.css' )
	);
	wp_enqueue_style(
		'sp-style',
		get_template_directory_uri() . '/css/sp.css',
		array( 'theme-style' ),
		filemtime( get_template_directory() . '/css/sp.css' )
	);
	wp_enqueue_style(
		'animation-style',
		get_template_directory_uri() . '/css/animation.css',
		array( 'theme-style' ),
		filemtime( get_template_directory() . '/css/animation.css' )
	);

	// Google Fontsの読み込み
	wp_enqueue_style(
		'google-fonts',
		'https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&family=Noto+Sans+JP:wght@400;600&display=swap',
		array(),    // 依存なし
		null
	);

	// JavaScriptの読み込み
	wp_enqueue_script(
		'my-script',
		get_template_directory_uri() . '/js/script.js',
		array( 'jquery' ),
		null,
		true
	);
	wp_enqueue_script(
		'index-script',
		get_template_directory_uri() . '/js/index.js',
		array( 'jquery' ),
		null,
		true
	);
	wp_enqueue_script(
		'insta-script',
		get_template_directory_uri() . '/js/instagram-feed.js',
		array( 'jquery' ),
		null,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_assets' );



function replace_core_jquery() {
	if ( ! is_admin() ) {
		wp_deregister_script( 'jquery' );
		wp_register_script(
			'jquery',
			'https://code.jquery.com/jquery-3.6.0.min.js',
			array(),
			'3.6.0',
			true  // footer に出力
		);
		wp_enqueue_script( 'jquery' );
	}
}
add_action( 'wp_enqueue_scripts', 'replace_core_jquery' );

// Lottie Player の読み込み
function enqueue_lottie_player() {
	wp_enqueue_script(
		'lottie-player',
		'https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js',
		array(),
		null,
		true  // footer に出力
	);
}
add_action( 'wp_enqueue_scripts', 'enqueue_lottie_player' );



function post_has_archive( $args, $post_type ) { // 設定後に（パーマリンク更新すること）
	if ( 'post' == $post_type ) {
		$args['rewrite'] = true;
		$args['has_archive'] = 'news';
		$args['label'] = 'News' ;
	}
	return $args;
}
add_filter( 'register_post_type_args', 'post_has_archive', 10, 2 );

add_theme_support( 'post-thumbnails' );

add_action('pre_get_posts','my_pre_get_posts_number'); 
function my_pre_get_posts_number( $query ) { 
        if(is_admin() || ! $query -> is_main_query()) return; 
        if($query->is_home()){
          $query->set( 'posts_per_page',5); //3件 
        } 
} 


add_filter( 'wp_pagenavi_css_class', function( $class ) {
    switch ( $class ) {
        case 'first':
            return 'first page-numbers';
        case 'last':
            return 'last page-numbers';
        case 'previouspostslink': // ← プラグインが渡してくるキー名
            return 'prev page-numbers';
        case 'nextpostslink':     // ← プラグインが渡してくるキー名
            return 'next page-numbers';
        case 'current':
            return 'page-numbers current';
        case 'extend':            // 「…」部分
            return 'page-numbers dots';
        case 'page':
        default:
            return 'page-numbers';
    }
});

// ドット表示だけはテキストごと差し替え
add_filter( 'wp_pagenavi_dotleft_text',  fn() => '<span class="page-numbers dots">&hellip;</span>' );
add_filter( 'wp_pagenavi_dotright_text', fn() => '<span class="page-numbers dots">&hellip;</span>' );



function register_property_cpt() {
    $labels = array(
        'name'               => '物件情報',
        'singular_name'      => '物件情報',
        'edit_item'          => '物件情報を編集',
        'menu_name'          => '物件情報',
    );
	$args = [
		'labels'      => $labels,
		'public'      => true,
		'has_archive' => true,
		'rewrite'     => [ 'slug'=>'property', 'with_front'=>false ],
		'supports'    => [ 'title' , 'thumbnail' ],
		'taxonomies'  => [ 'property_category' ],
	];
	register_post_type( 'property', $args );
}
// 優先度20にして、一度デフォルトのカテゴリー紐付けを確実に実行
add_action( 'init', 'register_property_cpt', 0 );

// カスタムタクソノミー「Property Category」を登録
function register_property_taxonomy() {
    $labels = array(
        'name'              => '物件カテゴリ',
        'singular_name'     => '物件カテゴリ',
        'search_items'      => '物件カテゴリを検索',
        'all_items'         => 'すべての物件カテゴリ',
        'parent_item'       => '親カテゴリ',
        'parent_item_colon' => '親カテゴリ：',
        'edit_item'         => 'カテゴリを編集',
        'update_item'       => 'カテゴリを更新',
        'add_new_item'      => '新規カテゴリを追加',
        'new_item_name'     => '新規カテゴリ名',
        'menu_name'         => '物件カテゴリ',
    );
    $args = array(
        'labels'              => $labels,
        'hierarchical'        => true,
        'public'              => true,
        'publicly_queryable'  => true, 
        'show_ui'             => true,
        'show_admin_column'   => true,
        'rewrite'           => array(
            'slug'         => 'works', 
            'with_front'   => false,
            'hierarchical' => false,
        ),
    );
    register_taxonomy( 'property_category', array( 'property' ), $args );
}
add_action( 'init', 'register_property_taxonomy', 10 );


// 「/works/」で property_category=works のアーカイブを呼び出す
function add_works_root_rewrite(){
    add_rewrite_rule(
		'^works/?$',
		'index.php?taxonomy=property_category&term=works',
		'top'
    );
}
add_action('init','add_works_root_rewrite', 11);


// Top用Sellハッシュタグスライド
function register_sell_hashtag_cpt() {
    $labels = array(
        'name'               => 'Sellハッシュタグ',
        'singular_name'      => 'Sellハッシュタグ',
        'edit_item'          => 'Sellハッシュタグを編集',
        'menu_name'          => 'Sellハッシュタグ',
    );
    $args = array(
        'labels'             => $labels,
        'public'             => false,           // 公開投稿ではなく管理画面のみ
        'show_ui'            => true,            // 管理画面には表示
        'show_in_menu'       => true,
        'has_archive'        => false,           // アーカイブページ不要
        'publicly_queryable' => false,
        'rewrite'            => false,
        'supports'           => array('title'),  // タイトルのみ
    );
    register_post_type('sell_hashtag', $args);
}
add_action('init', 'register_sell_hashtag_cpt');


// Top用Worksハッシュタグスライド
function register_works_hashtag_cpt() {
    $labels = array(
        'name'               => 'Worksハッシュタグ',
        'singular_name'      => 'Workslハッシュタグ',
        'edit_item'          => 'Worksハッシュタグを編集',
        'menu_name'          => 'Worksハッシュタグ',
    );
    $args = array(
        'labels'             => $labels,
        'public'             => false,           // 公開投稿ではなく管理画面のみ
        'show_ui'            => true,            // 管理画面には表示
        'show_in_menu'       => true,
        'has_archive'        => false,           // アーカイブページ不要
        'publicly_queryable' => false,
        'rewrite'            => false,
        'supports'           => array('title'),  // タイトルのみ
    );
    register_post_type('works_hashtag', $args);
}
add_action('init', 'register_works_hashtag_cpt');



function register_staff_cpt() {
    $labels = array(
        'name'               => 'スタッフ紹介',
        'singular_name'      => 'スタッフ紹介',
        'edit_item'          => 'スタッフ紹介を編集',
        'menu_name'          => 'スタッフ紹介',
    );
	$args = [
		'labels'      => $labels,
		'public'      => true,
		'has_archive' => true,
		'rewrite'     => [ 'slug'=>'staff', 'with_front'=>false ],
		'supports'    => [ 'title' ],
	];
	register_post_type( 'staff', $args );
}
// 優先度20にして、一度デフォルトのカテゴリー紐付けを確実に実行
add_action( 'init', 'register_staff_cpt', 0 );



// Contact Form 7 の自動 <p><br> を無効化
add_filter( 'wpcf7_autop_or_not', '__return_false' );





//コンタクトフォームを表示・処理するショートコードを登録
add_shortcode('custom_contact_form', 'custom_contact_form_handler');
function custom_contact_form_handler() {
  ob_start();

  $errors = [];
  $success_message = '';

  if (
    $_SERVER['REQUEST_METHOD'] === 'POST' &&
    ! empty($_POST['custom_contact_submitted'])
  ) {
    // nonceチェック
    if ( ! isset($_POST['custom_contact_nonce'])
      || ! wp_verify_nonce($_POST['custom_contact_nonce'], 'custom_contact')
    ) {
      $errors[] = 'セキュリティチェックに失敗しました。';
    } else {

      // サニタイズ
      $inquiry  = sanitize_text_field( $_POST['inquiry']        ?? '' );
      $name     = sanitize_text_field( $_POST['your_name']      ?? '' );
      $furigana = sanitize_text_field( $_POST['your_furigana']  ?? '' );
      $email    = sanitize_email(      $_POST['your_email']     ?? '' );
      $address  = sanitize_text_field( $_POST['your_address']   ?? '' );
      $phone    = sanitize_text_field( $_POST['your_phone']     ?? '' );
      $message  = sanitize_textarea_field( $_POST['your_message'] ?? '' );
      $confirm  = isset( $_POST['confirmation'] );

      // バリデーション
      if ( empty($inquiry) )  $errors[] = 'お問合せ内容を選択してください。';
      if ( empty($name) )     $errors[] = 'お名前を入力してください。';
      if ( empty($email) || ! is_email($email) ) $errors[] = '有効なメールアドレスを入力してください。';
      if ( empty($address) )  $errors[] = 'ご住所を入力してください。';
      if ( empty($phone) )    $errors[] = '電話番号を入力してください。';
      if ( empty($message) )  $errors[] = 'メッセージを入力してください。';
      if ( ! $confirm )       $errors[] = '「送信内容を確認」にチェックを入れてください。';

      // エラーがなければメール送信へ
      if ( empty($errors) ) {
        $to      = 'wakabayashi@mode-link.com'; // ←ここは文字列でOK
        $subject = '[お問い合わせ] ' . $inquiry;
        $body    = 
             "お問合せ内容: {$inquiry}\n"
           . "お名前: {$name}\n"
           . "フリガナ: {$furigana}\n"
           . "メールアドレス: {$email}\n"
           . "ご住所: {$address}\n"
           . "電話番号: {$phone}\n\n"
           . "メッセージ:\n{$message}\n";
        $headers = [
          'Content-Type: text/plain; charset=UTF-8',
          "From: {$name} <{$email}>"
        ];

        if ( wp_mail($to, $subject, $body, $headers) ) {
          $success_message = '送信が完了しました<br>
		  内容を確認の上、担当者よりご連絡させていただきます。<br>
		  2~3日経っても返信がない場合、再度コンタクトフォームをご記入の上お問合せください。';
        } else {
          $errors[] = 'メールの送信に失敗しました。時間をおいて再度お試しください。';
        }
      }
      //
      // ← ここまで
      //
    }
  }

  // エラー表示
  if ( ! empty($errors) ) {
    echo '<div class="error"><ul>';
    foreach ( $errors as $e ) {
      echo '<li>' . esc_html($e) . '</li>';
    }
    echo '</ul></div>';
  }

  // フォーム本体
  include locate_template('template-parts/contact-form-html.php');

  // 送信成功メッセージ
  if ( $success_message ) {
	// <br> タグだけを許可
    $allowed = array( 'br' => array() );
	echo '<p class="success">'
		. wp_kses( $success_message, $allowed )
		. '</p>';
  }

  return ob_get_clean();
}


//リザーブフォームを表示・処理するショートコードを登録
add_shortcode('custom_reserve_form', 'custom_reserve_form_handler');
function custom_reserve_form_handler() {
  ob_start();

  $errors = [];
  $success_message = '';

  if (
    $_SERVER['REQUEST_METHOD'] === 'POST' &&
    ! empty($_POST['custom_reserve_submitted'])
  ) {
    // nonceチェック
    if ( ! isset($_POST['custom_reserve_nonce'])
      || ! wp_verify_nonce($_POST['custom_reserve_nonce'], 'custom_reserve')
    ) {
      $errors[] = 'セキュリティチェックに失敗しました。';
    } else {

      // サニタイズ
      $inquiry  = sanitize_text_field( $_POST['inquiry']        ?? '' );
      $name     = sanitize_text_field( $_POST['your_name']      ?? '' );
      $furigana = sanitize_text_field( $_POST['your_furigana']  ?? '' );
      $email    = sanitize_email(      $_POST['your_email']     ?? '' );
      $address  = sanitize_text_field( $_POST['your_address']   ?? '' );
      $phone    = sanitize_text_field( $_POST['your_phone']     ?? '' );
      $message  = sanitize_textarea_field( $_POST['your_message'] ?? '' );
      $confirm  = isset( $_POST['confirmation'] );

      // バリデーション
      if ( empty($inquiry) )  $errors[] = 'お問合せ内容を選択してください。';
      if ( empty($name) )     $errors[] = 'お名前を入力してください。';
      if ( empty($email) || ! is_email($email) ) $errors[] = '有効なメールアドレスを入力してください。';
      if ( empty($address) )  $errors[] = 'ご住所を入力してください。';
      if ( empty($phone) )    $errors[] = '電話番号を入力してください。';
      if ( empty($message) )  $errors[] = 'メッセージを入力してください。';
      if ( ! $confirm )       $errors[] = '「送信内容を確認」にチェックを入れてください。';

      // エラーがなければメール送信へ
      if ( empty($errors) ) {
        $to      = 'wakabayashi@mode-link.com'; // ←ここは文字列でOK
        $subject = '[来場予約フォーム] ' . $inquiry;
        $body    = 
             "お問合せ内容: {$inquiry}\n"
           . "お名前: {$name}\n"
           . "フリガナ: {$furigana}\n"
           . "メールアドレス: {$email}\n"
           . "ご住所: {$address}\n"
           . "電話番号: {$phone}\n\n"
           . "メッセージ:\n{$message}\n";
        $headers = [
          'Content-Type: text/plain; charset=UTF-8',
          "From: {$name} <{$email}>"
        ];

        if ( wp_mail($to, $subject, $body, $headers) ) {
          $success_message = '送信が完了しました<br>
		  内容を確認の上、担当者よりご連絡させていただきます。<br>
		  2~3日経っても返信がない場合、再度コンタクトフォームをご記入の上お問合せください。';
        } else {
          $errors[] = 'メールの送信に失敗しました。時間をおいて再度お試しください。';
        }
      }
      //
      // ← ここまで
      //
    }
  }

  // エラー表示
  if ( ! empty($errors) ) {
    echo '<div class="error"><ul>';
    foreach ( $errors as $e ) {
      echo '<li>' . esc_html($e) . '</li>';
    }
    echo '</ul></div>';
  }

  // フォーム本体
  include locate_template('template-parts/reserve-form-html.php');

  // 送信成功メッセージ
  if ( $success_message ) {
	// <br> タグだけを許可
    $allowed = array( 'br' => array() );
	echo '<p class="success">'
		. wp_kses( $success_message, $allowed )
		. '</p>';
  }

  return ob_get_clean();
}
