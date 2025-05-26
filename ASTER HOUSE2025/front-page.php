<?php get_header(); ?>
<article class="header__top border_none" id="headerTop">
  <!--  追加分 ここから  -->
  <div class="top_anime-bg_wrap" id="topAnimeBgWrap">
    <!-- 字とスクロールで出す画像 -->
    <div class="top_anime-text-01 pc"><object type="image/svg+xml" data="<?php echo get_template_directory_uri(); ?>/images/top_anime_text-01_pc.svg"></object></div>
    <div class="top_anime-text-02 pc"><object type="image/svg+xml" data="<?php echo get_template_directory_uri(); ?>/images/top_anime_text-02_pc.svg"></object></div>
    <div class="top_anime-text-03 pc"><object type="image/svg+xml" data="<?php echo get_template_directory_uri(); ?>/images/top_anime_text-03_pc.svg"></object></div>
    <div class="top_anime-text-02 sp"><object type="image/svg+xml" data="<?php echo get_template_directory_uri(); ?>/images/top_anime_text-02_sp.svg"></object></div>
    <div class="top_anime-text-01 sp"><object type="image/svg+xml" data="<?php echo get_template_directory_uri(); ?>/images/top_anime_text-01_sp.svg"></object></div>
    <div class="top_anime-text-03 sp"><object type="image/svg+xml" data="<?php echo get_template_directory_uri(); ?>/images/top_anime_text-03_sp.svg"></object></div>
  </div>
  <!-- 線 -->
  <div class="loading_top_border_wrap" id="loadingTopBorder">
    <object class="loading_top_border pc" type="image/svg+xml" data="<?php echo get_template_directory_uri(); ?>/images/top_anime_border_pc.svg"></object>
    <object class="loading_top_border sp" type="image/svg+xml" data="<?php echo get_template_directory_uri(); ?>/images/top_anime_border_sp.svg"></object>
  </div>
  <!-- --------------------------
    追加分 ここまで
  -------------------------- -->
  <div class="header__wrapper">
    <div class="logo fadeUp"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.svg" alt="アスターハウス"></div>
    <div class="header__info fadeUp">
      <div class="contact"><a href="<?php echo esc_url(home_url('/contact/')); ?>">お問合せ・資料請求</a></div>
      <div class="tel roboto"><span>Tel.</span>0120-802-801</div>
      <div class="header__consul"><a href="<?php echo esc_url(home_url('/property/')); ?>#consul">家づくり相談会</a></div>
    </div>
    <nav class="roboto fadeUp">
      <li><a href="<?php echo esc_url(home_url('/property/')); ?>">Sell</a></li>
      <li><a href="<?php echo esc_url(home_url('/works/')); ?>">Works</a></li>
      <li><a href="<?php echo esc_url(home_url()); ?>#concept">Concept</a></li>
      <li><a href="<?php echo esc_url(home_url('/news/')); ?>">News</a></li>
      <li><a href="<?php echo esc_url(home_url('/company/')); ?>">About us</a></li>
    </nav>
  </div>
  <div class="header__top__sns">
    <li><a href="https://www.youtube.com/channel/UCoIVR-wyZFAeAOx5vTYoVxw" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/icon_header_youtube.svg" alt="ユーチューブ"></a></li>
    <li><a href="https://www.instagram.com/__aster_house" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/icon_header_insta.svg" alt="インスタ"></a></li>
    <li><a href="#" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/icon_header_tiktok.svg" alt="ティックトック"></a></li>
    <li><a href="https://www.facebook.com/people/%E3%82%A2%E3%82%B9%E3%82%BF%E3%83%BC%E3%83%8F%E3%82%A6%E3%82%B9/100083320001835/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/icon_header_facebook.svg" alt="フェイスブック"></a></li>
  </div>

  <?php
    // ACF で URL フィールドを取得
    $banner_link = get_field('banner_link');

    // フィールドに値があればそれを、なければ /reserve/ をフォールバック
    $link = $banner_link
      ? esc_url( $banner_link )
      : esc_url( home_url('/reserve/') );
    ?>
    <div class="reserve fadeLeft">
      <a href="<?php echo $link; ?>">
        <img src="<?php echo get_template_directory_uri(); ?>/images/header_top_reserve.svg" alt="来場予約">
      </a>
    </div>

  <div class="scroll-icon">
    <div class="line"></div>
    <div class="text roboto">Scroll</div>
  </div>
  <!-- --------------------------
      追加分 ここから
    -------------------------- -->
  <!-- スクロール検知用 見えない -->
  <span class="top_anime_scroll" id="topAnimeScroll"></span>
  <!-- --------------------------
      追加分 ここまで
    -------------------------- -->
</article>
<article>
  <div class="ttl__top fadeIn">
    <h2 class="fadeUp">Sell<span>販売中物件・土地情報</span></h2>
    <div class="btn__more fr mt25 fadeUp"><a href="<?php echo esc_url(home_url('/property/')); ?>">More</a></div>
  </div>

  <div class="top__card_wrapper fadeIn">
    <div class="sell__card slider">
      <ul class="slide-track">

        <?php
          // カスタムタクソノミー property_category で絞り込む
          $args = array(
          'post_type'      => 'property',
          'posts_per_page' => 8,
          'tax_query'      => array(
              array(
              'taxonomy' => 'property_category',
              'field'    => 'slug',
              'terms'    => array( 'sell', 'model', 'land' ),
              'operator' => 'IN',
              ),
          ),
          );
          $prop_query = new WP_Query( $args );

          if ( $prop_query->have_posts() ) :
          while ( $prop_query->have_posts() ) : $prop_query->the_post();

              // タームと価格を取得
              $terms = get_the_terms( get_the_ID(), 'property_category' );
              $term  = ( $terms && ! is_wp_error( $terms ) ) ? reset( $terms ) : null;
              $slug  = $term ? $term->slug : '';
              $price = get_field( 'price' );
          ?>

        <li>
          <a href="<?php the_permalink(); ?>">
            <?php if ( $codes = get_field('code') ): ?>
                <div class="code roboto">
                  <?= esc_html( $codes['code01'] ) ?>
                  <span class="roboto"><?= esc_html( $codes['code02'] ) ?></span>
                </div>
            <?php endif; ?>

            <div class="scale">
                <?= esc_html( get_field('scale') ) ?>　｜　
                <?php if ( $addr = get_field('address') ): ?>
                  <span><?= esc_html( $addr['address1'] ) ?></span>
                <?php endif; ?>
              </div>

            <div class="thumbnail">
                <?php
                if ( has_post_thumbnail() ) {
                the_post_thumbnail( 'medium', [
                    'alt'     => get_the_title(),
                    'loading' => 'lazy',
                ] );
                }
                ?>
            </div>

            <h3><?= esc_html( get_field('title') ) ?></h3>

            <!-- price / category 切り替え -->
            <?php if ( $slug === 'sell' ) : ?>
                <div class="build">
                <img src="<?= get_template_directory_uri() ?>/images/icon_sell_build.svg" alt="建売">
                <p class="price roboto"><?= esc_html( $price ) ?><span>万円</span></p>
                </div>
            <?php elseif ( $slug === 'model' ) : ?>
                <div class="model">
                <img src="<?= get_template_directory_uri() ?>/images/icon_sell_model.svg" alt="モデルハウス">
                <p class="price roboto"><?= esc_html( $price ) ?><span>万円</span></p>
                </div>
            <?php elseif ( $slug === 'land' ) : ?>
                <div class="land">
                <img src="<?= get_template_directory_uri() ?>/images/icon_sell_land.svg" alt="売土地">
                <p class="price roboto"><?= esc_html( $price ) ?><span>万円</span></p>
                </div>
            <?php endif; ?>
          </a>
        </li>

        <?php
          endwhile;
          wp_reset_postdata();
          else :
          ?>
          <li class="fadeIn"><p>該当する物件がありません。</p></li>
          <?php endif; ?>

      </ul>
    </div>
  </div>
  <div class="tag fadeIn">
    <div class="scrolling-wrapper">
      <?php
      // ハッシュタグ用カスタム投稿を取得
      $hashtags = get_posts([
          'post_type'      => 'sell_hashtag',
          'posts_per_page' => -1,
          'orderby'        => 'title',
          'order'          => 'ASC',
      ]);

      if ( $hashtags ) : ?>
        <ul class="scroll-list">
          <?php foreach ( $hashtags as $hashtag ) : ?>
            <li><?php echo esc_html( $hashtag->post_title ); ?></li>
          <?php endforeach; ?>
        </ul>
        <?php wp_reset_postdata(); ?>
      <?php endif; ?>
    </div>
  </div>

</article>

<article>
  <div class="ttl__top fadeIn">
    <h2 class="fadeUp">Works<span>過去の施工実績</span></h2>
    <div class="btn__more fr mt25 fadeUp"><a href="<?php echo esc_url(home_url('/works/')); ?>l">More</a></div>
  </div>
  <div class="top__card_wrapper fadeIn">
    <div class="sell__card" class="slider">
      <ul class="slide-track">

        <?php
          // カスタムタクソノミー property_category で絞り込む
          $args = array(
          'post_type'      => 'property',
          'posts_per_page' => 8,
          'tax_query'      => array(
              array(
              'taxonomy' => 'property_category',
              'field'    => 'slug',
              'terms'    => array( 'works' ),
              'operator' => 'IN',
              ),
          ),
          );
          $prop_query = new WP_Query( $args );

          if ( $prop_query->have_posts() ) :
          while ( $prop_query->have_posts() ) : $prop_query->the_post();

              // タームと価格を取得
              $terms = get_the_terms( get_the_ID(), 'property_category' );
              $term  = ( $terms && ! is_wp_error( $terms ) ) ? reset( $terms ) : null;
              $slug  = $term ? $term->slug : '';
              $price = get_field( 'price' );
          ?>

        <li>
          <a href="<?php the_permalink(); ?>">
            <?php if ( $codes = get_field('code') ): ?>
              <div class="code roboto">
                <?= esc_html( $codes['code01'] ) ?>
                <span><?= esc_html( $codes['code02'] ) ?></span>
              </div>
            <?php endif; ?>
            <div class="scale">
              <?= esc_html( get_field('scale') ) ?>　｜　
              <?php if ( $addr = get_field('address') ): ?>
                <span><?= esc_html( $addr['address1'] ) ?></span>
                <?php endif; ?>
            </div>
            <div class="thumbnail">
              <?php
                if ( has_post_thumbnail() ) {
                  the_post_thumbnail( 'medium', [
                      'alt'     => get_the_title(),
                      'loading' => 'lazy',
                  ] );
                  }
              ?>
            </div>
            <h3><?= esc_html( get_field('title') ) ?></h3>
            <div class="works">
              <img src="<?php echo get_template_directory_uri(); ?>/images/icon_sell_works.svg" alt="販売実績">
              <p class="price roboto"><?= esc_html( $price ) ?><span>万円</span></p>
            </div>
          </a>
        </li>

        <?php
          endwhile;
          wp_reset_postdata();
          else :
        ?>
          <li class="fadeIn"><p>該当する物件がありません。</p></li>
        <?php endif; ?>

      </ul>
    </div>
  </div>
  <div class="tag fadeIn">
    <div class="scrolling-wrapper">
      <?php
        // ハッシュタグ用カスタム投稿を取得
        $hashtags = get_posts([
            'post_type'      => 'works_hashtag',
            'posts_per_page' => -1,
            'orderby'        => 'title',
            'order'          => 'ASC',
        ]);

        if ( $hashtags ) : ?>
          <ul class="scroll-list">
            <?php foreach ( $hashtags as $hashtag ) : ?>
              <li><?php echo esc_html( $hashtag->post_title ); ?></li>
            <?php endforeach; ?>
          </ul>
        <?php wp_reset_postdata(); ?>
      <?php endif; ?>
    </div>
  </div>
</article>
<article class="relative">
  <div id="concept"></div>
  <div class="ttl__top border-bottom fadeIn">
    <h2 class="fadeUp">Concept<span>コンセプト</span></h2>
  </div>
  <h2 class="h2__concept">
    <div class="pc">
      <lottie-player id="lottieAnimation" mode="normal" src="<?php echo get_template_directory_uri(); ?>/images/concept_text.json" style="width: 100%;margin: 0 auto;">
      </lottie-player>  
    </div>
    <div class="sp">
      <lottie-player id="lottieAnimation" mode="normal" src="<?php echo get_template_directory_uri(); ?>/images/concept_text_sp.json" style="width: 100%;margin: 0 auto;">
      </lottie-player>  
    </div>
  </h2>
  <div class="top__concept fadeIn">
    <div class="imgbox__concept slide">
      <div class="slide"><img src="<?php echo get_template_directory_uri(); ?>/images/top_concept01.jpg" alt=""></div>
      <div class="slide"><img src="<?php echo get_template_directory_uri(); ?>/images/top_concept02.jpg" alt=""></div>
      <div class="slide"><img src="<?php echo get_template_directory_uri(); ?>/images/top_concept03.jpg" alt=""></div>
      <div class="slide"><img src="<?php echo get_template_directory_uri(); ?>/images/top_concept04.jpg" alt=""></div>
    </div>
    <div class="textbox__concept">
      <p class="fadeUp">Our strength is our ability to design homes<br>
        with ideal cost performance.</p>
      <p class="ja justify fadeUp">私たちアスターハウスはデザインとコスパにこだわった家づくりをしています。これから先、永く過ごす大切な住まい。気持ちよく住み続けていくために、理想のデザインとコスパを叶えた住宅をご提案いたします。家づくりを通して自分らしい暮らしを、一緒にデザインしていきましょう。</p>
      <div class="icon__concept fadeUp ani_trigger">
        <svg id="uuid-f95d9587-348e-45bd-aee9-3c54d06bc788" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 35.1 62">
          <defs>
              <style>
                  .text{
                      fill:#1c1c1c;
                      transform: translateY(20px); /* 初期状態 */
                      animation: text 0.7s forwards;
                  }
                  .flower{
                      fill:#b91f3a;
                  }
                  .text, .flower {
                    /* 初期状態ではアニメーションさせない */
                    animation: none;
                  }
                  .animate .text {
                    animation: text 0.7s forwards;
                  }
                  .animate .flower {
                    animation: flower 3s forwards;
                    animation-delay: 1s;
                    transform-box: fill-box;
                    transform-origin: center center;  
                  }
                  @keyframes flower {
                    10% {}
                    100% {
                      transform: rotate(720deg);
                    }
                  }
                  @keyframes text {
                    0% {
                      transform: translateY(20px);
                      opacity: 0;
                    }
                    100% {
                      transform: translateY(0px);
                      opacity: 1;
                    }
                  }
              </style>
          </defs>
          <g id="uuid-2c14fc1b-c8b6-4145-aeb8-fdf8f88e18c3">
          <path class="flower" d="M21.84,19.33l10.18,8.13c-1.23,1.79-2.78,3.34-4.57,4.57l-8.13-10.18,1.45,12.94c-1.05.2-2.13.31-3.23.31s-2.18-.11-3.23-.31l1.45-12.94-8.13,10.18c-1.79-1.23-3.34-2.78-4.57-4.57l10.18-8.13L.31,20.78c-.2-1.05-.31-2.13-.31-3.23s.11-2.18.31-3.23l12.94,1.45L3.07,7.64c1.23-1.79,2.78-3.34,4.57-4.57l8.13,10.18L14.32.31c1.05-.2,2.13-.31,3.23-.31s2.18.11,3.23.31l-1.45,12.94L27.46,3.07c1.79,1.23,3.34,2.78,4.57,4.57l-10.18,8.13,12.94-1.45c.2,1.05.31,2.13.31,3.23s-.11,2.18-.31,3.23l-12.94-1.45Z"/>
          <path class="text" d="M29.19,36.57c-8.68.11-14.62,4.86-14.62,12.7v12.73h5.96v-11.87c0-6.19,4.81-8.33,10.18-7.58l-1.52-5.98Z"/></g>
        </svg>
      </div>
    </div>
  </div>
</article>
<article>
  <div class="ttl__top border-bottom fadeIn">
    <h2 class="fadeUp">News<span>お知らせ</span></h2>
    <div class="btn__more fr mt25 fadeUp"><a href="<?php echo esc_url(home_url('/archive/')); ?>">More</a></div>
  </div>
  <div class="news">
    <dl class="news__textbox">

      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

      <div class="line-item">
        <dt class="fadeUp">
          <?php echo get_the_date('Y.m.d') ;?>
          <span><?php $cat = get_the_category(); $cat = $cat[0]; { echo $cat->name; } ?></span>
        </dt>
        <?php if (get_the_title()) : ?>
        <dd data-img="<?php the_post_thumbnail_url('large'); ?>" class="fadeUp">
          <a href="<?php the_permalink(); ?>"><?php echo get_the_title() ;?></a>
        </dd>
        <?php endif; ?>
        <div class="line-wrapper"></div>
      </div>

      <?php endwhile; ?>

      <?php wp_reset_postdata(); ?>
          <?php else: ?>
          <?php endif; ?>

    </dl>
    <div class="news__imgbox">
      <img src="<?php echo get_template_directory_uri(); ?>/images/news_top_thumbnail.jpg" alt="アスターハウス" id="newsImage">
    </div>
  </div>
</article>

<article>
  <div class="ttl__top border-bottom fadeIn">
    <h2 class="fadeUp">SNS<span>最新の住宅情報を発信</span></h2>
  </div>
  <div class="top__sns">
    <li class="fadeIn">
      <h3 class="top__youtube fadeUp">Youtube</h3>
      <div class="icon fadeUp"><img src="<?php echo get_template_directory_uri(); ?>/images/icon_top_youtube.svg" alt=""></div>
      <div class="sns__textbox fadeUp">
        <p>モデルハウスや施主様のお宅を5分<br>程度のルームツアー動画で公開中！</p>
        <div class="btn__top__sns fr"><a href="https://www.youtube.com/channel/UCoIVR-wyZFAeAOx5vTYoVxw" target="_blank">ユーチューブ</a></div>
      </div>
      <div class="thumbnail fadeIn">
        <iframe width="100%" height="315" src="https://www.youtube.com/embed/?list=UUoIVR-wyZFAeAOx5vTYoVxw" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen>
        </iframe>
      </div>
    </li>
    <li class="fadeIn">
      <h3 class="top__insta fadeUp">Instagram</h3>
      <div class="icon fadeUp"><img src="<?php echo get_template_directory_uri(); ?>/images/icon_top_insta.svg" alt=""></div>
      <div class="sns__textbox fadeUp">
        <p>モデルハウスや施主様のお宅<br class="sp">を投稿<br class="pc">写真やストーリーで公開！</p>
        <div class="btn__top__sns fr"><a href="https://www.instagram.com/__aster_house" target="_blank">インスタグラム</a></div>
      </div>
      <div class="insta__grid fadeIn">
          <?php echo do_shortcode('[instagram-feed feed=1]'); ?>
      </div>
    </li>
  </div>
</article>

<article>
  <div class="catch">
    <h2 class="fadeUp"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.svg" alt="アスターハウス"></h2>
    <p class="fadeUp">理想のデザインを最適なコストで。<span class="fadeUp">Your ideal design house at the best cost.</span></p>
  </div>
</article>

<?php get_footer(); ?>