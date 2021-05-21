<?php
$User = User(UrlRead(3));

$Orders = Sorgu("*", "Orders", "Users_id='$User[id]'");
?>

<div class="vb__layout__content">
    <form action="" method="post">
        <div class="vb__breadcrumbs">
            <div class="vb__breadcrumbs__path">
                <a href="/panel">Panel</a>
                <span class="vb__breadcrumbs__arrow"></span>
                <a href="/panel/users">Üyeler</a>
                <span>
                    <span class="vb__breadcrumbs__arrow"></span>
                    <span><?php echo $User['name'] . ' ' . $User['surname'] ?></span>
                </span>
            </div>
        </div>
        <div class="vb__utils__content">
            <div class="row">

                <div class="col-md-12">
                    <div class="card" style="padding-bottom: 15px">
                        <div class="card-header">
                            <div class="d-flex">
                                <h4 style="margin: unset"><strong>Admin Bilgileri</strong></h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Adı Soyadı:</strong>
                                    <span><?php echo $User['name'] . ' ' . $User['surname'] ?></span><br>
                                    <strong>Email:</strong>
                                    <span><?php echo $User['email'] ?></span><br>
                                    <strong>Kayıt Tarihi:</strong>
                                    <span><?php echo date_format(date_create($User['history']), "Y/m/d H:i"); ?></span>

                                </div>
                                <div class="col-md-6">
                                    <strong>Telefon:</strong>
                                    <span><?php echo $User['phone'] ?></span><br>
                                    <strong>TC Kimlik Numarası:</strong>
                                    <span><?php echo $User['hash'] ?></span><br>
                                    <strong>Adres:</strong>
                                    <span><?php echo $User['address'] ?></span>
                                </div>
                                <div class="col-md-12">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>