<?php get_header(); ?>

    <div class="ttl fadeIn">
        <h2 class="fadeUp">Sell<span>販売中物件・土地情報</span></h2>
    </div>


    <article>
        <ul class="archive__sell__card" id="sell-list">

            <?php
            // カスタムタクソノミー property_category で絞り込む
            $args = array(
            'post_type'      => 'property',
            'posts_per_page' => -1,
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
            <li class="fadeIn">
                <a href="<?php the_permalink(); ?>">
                <!-- code -->
                <?php if ( $codes = get_field('code') ): ?>
                    <div class="code">
                    <?= esc_html( $codes['code01'] ) ?>
                    <span class="roboto"><?= esc_html( $codes['code02'] ) ?></span>
                    </div>
                <?php endif; ?>

                <!-- scale & address -->
                <div class="scale">
                    <?= esc_html( get_field('scale') ) ?>　｜　
                    <?php if ( $addr = get_field('address') ): ?>
                    <span><?= esc_html( $addr['address1'] ) ?></span>
                    <?php endif; ?>
                </div>

                <!-- thumbnail -->
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
        <!-- <div class="more"><button id="more-button">もっと見る</button></div> -->
    </article>

    <article>
        <h2 class="h2_ttl fadeUp">Our strength<span>アスターハウスの強み</span></h2>
        <div class="strength-container">
            <button class="arrow arrow-left sp"></button>
            <ul class="strength" id="strengthSlider">
                <li>
                    <h3 class="fadeUp">Design<span class="fadeIn">デザイン</span></h3>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/strength_design.svg" alt="デザイン" class="ml20 fadeIn">
                    <p class="fadeUp">お客様のライフスタイルに合わせた柔軟なデザインに対応します。シンプルモダンからナチュラルテイストまで、幅広いデザインをご提案します。</p>
                </li>
                <li>
                    <h3 class="fadeUp">Cost<span class="fadeIn">コストパフォーマンス</span></h3>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/strength_cost.svg" alt="コスパ" class="fadeIn">
                    <p class="fadeUp">デザインとコストのバランスにこだわり、お客様の要望に沿った理想の家づくりを最適な価格で提供します。</p>
                </li>
                <li>
                    <h3 class="fadeUp">Hearing<span class="fadeIn">ヒアリング</span></h3>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/strength_hearing.svg" alt="ヒアリング" class="fadeIn">
                    <p class="fadeUp">理想の住まいを実現するために、丁寧なヒアリングを大切にしています。疑問や不安を解消しながら進められるよう、お客様が納得できるまで丁寧にサポートします。</p>
                </li>
            </ul>
            <button class="arrow arrow-right sp"></button>
        </div>
        <div class="dots" id="dots"></div>
    </article>

    <article>
        <h2 class="h2_ttl">After service<span>アフターサービス</span></h2>
        <div class="wrapper__p0">
            <div class="after__contents">
                <div class="tabs__after">
                    <!-- Tab 1 -->
                    <div class="tab_item_wrapper">
                        <input id="inspection" type="radio" name="tab_item" checked>
                        <label class="tab_item" for="inspection">1</label>
                        <div class="tab_content" id="inspection_content">
                            <div class="tab_content_description">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/afterservice01.jpg" alt="定期点検" class="fadeIn">
                                <h3 class="fadeUp">定期点検</h3>
                                <p class="fadeUp">入居後も住宅の安全を確認するため、一定期間ごとに専門スタッフが点検。長く快適に暮らせるようサポートします。</p>
                            </div>
                        </div>
                    </div>
                    <!-- Tab 2 -->
                    <div class="tab_item_wrapper">
                        <input id="defects" type="radio" name="tab_item">
                        <label class="tab_item" for="defects">2</label>
                        <div class="tab_content" id="defects_content">
                            <div class="tab_content_description">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/afterservice02.jpg" alt="瑕疵保証" class="fadeIn">
                                <h3 class="fadeUp">瑕疵保険（10年）</h3>
                                <p class="fadeUp">入居後も住宅の安全を確認するため、一定期間ごとに専門スタッフが点検。長く快適に暮らせるようサポートします。</p>
                            </div>
                        </div>
                    </div>
                    <!-- Tab 3 -->
                    <div class="tab_item_wrapper">
                        <input id="ground" type="radio" name="tab_item">
                        <label class="tab_item" for="ground">3</label>
                        <div class="tab_content" id="ground_content">
                            <div class="tab_content_description">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/afterservice03.jpg" alt="地盤保証" class="fadeIn">
                                <h3 class="fadeUp">地盤保証</h3>
                                <p class="fadeUp">建築前の地盤調査を実施し、不同沈下などのリスクに対応。万が一問題が発生した場合は補修費用を保証します。</p>
                            </div>
                        </div>
                    </div>
                    <!-- Tab 4 -->
                    <div class="tab_item_wrapper">
                        <input id="facility" type="radio" name="tab_item">
                        <label class="tab_item" for="facility">4</label>
                        <div class="tab_content" id="facility_content">
                            <div class="tab_content_description">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/afterservice04.jpg" alt="設備保証" class="fadeIn">
                                <h3 class="fadeUp">設備保証（有償）</h3>
                                <p class="fadeUp">キッチン・給湯器・エアコンなどの住宅設備の故障に対応。保証を追加することで修理費の負担を軽減できます。</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>

    <article id="consul">
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
                    <div class="btn__rounded mt20 fadeUp">
                        <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">相談希望の方はこちら</a>
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