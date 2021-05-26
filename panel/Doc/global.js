$("#AdminEdit").submit(function () {
    axios.post('/panel/api/adminedit', $("#AdminEdit").serialize()).then(function (response) {
        console.log(response.data);
        if (response.data.STATUS == "empty") {
            new Notification("Lütfen Bütün Boşlukları Doldurun", 1);
        } else if (response.data.STATUS == "invalid_email") {
            new Notification("Geçersiz Bir Email Adresi Girdiniz");
        } else if (response.data.STATUS == "invalid_name") {
            new Notification("Geçersiz Bir İsim Girdiniz");
        } else if (response.data.STATUS == "invalid_pass") {
            new Notification("Hatalı Bir Şifre Girdiniz");
        } else if (response.data.STATUS == "create_link_success") {
            new Notification("Mail Oluşturuldu", 0);
        }

    }).catch(function (error) {
        console.log(error);
    });
})

//Alert
function Notification(text, status = 2, button = 0) {
    //status : 0 = success, 1 = warning, 2 = danger
    if (status == 0) { //success
        _status = 'success';
        _title = '<strong>Başarılı!</strong>'
    }
    if (status == 1) { //warning
        _status = 'dark';
        _title = '<strong>Uyarı!</strong>'
    }
    if (status == 2) { //danger
        _status = 'danger';
        _title = '<strong>Dikkat!</strong>'
    }

    if (button == 0) _button = 'false';
    if (button == 1) _button = 'true';

    $.notify(
        {
            title: _title,
            message: text,
        },
        {
            type: _status,
            allow_dismiss: _button,
        },
    )
}