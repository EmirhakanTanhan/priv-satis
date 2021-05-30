<?php
if ($_SESSION['Admin_id']) header("location:/panel");
if ($_POST) {
    $Email = $_POST['email'];
    if (!$Email) $Error['empty'] = 'Email giriniz';
    if (!$Error) {
        $Admin = Query("*", "Admin", "email='$Email'", 1);
        if ($Admin) {
            $Success['email'] = "'$Email' adresine link gönderdik.";
        } else {
            $Error['email'] = 'Böyle bir email bulunmamaktadır.';
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

            <div class="card vb__auth__boxContainer">
                <div class="text-dark font-size-24 mb-4">
                    <strong>Şifrenizi Sıfırlayın</strong>
                </div>
                <?php
                if ($Error) {
                    foreach ($Error as $error) { ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php }
                } else if ($Success) {
                    foreach ($Success as $success) { ?>
                        <div class="alert alert-success"><?php echo $success; ?></div>
                    <?php }
                } ?>
                <form action="" method="post" class="mb-4">
                    <div class="form-group mb-4">
                        <input type="email" name="email" class="form-control" placeholder="Email"
                               value="<?php echo $Email; ?>"/>
                    </div>
                    <button class="btn btn-primary text-center w-100" type="submit">
                        <strong>Şifremi Sıfırla</strong>
                    </button>
                </form>
                <a href="/panel/login" class="vb__utils__link font-size-16">
                    Giriş Ekranına Dön
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

