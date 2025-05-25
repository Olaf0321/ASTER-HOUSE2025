            <div class="form__contact">
                <div class="note__form fadeUp">（<span class="main__color bold">＊</span>）は必須事項となります。</div>
                <div class="form-item fadeUp line-item">
                    <p class="form-item-label">来場希望物件<sup class="required__sp">＊</sup></p><div class="required"></div>
                    <select type="property" class="form-item-select-property">
                        <option value="SH001">SH001</option>
                        <option value=""></option>
                        <option value=""></option>
                        <option value=""></option>
                        <option value=""></option>
                        <option value=""></option>
                        <option value=""></option>
                    </select>
                    <div class="line-wrapper"></div>
                </div>
                <div class="form-item fadeUp line-item">
                    <p class="form-item-label">来場日時（第一希望）<sup class="required__sp">＊</sup></p><div class="required"></div>
                    <div class="form-date-group">
                        <div class="date-wrap">
                            <input id="visit-date datepicker1" type="date" class="date-input" required/>
                            <label for="visit-date" class="date-placeholder">
                                <span class="year">年</span>
                                <span class="month">月</span>
                                <span class="day">日</span>
                            </label>
                        </div>
                        <script>
                            const inp = document.getElementById('date');
                            const ph  = document.querySelector('.date-placeholder');
                            inp.addEventListener('input', () => {
                            ph.style.opacity = inp.value ? '0' : '1';
                            });
                            inp.addEventListener('focus',  () => ph.style.opacity = '0');
                            inp.addEventListener('blur',   () => ph.style.opacity = inp.value ? '0' : '1');
                        </script>
                        <!-- <input type="date" id="datepicker1" placeholder="年/　月/　日"> -->
                        <select type="time" class="form-item-select-time" required>
                            <option value="" disabled selected hidden>時</option>
                            <option value="09:00">09:00</option>
                            <option value="09:30">09:30</option>
                            <option value="10:00">10:00</option>
                            <option value="10:30">10:30</option>
                            <option value="11:00">11:00</option>
                            <option value="11:30">11:30</option>
                            <option value="12:00">12:00</option>
                            <option value="12:30">12:30</option>
                            <option value="13:00">13:00</option>
                            <option value="13:30">13:30</option>
                            <option value="14:00">14:00</option>
                            <option value="14:30">14:30</option>
                            <option value="15:00">15:00</option>
                            <option value="15:30">15:30</option>
                            <option value="16:00">16:00</option>
                            <option value="16:30">16:30</option>
                            <option value="17:00">17:00</option>
                            <option value="17:30">17:30</option>
                        </select>    
                    </div>
                    <div class="line-wrapper"></div>
                </div>
                <div class="form-item fadeUp line-item">
                    <p class="form-item-label">来場日時（第二希望）<sup class="required__sp">＊</sup></p><div class="required"></div>
                    <div class="form-date-group">
                        <div class="date-wrap">
                            <input id="visit-date datepicker1" type="date" class="date-input" required/>
                            <label for="visit-date" class="date-placeholder">
                                <span class="year">年</span>
                                <span class="month">月</span>
                                <span class="day">日</span>
                            </label>
                        </div>
                        <select type="time" class="form-item-select-time" required>
                            <option value="" disabled selected hidden>時</option>
                            <option value="09:00">09:00</option>
                            <option value="09:30">09:30</option>
                            <option value="10:00">10:00</option>
                            <option value="10:30">10:30</option>
                            <option value="11:00">11:00</option>
                            <option value="11:30">11:30</option>
                            <option value="12:00">12:00</option>
                            <option value="12:30">12:30</option>
                            <option value="13:00">13:00</option>
                            <option value="13:30">13:30</option>
                            <option value="14:00">14:00</option>
                            <option value="14:30">14:30</option>
                            <option value="15:00">15:00</option>
                            <option value="15:30">15:30</option>
                            <option value="16:00">16:00</option>
                            <option value="16:30">16:30</option>
                            <option value="17:00">17:00</option>
                            <option value="17:30">17:30</option>
                        </select>    
                    </div>
                    <div class="line-wrapper"></div>
                </div>
                <div class="form-item fadeUp line-item">
                    <p class="form-item-label">お名前<sup class="required__sp">＊</sup></p><div class="required"></div>
                    <input type="text" name="your_name" class="form-item-input" placeholder="例：山田太郎">
                    <div class="line-wrapper"></div>
                </div>
                <div class="form-item fadeUp line-item">
                    <p class="form-item-label">フリガナ</p>
                    <input type="text" name="your_furigana" class="form-item-input" placeholder="例：ヤマダタロウ">
                    <div class="line-wrapper"></div>
                </div>
                <div class="form-item fadeUp line-item">
                    <p class="form-item-label">メールアドレス<sup class="required__sp">＊</sup></p><div class="required"></div>
                    <input type="email" name="your_email" class="form-item-input" placeholder="例：〇〇〇〇＠〇〇〇〇.com">
                    <div class="line-wrapper"></div>
                </div>
                <div class="form-item fadeUp line-item">
                    <p class="form-item-label">ご住所<sup class="required__sp">＊</sup></p><div class="required"></div>
                    <input type="text" name="your_address" class="form-item-input" placeholder="例：札幌市中央区〇条〇丁目〇-〇">
                    <div class="line-wrapper"></div>
                </div>
                <div class="form-item fadeUp line-item">
                    <p class="form-item-label">電話番号<sup class="required__sp">＊</sup></p><div class="required"></div>
                    <input type="text" name="your_phone" class="form-item-input" placeholder="例：011-123-4567">
                    <div class="line-wrapper"></div>
                </div>
                <div class="form-item fadeUp line-item">
                    <p class="form-item-label">メッセージ本文</p>
                    <textarea name="your_message" class="form-item-textarea" placeholder="質問等ありましたらご記入ください。"></textarea>
                    <div class="line-wrapper"></div>
                </div>
                <label for="confirmation" class="checkbox-label fadeUp">
                    <input type="checkbox" id="confirmation" name="confirmation">
                    送信内容を確認し、チェックしてから送信して下さい。
                </label>
                <buttom type="submit" class="form-btn fadeUp">送信</buttom>
            </div>
