<!-- sign in -->
<div class="sign section--full-bg" data-bg="/Design/img/bg2.jpg">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="sign__content">
                    <!-- registration form -->
                    <form action="javascript:;" method="post" class="sign__form" id="SignUp">
                        <a href="/" class="sign__logo">
                            <img src="/Design/img/logo.svg" alt="">
                        </a>

                        <div class="sign__group">
                            <input type="text" class="sign__input" name="name" placeholder="İsim" required>
                        </div>

                        <div class="sign__group">
                            <input type="text" class="sign__input" name="surname" placeholder="Soyadı" required>
                        </div>

                        <div class="sign__group">
                            <input type="text" class="sign__input" name="email" placeholder="Email" required>
                        </div>

                        <div class="sign__group">
                            <input type="password" class="sign__input" name="pass" placeholder="Şifre" required>
                        </div>

                        <div class="sign__group">
                            <input type="password" class="sign__input" name="pass_repeat" placeholder="Şifre Tekrar" required>
                        </div>

                        <div class="sign__group sign__group--checkbox">
                            <input id="remember" name="agreement" type="checkbox" value="1">
                            <label for="remember"><a href="privacy.html">Gizlilik Sözleşmesini</a> Okudum ve Kabul
                                Ediyorum</label>
                        </div>

                        <button class="sign__btn" name="signup_btn" type="submit">Kayıt Ol</button>

                        <span class="sign__text">Zaten Bir Hesabınız Var mı? <a href="/login">Giriş Yap!</a></span>
                    </form>
                    <!-- registration form -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end sign in -->