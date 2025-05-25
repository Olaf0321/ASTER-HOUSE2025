<!doctype html>
<html lang="ja">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, user-scalable=yes">
<meta name="format-detection" content="telephone=no">
<?php wp_head();?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://use.typekit.net/abg4zef.css">

<link rel="preload" as="image" href="images/top_anime_text-01_sp.svg">
<link rel="preload" as="image" href="images/top_anime_text-02_sp.svg">
<link rel="preload" as="image" href="images/top_anime_text-03_sp.svg">

<script>
  (function(d) {
    var config = {
        kitId: 'hun8zss',
        scriptTimeout: 3000,
        async: true
      },
      h = d.documentElement,
      t = setTimeout(function() {
        h.className = h.className.replace(/\bwf-loading\b/g, "") + " wf-inactive";
      }, config.scriptTimeout),
      tk = d.createElement("script"),
      f = false,
      s = d.getElementsByTagName("script")[0],
      a;
    h.className += " wf-loading";
    tk.src = 'https://use.typekit.net/' + config.kitId + '.js';
    tk.async = true;
    tk.onload = tk.onreadystatechange = function() {
      a = this.readyState;
      if (f || a && a != "complete" && a != "loaded") return;
      f = true;
      clearTimeout(t);
      try {
        Typekit.load(config)
      } catch (e) {}
    };
    s.parentNode.insertBefore(tk, s)
  })(document);
  </script>
  

</head>

<body class="loading">
  <div class="overlay"></div>

  <!-- ローディング表示 -->
  <div class="loading_wrap on" id="loadingWrap">
    <object class="loading-anime" type="image/svg+xml" data="<?php echo get_template_directory_uri(); ?>/images/loading_anime.svg"></object>
</div>


  <!-- ローディング中に表示するトップ境界線アニメーション -->
  <div class="loading_top_border_wrap" id="loadingTopBorder">
    <object class="loading_top_border pc" type="image/svg+xml" data="<?php echo get_template_directory_uri(); ?>/images/top_anime_border_pc.svg"></object>
    <object class="loading_top_border sp" type="image/svg+xml" data="<?php echo get_template_directory_uri(); ?>/images/top_anime_border_sp.svg"></object>
  </div>

<!--共通ヘッダー-->

<header class="header__page">
  <div class="logo">
    <a href="<?php echo esc_url(home_url()); ?>">
      <img src="<?php echo get_template_directory_uri(); ?>/images/icon_symbol.svg" alt="アスターハウス" class="pc">
      <img src="<?php echo get_template_directory_uri(); ?>/images/logo_header_sp.svg" alt="アスターハウス" class="sp">
    </a>
  </div>
  <div class="contact">
    <a href="<?php echo esc_url(home_url('/contact/')); ?>">お問合せ</a>
  </div>
  <div class="openbtn1" id="menuButton"><span></span><span></span><span></span></div>
  <nav id="g-nav">
    <div class="panel__logo">
        <a href="index.html"><img src="<?php echo get_template_directory_uri(); ?>/images/logo_header_sp.svg" alt="アスターハウス" class="sp"></a>
    </div>
    <div class="sns">
        <ul>
            <li><a href="https://www.youtube.com/channel/UCoIVR-wyZFAeAOx5vTYoVxw" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/icon_header_youtube.svg" alt="ユーチューブ"></a></li>
            <li><a href="https://www.instagram.com/__aster_house" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/icon_header_insta.svg" alt="インスタ"></a></li>
            <li><a href="https://www.facebook.com/people/%E3%82%A2%E3%82%B9%E3%82%BF%E3%83%BC%E3%83%8F%E3%82%A6%E3%82%B9/100083320001835/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/icon_header_facebook.svg" alt="フェイスブック"></a></li>
            <li><a href="#" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/icon_header_tiktok.svg" alt="ティックトック"></a></li>    
        </ul>
    </div>
    <div id="g-navi-list">
        <ul>
            <li><a href="<?php echo esc_url(home_url('/property/')); ?>">Sell<span class="sp">販売中物件・土地情報</span></a></li>
            <li><a href="<?php echo esc_url(home_url('/works/')); ?>">Works<span class="sp">過去の実績一覧</span></a></li>
            <li><a href="<?php echo esc_url(home_url()); ?>#concept">Concept<span class="sp">コンセプト</span></a></li>
            <li><a href="<?php echo esc_url(home_url('/news/')); ?>">News<span class="sp">お知らせ</span></a></li>
            <li><a href="<?php echo esc_url(home_url('/company/')); ?>">About us<span class="sp">私たちについて</span></a></li>
        </ul>
    </div>
  </nav>
  <div class="panel" id="menuPanel"></div>
</header>


