<?php get_header(); ?> 

    <div class="ttl fadeIn">
        <h2 class="fadeUp">Sell<span>販売中の物件</span></h2>
    </div>

    <article>
        <div class="single__sell">

            <?php
                $terms = get_the_terms( get_the_ID(), 'property_category' );
                $cat_slug = '';
                if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                    // 最初のタームのスラッグを使う場合
                    $cat_slug = $terms[0]->slug;
                }
            ?>

            <?php if ( $cat_slug === 'land' ) : ?>
                <div class="thumbnail__land">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <?php
                            the_post_thumbnail(
                                'medium',
                                [
                                    'alt'     => get_the_title(),
                                    'loading' => 'lazy',
                                    'class'   => 'relative facade_img fadeIn',
                                ]
                            );
                        ?>
                    <?php endif; ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/icon_land01.svg" alt="売り土地" class="icon__land01 fadeUp">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/icon_land02.svg" alt="土地情報" class="icon__land02 fadeUp">
                </div>

            <?php else: ?>
                <div class="thumbnail fadeIn">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <?php
                            the_post_thumbnail(
                                'medium',
                                [
                                    'alt'     => get_the_title(),
                                    'loading' => 'lazy',
                                    'class'   => 'fadeIn facade_img',
                                ]
                            );
                        ?>
                    <?php endif; ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/icon_facade.svg" alt="外観" class="icon__facade fadeIn">
                </div>

            <?php endif; ?>

            <div class="wrapper__single__sell">
                <div class="sell__info">
                    <p class="fadeUp">
                        <?= esc_html( get_field('scale') ) ?> | 
                        <?php if ( $addr = get_field('address') ): ?>
                            <?= esc_html( $addr['address1'] ) ?><?= esc_html( $addr['address2'] ) ?>
                        <?php endif; ?>
                    </p>
                    <?php if ( $codes = get_field('code') ): ?>
                        <h2 class="roboto fadeUp">
                            <?= esc_html( $codes['code01'] ) ?><?= esc_html( $codes['code02'] ) ?>
                        </h2>
                    <?php endif; ?>
                    <div class="sell__tag fadeUp">
                        <?php
                            $raw = get_field('property_hashtag');  // テキストエリアで入力した値を取得
                            if( ! empty($raw) ){
                                // カンマ・空白・改行で分割して配列化
                                $tags = preg_split('/[\s,]+/', $raw, -1, PREG_SPLIT_NO_EMPTY);

                                foreach( $tags as $tag ) {
                                    echo '<li>' . esc_html($tag) . '</li>'; // １つずつ <li> で出力
                                }
                            }
                        ?>
                    </div>
                    <h3 class="fadeUp"><?= esc_html( get_field('title') ) ?></h3>
                    <p class="justify fadeUp"><?= esc_html( get_field('comment') ) ?></p>
                </div>
                
                <?php
                    $terms = get_the_terms( get_the_ID(), 'property_category' );
                    $cat_slug = '';
                    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                        // 最初のタームのスラッグを使う場合
                        $cat_slug = $terms[0]->slug;
                    }
                    $price = get_field( 'price' );
                ?>

                <?php if ( $cat_slug === 'sell' ) : ?>
                    <div class="sell__price">
                        <p class="fadeUp"><?= esc_html( $price ) ?><span>万円</span></p>
                        <p class="notion fadeUp pc">※価格は本体工事のみです。</p>
                    </div>
                <?php elseif ( $cat_slug === 'model' ) : ?>
                    <div class="sell__model fadeIn">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/icon_model.svg" alt="モデルハウス">
                    </div>
                <?php elseif ( $cat_slug === 'land' ) : ?>
                    <div class="sell__price__land fadeUp">
                        <p class="fadeUp"><?= esc_html( $price ) ?><span>万円</span></p>
                    </div>    
                <?php endif; ?>
            </div>


            <?php
                $terms = get_the_terms( get_the_ID(), 'property_category' );
                $cat_slug = '';
                if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                    // 最初のタームのスラッグを使う場合
                    $cat_slug = $terms[0]->slug;
                }
            ?>

            <?php if ( $cat_slug === 'land' ) : ?>
                <article>
                    <h2 class="h2_ttl fadeUp">Spec<span>仕様詳細</span></h2>
                    <div class="sell__spec">
                        <div class="textbox__sell__spec">
                            <?php if ( $codes = get_field('land_group') ): ?>

                                <dl class="sell__spec__area">
                                    <div class="line-item">
                                        <dt class="fadeUp fadeUp">土地面積</dt>
                                        <dd class="meters fadeUp"><?= esc_html( $codes['land_area'] ) ?></dd>
                                        <dd class="tsubo fadeUp"></dd>
                                        <div class="line-wrapper"></div>
                                    </div>
                                    <script>
                                        // 坪数の演算（小数第2位まで）
                                        let metersElements = document.querySelectorAll(".meters");
                                        let tsuboElements = document.querySelectorAll(".tsubo");

                                        // metersとtsuboの数が同じか確認して処理
                                        if (metersElements.length === tsuboElements.length) {
                                            metersElements.forEach((metersElement, index) => {
                                                let metersValue = parseFloat(metersElement.textContent);
                                                if (!isNaN(metersValue)) {
                                                    let tsuboValue = (metersValue * 0.3025).toFixed(2); // 小数点2桁まで表示
                                                    tsuboElements[index].textContent = tsuboValue;
                                                }
                                            });
                                        }
                                    </script>

                                    <div class="line-item">
                                        <dt class="fadeUp">用途地域</dt>
                                        <dd class="spec100 fadeUp"><?= esc_html( $codes['zoning'] ) ?></dd>
                                        <div class="line-wrapper"></div>
                                    </div>
                                    <div class="line-item">
                                        <dt class="fadeUp">備考</dt>
                                        <dd class="spec100 fadeUp"><?= esc_html( $codes['note'] ) ?></dd>
                                        <div class="line-wrapper"></div>
                                    </div>
                                </dl>
                            <?php endif; ?>

                        </div>
                        <div class="imgbox__sell__spec">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/spec.svg" alt="仕様">
                        </div>
                    </div>    
                </article>

            <?php else: ?>
                
            <article>
                <div class="wrapper__p0">
                    <div class="interior__contents">
                        <div class="icon__interior fadeIn">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/icon_interior.svg" alt="内観" class="icon__ionterior">
                        </div>
                        <div class="tabs__interior">

                            <?php if ( $codes = get_field('point1') ): ?>
                            <!-- Tab 1 -->
                                <div class="tab_item_wrapper">
                                    <input id="p1" type="radio" name="tab_item_interior" checked>
                                    <label class="tab_item roboto" for="p1">1</label>
                                    <div class="tab_content" id="p1_content">
                                        <div class="tab_content_description">
                                            <?php /*--画像--*/
                                                $codes = get_field( 'point1' );

                                                if ( ! empty( $codes['point1_image'] ) ) {
                                                    $img = $codes['point1_image'];

                                                    if ( is_array( $img ) ) {
                                                        // ACF の返り値が「配列」の場合
                                                        $url = $img['url'];
                                                        $alt = $img['alt'];
                                                    }
                                                ?>
                                                    <img
                                                        src="<?= esc_url( $url ); ?>"
                                                        alt="<?= esc_attr( $alt ); ?>"
                                                        class="fadeIn"
                                                    >
                                            <?php
                                                }
                                            ?>
                                            <div class="icon__point pc">
                                                <img src="<?php echo get_template_directory_uri(); ?>/images/icon_interior_point01.svg" alt="" class="fadeIn">
                                            </div>
                                            <div class="icon__point sp">
                                                <img src="<?php echo get_template_directory_uri(); ?>/images/icon_interior_point01_sp.svg" alt="" class="fadeIn">
                                            </div>
                                            <div class="sell__interior__tag fadeUp">
                                                <?php
                                                    // point1 グループ内のサブフィールド名に合わせる
                                                    $raw = isset($codes['point1_hashtag']) ? $codes['point1_hashtag'] : '';

                                                    if( $raw ){
                                                    // カンマ・空白・改行で分割
                                                    $tags = preg_split('/[\s,]+/', $raw, -1, PREG_SPLIT_NO_EMPTY);

                                                    echo '<ul>';
                                                    foreach( $tags as $tag ){
                                                        $tag = ltrim( $tag, '#' );
                                                        echo '<li>'. esc_html($tag) .'</li>';
                                                    }
                                                    echo '</ul>';
                                                    }
                                                ?>
                                            </div>        
                                            <h3 class="fadeUp"><?= esc_html( $codes['point1_title'] ) ?></h3>
                                            <p class="fadeUp"><?= esc_html( $codes['point1_comment'] ) ?></p>    
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if ( $codes = get_field('point2') ): ?>
                                <!-- Tab 2 -->
                                <div class="tab_item_wrapper">
                                    <input id="p2" type="radio" name="tab_item_interior">
                                    <label class="tab_item" for="p2">2</label>
                                    <div class="tab_content" id="p2_content">
                                        <div class="tab_content_description">
                                            <?php /*--画像--*/
                                                $codes = get_field( 'point2' );

                                                if ( ! empty( $codes['point2_image'] ) ) {
                                                    $img = $codes['point2_image'];

                                                    if ( is_array( $img ) ) {
                                                        // ACF の返り値が「配列」の場合
                                                        $url = $img['url'];
                                                        $alt = $img['alt'];
                                                    }
                                                ?>
                                                    <img
                                                        src="<?= esc_url( $url ); ?>"
                                                        alt="<?= esc_attr( $alt ); ?>"
                                                        class="fadeIn"
                                                    >
                                            <?php
                                                }
                                            ?>
                                            <div class="icon__point pc">
                                                <img src="<?php echo get_template_directory_uri(); ?>/images/icon_interior_point02.svg" alt="" class="fadeIn">
                                            </div>
                                            <div class="icon__point sp">
                                                <img src="<?php echo get_template_directory_uri(); ?>/images/icon_interior_point02_sp.svg" alt="" class="fadeIn">
                                            </div>
                                            <div class="sell__interior__tag fadeUp">
                                                <?php
                                                    // point1 グループ内のサブフィールド名に合わせる
                                                    $raw = isset($codes['point2_hashtag']) ? $codes['point2_hashtag'] : '';

                                                    if( $raw ){
                                                    // カンマ・空白・改行で分割
                                                    $tags = preg_split('/[\s,]+/', $raw, -1, PREG_SPLIT_NO_EMPTY);

                                                    echo '<ul>';
                                                    foreach( $tags as $tag ){
                                                        $tag = ltrim( $tag, '#' );
                                                        echo '<li>'. esc_html($tag) .'</li>';
                                                    }
                                                    echo '</ul>';
                                                    }
                                                ?>
                                            </div>        
                                            <h3 class="fadeUp"><?= esc_html( $codes['point2_title'] ) ?></h3>
                                            <p class="fadeUp"><?= esc_html( $codes['point2_comment'] ) ?></p>    
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                                
                            <?php if ( $codes = get_field('point3') ): ?>
                                <!-- Tab 3 -->
                                <div class="tab_item_wrapper">
                                    <input id="p3" type="radio" name="tab_item_interior">
                                    <label class="tab_item" for="p3">3</label>
                                    <div class="tab_content" id="p3_content">
                                        <div class="tab_content_description">
                                            <?php /*--画像--*/
                                                $codes = get_field( 'point3' );

                                                if ( ! empty( $codes['point3_image'] ) ) {
                                                    $img = $codes['point3_image'];

                                                    if ( is_array( $img ) ) {
                                                        // ACF の返り値が「配列」の場合
                                                        $url = $img['url'];
                                                        $alt = $img['alt'];
                                                    }
                                                ?>
                                                    <img
                                                        src="<?= esc_url( $url ); ?>"
                                                        alt="<?= esc_attr( $alt ); ?>"
                                                        class="fadeIn"
                                                    >
                                            <?php
                                                }
                                            ?>
                                            <div class="icon__point pc">
                                                <img src="<?php echo get_template_directory_uri(); ?>/images/icon_interior_point03.svg" alt="" class="fadeIn">
                                            </div>
                                            <div class="icon__point sp">
                                                <img src="<?php echo get_template_directory_uri(); ?>/images/icon_interior_point03_sp.svg" alt="" class="fadeIn">
                                            </div>
                                            <div class="sell__interior__tag fadeUp">
                                                <?php
                                                    // point1 グループ内のサブフィールド名に合わせる
                                                    $raw = isset($codes['point3_hashtag']) ? $codes['point3_hashtag'] : '';

                                                    if( $raw ){
                                                    // カンマ・空白・改行で分割
                                                    $tags = preg_split('/[\s,]+/', $raw, -1, PREG_SPLIT_NO_EMPTY);

                                                    echo '<ul>';
                                                    foreach( $tags as $tag ){
                                                        $tag = ltrim( $tag, '#' );
                                                        echo '<li>'. esc_html($tag) .'</li>';
                                                    }
                                                    echo '</ul>';
                                                    }
                                                ?>
                                            </div>        
                                            <h3 class="fadeUp"><?= esc_html( $codes['point3_title'] ) ?></h3>
                                            <p class="fadeUp"><?= esc_html( $codes['point3_comment'] ) ?></p>    
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                                
                            <?php if ( $codes = get_field('point4') ): ?>
                                <!-- Tab 4 -->
                                <div class="tab_item_wrapper">
                                    <input id="p4" type="radio" name="tab_item_interior">
                                    <label class="tab_item" for="p4">4</label>
                                    <div class="tab_content" id="p4_content">
                                        <div class="tab_content_description">
                                            <?php /*--画像--*/
                                                $codes = get_field( 'point4' );

                                                if ( ! empty( $codes['point4_image'] ) ) {
                                                    $img = $codes['point4_image'];

                                                    if ( is_array( $img ) ) {
                                                        // ACF の返り値が「配列」の場合
                                                        $url = $img['url'];
                                                        $alt = $img['alt'];
                                                    }
                                                ?>
                                                    <img
                                                        src="<?= esc_url( $url ); ?>"
                                                        alt="<?= esc_attr( $alt ); ?>"
                                                        class="fadeIn"
                                                    >
                                            <?php
                                                }
                                            ?>
                                            <div class="icon__point pc">
                                                <img src="<?php echo get_template_directory_uri(); ?>/images/icon_interior_point04.svg" alt="" class="fadeIn">
                                            </div>
                                            <div class="icon__point sp">
                                                <img src="<?php echo get_template_directory_uri(); ?>/images/icon_interior_point04_sp.svg" alt="" class="fadeIn">
                                            </div>
                                            <div class="sell__interior__tag fadeUp">
                                                <?php
                                                    // point1 グループ内のサブフィールド名に合わせる
                                                    $raw = isset($codes['point4_hashtag']) ? $codes['point4_hashtag'] : '';

                                                    if( $raw ){
                                                    // カンマ・空白・改行で分割
                                                    $tags = preg_split('/[\s,]+/', $raw, -1, PREG_SPLIT_NO_EMPTY);

                                                    echo '<ul>';
                                                    foreach( $tags as $tag ){
                                                        $tag = ltrim( $tag, '#' );
                                                        echo '<li>'. esc_html($tag) .'</li>';
                                                    }
                                                    echo '</ul>';
                                                    }
                                                ?>
                                            </div>        
                                            <h3 class="fadeUp"><?= esc_html( $codes['point4_title'] ) ?></h3>
                                            <p class="fadeUp"><?= esc_html( $codes['point4_comment'] ) ?></p>    
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                        </div>    
                    </div>
                </div>
            </article>
    
            <article>
                <h2 class="h2_ttl fadeUp">Drawing<span>住宅図面</span></h2>
                <div class="wrapper__p0">
                    <div class="drawing__contents">
                        <div class="tabs__drawing">

                        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                        <!-- ───────── Tab 1 ───────── -->
                        <?php 
                            $floor1 = get_field('floor_1', get_the_ID()) ?: [];
                            if ( $floor1 ) :
                        ?>
                            <div class="tab_item_wrapper">
                            <input id="f1" type="radio" name="tab_item_drawing" checked>
                            <label class="tab_item fadeIn" for="f1">1 F</label>
                            <div class="tab_content" id="f1_content">
                                <div class="tab_content_description">
                                <h3 class="fadeUp">1F information</h3>
                                <!-- 画像 -->
                                <div class="imgbox__drawing fadeIn">
                                    <?php
                                    if ( have_rows('floor_1') ) :
                                        while ( have_rows('floor_1') ) : the_row();
                                        $plan1 = get_sub_field('floor1_plan');
                                        if ( $plan1 ) :
                                            echo wp_get_attachment_image( $plan1['ID'], 'full', false, [ 'class'=>'fadeIn' ] );
                                        endif;
                                        endwhile;
                                    endif;
                                    ?>
                                </div>
                                <!-- テーブル -->
                                <dl class="sell__drawing__scale fadeUp">
                                    <?php 
                                    for ( $i = 1; $i <= 4; $i++ ) :
                                        $item1     = $floor1[ 'floor1_' . $i ] ?? [];
                                        $room1     = $item1[ 'room1_'   . $i ] ?? '';
                                        $size1     = $item1[ 'size1_'   . $i ] ?? '';
                                        $strage1   = $item1[ 'strage1_' . $i ] ?? '';
                                        $point1val = $item1[ 'point1_'  . $i ] ?? 'none';

                                        // アイコンクラス生成
                                        if ( $point1val !== 'none' ) {
                                        $num    = (int) filter_var( $point1val, FILTER_SANITIZE_NUMBER_INT );
                                        $icon   = get_template_directory_uri() . "/images/icon_drawing_point".sprintf('%02d',$num).".svg";
                                        $point1html = "<span class='point'><img src='".esc_url($icon)."' alt=''></span>";
                                        } else {
                                        $point1html = "<span class='point none'></span>";
                                        }
                                    ?>
                                    <div class="line-item">
                                        <dt><?= esc_html( $room1 ) ?></dt>
                                        <dd>
                                        <?= $point1html ?>
                                        <span class="scale"><?= esc_html( $size1 ) ?></span>/
                                        <span class="strage"><?= esc_html( $strage1 ) ?></span>
                                        </dd>
                                        <div class="line-wrapper"></div>
                                    </div>
                                    <?php endfor; ?>
                                </dl>
                                </div>
                            </div>
                            </div>
                        <?php endif; ?>


                        <!-- ───────── Tab 2 ───────── -->
                            <?php 
                                $floor2 = get_field('floor_2', get_the_ID()) ?: [];
                                if ( $floor2 ) :
                                // 画像フィールド（Array 返り値）
                                $plan2 = $floor2['floor2_plan'] ?? null;
                            ?>
                                <div class="tab_item_wrapper">
                                <input id="f2" type="radio" name="tab_item_drawing">
                                <label class="tab_item fadeIn" for="f2">2 F</label>
                                <div class="tab_content" id="f2_content">
                                    <div class="tab_content_description">
                                    <h3 class="fadeUp">2F information</h3>

                                    <!-- 画像 -->
                                    <div class="imgbox__drawing fadeIn">
                                        <?php if ( is_array($plan2) && ! empty($plan2['ID']) ) :
                                        echo wp_get_attachment_image( $plan2['ID'], 'full', false, [ 'class'=>'fadeIn' ] );
                                        endif; ?>
                                    </div>

                                    <!-- テーブル -->
                                    <dl class="sell__drawing__scale fadeUp">
                                        <?php for ( $i = 1; $i <= 4; $i++ ) :
                                        $item2     = $floor2[ 'floor2_' . $i ]   ?? [];
                                        $room2     = $item2[ 'room2_'   . $i ]   ?? '';
                                        $size2     = $item2[ 'size2_'   . $i ]   ?? '';
                                        $strage2   = $item2[ 'strage2_' . $i ]   ?? '';
                                        $point2val = $item2[ 'point2_'  . $i ]   ?? 'none';

                                        // アイコンHTML
                                        if ( $point2val !== 'none' ) {
                                            $num  = (int) filter_var( $point2val, FILTER_SANITIZE_NUMBER_INT );
                                            $icon = get_template_directory_uri()
                                                . sprintf('/images/icon_drawing_point%02d.svg', $num);
                                            $point2html = "<span class='point'>
                                                            <img src='".esc_url($icon)."' alt=''>
                                                        </span>";
                                        } else {
                                            $point2html = "<span class='point none'></span>";
                                        }
                                        ?>
                                        <div class="line-item">
                                            <dt><?= esc_html( $room2 ) ?></dt>
                                            <dd>
                                            <?= $point2html ?>
                                            <span class="scale"><?= esc_html( $size2 ) ?></span>/
                                            <span class="strage"><?= esc_html( $strage2 ) ?></span>
                                            </dd>
                                            <div class="line-wrapper"></div>
                                        </div>
                                        <?php endfor; ?>
                                    </dl>
                                    </div>
                                </div>
                                </div>
                            <?php endif; ?>


                            <?php
                            // ───────── Tab 3 ─────────
                            // 1) フィールド取得
                            $floor3 = get_field('floor_3', get_the_ID()) ?: [];

                            // 2) 表示フラグ初期化
                            $has_tab3 = false;

                            // 3) 画像フィールドにIDが入っていれば表示対象
                            if ( isset($floor3['floor3_plan']['ID']) && $floor3['floor3_plan']['ID'] ) {
                                $has_tab3 = true;
                            }

                            // 4) テーブル行いずれかに入力があれば表示対象
                            for ( $i = 1; $i <= 4; $i++ ) {
                                $item    = $floor3[ 'floor3_' . $i ]   ?? [];
                                $room3   = $item[ 'room3_'   . $i ]   ?? '';
                                $size3   = $item[ 'size3_'   . $i ]   ?? '';
                                $strage3 = $item[ 'strage3_' . $i ]   ?? '';
                                $point3  = $item[ 'point3_'  . $i ]   ?? 'none';

                                if ( $room3 !== '' || $size3 !== '' || $strage3 !== '' || $point3 !== 'none' ) {
                                    $has_tab3 = true;
                                    break;
                                }
                            }

                            // 5) フラグが true のときだけ Tab3 を出力
                            if ( $has_tab3 ) :
                            ?>
                            <div class="tab_item_wrapper">
                                <input id="f3" type="radio" name="tab_item_drawing">
                                <label class="tab_item fadeIn" for="f3">3 F</label>
                                <div class="tab_content" id="f3_content">
                                <div class="tab_content_description">
                                    <h3 class="fadeUp">3F information</h3>

                                    <!-- 画像 -->
                                    <div class="imgbox__drawing fadeIn">
                                    <?php
                                        if ( is_array($floor3['floor3_plan'] ?? null) && ! empty($floor3['floor3_plan']['ID']) ) {
                                        echo wp_get_attachment_image(
                                            $floor3['floor3_plan']['ID'],
                                            'full',
                                            false,
                                            [ 'class' => 'fadeIn' ]
                                        );
                                        }
                                    ?>
                                    </div>

                                    <!-- テーブル -->
                                    <dl class="sell__drawing__scale fadeUp">
                                    <?php for ( $i = 1; $i <= 4; $i++ ) :
                                        $item3     = $floor3[ 'floor3_' . $i ]   ?? [];
                                        $room3     = $item3[ 'room3_'   . $i ]   ?? '';
                                        $size3     = $item3[ 'size3_'   . $i ]   ?? '';
                                        $strage3   = $item3[ 'strage3_' . $i ]   ?? '';
                                        $point3val = $item3[ 'point3_'  . $i ]   ?? 'none';

                                        if ( $point3val !== 'none' ) {
                                            $num       = (int) filter_var( $point3val, FILTER_SANITIZE_NUMBER_INT );
                                            $icon_path = get_template_directory_uri()
                                                        . sprintf('/images/icon_drawing_point%02d.svg', $num);
                                            $point3html = "<span class='point'><img src='".esc_url($icon_path)."' alt=''></span>";
                                        } else {
                                            $point3html = "<span class='point none'></span>";
                                        }
                                    ?>
                                        <div class="line-item">
                                        <dt><?= esc_html( $room3 ) ?></dt>
                                        <dd>
                                            <?= $point3html ?>
                                            <span class="scale"><?= esc_html( $size3 ) ?></span>/
                                            <span class="strage"><?= esc_html( $strage3 ) ?></span>
                                        </dd>
                                        <div class="line-wrapper"></div>
                                        </div>
                                    <?php endfor; ?>
                                    </dl>
                                </div>
                                </div>
                            </div>
                            <?php endif; ?>

                            <?php endwhile; endif; ?>
                        </div>    
                    </div>
                </div>
            </article>


            <article>
                <h2 class="h2_ttl fadeUp">Spec<span>仕様詳細</span></h2>
                <div class="sell__spec">
                    <div class="textbox__sell__spec">

                        <?php if ( $codes = get_field('area') ): ?>
                        <dl class="sell__spec__area fadeUp">
                            <div class="line-item">
                                <dt>敷地面積</dt>
                                <dd class="meters"><?= esc_html( $codes['land_area'] ) ?></dd>
                                <dd class="tsubo"></dd>    
                                <div class="line-wrapper"></div>
                            </div>
                            <div class="line-item">
                                <dt>建物面積<span>1F</span></dt>
                                <dd class="meters"><?= esc_html( $codes['floor1_area'] ) ?></dd>
                                <dd class="tsubo"></dd>                                    
                                <div class="line-wrapper"></div>
                            </div>
                            <div class="line-item">
                                <dt><span>2F</span></dt>
                                <dd class="meters"><?= esc_html( $codes['floor2_area'] ) ?></dd>
                                <dd class="tsubo"></dd>                                    
                                <div class="line-wrapper"></div>
                            </div>
                            <div class="line-item">
                                <dt>延床面積</dt>
                                <dd class="meters"><?= esc_html( $codes['totalfloor_area'] ) ?></dd>
                                <dd class="tsubo"></dd>    
                                <div class="line-wrapper"></div>
                            </div>
                        </dl>
                        <?php endif; ?>

                        <script>
                            // 坪数の演算（小数第2位まで）
                            let metersElements = document.querySelectorAll(".meters");
                            let tsuboElements = document.querySelectorAll(".tsubo");
    
                            // metersとtsuboの数が同じか確認して処理
                            if (metersElements.length === tsuboElements.length) {
                                metersElements.forEach((metersElement, index) => {
                                    let metersValue = parseFloat(metersElement.textContent);
                                    if (!isNaN(metersValue)) {
                                        let tsuboValue = (metersValue * 0.3025).toFixed(2); // 小数点2桁まで表示
                                        tsuboElements[index].textContent = tsuboValue;
                                    }
                                });
                            }
                        </script>    
                    </div>
                    <div class="imgbox__sell__spec pc">
                        <object data="<?php echo get_template_directory_uri(); ?>/images/spec.svg" type="image/svg+xml" class="svg__company01 fadeIn"></object>
                    </div>
                </div>    
            </article>
        </div>
    </article>

    <article>
        <h2 class="h2_ttl fadeUp">After service<span>アフターサービス</span></h2>

        <div class="wrapper__p0">
            <div class="after__contents fadeUp">
                <div class="tabs__after">
                    <!-- Tab 1 -->
                    <div class="tab_item_wrapper">
                        <input id="inspection" type="radio" name="tab_item" checked>
                        <label class="tab_item fadeIn" for="inspection">1</label>
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
                        <label class="tab_item fadeIn" for="defects">2</label>
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
                        <label class="tab_item fadeIn" for="ground">3</label>
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
                        <label class="tab_item fadeIn5" for="facility">4</label>
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

    <?php endif; ?>

    <article class="relative">
        <h2 class="h2_ttl">Reserve<span>この物件を見学予約する</span></h2>
        <div class="wrapper">
            <div class="imgbox__form__reserve">
                <object data="images/reserve.svg" type="image/svg+xml" class="svg__company01"></object>
            </div>
            <div class="textbox__form">
                <?php echo do_shortcode('[custom_reserve_form]'); ?>
            </div>
        </div>
    </article>

<?php get_footer(); ?>