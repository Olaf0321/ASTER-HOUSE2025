<form method="post">
  <?php wp_nonce_field('custom_contact','custom_contact_nonce'); ?>
  <input type="hidden" name="custom_contact_submitted" value="1">

  <div class="form__contact">
    <div class="note__form fadeUp">
      （<span class="main__color bold">＊</span>）は必須事項となります。
    </div>

    <div class="form-item fadeUp line-item">
      <p class="form-item-label">お問合せ内容<sup class="required__sp">＊</sup></p><div class="required"></div>
      <div class="form-radio-group">
        <label class="bold">
          <input type="radio" name="inquiry" value="general" required> 資料請求
        </label>
        <label class="bold">
          <input type="radio" name="inquiry" value="consultation" required> 家づくり相談会の予約
        </label>
        <label class="bold">
          <input type="radio" name="inquiry" value="property" required> 物件について
        </label>
        <label class="bold">
          <input type="radio" name="inquiry" value="other" required> その他、住まいに関するご相談
        </label>
      </div>
      <div class="line-wrapper"></div>
    </div>

    <div class="form-item fadeUp line-item">
      <p class="form-item-label">お名前<sup class="required__sp">＊</sup></p><div class="required"></div>
      <input type="text" name="your_name" class="form-item-input" placeholder="例：山田太郎" required>
      <div class="line-wrapper"></div>
    </div>

    <div class="form-item fadeUp line-item">
      <p class="form-item-label">フリガナ</p>
      <input type="text" name="your_furigana" class="form-item-input" placeholder="例：ヤマダタロウ">
      <div class="line-wrapper"></div>
    </div>

    <div class="form-item fadeUp line-item">
      <p class="form-item-label">メールアドレス<sup class="required__sp">＊</sup></p><div class="required"></div>
      <input type="email" name="your_email" class="form-item-input" placeholder="例：aaa@bbb.com" required>
      <div class="line-wrapper"></div>
    </div>

    <div class="form-item fadeUp line-item">
      <p class="form-item-label">ご住所<sup class="required__sp">＊</sup></p><div class="required"></div>
      <input type="text" name="your_address" class="form-item-input" placeholder="例：札幌市中央区〇条〇丁目" required>
      <div class="line-wrapper"></div>
    </div>

    <div class="form-item fadeUp line-item">
      <p class="form-item-label">電話番号<sup class="required__sp">＊</sup></p><div class="required"></div>
      <input type="text" name="your_phone" class="form-item-input" placeholder="例：011-123-4567" required>
      <div class="line-wrapper"></div>
    </div>

    <div class="form-item fadeUp line-item">
      <p class="form-item-label">メッセージ本文<sup class="required__sp">＊</sup></p><div class="required"></div>
      <textarea name="your_message" class="form-item-textarea" placeholder="質問等ありましたらご記入ください。" required></textarea>
      <div class="line-wrapper"></div>
    </div>

    <label for="confirmation" class="checkbox-label fadeUp">
      <input type="checkbox" id="confirmation" name="confirmation" value="1" required>
      送信内容を確認し、チェックしてから送信して下さい。
    </label>

    <button type="submit" class="form-btn fadeUp">送信</button>
  </div>
</form>