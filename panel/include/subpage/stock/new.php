<?php
if ($_POST) {
    $status = $_POST['status'];
    $description = $_POST['description'];
    $product_ = $_POST['product'];

    $Query = Process("insert", "Stock", array(
        "status" => $status,
        "Product_id" => $product_,
        "description" => $description,
    ));

    //Ürünün stok sayısını değiştirme
    if ($status == "1") {
        if ($Query) {
            $Product_stock_num = Sorgu("stock", "Product", "id='$product_'", 1)['stock'];
            $Product_stock_num = $Product_stock_num + 1;

            $Query = Process("update", "Product", array(
                "stock" => $Product_stock_num,
            ), "id='$product_'");
        }
    }
    if ($Query) header("location:/panel/stocks/new#o"); else header("location:/panel/stocks/new#n");
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
                <span>Yeni Stok Ürünü</span>
            </span>
        </div>
    </div>
    <div class="vb__utils__content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-4">
                            <strong>Yeni Stok Ürünü</strong>
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
                                                        <option value="<?php echo $product['id'] ?>"><?php echo $product['name'] ?></option>
                                                    <?php }
                                                } ?>
                                            </optgroup>
                                        <?php } ?>
                                    </select>
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
                                        <label class="btn btn-outline-primary">
                                            <input type="radio" name="status" value="2"/>
                                            Satıldı
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="name">Açıklama</label>
                                    <textarea class="texteditor" name="description"></textarea>
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
