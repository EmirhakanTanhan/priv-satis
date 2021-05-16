function BasketAdd(id) {
    if (id) {
        axios.post('/api/basketadd', {
            id: id
        }).then(function (response) {
            console.log(response.data);
            if (response.data.STATUS == 'unknown_error') new Notify({
                text: 'Bilinmeyen Bir Hata Oluştu',
                status: 'error',
                autoclose: true,
                position: "right bottom"
            })
            else if (response.data.STATUS == 'login_required') new Notify({
                text: 'Lütfen Giriş Yapınız',
                status: 'error',
                autoclose: true,
                position: "right bottom"
            })
            else if (response.data.STATUS == 'add_success') {
                new Notify({
                    text: 'Ürün Sepetinize Eklendi',
                    status: 'success',
                    autoclose: true,
                    position: "right bottom"
                })
                $("#BasketHeader").load(window.location.href + " #BasketHeader");
            }
        }).catch(function (error) {
            console.log(error);
        });
    }
}

function BasketRemove(id) {
    if (id) {
        axios.post('/api/basketremove', {
            id: id
        }).then(function (response) {
            console.log(response.data);
            if (response.data.STATUS == 'unknown_error') {
                new Notify({
                    text: 'Bilinmeyen Bir Hata Oluştu',
                    status: 'error',
                    autoclose: true,
                    position: "right bottom"
                })
            } else if (response.data.STATUS == 'remove_success') {
                new Notify({
                    text: 'Ürün Sepetinizden Kaldırıldı',
                    status: 'success',
                    autoclose: true,
                    position: "right bottom"
                })
                $("#Basketitem-" + id).remove();
                $("#BasketHeader").load(window.location.href + " #BasketHeader");
                $("#BasketTotal_basket").load(window.location.href + " #BasketTotal_basket");
            } else if (response.data.STATUS == 'remove_success_basket_empty') {
                new Notify({
                    text: 'Sepetinizde Ürün Kalmadı',
                    type: 2,
                    status: 'warning',
                    autoclose: true,
                    position: "right bottom"
                })
                $("#Basketitem-" + id).remove();
                $("#BasketHeader").load(window.location.href + " #BasketHeader");
                $("#BasketTotal_basket").load(window.location.href + " #BasketTotal_basket");

                setTimeout(function () {
                    window.location.href = "/"
                }, 2000);
            }
        }).catch(function (error) {
            console.log(error);
        })
    }
}

function Logout() {
    window.location.href = "/logout";
}

$("#LogIn").submit(function () {
    axios.post('/api/login', $("#LogIn").serialize()).then(function (response) {
        console.log(response.data);
        if (response.data.STATUS == "empty") {
            new Notify({
                text: 'Lütfen Bütün Boşlukları Doldurun',
                status: 'warning',
                autoclose: true,
                position: "right bottom"
            })
        } else if (response.data.STATUS == "invalid_user") {
            new Notify({
                text: 'Email veya Şifre Hatalı',
                status: 'error',
                autoclose: true,
                position: "right bottom"
            })
        } else if (response.data.STATUS == "login_success") {
            setTimeout(function () {
                window.location.href = "/"
            }, 800);

            new Notify({
                text: 'Başarıyla Giriş Yaptınız',
                status: 'success',
                autoclose: true,
                position: "right bottom"
            })
        }

    }).catch(function (error) {
        console.log(error);
    })
})

$("#SignUp").submit(function () {
    axios.post('/api/signup', $("#SignUp").serialize()).then(function (response) {
        console.log(response.data);
        if (response.data.STATUS == "empty") {
            new Notify({
                text: 'Lütfen Bütün Boşlukları Doldurun',
                status: 'warning',
                autoclose: true,
                position: "right bottom"
            })
        } else if (response.data.STATUS == "invalid_email") {
            new Notify({
                text: 'Lütfen Geçerli Bir Email Giriniz',
                status: 'error',
                autoclose: true,
                position: "right bottom"
            })
        } else if (response.data.STATUS == "invalid_name") {
            new Notify({
                text: 'Lütfen Sayı ve Özel Karakter Kullanmayınız',
                status: 'error',
                autoclose: true,
                position: "right bottom"
            })
        } else if (response.data.STATUS == "invalid_pass") {
            new Notify({
                text: 'Şifreleriniz Uyuşmuyor',
                status: 'error',
                autoclose: true,
                position: "right bottom"
            })
        } else if (response.data.STATUS == "email_exists") {
            new Notify({
                text: 'Bu Email ile Kayıtlı Kullanıcı Bulunmaktadır',
                status: 'error',
                autoclose: true,
                position: "right bottom"
            })
        } else if (response.data.STATUS == "unknown_error") {
            new Notify({
                text: 'Bilinmeyen Bir Hata Oluştu',
                status: 'error',
                autoclose: true,
                position: "right bottom"
            })
        } else if (response.data.STATUS == "unchecked_agreement") {
            new Notify({
                text: 'Gizlilik Sözleşmesini Kabul Etmek Zorundasınız',
                status: 'error',
                autoclose: true,
                position: "right bottom"
            })
        } else if (response.data.STATUS == "signup_success") {
            setTimeout(function () {
                window.location.href = "/login"
            }, 800);

            new Notify({
                text: 'Başarıyla Kayıt Yaptınız',
                status: 'success',
                autoclose: true,
                position: "right bottom"
            })
        }
    }).catch(function (error) {
        console.log(error);
    })
})

$("#EditDetails").submit(function () {
    axios.post('/api/editdetails', $("#EditDetails").serialize()).then(function (response) {
        if (response.data.STATUS == "empty") new Notify({
            text: 'Herhangi Bir Değişiklik Yapılmadı',
            status: 'warning',
            autoclose: true,
            position: "right bottom"
        })
        else if (response.data.STATUS == "invalid_email") new Notify({
            text: 'Lütfen Geçerli Bir Email Giriniz',
            status: 'error',
            autoclose: true,
            position: "right bottom"
        })
        else if (response.data.STATUS == "email_exists") new Notify({
            text: 'Girdiğiniz Email Zaten Kayıtlı',
            status: 'error',
            autoclose: true,
            position: "right bottom"
        })
        else if (response.data.STATUS == "invalid_name" || response.data.STATUS == "invalid_surname") new Notify({
            text: 'Lütfen İsim ve Soyadı için Sayı veya Özel Karakter Kullanmayınız',
            status: 'error',
            autoclose: true,
            position: "right bottom"
        })
        else if (response.data.STATUS == "invalid_phone" || response.data.STATUS == "invalid_hash") new Notify({
            text: 'Lütfen Telefon ve TC Kimlik Numarası için Harf ve Özel Karakter Kullanmayınız',
            status: 'error',
            autoclose: true,
            position: "right bottom"
        })
        else if (response.data.STATUS == "unknown_error") new Notify({
            text: 'Bilinmeyen Bir Hata Oluştu',
            status: 'error',
            autoclose: true,
            position: "right bottom"
        })
        else if (response.data.STATUS == "detail_success") new Notify({
            text: 'Hesap Detayları Başarıyla Kaydedildi',
            status: 'success',
            autoclose: true,
            position: "right bottom"
        })

    }).catch(function (error) {
        console.log(error);
    });
})

$("#ChangePass").submit(function () {
    axios.post('/api/changepassword', $("#ChangePass").serialize()).then(function (response) {
        console.log(response.data);
        if (response.data.STATUS == "empty") new Notify({
            text: 'Herhangi Bir Değişiklik Yapılmadı',
            status: 'warning',
            autoclose: true,
            position: "right bottom"
        })
        else if (response.data.STATUS == "incompatible_pass") new Notify({
            text: 'Şifreler Birbiriyle Uyuşmuyor',
            status: 'error',
            autoclose: true,
            position: "right bottom"
        })
        else if (response.data.STATUS == "invalid_pass") new Notify({
            text: 'Girdiğiniz Şifre Yanlış',
            status: 'error',
            autoclose: true,
            position: "right bottom"
        })
        else if (response.data.STATUS == "same_pass") new Notify({
            text: 'Yeni Şifreniz Eski Şifrenizden Farklı Olmak Zorunda',
            status: 'error',
            autoclose: true,
            position: "right bottom"
        })
        else if (response.data.STATUS == "unknown_error") new Notify({
            text: 'Bilinmeyen Bir Hata Oluştu',
            status: 'error',
            autoclose: true,
            position: "right bottom"
        })
        else if (response.data.STATUS == "pass_success") new Notify({
            text: 'Şifreniz Başarıyla Kaydedildi',
            status: 'success',
            autoclose: true,
            position: "right bottom"
        })

    }).catch(function (error) {
        console.log(error);
    });
})

$("#PlaceOrder").submit(function () {
    axios.post('/api/placeorder', $("#PlaceOrder").serialize()).then(function (response) {
        console.log(response)
        if (response.data.STATUS == "empty") {
            new Notify({
                text: 'Eksik Veri Aktarımı',
                status: 'error',
                autoclose: true,
                position: "right bottom"
            })
        } else if (response.data.STATUS == "invalid_total") {
            new Notify({
                text: 'Hatalı Sepet Tutarı',
                status: 'error',
                autoclose: true,
                position: "right bottom"
            })
        } else if (response.data.STATUS == "invalid_paymentid") {
            new Notify({
                text: 'Hatalı Ödeme Yöntemi',
                status: 'error',
                autoclose: true,
                position: "right bottom"
            })
        } else if (response.data.STATUS == "unknown_error_editbasket") {
            new Notify({
                text: 'Sepet Düzenlemesi Sırasında Beklenmeyen Hata',
                status: 'error',
                autoclose: true,
                position: "right bottom"
            })
        } else if (response.data.STATUS == "unknown_error_placeorder") {
            new Notify({
                text: 'Sipariş Verme Sırasında Beklenmeyen Hata',
                status: 'error',
                autoclose: true,
                position: "right bottom"
            })
        } else if (response.data.STATUS == "placeorder_success") {
            new Notify({
                text: 'Satın Alma Ekranına Yönlendiriliyorsunuz',
                status: 'success',
                autoclose: true,
                position: "right bottom",
                isCloseButton: false,
            })
            setTimeout(function () {
                window.location.href = "/checkout/" + response.data.Orders_id;
            }, 1000);
        }
    }).catch(function (error) {
        console.log(error)
    })
})

function CancelOrder(id) {
    if (id) {
        axios.post('/api/cancelorder', {
            id: id
        }).then(function (response) {
            console.log(response.data);
            if (response.data.STATUS == 'unknown_error') {
                new Notify({
                    text: 'Bilinmeyen Bir Hata Oluştu',
                    status: 'error',
                    autoclose: true,
                    position: "right bottom"
                })
            } else if (response.data.STATUS == 'cancelorder_success') {
                new Notify({
                    text: 'Siparişiniz İptal Edildi',
                    status: 'success',
                    autoclose: true,
                    position: "right bottom"
                })
                setTimeout(function () {
                    window.location.href = "/account"
                }, 2000);
            }
        }).catch(function (error) {
            console.log(error);
        })
    }
}

$("#NewTicket").submit(function () {
    axios.post('/api/newticket', $("#NewTicket").serialize()).then(function (response) {
        console.log(response);
        if (response.data.STATUS == "empty") {
            new Notification("Lütfen Bütün Boşlukları Doldurun", 2);
        } else if (response.data.STATUS == "unknown_error") {
            new Notification("Bilinmeyen Bir Hata Oluştu, Lütfen Daha Sonra Tekrar Deneyin", 0);
        } else if (response.data.STATUS == "newticket_success") {
            new Notification("Destek Talebiniz Başarıyla Gönderildi", 1);
            setTimeout(function () {
                window.close();
            }, 1000);
        }
    }).catch(function (error) {
        console.log(error)
    })
})

$("#NewTicketMessage").submit(function () {
    axios.post('/api/NewTicketMessage', $("#NewTicketMessage").serialize()).then(function (response) {
        console.log(response);
        if (response.data.STATUS == "unknown_error") {
            new Notification("Bilinmeyen Bir Hata Oluştu, Lütfen Daha Sonra Tekrar Deneyin", 0);
        } else if (response.data.STATUS == "newticketmessage_success") {
            location.reload();
        }
    }).catch(function (error) {
        console.log(error)
    })
})

//Alert
function Notification(text, status = 0, button = 0) {
    //status : 0 = error, 1 = success, 2 = warning
    if (status == 0) _status = 'error';
    if (status == 1) _status = 'success';
    if (status == 2) _status = 'warning';

    if (button == 0) _button = 'false';
    if (button == 1) _button = 'true';

    new Notify({
        text: text,
        status: _status,
        autoclose: true,
        position: "right bottom",
        isCloseButton: _button
    })
}