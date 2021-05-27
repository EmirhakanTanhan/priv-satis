<?php
$Admin = Sorgu("*", "Admin", "id='$_SESSION[Admin_id]'", 1);
?>

<div class="vb__layout__content">
    <div class="vb__breadcrumbs">
        <div class="vb__breadcrumbs__path">
            <span href="/panel">Admin</span>
            <span class="vb__breadcrumbs__arrow"></span>
            <span href="/panel/users"><?php echo $Admin['name'] ?></span>
        </div>
    </div>
    <div class="vb__utils__content">
        <div class="row">
            <div class="col-md-12">

                <div class="card" style="padding-bottom: 15px">
                    <form action="javascript:;" method="post" id="AdminEdit">
                        <div class="card-header">
                            <div class="row" style="justify-content: space-between">
                                <h4 class="ml-3 mb-0" style="align-self: center">
                                    <strong>Admin Bilgileri</strong>
                                </h4>
                                <button type="submit" class="btn btn-success mr-3 px-4" style=" float: right">
                                    <i class="fe fe-save"></i>
                                    Kaydet
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="name">İsim</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                           value="<?php echo $Admin['name']; ?>"/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" name="email" id="email"
                                           value="<?php echo $Admin['email']; ?>"/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="pass">Şifre</label>
                                    <input type="password" class="form-control" name="pass" id="pass"/>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card" style="padding-bottom: 15px">
                    <form action="" method="post">
                        <div class="card-header">
                            <div class="row" style="justify-content: space-between">
                                <h4 class="ml-3 mb-0" style="align-self: center">
                                    <strong>Şifre Değiştir</strong>
                                </h4>
                                <button type="submit" class="btn btn-success mr-3 px-4" style=" float: right">
                                    <i class="fe fe-save"></i>
                                    Kaydet
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="pass_old">Eski Şifre</label>
                                    <input type="password" class="form-control" name="pass_old" id="pass_old"/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="pass_new">Yeni Şifre</label>
                                    <input type="password" class="form-control" name="pass_new" id="pass_new"/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="pass_new_rpt">Yeni Şifre Tekrar</label>
                                    <input type="password" class="form-control" name="pass_new_rpt"
                                           id="pass_new_rpt"/>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    ;(function ($) {
        'use strict'
        $(function () {
            $('#pass').password({
                eyeClass: '',
                eyeOpenClass: 'fe fe-eye',
                eyeCloseClass: 'fe fe-eye-off',
            })
            $('#pass_old').password({
                eyeClass: '',
                eyeOpenClass: 'fe fe-eye',
                eyeCloseClass: 'fe fe-eye-off',
            })
            $('#pass_new').password({
                eyeClass: '',
                eyeOpenClass: 'fe fe-eye',
                eyeCloseClass: 'fe fe-eye-off',
            })
            $('#pass_new_rpt').password({
                eyeClass: '',
                eyeOpenClass: 'fe fe-eye',
                eyeCloseClass: 'fe fe-eye-off',
            })
        })
    })(jQuery)
</script>