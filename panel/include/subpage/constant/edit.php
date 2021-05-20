<?php
$Constant_id = UrlRead(4);
if ($_POST) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $label = $_POST['label'];
    $link = $_POST['link'];
    $image = $_POST['pic'];

    $Query = Process("update", "Constant", array(
        "status" => $status,
        "name" => $name,
        "description" => $description,
        "label" => $label,
        "link" => $link,
        "image" => $image
    ), "id='$Constant_id'");
    if ($Query) header("location:/panel/constant/edit/$Constant_id#o"); else  header("location:/panel/constant/edit/$Constant_id#n");
} else {
    $Constant = Sorgu("*", "Constant", "id='$Constant_id'", 1);
}
?>
<div class="vb__layout__content">
    <div class="vb__breadcrumbs">
        <div class="vb__breadcrumbs__path">
            <a href="/panel">Panel</a>
            <span class="vb__breadcrumbs__arrow"></span>
            <a href="/panel/constant">Sabit İçerik Yönetimi</a>
            <span>
                <span class="vb__breadcrumbs__arrow"></span>
                <span><?php echo $Constant['name'] ?></span>
            </span>
        </div>
    </div>
    <div class="vb__utils__content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-4">
                            <strong>Düzenle</strong>
                        </h4>
                        <form action="" method="post">
                            <div class="form-row">
                                <div class="form-row col-md-8"> <!--1-->
                                    <div class="form-group col-md-10">
                                        <label for="name">Başlık</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                               value="<?php echo $Constant['name'] ?>"/>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Durum</label><br>
                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-outline-primary active" style="min-width: 62px">
                                                <input type="radio" name="status"
                                                       value="1" <?php if ($Constant['status'] == "1") echo "checked" ?>/>
                                                Açık
                                            </label>
                                            <label class="btn btn-outline-primary">
                                                <input type="radio" name="status"
                                                       value="0" <?php if ($Constant['status'] == "0") echo "checked" ?>/>
                                                Kapalı
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="label">Label</label>
                                        <input type="text" class="form-control" name="label" id="label" value="<?php echo $Constant['label'] ?>" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="link">Link</label>
                                        <input type="text" class="form-control" name="link" id="link" value="<?php echo $Constant['link'] ?>" />
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="description">Açıklama</label>
                                        <textarea class="form-control" name="description" id="description"
                                                  cols="30" rows="3"><?php echo $Constant['description'] ?></textarea>
                                    </div>
                                </div>

                                <div class="form-row col-md-4"> <!--2-->
                                    <div class="form-group col-md-12">
                                        <div class="form-group col-sm-12">
                                            <input type="hidden"
                                                   id="Dosya"
                                                   name="pic"
                                                   value="<?php echo $Constant['image'] ?>">
                                            <label class="form-label">Resim</label>
                                            <button type="button"
                                                    data-toggle="modal"
                                                    data-target="#DosyaModal"
                                                    id="DosyaBtn"
                                                    onclick="UrlYukle('/panel/storage/index.php?integration=custom&amp;type=files&amp;Input=Dosya')"
                                                    class="btn btn-light btn-block btn-xs">Seçiniz
                                            </button>
                                            <div id="ResimBilgi" class="mt-1"
                                                 style="text-align: center" <?php if (!$Constant['image']) echo 'style="display: none;"'; ?>>
                                                <img src="<?php echo $Constant['image'] ?>" id="imgDosya"
                                                     style="height: 120px;max-width: 300px;object-fit: contain"/>
                                                <p class="text-center" id="DosyaText"><?php echo substr($Constant['image'], strrpos($Constant['image'], '/') + 1); ?></p>
                                            </div>
                                        </div>
                                    </div>
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