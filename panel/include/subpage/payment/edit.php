<?php
$Payment_id = UrlRead(4);
if ($_POST) {
    $status = $_POST['status'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $api_secret = $_POST['api_secret'];
    $api_key = $_POST['api_key'];


    $Query = Process("update", "Payment", array(
        "status" => $status,
        "name" => $name,
        "description" => $description,
        "api_secret" => $api_secret,
        "api_key" => $api_key,
    ), "id='$Payment_id'");

    if (($Payment_id == '1' or $Payment_id == '2') and $status == '1' and $Query) {
        if ($Payment_id == '1')
            $status_update_id = 2;
        if ($Payment_id == '2')
            $status_update_id = 1;
        $Query_update = Process("update", "Payment", array(
            "status" => 0,
        ), "id='$status_update_id'");
    }

    if ($Query) header("location:/panel/payment/edit/$Payment_id#o"); else header("location:/panel/payment/edit/$Payment_id#n");
} else {
    $Payment = Query("*", "Payment", "id='$Payment_id'", 1);
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
                <span><?php echo $Payment['name'] ?></span>
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
                                <div class="form-group col-md-2">
                                    <label>Durum</label><br>
                                    <div class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-outline-primary active" style="min-width: 62px">
                                            <input type="radio" name="status"
                                                   value="1" <?php if ($Payment['status'] == "1") echo "checked" ?> />
                                            Aktif
                                        </label>
                                        <label class="btn btn-outline-primary">
                                            <input type="radio" name="status"
                                                   value="0" <?php if ($Payment['status'] == "0") echo "checked" ?> />
                                            Pasif
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="name">İsim</label>
                                    <input type="text" class="form-control" name="name" autocomplete="off"
                                           id="name" value="<?php echo $Payment['name']; ?>"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="description">Açıklama</label>
                                    <input type="text" class="form-control" name="description" autocomplete="off"
                                           id="description"
                                           value="<?php echo $Payment['description']; ?>" <?php if ($Payment_id == '1' or $Payment_id == '2') echo "readonly"; ?> />
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="api_secret">Api Secret</label>
                                    <input type="text" class="form-control" name="api_secret" id="api_secret"
                                           value="<?php echo $Payment['api_secret']; ?>" <?php if ($Payment_id != '1' and $Payment_id != '2') echo "readonly"; ?> />
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="api_key">Api Key</label>
                                    <input type="text" class="form-control" name="api_key" id="api_key"
                                           value="<?php echo $Payment['api_key']; ?>" <?php if ($Payment_id != '1' and $Payment_id != '2') echo "readonly"; ?> />
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