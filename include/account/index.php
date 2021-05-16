<?php
$User = User();

$Pagination = Paginator(5, "Orders", UrlRead(2));
if ($Pagination)
    $Orders = Sorgu("*", "Orders", "Users_id='$User[id]'", "$Pagination[Start],$Pagination[Limit]", "id DESC");

$Pagination_ticket = Paginator(5, "Ticket", UrlRead(2));
if ($Pagination_ticket)
    $Tickets = Sorgu("*", "Ticket", "Users_id='$User[id]'", "$Pagination_ticket[Start],$Pagination_ticket[Limit]", "id DESC");
?>

<!-- page title -->
<section class="section section--first section--last section--head" data-bg="/Design/img/bg.jpg">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section__wrap">
                    <!-- section title -->
                    <h2 class="section__title">Hesabım</h2>
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

<!-- section -->
<section class="section section--last">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="profile">
                    <div class="profile__user">
                        <div class="profile__avatar">
                            <img src="/Design/img/user.svg" alt="">
                        </div>
                        <div class="profile__meta">
                            <h3 style="text-transform: capitalize"><?php echo $User['name'] . ' ' . $User['surname'] ?></h3>
                            <span><?php echo $User['email'] ?></span>
                        </div>
                    </div>

                    <ul class="nav nav-tabs profile__tabs" id="profile__tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tab-1" role="tab" aria-controls="tab-1"
                               aria-selected="true">SİPARİŞLERİM</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab-2" role="tab" aria-controls="tab-2"
                               aria-selected="false">AYARLAR</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab-3" role="tab" aria-controls="tab-3"
                               aria-selected="false">YARDIM</a>
                        </li>
                    </ul>

                    <button id="new_ticket_button" style="display: none" class="header__login mr-3" type="button"
                            onclick="window.open('/ticket/new','','width=600,height=500');">
                        <span>YENİ DESTEK TALEBİ</span>
                    </button>

                    <button class="profile__logout" type="button" onclick="Logout()">
                        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'>
                            <path d='M304 336v40a40 40 0 01-40 40H104a40 40 0 01-40-40V136a40 40 0 0140-40h152c22.09 0 48 17.91 48 40v40M368 336l80-80-80-80M176 256h256'
                                  fill='none' stroke-linecap='round' stroke-linejoin='round' stroke-width='32'/>
                        </svg>
                        <span>ÇIKIŞ YAP</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- content tabs -->
        <div class="tab-content">
            <div class="tab-pane fade show active" id="tab-1" role="tabpanel">
                <div class="row">
                    <div class="col-10" style="float: none; margin: auto">
                        <div class="table-responsive table-responsive--border">
                            <?php if (!$Orders) { ?>
                                <div style="margin: 60px auto; text-align: center">
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                         width="65" height="65"
                                         viewBox="0 0 172 172"
                                         style=" fill:#000000; margin: 20px 124px">
                                        <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1"
                                           stroke-linecap="butt"
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
                                    <p style="color: white">Herhangi Bir Siparişiniz Bulunmamaktadır.</p>
                                </div>
                            <?php } ?>
                            <?php if ($Orders) { ?>
                                <table class="profile__table">
                                    <thead>
                                    <tr>
                                        <th>№</th>
                                        <th>Tarih</th>
                                        <th>Ürün Adedi</th>
                                        <th>Ödeme Yöntemi</th>
                                        <th>Tutar</th>
                                        <th>Durumu</th>
                                        <th></th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <?php
                                    foreach ($Orders as $order) {
                                        $NumberOfProduct = count(Basket($order['id'])) - 2;
                                        ?>
                                        <tr style="height: 110px">
                                            <td>
                                                #<?php echo $order['id']; ?>
                                            </td>
                                            <td style="width: 140px">
                                                <?php echo explode(" ", $order['history'])[0] ?>
                                            </td>
                                            <td style="text-align: center">
                                                <?php echo $NumberOfProduct ?>
                                            </td>
                                            <td>
                                                <?php echo PaymentMethod($order['Payments_id']) ?>
                                            </td>
                                            <td>
                                                <?php echo $order['price'] ?> TL
                                            </td>
                                            <td style="width: 190px;">
                                                <?php if ($order['status'] == 0) { ?>
                                                    <p style="color: #ffcd39; margin-bottom: unset">
                                                        Ödeme Beklemede</p> <?php } else if ($order['status'] == 1) { ?>
                                                    <p style="color: lawngreen; margin-bottom: unset">
                                                        Ödeme
                                                        Tamamlandı</p> <?php } else if ($order['status'] == 2) { ?>
                                                    <p style="color: red; margin-bottom: unset">İptal
                                                        Edildi</p> <?php } ?>
                                            </td>
                                            <td style="width: 125px; padding-right: unset">
                                                <a class="header__login"
                                                   href="/account/order/<?php echo $order['id']; ?>"
                                                   style="border: 1px solid rgba(167,130,233,0.4); cursor: pointer; width: 140px; font-size: 15px">
                                                    Sipariş Detayları
                                                </a>

                                            </td>
                                            <td></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            <?php } ?>
                        </div>

                        <?php if ($Orders) { ?> <!--PAGINATOR, KOMPLE ALABILIRSIN BURAYI, HER SAYFA ICIN AYNI-->
                            <div class="col-12">
                                <div class="paginator">
                                    <div class="paginator__counter">
                                        <?php echo "Toplam: $Pagination[Count] | Gösterilen: $Pagination[first_shown]-$Pagination[last_shown]" ?>
                                    </div>

                                    <ul class="paginator__wrap">
                                        <?php
                                        if ($Pagination['Count'] > $Pagination['Limit']) {
                                            if ($Pagination['Page'] != 1) { ?>
                                                <li class="paginator__item paginator__item--prev">
                                                    <a href="/account">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                             viewBox="0 0 24 24" fill="none" stroke="#000000"
                                                             stroke-width="2" stroke-linecap="round"
                                                             stroke-linejoin="round">
                                                            <path d="M11 17l-5-5 5-5M18 17l-5-5 5-5"/>
                                                        </svg>
                                                    </a>
                                                </li>
                                            <?php } ?>

                                            <?php for ($index = $Pagination['Page'] - 2, $countLimit = 0, $check = 0; $index <= $Pagination['Page'], $countLimit < 3; $index++, $countLimit++) {
                                                if ($index < 0) $index = 0;
                                                if ($Pagination['Page'] == $Pagination['LastPage'] and $countLimit == 0 and $Pagination['LastPage'] != 2) {
                                                    $index = $Pagination['LastPage'] - 3;
                                                }
                                                if ($index < $Pagination['LastPage']) {
                                                    ?>
                                                    <li class="paginator__item <?php if ($Pagination['Page'] == ($index + 1)) echo "paginator__item--active" ?>">
                                                        <a href="/account/<?php echo $index + 1; ?>"><?php echo $index + 1; ?></a>
                                                    </li>
                                                <?php }
                                            } ?>

                                            <?php if ($Pagination['Page'] != $Pagination['LastPage']) { ?>
                                                <li class="paginator__item paginator__item--next">
                                                    <a href="/account/<?php echo $Pagination['LastPage']; ?>">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                             viewBox="0 0 24 24" fill="none" stroke="#000000"
                                                             stroke-width="2"
                                                             stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M13 17l5-5-5-5M6 17l5-5-5-5"/>
                                                        </svg>
                                                    </a>
                                                </li>
                                            <?php }
                                        } ?>
                                    </ul>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>


            <div class="tab-pane fade" id="tab-2" role="tabpanel">
                <div class="row">
                    <!-- details form -->
                    <div class="col-12 col-lg-6">
                        <form action="javascript:;" method="post" class="form" id="EditDetails">
                            <div class="row">
                                <div class="col-12">
                                    <h4 class="form__title">Hesap Detayları</h4>
                                </div>

                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                    <label class="form__label" for="username">İsim</label>
                                    <input id="name" type="text" name="name" class="form__input"
                                           placeholder="<?php echo $User['name'] ?>">
                                </div>

                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                    <label class="form__label" for="email">Soyadı</label>
                                    <input id="surname" type="text" name="surname" class="form__input"
                                           placeholder="<?php echo $User['surname'] ?>">
                                </div>

                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                    <label class="form__label" for="firstname">Email</label>
                                    <input id="email" type="text" name="email" class="form__input"
                                           placeholder="<?php echo $User['email'] ?>">
                                </div>

                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                    <label class="form__label" for="lastname">Telefon</label>
                                    <input id="phone" type="text" name="phone" class="form__input"
                                           placeholder="<?php echo $User['phone'] ?>">
                                </div>

                                <div class="col-12 col-md-6 col-lg-12 col-xl-12">
                                    <label class="form__label" for="lastname">Adres</label>
                                    <input id="address" type="text" name="address" class="form__input"
                                           placeholder="<?php echo $User['address'] ?>">
                                </div>

                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                    <label class="form__label" for="lastname">TC Kimlik Numarası</label>
                                    <input id="hash" type="text" name="hash" class="form__input"
                                           placeholder="<?php echo $User['hash'] ?>">
                                </div>

                                <div class="col-12">
                                    <button class="form__btn" type="submit">Kaydet</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- end details form -->

                    <!-- password form -->
                    <div class="col-12 col-lg-6">
                        <form action="javascript:;" method="post" class="form" id="ChangePass">
                            <div class="row">
                                <div class="col-12">
                                    <h4 class="form__title">Şifrenizi Değiştirin</h4>
                                </div>

                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                    <label class="form__label" for="old_pass">Eski Şifre</label>
                                    <input id="old_pass" type="password" name="old_pass" class="form__input">
                                </div>

                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                    <label class="form__label" for="pass">Yeni Şifre</label>
                                    <input id="pass" type="password" name="pass" class="form__input">
                                </div>

                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                    <label class="form__label" for="pass_repeat">Yeni Şifre Tekrar</label>
                                    <input id="pass_repeat" type="password" name="pass_repeat" class="form__input">
                                </div>

                                <div class="col-12">
                                    <button class="form__btn" type="submit">Kaydet</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- end password form -->
                </div>
            </div>


            <div class="tab-pane fade" id="tab-3" role="tabpanel">
                <div class="row">
                    <div class="col-10" style="float: none; margin: auto">
                        <div class="table-responsive table-responsive--border">
                            <?php if (!$Tickets) { ?>
                                <div style="margin: 60px auto; text-align: center">
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                         width="65" height="65"
                                         viewBox="0 0 172 172"
                                         style=" fill:#000000; margin: 20px 124px">
                                        <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1"
                                           stroke-linecap="butt"
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
                                    <p style="color: white">Herhangi Bir Destek Talebiniz Bulunmamaktadır.</p>
                                </div>
                            <?php } ?>
                            <?php if ($Tickets) { ?>
                                <table class="profile__table">
                                    <thead>
                                    <tr>
                                        <th>№</th>
                                        <th>Tarih</th>
                                        <th>Başlık</th>
                                        <th>Açıklama</th>
                                        <th></th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <?php
                                    foreach ($Tickets as $ticket) {
                                        ?>
                                        <tr style="height: 110px">
                                            <td>
                                                #<?php echo $ticket['id']; ?>
                                            </td>
                                            <td style="width: 140px">
                                                <?php echo explode(" ", $ticket['history'])[0] ?>
                                            </td>
                                            <td style="width: 340px">
                                                <?php echo $ticket['name'] ?>
                                            </td>
                                            <td>
                                                <?php echo $ticket['description'] ?>
                                            </td>
                                            <td style="width: 125px; padding-right: unset">
                                                <a class="header__login"
                                                   onclick="window.open('/ticket/<?php echo $ticket['id']; ?>','name','width=700,height=600')"
                                                   style="border: 1px solid rgba(167,130,233,0.4); cursor: pointer; width: 140px; font-size: 15px">
                                                    Konuşma Ekranı
                                                </a>

                                            </td>
                                            <td></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            <?php } ?>
                        </div>

                        <?php if ($Tickets) { ?> <!--PAGINATOR, KOMPLE ALABILIRSIN BURAYI, HER SAYFA ICIN AYNI-->
                            <div class="col-12">
                                <div class="paginator">
                                    <div class="paginator__counter">
                                        <?php echo "Toplam: $Pagination_ticket[Count] | Gösterilen: $Pagination_ticket[first_shown]-$Pagination_ticket[last_shown]" ?>
                                    </div>

                                    <ul class="paginator__wrap">
                                        <?php
                                        if ($Pagination_ticket['Count'] > $Pagination_ticket['Limit']) {
                                            if ($Pagination_ticket['Page'] != 1) { ?>
                                                <li class="paginator__item paginator__item--prev">
                                                    <a href="/account">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                             viewBox="0 0 24 24" fill="none" stroke="#000000"
                                                             stroke-width="2" stroke-linecap="round"
                                                             stroke-linejoin="round">
                                                            <path d="M11 17l-5-5 5-5M18 17l-5-5 5-5"/>
                                                        </svg>
                                                    </a>
                                                </li>
                                            <?php } ?>

                                            <?php for ($index = $Pagination_ticket['Page'] - 2, $countLimit = 0, $check = 0; $index <= $Pagination_ticket['Page'], $countLimit < 3; $index++, $countLimit++) {
                                                if ($index < 0) $index = 0;
                                                if ($Pagination_ticket['Page'] == $Pagination_ticket['LastPage'] and $countLimit == 0 and $Pagination_ticket['LastPage'] != 2) {
                                                    $index = $Pagination_ticket['LastPage'] - 3;
                                                }
                                                if ($index < $Pagination_ticket['LastPage']) {
                                                    ?>
                                                    <li class="paginator__item <?php if ($Pagination_ticket['Page'] == ($index + 1)) echo "paginator__item--active" ?>">
                                                        <a href="/account/<?php echo $index + 1; ?>"><?php echo $index + 1; ?></a>
                                                    </li>
                                                <?php }
                                            } ?>

                                            <?php if ($Pagination_ticket['Page'] != $Pagination_ticket['LastPage']) { ?>
                                                <li class="paginator__item paginator__item--next">
                                                    <a href="/account/<?php echo $Pagination_ticket['LastPage']; ?>">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                             viewBox="0 0 24 24" fill="none" stroke="#000000"
                                                             stroke-width="2"
                                                             stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M13 17l5-5-5-5M6 17l5-5-5-5"/>
                                                        </svg>
                                                    </a>
                                                </li>
                                            <?php }
                                        } ?>
                                    </ul>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- end content tabs -->
    </div>
</section>
<!-- end section -->