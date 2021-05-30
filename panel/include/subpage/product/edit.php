<?php
$Product_id = UrlRead(4);
if ($_POST) {
    $category = Category("", $_POST['category']);
    $name = $_POST['name'];
    $price = $_POST['price'];
    $status = $_POST['status'];
    $pic = $_POST['pic'];
    $description = $_POST['description'];
    $type = $_POST['type'];
    if (!$_POST['discount'])
        $discount = NULL;
    else $discount = $_POST['discount'];

    if ($type == "0")
        $stock = NULL;
    if ($type == "1") {
        $stock = $_POST['stock'];
        if ($stock <= 0) $stock = 0;
    }
    if ($type == "2") {
        $stock = $_POST['stock'];
        if ($stock <= 0) $stock = 0;
    }

    //Otomatik stokta bu ürünün sorgusu (aktif -> pasif)
    if ($type != "1") {
        $Data = Stock($Product_id);
        foreach ($Data as $datum) {
            if ($datum['status'] == "1") {
                $Query = Process("update", "Stock", array(
                    "status" => 0
                ), "id='$datum[id]'");
            }
        }
    }


    $Query = Process("update", "Product", array(
        "status" => $status,
        "Category_id" => $category,
        "name" => $name,
        "price" => $price,
        "discount" => $discount,
        "stock" => $stock,
        "type" => $type,
        "description" => $description,
        "link" => $name,
        "image" => $pic
    ), "id='$Product_id'");
    if ($Query) header("location:/panel/products/edit/$Product_id#o"); else header("location:/panel/products/edit/$Product_id#n");
} else {
    $Product = Query("*", "Product", "id='$Product_id'", 1);
}
?>
<script src="/panel/include/subpage/product/product.js"></script>

<div class="vb__layout__content">
    <div class="vb__breadcrumbs">
        <div class="vb__breadcrumbs__path">
            <a href="/panel">Panel</a>
            <span class="vb__breadcrumbs__arrow"></span>
            <a href="/panel/products">Ürün Yönetimi</a>
            <span>
                <span class="vb__breadcrumbs__arrow"></span>
                <span><?php echo $Product['name'] ?></span>
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
                                <div class="form-row col-md-10">
                                    <div class="form-group col-md-3">
                                        <label for="facebook">Kategori</label><br>
                                        <select name="category" class="selectpicker w-100" data-live-search="true">
                                            <?php
                                            $Category = Category();
                                            foreach ($Category as $category) { ?>
                                                <option <?php if (Category($Product['Category_id']) == $category['name']) echo "selected"; ?> ><?php echo $category['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label for="name">Ürün İsmi</label>
                                        <input type="text" class="form-control" name="name"
                                               value="<?php echo $Product['name'] ?>"
                                               id="name" required/>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="price">Fiyat</label>
                                        <div class="input-group">
                                            <input type="number" step="any" class="form-control" name="price"
                                                   value="<?php echo $Product['price'] ?>"
                                                   id="price" required/>
                                            <div class="input-group-append">
                                                <span class="input-group-text">₺</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Durum</label><br>
                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-outline-primary active" style="min-width: 62px">
                                                <input type="radio" name="status"
                                                       value="1" <?php if ($Product['status'] == "1") echo "checked" ?> />
                                                Açık
                                            </label>
                                            <label class="btn btn-outline-primary">
                                                <input type="radio" name="status"
                                                       value="0" <?php if ($Product['status'] == "0") echo "checked" ?> />
                                                Kapalı
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-row col-md-12">
                                        <div class="form-group col-md-2">
                                            <label>İndirim</label><br>
                                            <div class="btn-group" data-toggle="buttons">
                                                <label class="btn btn-outline-primary active" style="min-width: 62px">
                                                    <input type="radio"
                                                           onclick="changeDiscountValue(<?php echo $Product['discount'] ?>)"
                                                           id="discount_chk_on" <?php if ($Product['discount']) echo "checked" ?> />
                                                    Var
                                                </label>
                                                <label class="btn btn-outline-primary" style="min-width: 62px">
                                                    <input type="radio" onclick="changeDiscountValue(0)"
                                                           id="discount_chk_off" <?php if (!$Product['discount']) echo "checked" ?> />
                                                    Yok
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <div id="discount"
                                                 style="display: <?php echo($Product['discount'] ? "unset" : "none") ?>">
                                                <label for="discount">İndirim Yüzdesi</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">%</span>
                                                    </div>
                                                    <input id="discount_input" type="number" name="discount"
                                                           value="<?php echo $Product['discount'] ?>" step="any"
                                                           class="form-control"/>
                                                </div>
                                                <small>İndirimli Fiyat:</small>
                                                <small id="discounted_price"></small>
                                                <small> TL</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row col-md-12 mb-0">
                                        <div class="form-group col-md-3 mb-0">
                                            <label>Stok Yönetim Çeşidi</label><br>
                                            <div class="btn-group" data-toggle="buttons">
                                                <label class="btn btn-outline-primary active" style="min-width: 62px">
                                                    <input type="radio" id="stock_unlimited" value="0" name="type"
                                                        <?php if ($Product['type'] == "0") echo "checked" ?> />
                                                    Sınırsız
                                                </label>
                                                <label class="btn btn-outline-primary" style="min-width: 62px">
                                                    <input type="radio" id="stock_auto" value="1" name="type"
                                                           onclick="changeStockValue(<?php if ($Product['type'] == "1") echo $Product['stock']; else echo "0" ?>)"
                                                        <?php if ($Product['type'] == "1") echo "checked" ?> />
                                                    Otomatik
                                                </label>
                                                <label class="btn btn-outline-primary">
                                                    <input type="radio" id="stock_manuel" value="2" name="type"
                                                           onclick="changeStockValue(<?php if ($Product['type'] == "2") echo $Product['stock']; else echo "0" ?>)"
                                                        <?php if ($Product['type'] == "2") echo "checked" ?> />
                                                    Manuel
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-2 mb-0">
                                            <div id="stock_for_pedit"
                                                 style="display: <?php if ($Product['type'] == "0") {
                                                     echo "none";
                                                 } else echo "unset" ?>">
                                                <label for="stock">Stok Adedi</label>
                                                <div class="input-group">
                                                    <input id="stock_input_for_pedit" type="number" step="1"
                                                           class="form-control"
                                                           name="stock"
                                                           value="<?php if ($Product['type'] != "0") echo $Product['stock'] ?>"
                                                        <?php if ($Product['type'] == "1") echo "readonly";
                                                        if ($Product['type'] == "0") echo "placeholder='0'" ?>
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <?php if ($Product['type'] == "1") { ?>
                                            <small>Stok Yönetim Çeşidini değiştirirseniz stok ürünleriniz <span
                                                        class="badge badge-warning">PASİF</span> hale getirilir.</small>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="form-row col-md-2">
                                    <div class="form-group col-sm-12">
                                        <input type="hidden"
                                               id="Dosya"
                                               name="pic"
                                               value="<?php echo $Product['image'] ?>">
                                        <label class="form-label">Resim</label>
                                        <button type="button"
                                                data-toggle="modal"
                                                data-target="#DosyaModal"
                                                id="DosyaBtn"
                                                onclick="UrlYukle('/panel/storage/index.php?integration=custom&amp;type=files&amp;Input=Dosya')"
                                                class="btn btn-light btn-block btn-xs">Seçiniz
                                        </button>
                                        <div id="ResimBilgi" class="mt-1" style="text-align: center">
                                            <img src="<?php echo $Product['image'] ?>" id="imgDosya"
                                                 style="height: 120px;max-width: 150px;object-fit: contain"/>
                                            <p class="text-center"
                                               id="DosyaText"><?php echo substr($Product['image'], strrpos($Product['image'], '/') + 1); ?></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row col-md-12">
                                    <div class="form-group col-md-12">
                                        <div class="alert alert-light" role="alert">
                                        <span id="stock_alert_unlimited"
                                              style="display: <?php if ($Product['type'] == "0") echo "unset"; else echo "none" ?>">
                                            <strong>Sınırsız Stok:</strong> Herhangi bir stok kısıtlaması bulundurmaz, sınırsız stoğunuz vardır, istediğiniz kadar ürünü satabilirsiniz.</span>
                                            <span id="stock_alert_auto"
                                                  style="display: <?php if ($Product['type'] == "1") echo "unset"; else echo "none" ?>">
                                            <strong>Otomatik Stok:</strong> Ürün için her bir stoğu, <a
                                                        style="text-decoration: underline"
                                                        href="/panel/stocks">Stok Yönetimi</a> sayfasından eklemeniz gerekir, eklediğiniz stok kadar ürün satabilirsiniz. Dijital ürün satışları için tavsiye edilir. <br>(Bkz: Oyun için eşya, Site üyeliği)</span>
                                            <span id="stock_alert_manuel"
                                                  style="display: <?php if ($Product['type'] == "2") echo "unset"; else echo "none" ?>"><strong>Manuel Stok:</strong> Stok adedini girmeniz yeterlidir, girdiğiniz stok adedi kadar ürün satabilirsiniz. Fiziksel ürün satışları için tavsiye edilir.</span>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div>
                                            <label class="form-control-label" for="description">Açıklama</label>
                                            <textarea class="form-control" name="description" id="" cols="30"
                                                      rows="3" required><?php echo $Product['description'] ?></textarea>
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
