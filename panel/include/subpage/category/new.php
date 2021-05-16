<?php
if ($_POST) {
    $name = $_POST['name'];
    $status = $_POST['status'];
    $description = $_POST['description'];

    $Query = Process("insert", "Category", array(
        "name" => $name,
        "description" => $description,
        "status" => $status,
    ));
    if ($Query) header("location:/panel/category/new#o"); else  header("location:/panel/category/new#n");
}
?>

<div class="vb__layout__content">
    <div class="vb__breadcrumbs">
        <div class="vb__breadcrumbs__path">
            <a href="/panel">Panel</a>
            <span class="vb__breadcrumbs__arrow"></span>
            <a href="/panel/category">Kategoriler</a>
            <span>
                <span class="vb__breadcrumbs__arrow"></span>
                <span>Yeni</span>
            </span>
        </div>
    </div>
    <div class="vb__utils__content">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-4">
                            <strong>Yeni kategori</strong>
                        </h4>
                        <form action="" method="post">
                            <div class="form-row">
                                <div class="form-group col-md-8">
                                    <label for="name">Kategori Adı</label>
                                    <input type="text" class="form-control" name="name" placeholder=""
                                           id="name"/>
                                </div>
                                <div class="form-group col-md-4">
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
                                <div class="form-group col-md-12">
                                    <label for="description">Açıklama</label>
                                    <textarea class="form-control" name="description" id="description" cols="30"
                                              rows="3"></textarea>
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