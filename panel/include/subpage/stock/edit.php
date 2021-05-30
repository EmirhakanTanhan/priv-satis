<?php
$Stock_id = UrlRead(4);
$Stock = Query("*", "Stock", "id='$Stock_id'", 1);

if ($_POST) {
    $status = $_POST['status'];
    $description = $_POST['description'];
    $product_ = $_POST['product'];

    $Query = Process("update", "Stock", array(
        "status" => $status,
        "Product_id" => $product_,
        "description" => $description,
    ), "id='$Stock_id'");

    //Ürünün stok sayısını değiştirme
    if ($Query) {
        //durum (açık->kapalı) veya (açık->satıldı)
        if ($Stock['status'] == "1" and ($status == "0" or $status == "2")) {
            $Product_stock_num = Query("stock", "Product", "id='$product_'", 1)['stock'];
            $Product_stock_num = $Product_stock_num - 1;
            if ($Product_stock_num <= 0) $Product_stock_num = 0;

            $Query = Process("update", "Product", array(
                "stock" => $Product_stock_num,
            ), "id='$product_'");
        }
        //durum (kapalı->açık) veya (satıldı->açık)
        if (($Stock['status'] == "0" or $Stock['status'] == "2") and $status == "1") {
            $Product_stock_num = Query("stock", "Product", "id='$product_'", 1)['stock'];
            $Product_stock_num = $Product_stock_num + 1;

            $Query = Process("update", "Product", array(
                "stock" => $Product_stock_num,
            ), "id='$product_'");
        }
    }

    if ($Query)
        header("location:/panel/stocks/edit/$Stock_id#o");
    else
        header("location:/panel/stocks/new/$Stock_id#n");
}
?>

<div class="vb__layout__content">
    <div class="vb__breadcrumbs">
        <div class="vb__breadcrumbs__path">
            <a href="/panel">Panel</a>
            <span class="vb__breadcrumbs__arrow"></span>
            <a href="/panel/stocks">Stok Yönetimi</a>
            <span>
                <span class="vb__breadcrumbs__arrow"></span>
                <span>#<?php echo $Stock['id'] ?></span>
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
                                <div class="form-group col-md-3">
                                    <label for="facebook">Ürün</label><br>
                                    <select name="product" class="selectpicker" data-live-search="true">
                                        <?php
                                        $Category = Product();
                                        foreach ($Category as $category) { ?>
                                            <optgroup label="<?php echo $category['name'] ?>">
                                                <?php foreach ($category['product'] as $product) {
                                                    if ($product["type"] == "1") { ?>
                                                        <option <?php if ($Stock['Product_id'] == $product['id']) echo "selected" ?>
                                                                value="<?php echo $product['id'] ?>"><?php echo $product['name'] ?></option>
                                                    <?php }
                                                } ?>
                                            </optgroup>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-2">
                                    <label>Durum</label><br>
                                    <div class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-outline-primary" style="min-width: 62px">
                                            <input type="radio" name="status"
                                                   value="1" <?php if ($Stock['status'] == "1") echo "checked" ?> />
                                            Açık
                                        </label>
                                        <label class="btn btn-outline-primary">
                                            <input type="radio" name="status"
                                                   value="0" <?php if ($Stock['status'] == "0") echo "checked" ?> />
                                            Kapalı
                                        </label>
                                        <label class="btn btn-outline-primary">
                                            <input type="radio" name="status"
                                                   value="2" <?php if ($Stock['status'] == "2") echo "checked" ?> />
                                            Satıldı
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="name">Açıklama</label>
                                    <textarea class="texteditor"
                                              name="description"><?php echo $Stock['description'] ?></textarea>
                                </div>
                            </div>
                            <script>
                                ;(function ($) {
                                    'use strict'
                                    $(function () {
                                        $('.texteditor').summernote({
                                            height: 200,
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

