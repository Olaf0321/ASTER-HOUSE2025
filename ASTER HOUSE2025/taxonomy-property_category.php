<?php get_header(); ?> 

    <div class="ttl fadeIn">
        <h2 class="fadeUp">Sell<span>販売中物件・土地情報</span></h2>
    </div>

    <?php if ( have_posts() ) : ?>

    <article>
        <div class="archive__sell__card" id="sell-list">

            <?php while ( have_posts() ) : the_post(); ?>
            <li class="fadeIn">
                <a href="<?php the_permalink(); ?>">
                    <?php 
                        $codes = get_field('code');
                        if ( ! empty( $codes ) ): ?>
                        <div class="code">
                            <?php 
                            echo esc_html( $codes['code01'] ); 
                            ?>
                            <span class="roboto">
                            <?php echo esc_html( $codes['code02'] ); ?>
                            </span>
                        </div>
                    <?php endif; ?>
                    <div class="scale">
                        <?php echo esc_html( get_field('scale') ); ?>　｜　
                        <span>
                            <?php 
                                $address = get_field('address');
                                if ( ! empty( $address ) ): ?>
                                    <?php echo esc_html( $address['address1'] );
                                endif;
                            ?>
                        </span>
                    </div>
                    <div class="thumbnail">
                        <?php if ( has_post_thumbnail() ): ?>
                            <?php 
                            the_post_thumbnail( 'medium', [
                                'alt'     => get_the_title(),
                                'loading' => 'lazy',
                            ] );
                            ?>
                        <?php endif; ?>
                    </div>
                    <h3><?php echo esc_html( get_field('title') ); ?></h3>
                    <div class="build">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/icon_sell_build.svg" alt="建売">
                        <p class="price roboto"><?php echo esc_html( get_field('price') ); ?><span>万円</span></p>
                    </div>    
                </a>
            </li>
            <li class="fadeIn">
                <a href="single-sell-land.html">
                    <div class="code">CM<span class="roboto">002</span></div>
                    <div class="scale">約30坪　｜　<span>札幌市東区</span></div>
                    <div class="thumbnail"><img src="images/thumb_card_land.svg" alt=""></div>
                    <h3>宮の森2条9丁目 2区画</h3>
                    <div class="land">
                        <img src="images/icon_sell_land.svg" alt="売土地">
                        <p class="price roboto">2,498<span>万円</span></p>
                    </div>
                </a>
            </li>
            <li class="fadeIn">
                <a href="single-sell-model.html">
                    <div class="code">SH<span class="roboto">003</span></div>
                    <div class="scale">4LDK　｜　<span>札幌市東区</span></div>
                    <div class="thumbnail"><img src="images/sell03.jpg" alt=""></div>
                    <h3>サイディングと木羽目板で演出する。<br>ナチュラルテイストの家</h3>
                    <div class="model">
                        <img src="images/icon_sell_model.svg" alt="モデルハウス">
                        <p class="price roboto">2,300<span>万円</span></p>
                    </div>
                </a>
            </li>
            <?php endwhile; ?>
        </div>
        <!-- <div class="more"><button id="more-button">もっと見る</button></div> -->
    </article>

    <?php else : ?>
        <p>該当する物件がありません。</p>
    <?php endif; ?>

    <article>
        <h2 class="h2_ttl fadeUp">Our strength<span>アスターハウスの強み</span></h2>
        <div class="strength-container">
            <button class="arrow arrow-left sp"></button>
            <ul class="strength" id="strengthSlider">
                <li>
                    <h3 class="fadeUp">Design<span class="fadeIn">デザイン</span></h3>
                    <img src="images/strength_design.svg" alt="デザイン" class="ml20 fadeIn">
                    <p class="fadeUp">お客様のライフスタイルに合わせた柔軟なデザインに対応します。シンプルモダンからナチュラルテイストまで、幅広いデザインをご提案します。</p>
                </li>
                <li>
                    <h3 class="fadeUp">Cost<span class="fadeIn">コストパフォーマンス</span></h3>
                    <img src="images/strength_cost.svg" alt="コスパ" class="fadeIn">
                    <p class="fadeUp">デザインとコストのバランスにこだわり、お客様の要望に沿った理想の家づくりを最適な価格で提供します。</p>
                </li>
                <li>
                    <h3 class="fadeUp">Hearing<span class="fadeIn">ヒアリング</span></h3>
                    <img src="images/strength_hearing.svg" alt="ヒアリング" class="fadeIn">
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
                                <img src="images/afterservice01.jpg" alt="定期点検" class="fadeIn">
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
                                <img src="images/afterservice02.jpg" alt="瑕疵保証" class="fadeIn">
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
                                <img src="images/afterservice03.jpg" alt="地盤保証" class="fadeIn">
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
                                <img src="images/afterservice04.jpg" alt="設備保証" class="fadeIn">
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
                <img src="images/consul.jpg" alt="家づくり相談会" class="fadeIn">
                <div class="icon_free">
                    <img src="images/icon_consulfree.svg" alt="相談無料" class="fadeIn">
                </div>
            </div>
            <div class="relative">
                <div class="imgbox__consul02">
                    <object data="images/consul_ani.svg" type="image/svg+xml" class="fadeIn"></object>
                    <div class="btn__rounded mt20 fadeUp">
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