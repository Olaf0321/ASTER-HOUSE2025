<?php get_header(); ?>

<div class="ttl fadeIn">
    <h2 class="fadeUp">News<span>お知らせ</span></h2>
</div>

<article>
    <ul class="news__category">
        <li class="fadeUp"><a href="<?php echo esc_url( home_url('/news/') ); ?>">全て</a></li>
        <?php
        $cats = get_categories([
            'taxonomy'   => 'category',
            'hide_empty' => false,
            'orderby'    => 'term_order',
            'order'      => 'ASC',
        ]);
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
        <?php
        // ページャー対応
        $paged = max( 1, get_query_var('paged', 1) );
        $posts_per_page = wp_is_mobile() ? 5 : 10;

        // 投稿クエリ（これだけ）
        $q = new WP_Query([
            'post_type'           => 'post',
            'posts_per_page'      => $posts_per_page,
            'paged'               => $paged,
            'ignore_sticky_posts' => true,
        ]);

        if ( $q->have_posts() ) :
            echo '<dl>';
            while ( $q->have_posts() ) : $q->the_post(); ?>
                <div class="line-item">
                    <dt class="fadeUp">
                        <div class="date"><?php echo get_the_date('Y.m.d'); ?></div>
                        <div class="news__cat">
                            <?php
                            $post_cats = get_the_category();
                            echo ! empty( $post_cats ) ? esc_html( $post_cats[0]->name ) : '';
                            ?>
                        </div>
                    </dt>
                    <dd class="fadeUp">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </dd>
                    <div class="line-wrapper"></div>
                </div>
            <?php
            endwhile;
            echo '</dl>';

            // ページネーション
            $big   = 999999999;
            $pages = paginate_links([
                'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format'    => 'page/%#%/',
                'current'   => $paged,
                'total'     => $q->max_num_pages,
                'prev_text' => '<img src="' . get_template_directory_uri() . '/images/icon_pagenavi_prev.svg" alt="前へ">',
                'next_text' => '<img src="' . get_template_directory_uri() . '/images/icon_pagenavi_next.svg" alt="次へ">',
                'type'      => 'array',
                'end_size'  => 1,
                'mid_size'  => 2,
            ]);

            if ( is_array( $pages ) ) : ?>
                <div class="page__nav fadeUp">
                    <nav class="navigation pagination" role="navigation" aria-label="投稿">
                        <div class="nav-links">
                            <?php
                            foreach ( $pages as $page_html ) {
                                // your CSS 前提のクラスをマークアップに追加
                                $page_html = str_replace(
                                    [ '<a ', '<span ' ],
                                    [ '<a class="page-numbers" ', '<span class="page-numbers current" ' ],
                                    $page_html
                                );
                                echo $page_html;
                            }
                            ?>
                        </div>
                    </nav>
                </div>
            <?php
            endif;

            wp_reset_postdata();

        else :
            echo '<p>現在、公開中のニュースはありません。</p>';
        endif;
        ?>
    </div>
</article>
    <article>
        <div class="ttl__page mt0 fadeIn">
            <h2 class="fadeUp">Sell<span>販売中物件・土地情報</span></h2>
            <div class="btn__more fr mt25 fadeUp"><a href="<?php echo esc_url(home_url('/property/')); ?>">More</a></div>
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
                <div class="insta__grid fadeIn">
                    <?php echo do_shortcode('[instagram-feed feed=1]'); ?>
                </div>
            </li>
        </div>
    </article>

<?php get_footer(); ?>