<?php get_header(); ?>

    <div class="ttl fadeIn">
        <h2>About us<span>私たちについて</span></h2>
    </div>

    <div class="imgbox__about">
        <img src="<?php echo get_template_directory_uri(); ?>/images/about.jpg" alt="アスターハウスについて">
        <div class="icon__about">
            <img src="<?php echo get_template_directory_uri(); ?>/images/icon_about.svg" alt="暮らしのこと、お任せください">
        </div>
    </div>

    <article>
        <div class="accordion">
            <div class="accordion-item">
                <h2 class="h2_ttl accordion-header">Company<span>会社概要</span></h2>
                <div class="accordion-content">
                    <div class="imgbox50__company">
                        <object data="<?php echo get_template_directory_uri(); ?>/images/company01.svg" type="image/svg+xml" class="svg__company01 fadeIn"></object>
                        <object data="<?php echo get_template_directory_uri(); ?>/images/company02.svg" type="image/svg+xml" class="svg__company02 fadeIn"></object>
                        <object data="<?php echo get_template_directory_uri(); ?>/images/company03.svg" type="image/svg+xml" class="svg__company03 fadeIn"></object>
                        <object data="<?php echo get_template_directory_uri(); ?>/images/company04.svg" type="image/svg+xml" class="svg__company04 fadeIn"></object>
                    </div>
                    <div class="textbox50 fr">
                        <dl class="company">
                            <div class="company-item fadeUp">
                                <dt>会社名</dt>
                                <dd>有限会社 アスター</dd>
                                <div class="line-wrapper"></div>
                            </div>
                            <div class="company-item fadeUp">
                                <dt>所在地</dt>
                                <dd class="mb2em">〒065-0013<br>札幌市東区北13条東16丁目1-1</dd>
                                <div class="line-wrapper"></div>
                            </div>
                            <div class="company-item fadeUp">
                                <dt>設立</dt>
                                <dd>平成元年5月1日</dd>
                                <div class="line-wrapper"></div>
                            </div>
                            <div class="company-item fadeUp">
                                <dt>資本金</dt>
                                <dd>3,000万円</dd>
                                <div class="line-wrapper"></div>
                            </div>
                            <div class="company-item fadeUp">
                                <dt>代表者</dt>
                                <dd>今野 誉志雄</dd>
                                <div class="line-wrapper"></div>
                            </div>
                            <div class="company-item fadeUp">
                                <dt>電話番号</dt>
                                <dd class="tel-link_company">011-214-0455</dd>
                                <div class="line-wrapper"></div>
                            </div>
                            <div class="company-item fadeUp">
                                <dt class="company__free">フリーダイヤル</dt>
                                <dd class="tel-link_company">0120-802-801</dd>
                                <div class="line-wrapper"></div>
                            </div>
                            <div class="company-item fadeUp">
                                <dt>F A X</dt>
                                <dd>011-214-0457</dd>
                                <div class="line-wrapper"></div>
                            </div>
                            <div class="company-item fadeUp">
                                <dt>メール</dt>
                                <dd>master@aster-estate.com</dd>
                                <div class="line-wrapper"></div>
                            </div>
                            <div class="company-item fadeUp">
                                <dt>免許番号</dt>
                                <dd class="mb2em">北海道知事免許（9）4991号<br>
                                宅建免許 / 北海道知事許可<br class="sp">（般-3）石 第24221号</dd>
                                <div class="line-wrapper"></div>
                            </div>
                            <div class="company-item fadeUp">
                                <dt>営業内容</dt>
                                <dd>不動産買取、販売、仲介、リフォーム</dd>
                                <div class="line-wrapper"></div>
                            </div>
                            <div class="company-item fadeUp">
                                <dt>取引銀行</dt>
                                <dd class="mb2em">北海道銀行　篠路支店<br>
                                北陸銀行　麻生支店<br>
                                北洋銀行　栄町支店<br>
                                北海道信用金庫　丘珠支店<br>
                                旭川信用金庫　栄町支店</dd>
                                <div class="line-wrapper"></div>
                            </div>
                            <div class="company-item fadeUp">
                                <dt>所属団体</dt>
                                <dd class="mb2em">公益社団法人　<br class="sp">北海道宅地建物取引協会<br>
                                公益社団法人　<br class="sp">全国宅地建物取引業保証協会</dd>
                                <div class="line-wrapper"></div>
                            </div>
                            <div class="company-item fadeUp">
                                <dt>年商/<br>
                                営業利益</dt>
                                <dd class="mb2em">R6.2　22.5億 / 1.5億<br>
                                R5.2　19.1億 / 1.9億<br>
                                R4.2　14.4億 / 1.4億</dd>
                                <div class="line-wrapper"></div>
                            </div>
                        </dl>
                    </div>   
                </div> 
            </div>
        </div>
    </article>

    <article class="staff-section">
        <div class="accordion">
            <div class="accordion-item">
                <h2 class="h2_ttl accordion-header" id="staffAccHeader">Staff<span>スタッフ紹介</span></h2>
                <div class="accordion-content" id="staffAcc">
                <?php
                    $staff_query = new WP_Query( array(
                        'post_type'      => 'staff',
                        'posts_per_page' => -1,
                        'orderby'        => 'date',  // 投稿日でソート
                        'order'          => 'ASC',   // 昇順（古いもの→新しいもの）
                    ) );
                    
                if ( $staff_query->have_posts() ) : ?>
                    <ul class="staff__card staff-list">
                    <?php
                    while ( $staff_query->have_posts() ) : $staff_query->the_post();

                        // ACF フィールドを一度だけ取得
                        $photo   = get_field( 'photo' );   // ['url'], ['alt']
                        $job     = get_field( 'job' );
                        $name    = get_field( 'name' );
                        $lisence = get_field( 'lisence' );
                        $english = get_field( 'english' );
                        $hobby   = get_field( 'hobby' );
                        $skill   = get_field( 'skill' );
                        $message = get_field( 'message' );
                    ?>
                        <li class="staff-card" data-id="<?php echo esc_attr( get_the_ID() ); ?>">
                        <?php if ( ! empty( $photo['url'] ) ) : ?>
                            <img
                            src="<?php echo esc_url( $photo['url'] ); ?>"
                            alt="<?php echo esc_attr( $photo['alt'] ); ?>"
                            >
                        <?php endif; ?>

                        <div class="type"><?php echo esc_html( $job ); ?></div>
                        <div class="name">
                            <?php echo esc_html( $name ); ?>
                            <span><?php echo esc_html( $english ); ?></span>
                        </div>
                            <p class="qualification">
                            <?php 
                                // エスケープ + 改行を <br> に変換
                                echo nl2br( esc_html( $lisence ) ); 
                            ?>
                        </p>

                        <button class="view-btn">View</button>

                        <div class="card-detail">
                            <div class="sp">
                            <?php if ( ! empty( $photo['url'] ) ) : ?>
                                <img
                                src="<?php echo esc_url( $photo['url'] ); ?>"
                                alt="<?php echo esc_attr( $photo['alt'] ); ?>"
                                >
                            <?php endif; ?>
                            <div class="type"><?php echo esc_html( $job ); ?></div>
                            <div class="name">
                                <?php echo esc_html( $name ); ?>
                                <span><?php echo esc_html( $english ); ?></span>
                            </div>
                            </div>
                            <div class="staff_modal_fr">
                                <h3 class="hobby">Hobby</h3>
                                <p><?php echo esc_html( $hobby ); ?></p>
                                <h3 class="skill">Skill</h3>
                                <p><?php echo esc_html( $skill ); ?></p>
                                <h3 class="message">Message</h3>
                                <p><?php echo esc_html( $message ); ?></p>
                            </div>
                        </div>

                        <button class="close-btn">Close</button>
                        </li>
                    <?php endwhile; ?>
                    </ul>
                    <?php
                    // ③ ループ後のリセット
                    wp_reset_postdata();

                // ────────────────────────────────
                // 投稿がなかった場合
                else : ?>
                    <p>現在スタッフ情報はありません。</p>
                <?php endif; ?>

                <!-- モーダル -->
                <div class="modal" id="modal">
                    <div class="modal-content">
                    <button id="modalClose">Close</button>
                    <div id="modalBody"></div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </article>

    <article id="privacy-accordion">
        <div class="accordion">
            <div class="accordion-item">
                <h2 class="h2_ttl accordion-header">Privacy policy<span>個人情報保護方針</span></h2>
                <div class="accordion-content" id="privacy">

                    <div class="privacy">
                        <h3>1.お客様の個人情報の取り扱いについて</h3>
                        <li>お客様のプライバシー、個人情報の保護について最大限の注意を払っております。個人情報をお客様の事前の同意なく第三者に対して開示することはありません。</li>
                        <li>弊社ではお客様の個人情報を厳重に管理し、第三者に譲渡する事はございません。但し弊社の財産を守る目的において、公的機関より開示請求があった場合等は開示する可能性がございます。</li>
                        <li>お客様からいただいた個人情報は商品の発送とご連絡以外には一切使用いたしません。</li>
                        <li>弊社が責任をもって安全に蓄積・保管し、第三者に譲渡・提供することはございません。</li>
                        <li>弊社では、お客様の個人情報（住所、氏名、メールアドレス、ご購入商品など）を、裁判所・警察機関等、公共機関からの提出要請があった場合以外の第三者に譲渡または利用する事は一切ございません。</li>

                        <h3>2.Google Analyticsの利用について</h3>
                        <p>当社サイトでは、お客様の当社サイトの訪問状況を把握するためにGoogle社のサービスであるGoogle Analyticsを利用しています。当社のサイトでGoogle Analyticsを利用しますと、当社が発行するクッキーをもとにして、
                            Google社がお客様の当社サイトの訪問履歴を収集、記録、分析します。当社は、Google社からその分析結果を受け取り、お客様の当社サイトの訪問状況を把握します。Google Analyticsにより収集、記録、分析された
                            お客様の情報には、特定の個人を識別する情報は一切含まれません。また、それらの情報は、Google社により同社のプライバシーポリシーに基づいて管理されます。Google Analyticsの利用規約に関する説明については
                            Google Analyticsのサイトを、Google社のプライバシーポリシーに関する説明については同社のサイトをご覧下さい。</p>
                        <p>[ Google Analyticsの利用規約 ]<br>
                            <a href="http://www.google.com/analytics/terms/jp.html" target="_blank">http://www.google.com/analytics/terms/jp.html</a></p>
                        <p class="mb100">[ Googleのプライバシーポリシー ] <br>
                            <a href="http://www.google.com/intl/ja/policies/privacy/" target="_blank">http://www.google.com/intl/ja/policies/privacy/</a></p>

                        <h3>3.お問合せ窓口</h3>
                        <p>当社における個人データの取り扱いに関するお問合せは下記の窓口にご連絡ください。</p>
                        <dl class="privacy__contact">
                            <div class="contact-item">
                                <dt>電話番号</dt>
                                <dd>0120-802-801</dd>
                            </div>
                            <div class="contact-item">
                                <dt>受付時間</dt>
                                <dd>10:00-18:00（水曜日は定休日となっております。）</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </article>


<?php get_footer(); ?>