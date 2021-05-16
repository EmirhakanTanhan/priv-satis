<?php
if ($_POST) {
    $status = $_POST['status'];
    $name = $_POST['name'];
    $description = $_POST['description'];


    $Query = Process("insert", "Payment", array(
        "status" => $status,
        "name" => $name,
        "description" => $description,
    ));
    if ($Query) header("location:/panel/payment/new#o"); else  header("location:/panel/payment/new#n");
}
?>

<div class="vb__layout__content">
    <div class="vb__breadcrumbs">
        <div class="vb__breadcrumbs__path">
            <a href="/panel">Panel</a>
            <span class="vb__breadcrumbs__arrow"></span>
            <a href="/panel/payment">Ödeme Yönetimi</a>
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
                            <strong>Yeni Ödeme Yönetimi</strong>
                        </h4>
                        <form action="" method="post">
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label>Durum</label><br>
                                    <div class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-outline-primary active" style="min-width: 62px">
                                            <input type="radio" name="status" value="1" checked/>
                                            Aktif
                                        </label>
                                        <label class="btn btn-outline-primary">
                                            <input type="radio" name="status" value="0"/>
                                            Pasif
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="name">İsim</label>
                                    <input type="text" class="form-control" name="name" placeholder="" autocomplete="off"
                                           id="name" required/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="description">Açıklama</label>
                                    <input type="text" class="form-control" name="description" placeholder="" autocomplete="off"
                                           id="description" required/>
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

