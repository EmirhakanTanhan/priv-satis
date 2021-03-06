$("#AdminEdit").submit(function () {
    axios.post('/panel/api/adminedit', $("#AdminEdit").serialize()).then(function (response) {
        console.log(response.data);
        switch (response.data.STATUS) {
            case 'ERR_EMPTY':
                new Notification("Lütfen bütün boşlukları doldurun", 1);
                break;
            case 'ERR_UNCHANGED':
                new Notification("Değiştirilecek bir değer bulunmamaktadır", 1);
                break;
            case 'ERR_INVALID_EMAIL':
                new Notification("Geçersiz bir email adresi girdiniz");
                break;
            case 'ERR_INVALID_NAME':
                new Notification("Geçersiz bir isim girdiniz");
                break;
            case 'ERR_INVALID_PASS':
                new Notification("Hatalı bir şifre girdiniz");
                break;
            case 'ERR_OVER_REQUEST':
                new Notification("Aynı anda yalnızca bir özellik değiştirebilirsiniz");
                break;
            case 'SUCC_NAME':
                new Notification("İşleminiz başarıyla gerçekleştirildi", 0);
                break;
            case 'SUCC_VER_REQ_SENT':
                new Notification("Değişiklikleri tamamlamak için " + response.data.EMAIL + " adresine gelen onaylama linkine gidiniz", 0);
                break;
            default:
                new Notification("Bilinmeyen bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.");
                break;
        }
    }).catch(function (error) {
        console.log(error);
    });
})

//$("#VerCheck").submit(function () >>>>post on page load
if (window.location.href.includes("/verification") && !window.location.href.includes("?status=")) {
    $(function () {
        axios.post('/panel/api/vercheck', $("#VerCheck").serialize()).then(function (response) {
            console.log(response.data);
            switch (response.data.STATUS) {
                case 'ERR_INVALID_LINK_a':
                    window.location.href = "/panel/verification/" + response.data.LINK + "?status=" + response.data.STATUS
                    break;
                case 'ERR_INVALID_LINK_b':
                    window.location.href = "/panel/verification/" + response.data.LINK + "?status=" + response.data.STATUS
                    break;
                case 'SUCC_APPLY_CHANGE':
                    window.location.href = "/panel/verification/" + response.data.LINK + "?status=" + response.data.STATUS
                    break;
                default:
                    window.location.href = "/panel/404"
                    break;
            }
        }).catch(function (error) {
            console.log(error);
        });
    })
}

$("#VerLogin").submit(function () {
    axios.post('/panel/api/verlogin', $("#VerLogin").serialize()).then(function (response) {
        console.log(response.data);
        switch (response.data.STATUS) {
            case 'ERR_EMPTY':
                new Notification("Lütfen bütün boşlukları doldurun", 1);
                break;
            case 'ERR_INVALID_EMAIL':
                new Notification("Geçersiz bir email adresi girdiniz");
                break;
            case 'ERR_INVALID_USER_OR_PASS':
                new Notification("Email adresi veya şifre hatalı");
                break;
            case 'SUCC_LOGIN':
                new Notification("Başarıyla giriş yaptınız", 0);
                setTimeout(function () {
                    window.location.href = "/panel"
                }, 800);
                break;
            default:
                new Notification("Bilinmeyen bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.");
                break;

        }
    }).catch(function (error) {
        console.log(error);
    });
})

$("#VerChangePass").submit(function () {
    axios.post('/panel/api/verchangepass', $("#VerChangePass").serialize()).then(function (response) {
        console.log(response.data);
        switch (response.data.STATUS) {
            case 'ERR_INVALID_LINK_a':
                window.location.href = "/panel/verification/" + response.data.LINK + "?status=" + response.data.STATUS
                break;
            case 'ERR_INVALID_LINK_b':
                window.location.href = "/panel/verification/" + response.data.LINK + "?status=" + response.data.STATUS
                break;
            case 'ERR_EMPTY':
                new Notification("Lütfen bütün boşlukları doldurun", 1);
                break;
            case 'ERR_INVALID_PASS_RPT':
                new Notification("Şifreleriniz birbiriyle uyuşmuyor");
                break;
            case 'SUCC_PASS_CHANGED':
                new Notification("Başarıyla şifrenizi değiştirdiniz", 0);
                setTimeout(function () {
                    window.location.href = "/panel/login"
                }, 800);
                break;
            default:
                new Notification("Bilinmeyen bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.");
                break;

        }
    }).catch(function (error) {
        console.log(error);
    });
})

$("#ChangePass").submit(function () {
    axios.post('/panel/api/changepass', $("#ChangePass").serialize()).then(function (response) {
        console.log(response.data);
        switch (response.data.STATUS) {
            case 'ERR_EMPTY':
                new Notification("Lütfen bütün boşlukları doldurun", 1);
                break;
            case 'ERR_INVALID_PASS_RPT':
                new Notification("Şifreleriniz birbiriyle uyuşmuyor");
                break;
            case 'SUCC_PASS_CHANGED':
                new Notification("Başarıyla şifrenizi değiştirdiniz", 0);
                break;
            default:
                new Notification("Bilinmeyen bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.");
                break;
        }
    }).catch(function (error) {
        console.log(error);
    });
})

$("#ForgotPass").submit(function () {
    axios.post('/panel/api/forgotpassword', $("#ForgotPass").serialize()).then(function (response) {
        console.log(response);
        switch (response.data.STATUS) {
            case 'ERR_EMPTY':
                new Notification("Lütfen bütün boşlukları doldurun", 1);
                break;
            case 'ERR_INVALID_EMAIL':
                new Notification("Geçersiz bir email adresi girdiniz");
                break;
            case 'ERR_INVALID_USER':
                new Notification("Böyle bir kullanıcı bulunmamaktadır", 1);
                break;
            case 'SUCC_VER_REQ_SENT':
                new Notification("Şifrenizi sıfırlamak için " + response.data.EMAIL + " adresine gelen onaylama linkine gidiniz", 0);
                break;
            default:
                new Notification("Bilinmeyen bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.");
                break;
        }

    }).catch(function (error) {
        console.log(error);
    })
})

//Alert | status : 0 = success, 1 = warning, 2 = failed
function Notification(text, status = 2, closeButton = 0) {
    switch (status) {
        case 0:
            _status = 'success';
            _title = '<strong class="ml-1">Başarılı!</strong>';
            _icon = 'fe fe-check-circle';
            break;
        case 1:
            _status = 'dark';
            _title = '<strong class="ml-1">Uyarı!</strong>';
            _icon = 'fe fe-alert-circle';
            break;
        case 2:
            _status = 'danger';
            _title = '<strong class="ml-1">Dikkat!</strong>';
            _icon = 'fe fe-alert-triangle';
            break;
    }

    if (closeButton == 0) _button = 'false'; else _button = 'true';

    $.notify(
        {
            icon: _icon,
            title: _title,
            message: text,
        },
        {
            type: _status,
            allow_dismiss: _button,
        },
    )
}