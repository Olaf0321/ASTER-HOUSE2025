<?php get_header(); ?> 

    <div class="ttl fadeIn">
        <h2 class="fadeUp">Contact<span>お問合せ</span></h2>
    </div>

    <article class="wrapper relative">
        <div class="imgbox__form__contact">
            <img src="<?php echo get_template_directory_uri(); ?>/images/contact.svg" alt="問合せ" class="pc">
        </div>

        <div class="textbox__form">
            <?php echo do_shortcode('[custom_contact_form]'); ?>
        </div>
    </article>

<?php get_footer(); ?>






<!-- <div class="form__contact">

  <div class="note__form fadeUp">
    （<span class="main__color bold">＊</span>）は必須事項となります。
  </div>

  <div class="form-item fadeUp line-item">
    <p class="form-item-label">お問合せ内容<sup class="required__sp">＊</sup></p>
    <div class="required"></div>
    <div class="form-radio-group">
      [radio* inquiry use_label_element
        class:form-radio-group
        "資料請求"
        "家づくり相談会の予約"
        "物件について"
        "その他、住まいに関するご相談"
      ]
    </div>
    <div class="line-wrapper"></div>
  </div>

  <div class="form-item fadeUp line-item">
    <p class="form-item-label">お名前<sup class="required__sp">＊</sup></p>
    <div class="required"></div>
    [text* your-name class:form-item-input placeholder "例：山田太郎"]
    <div class="line-wrapper"></div>
  </div>

  <div class="form-item fadeUp line-item">
    <p class="form-item-label">フリガナ</p>
    [text your-kana class:form-item-input placeholder "例：ヤマダタロウ"]
    <div class="line-wrapper"></div>
  </div>

  <div class="form-item fadeUp line-item">
    <p class="form-item-label">メールアドレス<sup class="required__sp">＊</sup></p>
    <div class="required"></div>
    [email* your-email class:form-item-input placeholder "例：〇〇＠〇〇.com"]
    <div class="line-wrapper"></div>
  </div>

  <div class="form-item fadeUp line-item">
    <p class="form-item-label">ご住所<sup class="required__sp">＊</sup></p>
    <div class="required"></div>
    [text* your-address class:form-item-input placeholder "例：札幌市中央区〇条〇丁目〇-〇"]
    <div class="line-wrapper"></div>
  </div>

  <div class="form-item fadeUp line-item">
    <p class="form-item-label">電話番号<sup class="required__sp">＊</sup></p>
    <div class="required"></div>
    [tel* your-tel class:form-item-input placeholder "例：011-123-4567"]
    <div class="line-wrapper"></div>
  </div>

  <div class="form-item fadeUp line-item">
    <p class="form-item-label">メッセージ本文<sup class="required__sp">＊</sup></p>
    <div class="required"></div>
    [textarea* your-message class:form-item-textarea placeholder "質問等ありましたらご記入ください。"]
    <div class="line-wrapper"></div>
  </div>

  <div class="form-item fadeUp">
    [checkbox* confirmation use_label_element
      class:checkbox-label
      "送信内容を確認し、チェックしてから送信して下さい。"
    ]
  </div>

  [submit class:form-btn fadeUp "送信"]

</div> -->


