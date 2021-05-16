<?php
if (!$_SESSION['User_id']) header("location:/login");

$Basket = Basket();
if ($Basket['total']) $Payment = PaymentMethod()
?>
<!-- page title -->
<section class="section section--first section--last section--head" data-bg="/Design/img/bg.jpg">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section__wrap">
                    <!-- section title -->
                    <h2 class="section__title">Sepet</h2>
                    <!-- end section title -->

                    <!-- breadcrumb -->
                    <ul class="breadcrumb">
                        <li class="breadcrumb__item"><a href="/">Anasayfa</a></li>
                        <li class="breadcrumb__item breadcrumb__item--active">Sepet</li>
                    </ul>
                    <!-- end breadcrumb -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end page title -->

<!-- section -->
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-12 <?php echo $Basket['total'] ? 'col-lg-8' : 'col-lg-12' ?>">
                <!-- cart -->
                <div class="cart" style="min-height: 200px">
                    <?php if (!$Basket['total']) { ?>
                        <div style="margin: 40px auto; text-align: center">
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                 width="65" height="65"
                                 viewBox="0 0 172 172"
                                 style=" fill:#000000; margin: 20px 124px">
                                <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt"
                                   stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray=""
                                   stroke-dashoffset="0"
                                   font-family="none" font-size="none"
                                   style="mix-blend-mode: normal">
                                    <path d="M0,172v-172h172v172z" fill="none"></path>
                                    <g fill="#ffd83c">
                                        <path d="M86,7.85577c-43.15504,0 -78.14423,34.98919 -78.14423,78.14423c0,43.15505 34.98919,78.14423 78.14423,78.14423c43.15505,0 78.14423,-34.98918 78.14423,-78.14423c0,-43.15504 -34.98918,-78.14423 -78.14423,-78.14423zM102.28005,128.97416c-4.03125,1.57632 -7.23558,2.79087 -9.63883,3.61779c-2.40324,0.82692 -5.16827,1.24038 -8.34675,1.24038c-4.85817,0 -8.65685,-1.18871 -11.37019,-3.56611c-2.6875,-2.35156 -4.03125,-5.375 -4.03125,-9.04447c0,-1.42128 0.10337,-2.86839 0.3101,-4.34135c0.18088,-1.4988 0.51683,-3.15265 0.95613,-5.03906l5.03906,-17.77885c0.4393,-1.70553 0.82692,-3.30769 1.13702,-4.83233c0.3101,-1.52463 0.4393,-2.92007 0.4393,-4.18629c0,-2.2482 -0.46515,-3.85036 -1.39544,-4.72897c-0.95613,-0.90445 -2.73918,-1.34375 -5.375,-1.34375c-1.29206,0 -2.63581,0.20673 -4.0054,0.59435c-1.3696,0.41346 -2.53246,0.80108 -3.51442,1.16286l1.34375,-5.47837c3.28185,-1.34375 6.43449,-2.48077 9.45793,-3.4369c2.9976,-0.95613 5.86599,-1.44712 8.52765,-1.44712c4.83233,0 8.57933,1.1887 11.1893,3.51442c2.60997,2.32572 3.92788,5.375 3.92788,9.09615c0,0.77524 -0.07753,2.14483 -0.25842,4.08293c-0.18088,1.9381 -0.51683,3.72115 -1.00781,5.375l-5.01322,17.72717c-0.41346,1.42128 -0.77524,3.04928 -1.11118,4.85817c-0.3101,1.80889 -0.46514,3.20433 -0.46514,4.13462c0,2.35156 0.51683,3.97956 1.57632,4.83233c1.03365,0.85276 2.86839,1.26622 5.47837,1.26622c1.21454,0 2.58413,-0.20673 4.13462,-0.62019c1.52464,-0.4393 2.63582,-0.80108 3.33353,-1.13702zM101.3756,57.00601c-2.32572,2.17067 -5.14243,3.25601 -8.42428,3.25601c-3.28185,0 -6.1244,-1.08533 -8.47596,-3.25601c-2.35156,-2.17067 -3.51442,-4.80649 -3.51442,-7.88162c0,-3.07512 1.18871,-5.73678 3.51442,-7.93329c2.35156,-2.19652 5.19412,-3.28185 8.47596,-3.28185c3.28185,0 6.09856,1.08533 8.42428,3.28185c2.35156,2.19651 3.51442,4.85817 3.51442,7.93329c0,3.07512 -1.16286,5.71094 -3.51442,7.88162z"></path>
                                    </g>
                                </g>
                            </svg>
                            <p style="color: white">Alışveriş sepetinizde ürün bulunmamaktadır.</p>
                        </div>

                    <?php } ?>
                    <div class="<?php echo $Basket['total'] ? '' : 'd-none' ?>" style="width: 100%">
                        <div class="table-responsive">
                            <table class="cart__table" style="min-width: unset">
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
                                    if ($index !== "total" and $index !== "count") {
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
                                            <td>
                                                <?php if ($Product['discount']) { ?>
                                                    <span class="cart__price"><?php echo number_format(DiscountedPrice($Product['price'], $Product['discount']),"2") ?> TL
                                                    <s class="fw-normal ml-2"><?php echo number_format($Product['price'],"2"); ?> TL</s></span>
                                                <?php }
                                                if (!$Product['discount']) { ?>
                                                    <span class="cart__price"><?php echo number_format($Product['price'], "2") ?> TL</span>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <button class="cart__delete" type="button"
                                                        onclick="BasketRemove(<?php echo $Product['id'] ?>)">
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='512' height='512'
                                                         viewBox='0 0 512 512'>
                                                        <line x1='368' y1='368' x2='144' y2='144'
                                                              style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/>
                                                        <line x1='368' y1='144' x2='144' y2='368'
                                                              style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/>
                                                    </svg>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php }
                                } ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="cart__info">
                            <div class="cart__systems">
                                <i class="pf pf-visa"></i>
                                <i class="pf pf-mastercard"></i>
                            </div>
                            <div class="cart__total" style="width: 215px">
                                <p>Toplam:</p>
                                <span id="BasketTotal_basket"><?php echo number_format($Basket['total'], "2") ?> TL</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end cart -->
            </div>

            <div class="col-12 <?php echo $Basket['total'] ? 'col-lg-4' : 'd-none' ?>" style="place-self: flex-end">
                <form action="javascript:;" method="post" class="form form--first form--coupon" id="PlaceOrder">
                    <select class="form__select" name="payments_id" style="margin-bottom: unset; width: 68%">
                        <?php foreach ($Payment as $method) { ?>
                            <option value="<?php echo $method['id'] ?>"><?php echo $method['name'] ?></option>
                        <?php } ?>
                    </select>
                    <button type="submit" class="accept_button form__btn" style="display: inline-flex; float: right">
                        Satın Al
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end section -->
