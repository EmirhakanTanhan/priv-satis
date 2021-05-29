<?php
$VerUrl = UrlRead(3);
$VerType = substr($VerUrl, 0, 1);
$VerId = hexdec(substr($VerUrl, 20));

if ($_POST) {
    $Email = $_POST['email'];
    $Password = $_POST['password'];
    if (!$Email) $Error['email'] = 'Email Giriniz';
    if (!$Password) $Error['password'] = 'Şifre Giriniz';
    if (!$Error) {
        $Admin = Sorgu("*", "Admin", "email='$Email'", 1);
        if ($Admin) {
            if (password_verify($Password, $Admin['password'])) {
                $_SESSION['Admin_id'] = $Admin['id'];
                $_SESSION['email'] = $Admin['email'];
                $_SESSION['name'] = $Admin['name'];
                header("location:/panel");
            } else {
                $Error['email'] = 'Email veya Şifre Yanlış';
            }
        } else {
            $Error['email'] = 'Email veya Şifre Yanlış';
        }
    }
}
?>

<div class="vb__layout__content">
    <div class="vb__auth__authContainer">
        <div class="vb__auth__topbar">
            <div class="vb__auth__logoContainer" style="margin:0 auto">
                <div class="vb__auth__logoContainer__name">Panel</div>
                <div class="vb__auth__logoContainer__descr">
                    <a href="https://satis.emirhakan.com/">satis.emirhakan.com</a>
                </div>
            </div>
        </div>
        <div class="vb__auth__containerInner">

            <div class="container pl-5 pr-5 pb-5 mb-auto text-dark font-size-32 text-center">
                <div class="font-weight-bold mb-3">Tebrikler!</div>
                <div class="text-gray-6 font-size-24">
                    Email adresiniz onaylandı.
                </div>
            </div>

            <div class="card vb__auth__boxContainer">
                <div class="text-dark font-size-24 mb-4">
                    <strong>Giriş Yap</strong>
                </div>
                <?php
                if ($Error) {
                    foreach ($Error as $item) { ?>
                        <div class="alert alert-danger"><?php echo $item; ?></div>
                    <?php }
                } ?>
                <form action="" method="post" class="mb-4">
                    <div class="form-group mb-4">
                        <input type="email" name="email" class="form-control" placeholder="Email"
                               value="<?php echo $Email; ?>"/>
                    </div>
                    <div class="form-group mb-4">
                        <input type="password" name="password" class="form-control" placeholder="Şifre"/>
                    </div>
                    <button class="btn btn-primary text-center w-100" type="submit">
                        <strong>Giriş Yap</strong>
                    </button>
                </form>
                <a href="/panel/forgot-password" class="vb__utils__link font-size-16">
                    Şifrenizi mi Unuttunuz ?
                </a>
            </div>

        </div>
        <div class="mt-auto pb-5 pt-5">
            <div class="text-center">
                <a href="http://www.emirhakan.com" target="_blank" rel="noopener noreferrer">
                    Emirhakan Tanhan
                </a>
            </div>
        </div>
    </div>
</div>