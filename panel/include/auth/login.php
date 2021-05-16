<?php
if($_SESSION['Admin_id'])  header("location:/panel");
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
            <div class="vb__auth__logoContainer">
                <div class="vb__auth__logoContainer__logo">
                    <img src="https://html.visualbuilder.cloud/components/css/img/logo.svg" class="mr-2"
                         alt="Clean UI"/>
                    <div class="vb__auth__logoContainer__name">Admin</div>
                </div>
            </div>

        </div>
        <div class="vb__auth__containerInner">

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
                        <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $Email; ?>"/>
                    </div>
                    <div class="form-group mb-4">
                        <input type="password" name="password" class="form-control" placeholder="Şifre"/>
                    </div>
                    <button class="btn btn-primary text-center w-100" type="submit">
                        <strong>Giriş Yap</strong>
                    </button>
                </form>
                <a href="auth-forgot-password.html" class="vb__utils__link font-size-16">
                    Şifrenizimi Unuttunuz ?
                </a>
            </div>

        </div>
        <div class="mt-auto pb-5 pt-5">

            <div class="text-center">
                Copyright © 2021
                <a href="https://www.mestav.com" target="_blank" rel="noopener noreferrer">
                    mestav
                </a>
            </div>
        </div>
    </div>
</div>
