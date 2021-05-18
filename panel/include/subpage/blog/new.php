<?php
if ($_POST) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $link = $_POST['link'];
    $label = $_POST['label'];
    $content = $_POST['content'];
    $pics = $_POST['pic'];

    $Query = Process("insert", "Pages", array(
        "status" => $status,
        "name" => $name,
        "description" => $description,
        "content" => $content,
        "link" => $link,
        "label" => $label,
        "Pages_id" => 1
    ));

    if ($Query and $pics) {
        foreach ($pics as $index => $pic) {
            $Query_pic = Process("insert", "Images", array(
                "image" => $pic,
                "orders" => $index,
                "Pages_id" => $Query,
            ));
        }
    }

    if ($Query) header("location:/panel/blog/new#o"); else  header("location:/panel/blog/new#n");
}
?>

<div class="vb__layout__content">
    <div class="vb__breadcrumbs">
        <div class="vb__breadcrumbs__path">
            <a href="/panel">Panel</a>
            <span class="vb__breadcrumbs__arrow"></span>
            <a href="/panel/blog">Blog Yönetimi</a>
            <span>
                <span class="vb__breadcrumbs__arrow"></span>
                <span>Yeni Blog</span>
            </span>
        </div>
    </div>
    <div class="vb__utils__content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-4">
                            <strong>Yeni Blog</strong>
                        </h4>
                        <form action="" method="post">
                            <div class="form-row">
                                <div class="form-row col-md-8"><!--1-->
                                    <div class="form-group col-md-10">
                                        <label for="name">Başlık</label>
                                        <input type="text" class="form-control" name="name" placeholder=""
                                               id="name"/>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Durum</label><br>
                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-outline-primary active" style="min-width: 62px">
                                                <input type="radio" value="1" name="status" checked/>
                                                Açık
                                            </label>
                                            <label class="btn btn-outline-primary">
                                                <input type="radio" value="0" name="status"/>
                                                Kapalı
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="label">Label</label>
                                        <input type="text" class="form-control" name="label" placeholder=""
                                               id="label"/>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="link">Link</label>
                                        <input type="text" class="form-control" name="link" placeholder=""
                                               id="link"/>
                                    </div>
                                </div>

                                <div class="form-row col-md-4"><!--2-->
                                    <div class="form-group col-md-12">
                                        <div class="form-group col-sm-12">
                                            <input type="hidden"
                                                   id="Dosya"
                                                   value="">
                                            <label class="form-label">Resim</label>
                                            <button type="button"
                                                    data-toggle="modal"
                                                    data-target="#DosyaModal"
                                                    id="DosyaBtn"
                                                    onclick="UrlYukle('/panel/storage/index.php?integration=custom&amp;type=files&amp;Input=Dosya')"
                                                    class="btn btn-light btn-block btn-xs">Seçiniz
                                            </button>
                                            <div id="ResimBilgi" style="display: none;">
                                                <button type="button" onclick="GaleriEkle()"
                                                        class="btn btn-xs btn-success btn-block mt-1">"
                                                    <span id="DosyaText"></span>" Ekle
                                                </button>
                                            </div>
                                            <div id="Galeri"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row col-md-12"><!--3-->
                                    <div class="form-group col-md-12">
                                        <label for="description">Açıklama</label>
                                        <textarea class="form-control" name="description" id="description"
                                                  cols="30"
                                                  rows="3"></textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="name">İçerik</label>
                                        <textarea class="texteditor" name="content"></textarea>
                                    </div>
                                </div>
                            </div>

                            <script>
                                ;(function ($) {
                                    'use strict'
                                    $(function () {
                                        $('.texteditor').summernote({
                                            height: 350,
                                        })
                                    })
                                })(jQuery)
                            </script>

                            <button type="submit" class="btn btn-success px-4">
                                <i class="fe fe-save"></i>
                                Kaydet
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>