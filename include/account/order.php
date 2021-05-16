<?php
if (!$_SESSION['User_id']) header("location:/404");
$User = User();

$Order_id = UrlRead(3);
if (!is_numeric($Order_id))
    header("location:/404");

$Order = Sorgu("*", "Orders", "id='$Order_id' AND Users_id='$User[id]'", 1);
if (!$Order)
    header("location:/404");

$Basket = Basket($Order_id);
?>

<!-- page title -->
<section class="section section--first section--last section--head" data-bg="/Design/img/bg.jpg">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section__wrap">
                    <!-- section title -->
                    <h2 class="section__title">Siparişlerim</h2>
                    <!-- end section title -->

                    <!-- breadcrumb -->
                    <ul class="breadcrumb">
                        <li class="breadcrumb__item"><a href="/">Anasayfa</a></li>
                        <li class="breadcrumb__item"><a href="/account">Hesabım</a></li>
                        <li class="breadcrumb__item breadcrumb__item--active">Siparişlerim</li>
                    </ul>
                    <!-- end breadcrumb -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end page title -->

<!-- section -->
<section class="section">
    <div class="container">
        <div class="row">
            <?php if ($Order['status'] == 0) { ?>
            <div class="col-12 col-lg-8">
                <?php } else if (in_array($Order['status'], array(1, 2)) == true) { ?>
                <div class="col-12 col-10" style="float: none; margin: auto">
                    <?php } ?>
                    <div class="cart" style="min-height: 100px">
                        <div class="table-responsive">
                            <table class="cart__table">
                                <thead style="border-bottom: 1px solid rgba(167,130,233,0.06);">
                                <tr>
                                    <th>Ürün</th>
                                    <th>İsim</th>
                                    <th>Kategori</th>
                                    <th>Fiyat</th>
                                    <th></th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr style="height: 13px"></tr>
                                <?php foreach ($Basket as $index => $Product) {
                                    if ($index !== "total" and $index !=="count") {
                                        ?>
                                        <tr id="Basketitem-<?php echo $Product['id']; ?>">
                                            <td>
                                                <a class="card__cover" href="">
                                                    <div class="cart__img" style="height: 130px">
                                                        <img src="<?php echo $Product['image'] ?>" alt=""
                                                             style="object-fit: cover; height: 130px">
                                                    </div>
                                                </a>
                                            </td>
                                            <td>
                                                <div class="card__title" style="border-left: none; padding: unset">
                                                    <h3><a href=""><?php echo $Product['name']; ?></a></h3>
                                                </div>
                                            </td>
                                            <td><?php echo Category($Product['Category_id']) ?></td>
                                            <td style="width: 93px">
                                                <?php if ($Product['discounted_price']) { ?>
                                                    <span><?php echo number_format($Product['discounted_price'], "2") ?> TL
                                                    <s><?php echo $Product['price']; ?> TL</s></span>
                                                <?php }
                                                if (!$Product['discounted_price']) { ?>
                                                    <span><?php echo number_format($Product['price'], "2") ?> TL</span>
                                                <?php } ?>
                                            </td>
                                            <td></td>
                                        </tr>
                                    <?php }
                                } ?>
                                </tbody>
                            </table>
                        </div>
                        <?php if ($Order['status'] == 0) { ?>
                            <div class="cart__info">
                                <div class="cart__systems">
                                    <i class="pf pf-visa"></i>
                                    <i class="pf pf-mastercard"></i>
                                    <i class="pf pf-paypal"></i>
                                </div>
                                <div class="cart__total" style="width: 120px">
                                    <p>Toplam:</p>
                                    <span id="BasketTotal_basket"><?php echo number_format($Basket['total'], "2") ?> TL</span>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <?php if ($Order['status'] == 0) { ?>
                    <div class="col-12 col-lg-4"
                         style="place-self: flex-end">
                        <form action="javascript:;" method="post" class="form form--first" id="PlaceOrder">
                            <button type="button" onclick="location.href='/checkout/<?php echo $Order_id ?>'" class="accept_button form__btn"
                                    style="display: inline-flex; width: 48%; text-transform: unset;">
                                Ödemeye Devam Et
                            </button>
                            <button type="button" onclick="CancelOrder(<?php echo $Order['id'] ?>)"
                                    class="cancel_button form__btn"
                                    style="display: inline-flex; width: 48%; text-transform: unset; float: right">
                                Ödemeyi İptal Et
                            </button>
                        </form>
                    </div>
                <?php } ?>
            </div>
</section>
<!-- end section -->


