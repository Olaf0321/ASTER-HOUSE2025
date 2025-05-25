<?php
    get_header();
    $queried_cat = get_queried_object(); // 現在のカテゴリ情報
?>

    <div class="ttl fadeIn">
        <h2 class="fadeUp">News<span>お知らせ</span></h2>
    </div>

    <article>
        <ul class="news__category">
            <li class="fadeUp">
                <a href="<?php echo esc_url(home_url('/news/')); ?>">全て</a>
            </li>

            <?php
            // 投稿カテゴリーを取得
            $cats = get_categories( array(
                'taxonomy'   => 'category',
                'hide_empty' => false,    // 投稿がゼロでも表示する場合
                'orderby'    => 'term_order',
                'order'      => 'ASC',
            ) );

            // 各カテゴリーをループして出力
            foreach ( $cats as $cat ) : ?>
                <li class="fadeUp">
                    <a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>">
                        <?php echo esc_html( $cat->name ); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </article>

    <article>
        <div class="news__archive">
            <?php if ( have_posts() ) : ?>
                <?php while ( have_posts() ) : the_post(); ?>
                
                <div class="line-item">
                <dt class="fadeUp">
                    <div class="date"><?php echo get_the_date('Y.m.d'); ?></div>
                    <div class="news__cat">
                    <?php
                        $cats = get_the_category();
                        echo ! empty( $cats ) ? esc_html( $cats[0]->name ) : '';
                    ?>
                    </div>
                </dt>
                <dd class="fadeUp">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </dd>
                <div class="line-wrapper"></div>
                </div>
            <?php endwhile; ?>
        </div>

        <div class="page__nav fadeUp">

            <!-- <?php the_posts_pagination(); ?> -->

            <nav class="navigation pagination" role="navigation" aria-label="投稿">
                <div class="nav-links">
                    <a class="prev page-numbers" href="archive-news.html"></a>
                    <span aria-current="page" class="page-numbers current">1</span>
                    <a class="page-numbers" href="archive-news.html">2</a>
                    <a class="page-numbers" href="archive-news.html">3</a>
                    <a class="page-numbers" href="archive-news.html">4</a>
                    <a class="page-numbers" href="archive-news.html">5</a>
                    <!-- <a class="page-numbers" href="archive-news.html">...</a> -->
                    <a class="next page-numbers" href="archive-news.html"></a>
                </div>
            </nav> 

            <?php else: ?>
            <p>現在、公開中の投稿はありません。</p>
            <?php endif; ?>
        </div>

    </article>

    <article>
        <div class="ttl__page mt0 fadeIn">
            <h2 class="fadeUp">Sell<span>販売中物件・土地情報</span></h2>
            <div class="btn__more fr mt30 fadeUp"><a href="archive-sell.html">More</a></div>
        </div>
        <div class="top__card_wrapper fadeIn">
            <div class="sell__card" id="slider">
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
    </article>

    <article>
        <div class="ttl__page border-bottom fadeIn">
            <h2 class="fadeUp">SNS<span>最新の住宅情報を発信</span></h2>
        </div>
        <div class="top__sns">
            <li class="fadeIn">
                <h3 class="top__youtube">Youtube</h3>
                <div class="icon fadeUp"><img src="images/icon_top_youtube.svg" alt=""></div>
                <div class="sns__textbox">
                    <p>モデルハウスや施主様のお宅を5分<br>程度のルームツアー動画で公開中！</p>
                    <div class="btn__top__sns fr"><a href="https://www.youtube.com/channel/UCoIVR-wyZFAeAOx5vTYoVxw" target="_blank">ユーチューブ</a></div>
                </div>
                <div class="thumbnail">
                    <iframe 
                        width="100%" 
                        height="315" 
                        src="https://www.youtube.com/embed/?list=UUoIVR-wyZFAeAOx5vTYoVxw" 
                        title="YouTube video player" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                        allowfullscreen class="fadeUp">
                    </iframe>
                </div>    
            </li>
            <li class="fadeIn">
                <h3 class="top__insta">Instagram</h3>
                <div class="icon fadeUp"><img src="images/icon_top_insta.svg" alt=""></div>
                <div class="sns__textbox">
                    <p>モデルハウスや施主様のお宅を投稿<br>写真やストーリーで公開！</p>
                    <div class="btn__top__sns fr"><a href="https://www.instagram.com/__aster_house" target="_blank">インスタグラム</a></div>
                </div>
                <div class="thumbnail">
                    <div id="instagram-feed" class="instagram-grid"></div>
                </div>
            </li>
        </div>
    </article>

<?php get_footer(); ?>