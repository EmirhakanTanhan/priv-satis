<?php
$Order_id = UrlRead(3);

$Order = Query("*", "Orders", "id='$Order_id'", 1);
$User = User($Order['Users_id']);
$Products = Basket($Order['id'], $Order['Users_id']);
?>

<div class="vb__layout__content">
    <form action="" method="post">
        <div class="vb__breadcrumbs">
            <div class="vb__breadcrumbs__path">
                <a href="/panel">Panel</a>
                <span class="vb__breadcrumbs__arrow"></span>
                <a href="/panel/orders">Siparişler</a>
                <span>
                    <span class="vb__breadcrumbs__arrow"></span>
                    <span><?php echo $Order_id . ' Numaralı Sipariş' ?></span>
                </span>
            </div>
        </div>
        <div class="vb__utils__content">
            <div class="row">
                <div class="col-md-6">
                    <div class="card" style="padding-bottom: 15px">
                        <div class="card-header">
                            <div class="d-flex">
                                <h4 style="margin: unset"><strong>Sipariş Bilgileri</strong></h4>
                                <small style="align-self: flex-end;padding-left: 5px">#<?php echo $Order['id'] ?></small>
                                <?php if ($Order['status'] == '0') { ?> <span class="badge badge-warning"
                                                                              style="margin-left: auto; line-height: normal">ÖDEME BEKLENİYOR</span>
                                <?php }
                                if ($Order['status'] == '1') { ?> <span class="badge badge-success"
                                                                        style="margin-left: auto; line-height: normal">ÖDENDİ</span>
                                <?php }
                                if ($Order['status'] == '2') { ?> <span class="badge badge-danger"
                                                                        style="margin-left: auto; line-height: normal">İPTAL EDİLDİ</span> <?php } ?>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>İşlem Numarası:</strong>
                                    <span><?php echo $Order['id'] ?></span><br>
                                    <strong>Oluşturma Tarihi:</strong>
                                    <span><?php echo date_format(date_create($Order['history']), "Y/m/d H:i"); ?></span><br>
                                    <strong>Sipariş Durumu:</strong>
                                    <?php if ($Order['status'] == '0') { ?> <span>Ödeme Bekleniyor</span>
                                    <?php }
                                    if ($Order['status'] == '1') { ?> <span>Ödendi</span>
                                    <?php }
                                    if ($Order['status'] == '2') { ?> <span>İptal Edildi</span> <?php } ?>
                                </div>
                                <div class="col-md-6">
                                    <strong>Toplam Tutar:</strong>
                                    <span><?php echo $Order['price'] ?> TL</span><br>
                                    <strong>Ödeme Yöntemi:</strong>
                                    <span><?php echo PaymentMethod($Order['Payments_id']) ?></span><br>
                                    <strong>Ürün Adedi:</strong>
                                    <span><?php echo count(Basket($Order['id'], $Order['Users_id'])) - 2; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card" style="padding-bottom: 15px">
                        <div class="card-header">
                            <div class="d-flex">
                                <h4 style="margin: unset"><strong>Üye Bilgileri</strong></h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Adı Soyadı:</strong>
                                    <span><?php echo $User['name'] . ' ' . $User['surname'] ?></span><br>
                                    <strong>Email:</strong>
                                    <span><a href="/panel/users/<?php echo $User['id'] ?>" class="link-info"
                                             style="text-decoration: underline"><?php echo $User['email'] ?></a></span>

                                </div>
                                <div class="col-md-6">
                                    <strong>Telefon:</strong>
                                    <span><?php echo $User['phone'] ?></span><br>
                                    <strong>TC Kimlik Numarası:</strong>
                                    <span><?php echo $User['hash'] ?></span><br>
                                </div>
                                <div class="col-md-12">
                                    <strong>Adres:</strong>
                                    <span><?php echo $User['address'] ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex">
                                <h4 style="margin: unset"><strong>Ürünler</strong></h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-5">
                                        <table class="table table-hover" id="example2">
                                            <thead>
                                            <tr>
                                                <th style="width: 30px">Resim</th>
                                                <th style="width: 190px;">İsim</th>
                                                <th>Kategori</th>
                                                <th>Stok</th>
                                                <th>Fiyat</th>
                                            </tr>
                                            </thead>
                                            <tbody class="panel_table">
                                            <?php
                                            foreach ($Products as $index => $product) {
                                                if ($index !== "total" and $index !== "count") {
                                                    ?>
                                                    <tr>
                                                        <td><img src="<?php echo $product['image']; ?>" alt=""
                                                                 style="max-height: 70px"></td>
                                                        <td><?php echo $product['name']; ?></td>
                                                        <td><?php echo Category($product['Category_id']); ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($product['stock'] == NULL) echo "Sınırsız";
                                                            else echo $product['stock'];
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php if (!$product['discounted_price']) { ?>
                                                                <span><?php echo $product['price']; ?> TL </span>
                                                            <?php } else if ($product['discounted_price']) { ?>
                                                                <span style="text-decoration: line-through"><?php echo $product['price'] ?> TL</span>
                                                                <span style="margin-left: 5px">%<?php echo DiscountedPrice($product['price'], $product['discounted_price'], 1) ?></span>
                                                                <br>
                                                                <span><?php echo $product['discounted_price'] . " TL" ?></span>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                <?php }
                                            } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>




