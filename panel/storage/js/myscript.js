$('#wForm').validate({
    submit: {
        settings: {
            inputContainer: '.form-group'
        }
    }
});

function UrlYukle(Url) {
    //document.getElementById('calendar').src = loc;
    $("#DosyaDizin").attr('src', Url);
    $("#DosyaDizin").attr('style', "height:600px");

    $("#DosyaGetir").attr('style', "height:0");
    $("#DosyaGetir").html(' ');
}

function ModalGizle(id) {
    $("#" + id).modal('hide');
}

function GaleriEkle() {
    sira = $(".move").length + 1;
    img = $("#Dosya").val();
    adi = $("#DosyaText").html();
    $("#Galeri").append("<div class='move' id='" + sira + "'><img src='" + img + "' class='panel_image img-arrows'><input name='pic[]' type='hidden' value='" + img + "'><button class='btn btn-danger btn-block panel_button' onclick='ResimSil(" + sira + ")'> SİL</button></div>");
    $("#ResimBilgi").attr("style", "display:none");
}

function ResimSil(sira) {
    $("#" + sira).remove();
}

$("#Galeri").sortable({
    handle: ".img-arrows",
});
$("#Galeri").disableSelection();
$("#Kategori_id").change(function () {
    Kategori = $("#Kategori_id").val();
});
