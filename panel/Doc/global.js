$("#AdminEdit").submit(function () {
    axios.post('/panel/api/adminedit', $("#AdminEdit").serialize()).then(function (response) {
        console.log(response.data);
        switch (response.data.STATUS) {
            case 'empty':
                new Notification("Lütfen Bütün Boşlukları Doldurun", 1);
                break;
            case 'unchanged':
                new Notification("Değiştirilecek Bir Değer Bulunmamaktadır", 1);
                break;
            case 'invalid_email':
                new Notification("Geçersiz Bir Email Adresi Girdiniz");
                break;
            case 'invalid_name':
                new Notification("Geçersiz Bir İsim Girdiniz");
                break;
            case 'invalid_pass':
                new Notification("Hatalı Bir Şifre Girdiniz");
                break;
            case 'success_edit_name':
                new Notification("İşleminiz Başarıyla Gerçekleştirildi", 0);
                break;
            case 'success_ver_req_sent':
                new Notification("Lütfen "+response.data.EMAIL+" Adresini Onaylayınız.", 0);
                break;
            default:
                new Notification("Bilinmeyen Bir Hata Oluştu, Lütfen Daha Sonra Tekrar Deneyiniz.");
                break;
        }
    }).catch(function (error) {
        console.log(error);
    });
})

//Alert
function Notification(text, status = 2, closeButton = 0) {
    //status : 0 = success, 1 = warning, 2 = failed
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