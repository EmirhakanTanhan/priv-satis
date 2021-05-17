<?php
if ($_POST) {
    $category = $_POST['category'];
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
    if ($type == "1")
        $stock = 0;
    if ($type == "2") {
        $stock = $_POST['stock'];
        if ($stock <= 0) $stock = 0;
    }


    $Query = Process("insert", "Product", array(
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
    ));
    if ($Query) header("location:/panel/products/new#o"); else  header("location:/panel/products/new#n");
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
                <span>Yeni ürün</span>
            </span>
        </div>
    </div>
    <div class="vb__utils__content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-4">
                            <strong>Yeni Ürün</strong>
                        </h4>
                        <form action="" method="post">
                            <div class="form-row">
                                <div class="form-row col-md-10"> <!--1-->
                                    <div class="form-group col-md-3">
                                        <label for="facebook">Kategori</label><br>
                                        <select name="category" class="selectpicker w-100" data-live-search="true">
                                            <?php
                                            $Category = Category();
                                            foreach ($Category as $category) { ?>
                                                <option value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label for="name">Ürün İsmi</label>
                                        <input type="text" class="form-control" name="name" placeholder=""
                                               id="name" required/>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="price">Fiyat</label>
                                        <div class="input-group">
                                            <input type="number" step="any" class="form-control" name="price"
                                                   placeholder="00,00"
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
                                                <input type="radio" name="status" value="1" checked/>
                                                Açık
                                            </label>
                                            <label class="btn btn-outline-primary">
                                                <input type="radio" name="status" value="0"/>
                                                Kapalı
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-row col-md-12">
                                        <div class="form-group col-md-2">
                                            <label>İndirim</label><br>
                                            <div class="btn-group" data-toggle="buttons">
                                                <label class="btn btn-outline-primary active" style="min-width: 62px">
                                                    <input type="radio" id="discount_chk_on"/>
                                                    Var
                                                </label>
                                                <label class="btn btn-outline-primary" style="min-width: 62px">
                                                    <input type="radio" id="discount_chk_off" checked/>
                                                    Yok
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-2">
                                            <div id="discount" style="display: none">
                                                <label for="discount">İndirim Yüzdesi</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">%</span>
                                                    </div>
                                                    <input id="discount_input" type="number" name="discount"
                                                           placeholder="00,00" step="any"
                                                           class="form-control"/>
                                                </div>
                                                <small>İndirimli Fiyat:</small>
                                                <small id="discounted_price"></small>
                                                <small> TL</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row col-md-12">
                                        <div class="form-group col-md-3">
                                            <label>Stok Yönetim Çeşidi</label><br>
                                            <div class="btn-group" data-toggle="buttons">
                                                <label class="btn btn-outline-primary active" style="min-width: 70px">
                                                    <input type="radio" id="stock_unlimited" name="type" value="0"
                                                           checked/>
                                                    Sınırsız
                                                </label>
                                                <label class="btn btn-outline-primary" style="min-width: 70px">
                                                    <input type="radio" id="stock_auto" name="type" value="1"/>
                                                    Otomatik
                                                </label>
                                                <label class="btn btn-outline-primary" style="min-width: 70px">
                                                    <input type="radio" id="stock_manuel" name="type"
                                                           value="2"/>
                                                    Manuel
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-2">
                                            <div id="stock_for_pnew" style="display: none">
                                                <label for="stock">Stok Adedi</label>
                                                <div class="input-group">
                                                    <input id="stock_input_for_pnew" type="number" step="1"
                                                           class="form-control"
                                                           name="stock"
                                                           placeholder="0"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row col-md-2"> <!--2-->
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
                                            <img src="" id="imgDosya" style="height: 120px;max-width: 150px;object-fit: contain"/>
                                            <p class="text-center" id="DosyaText"></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row col-md-12"> <!--3-->
                                    <div class="form-group col-md-12">
                                        <div class="alert alert-light" role="alert">
                                            <span id="stock_alert_unlimited"><strong>Sınırsız Stok:</strong> Herhangi bir stok kısıtlaması bulundurmaz, sınırsız stoğunuz vardır, istediğiniz kadar ürünü satabilirsiniz.</span>
                                            <span id="stock_alert_auto"
                                                  style="display: none"><strong>Otomatik Stok:</strong> Ürün için her bir stoğu, <a
                                                        style="text-decoration: underline"
                                                        href="/panel/stocks">Stok Yönetimi</a> sayfasından eklemeniz gerekir, eklediğiniz stok kadar ürün satabilirsiniz. Dijital ürün satışları için tavsiye edilir. <br>(Bkz:Oyun için eşya, Site üyeliği)</span>
                                            <span id="stock_alert_manuel"
                                                  style="display: none"><strong>Manuel Stok:</strong> Stok adedini girmeniz yeterlidir, girdiğiniz stok adedi kadar ürün satabilirsiniz. Fiziksel ürün satışları için tavsiye edilir.</span>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div>
                                            <label class="form-control-label" for="description">Açıklama</label>
                                            <textarea class="form-control" name="description" id="" cols="30"
                                                      rows="3" required></textarea>
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
