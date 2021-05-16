<?php
if (!$_SESSION['User_id']) header("location:/404");
$User = User();

$Order_id = UrlRead(2);
if (!is_numeric($Order_id)) header("location:/404");

$Order = Sorgu("*", "Orders", "id='$Order_id' AND Users_id='$User[id]'", 1);
if (!$Order) header("location:/404");

$Basket = Basket($Order_id);
?>

<!-- page title -->
<section class="section section--first section--last section--head" data-bg="/Design/img/bg.jpg">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section__wrap">
                    <!-- section title -->
                    <h2 class="section__title">Ödeme</h2>
                    <!-- end section title -->

                    <!-- breadcrumb -->
                    <ul class="breadcrumb">
                        <li class="breadcrumb__item"><a href="/">Anasayfa</a></li>
                        <li class="breadcrumb__item breadcrumb__item--active">Hesabım</li>
                    </ul>
                    <!-- end breadcrumb -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end page title -->

<div class="container">
    <form action="" method="post" id="CreditCard" novalidate>
        <div class="row">


            <div class="col-12 col-lg-7">
                <div class="form">
                    <div class="row">
                        <div class="col-12" style="padding: 0px 30px  15px;">
                            <div class="row" style="justify-content: space-between">
                                <h4 class="form__title" style="margin: 0 10px 0 0">Kredi Kartı</h4>
                                <div class="cart__systems">
                                    <i class="pf pf-visa"></i>
                                    <i class="pf pf-mastercard"></i>
                                </div>
                            </div>

                        </div>

                        <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                            <label class="form__label" for="cc-first-name">Kart Üzerindeki Ad</label>
                            <input id="custom_input cc-first-name" type="text" name="first-name" class="form__input"
                                   placeholder="Adınız">
                        </div>

                        <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                            <label class="form__label" for="cc-last-name">Kart Üzerindeki Soyad</label>
                            <input id="custom_input cc-last-name" type="text" name="last-name" class="form__input"
                                   placeholder="Soyadınız">
                        </div>

                        <div class="col-12 col-md-6 col-lg-12 col-xl-12">
                            <label class="form__label" for="cc-number">Kart Numarası</label>
                            <input id="custom_input cc-number" type="text" name="number" class="form__input"
                                   placeholder="0000 0000 0000 0000">
                        </div>

                        <div class="col-12 col-md-6 col-lg-12 col-xl-7">
                            <label class="form__label" for="cc-expiry">Son Kullanma Tarihi</label>
                            <input id="custom_input cc-expiry" type="text" name="expiry" class="form__input"
                                   placeholder="mm/yy">
                        </div>

                        <div class="col-12 col-md-6 col-lg-12 col-xl-5">
                            <label class="form__label" for="cc-cvc">CVC</label>
                            <input id="custom_input cc-cvc" type="text" name="cvc" class="form__input"
                                   placeholder="000" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-5">
                <div class="cart" style="margin-top: 30px">
                    <div class="col-12"><h4 class="form__title">Özet</h4></div>

                    <div class='card-wrapper' style="margin: 0 auto 30px"></div>

                    <div style="min-height: 100px; width: 100%">
                        <div class="table-responsive">
                            <table class="cart__table" style="min-width: unset">
                                <tbody>
                                <tr style="height: 13px"></tr>
                                <?php foreach ($Basket as $index => $Product) {
                                    if ($index !== "total" and $index !== "count") {
                                        ?>
                                        <tr id="Basketitem-<?php echo $Product['id']; ?>">
                                            <td>
                                                <a class="card__cover" href="">
                                                    <div class="cart__img" style="height: 60px; width: 50px">
                                                        <img src="<?php echo $Product['image'] ?>" alt=""
                                                             style="object-fit: cover; height: inherit">
                                                    </div>
                                                </a>
                                            </td>
                                            <td>
                                                <div class="card__title" style="border-left: none; padding: unset">
                                                    <h3><a href=""><?php echo $Product['name']; ?></a></h3>
                                                </div>
                                            </td>
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
                        <div class="cart__info"
                             style="margin-top: 12px;padding-top: 14px;border-top: 1px solid rgba(167,130,233,0.06)">
                            <div style="color: #fff; font-size: 25px">Toplam:</div>
                            <div class="cart__total" style="width: 120px">
                                <span id="BasketTotal_basket"><?php echo number_format($Basket['total'], "2") ?> TL</span>
                            </div>
                        </div>
                        <div class="sign__group sign__group--checkbox" style="margin-top: 20px">
                            <input id="agreement" name="agreement" type="checkbox" value="1">
                            <label for="agreement">Mesafeli Satış Sözleşmesini Kabul Ediyorum <span
                                        style="font-size: 15px; color: #9147ff">*</span></label>
                        </div>
                        <button type="submit" class="accept_button form__btn"
                                style="display: inline-flex; width: 100%; font-size: 16px; text-transform: unset;">
                            Ödemeyi Tamamla
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script src="/Design/js/card.js"></script>
<script src="/Design/js/creditcard.js"></script>

