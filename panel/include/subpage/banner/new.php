<?php
if ($_POST) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $image = $_POST['pic'];

    $Query = Process("insert", "Banner", array(
        "status" => $status,
        "name" => $name,
        "description" => $description,
        "image" => $image
    ));
    if ($Query) header("location:/panel/banner/new#o"); else  header("location:/panel/banner/new#n");
}
?>

<div class="vb__layout__content">
    <div class="vb__breadcrumbs">
        <div class="vb__breadcrumbs__path">
            <a href="/panel">Panel</a>
            <span class="vb__breadcrumbs__arrow"></span>
            <a href="/panel/banner">Banner</a>
            <span>
                <span class="vb__breadcrumbs__arrow"></span>
                <span>Yeni</span>
            </span>
        </div>
    </div>
    <div class="vb__utils__content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-4">
                            <strong>Yeni Banner</strong>
                        </h4>
                        <form action="" method="post">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Başlık</label>
                                    <input type="text" class="form-control" name="name" placeholder=""
                                           id="name"/>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Durum</label><br>
                                    <div class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-outline-primary active" style="min-width: 62px">
                                            <input type="radio" name="status" value="1" checked/>
                                            Açık
                                        </label>
                                        <label class="btn btn-outline-primary">
                                            <input type="radio" name="status" value="0"/>
                                            Kapalı
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-group col-sm-12">
                                        <input type="hidden"
                                               id="Dosya"
                                               name="pic"
                                               value="">
                                        <label class="form-label">Resim</label>
                                        <button type="button"
                                                data-toggle="modal"
                                                data-target="#DosyaModal"
                                                id="DosyaBtn"
                                                onclick="UrlYukle('/panel/storage/index.php?integration=custom&amp;type=files&amp;Input=Dosya')"
                                                class="btn btn-light btn-block btn-xs">Seçiniz
                                        </button>
                                        <div id="ResimBilgi" class="mt-1" style="display: none">
                                            <img src="" id="imgDosya" style="height: 120px"/>
                                            <p class="text-center" id="DosyaText"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="description">Açıklama</label>
                                    <textarea class="form-control" name="description" id="description"
                                              cols="30" rows="3"></textarea>
                                </div>
                            </div>

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

