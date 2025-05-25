<?php get_header(); ?> 

<body>

    <div class="ttl fadeIn">
        <h2 class="fadeUp">News<span>お知らせ</span></h2>
    </div>


    <article>
        <div class="news__single">
            <div class="textbox__news">
                <div class="date fadeUp"><?php the_time('Y.m.d'); ?></div>
                <div class="news__category fadeUp">物件情報</div>

                <h3 class="fadeUp"><?php echo get_the_title() ;?></h3>
                <p class="fadeUp"><?php echo get_the_content() ;?></p>

                <?php
                    $detail_url = get_field( 'link' );
                    if ( $detail_url ) :
                    ?>
                        <div class="btn__detail fadeUp">
                            <a href="<?php echo esc_url( $detail_url ); ?>" rel="noopener"> 物件詳細はこちら</a>
                        </div>
                    <?php
                    endif;
                    ?>

                <div class="btn__rounded__small fr fadeUp"><a href="<?php echo esc_url(home_url('/news/')); ?>">一覧に戻る</a></div>
            </div>
            <div class="imgbox__news">
                <?php
                    if ( has_category( 'land' ) ) :
                    // device width ≤768px なら SP用、そうでなければ 通常画像 を出力
                ?>
                    <picture>
                    <!-- スマホ用（768px 以下） -->
                    <source
                        media="(max-width: 768px)"
                        srcset="<?php echo get_template_directory_uri(); ?>/images/news_top_thumbnail_land_sp.jpg"
                    >
                    <!-- それ以外は通常用 -->
                    <img
                        src="<?php echo get_template_directory_uri(); ?>/images/news_top_thumbnail_land.jpg"
                        alt="<?php echo esc_attr( get_the_title() ); ?>"
                        class="fadeIn"
                    >
                    </picture>
                <?php
                    elseif ( has_post_thumbnail() ) :
                    // カテゴリ land 以外でアイキャッチがあればそれを出力
                    $url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
                ?>
                    <img src="<?php echo esc_url( $url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" class="fadeIn">
                <?php
                    else :
                    // アイキャッチもなく land でもない場合
                ?>
                    <img
                        src="<?php echo get_template_directory_uri(); ?>/images/news_top_thumbnail.jpg"
                        alt="<?php echo esc_attr( get_the_title() ); ?>"
                        class="fadeIn"
                    >
                <?php endif; ?>
            </div>
        </div>
    </article>

    <article>
        <h2 class="h2_ttl fadeUp">Consultation<span>家づくり相談会</span></h2>
        <div class="consul">
            <div class="imgbox__consul">
                <img src="<?php echo get_template_directory_uri(); ?>/images/consul.jpg" alt="家づくり相談会" class="fadeIn">
                <div class="icon_free">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/icon_consulfree.svg" alt="相談無料" class="fadeIn">
                </div>
            </div>
            <div class="relative">
                <div class="imgbox__consul02">
                    <object data="<?php echo get_template_directory_uri(); ?>/images/consul_ani.svg" type="image/svg+xml" class="fadeIn"></object>
                    <div class="btn__rounded mt20 fadeIn">
                        <a href="contact.html">相談希望の方はこちら</a>
                    </div>
                </div>
                <div class="textbox__consul">
                    <h3 class="fadeUp">アスターハウスでは<br>
                        家づくり相談会を実施しています</h3>
                    <p class="fadeUp">「初めての家づくりで不安…」<br>
                        「何から始めていいか分からない…」<br><br>
                        どんな方でも気軽に参加できる無料の相談会です。資料だけではわからない家づくりの
                        様々な疑問や不明点、心配事にアスターハウスのスタッフが直接お答えいたします！</p>
                </div>        
            </div>
        </div>
    </article>

<?php get_footer(); ?>