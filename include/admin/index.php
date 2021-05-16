<?php

?>

<!-- page title -->
<section class="section section--first section--last my_section_head" data-bg="/Design/img/bg.jpg"
         style="padding-top: 90px; ">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section__wrap">
                    <!-- section title -->
                    <h2 class="section__title">Yönetici Paneli</h2>
                    <!-- end section title -->

                    <!-- breadcrumb -->
                    <ul class="breadcrumb">
                        <li class="breadcrumb__item"><a href="/">Anasayfa</a></li>
                        <li class="breadcrumb__item breadcrumb__item--active">Yönetici Paneli</li>
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
                            <h3 style="text-transform: capitalize">Yönetici</h3>
                            <!--<span><?php /*echo $User['email'] */ ?></span>-->
                        </div>
                    </div>

                    <ul class="nav nav-tabs profile__tabs" id="profile__tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" href="/admin"
                               aria-selected="false">GENEL AYARLAR</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/admin/menu"
                               aria-selected="false">MENÜ</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/admin/sabit"
                               aria-selected="false">SABİT</a>
                        </li>
                    </ul>

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
        <!--<div class="tab-content">
            <div class="tab-pane fade" id="tab-2" role="tabpanel">-->
        <div class="row">
            <!-- details form -->
            <div class="col-12 col-lg-6">
                <form action="javascript:;" method="post" class="form" id="EditDetails" style="max-height: 525px">
                    <div class="row">
                        <div class="col-12">
                            <h4 class="form__title">Genel Ayarlar</h4>
                        </div>

                        <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                            <label class="form__label" for="username">Site Başlık</label>
                            <input id="name" type="text" name="name" class="form__input"
                                   placeholder="<?php echo $User['name'] ?>">
                        </div>


                        <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                            <label class="form__label" for="email">Site Açıklama</label>
                            <input id="surname" type="text" name="surname" class="form__input"
                                   placeholder="<?php echo $User['surname'] ?>">
                        </div>

                        <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                            <label class="form__label" for="firstname">Site Anahtar Kelimeler</label>
                            <input id="email" type="text" name="email" class="form__input"
                                   placeholder="<?php echo $User['email'] ?>">
                        </div>

                        <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                            <label class="form__label" for="email">Site Logo</label>
                            <button class="form__select" type="button">Seçiniz</button>
                            <img src="/Design/img/bg2.jpg" alt="" style="width: 270px; border-radius: 10px">
                        </div>

                        <div class="col-12 col-md-6 col-lg-12 col-xl-6" style="position: relative; top: -179px">
                            <label class="form__label" for="email">Site Favicon</label>
                            <button class="form__select" type="button">Seçiniz</button>
                            <img src="/Design/img/bg2.jpg" alt="" style="width: 50px; margin: 0 114px">
                        </div>

                        <div class="col-12" style="position: relative; top: -111px">
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
                            <h4 class="form__title">İletişim</h4>
                        </div>

                        <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                            <label class="form__label" for="username">Email</label>
                            <input id="name" type="text" name="name" class="form__input"
                                   placeholder="<?php echo $User['name'] ?>">
                        </div>

                        <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                            <label class="form__label" for="email">Telefon</label>
                            <input id="surname" type="text" name="surname" class="form__input"
                                   placeholder="<?php echo $User['surname'] ?>">
                        </div>

                        <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                            <label class="form__label" for="firstname">Whatsapp</label>
                            <input id="email" type="text" name="email" class="form__input"
                                   placeholder="<?php echo $User['email'] ?>">
                        </div>

                        <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                            <label class="form__label" for="username">Fax</label>
                            <input id="name" type="text" name="name" class="form__input"
                                   placeholder="<?php echo $User['name'] ?>">
                        </div>

                        <div class="col-12 col-md-6 col-lg-12 col-xl-12">
                            <label class="form__label" for="email">Adres</label>
                            <input id="surname" type="text" name="surname" class="form__input"
                                   placeholder="<?php echo $User['surname'] ?>">
                        </div>

                        <div class="col-12">
                            <button class="form__btn" type="submit">Kaydet</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- end password form -->
            <!-- password form -->
            <div class="col-12 col-lg-6" style="position: relative; top: -101px; left: 655px">
                <form action="javascript:;" method="post" class="form" id="ChangePass">
                    <div class="row">
                        <div class="col-12">
                            <h4 class="form__title">Sosyal Medya</h4>
                        </div>

                        <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                            <label class="form__label" for="username">Facebook</label>
                            <input id="name" type="text" name="name" class="form__input"
                                   placeholder="<?php echo $User['name'] ?>">
                        </div>

                        <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                            <label class="form__label" for="email">Twitter</label>
                            <input id="surname" type="text" name="surname" class="form__input"
                                   placeholder="<?php echo $User['surname'] ?>">
                        </div>

                        <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                            <label class="form__label" for="username">Pinterest</label>
                            <input id="name" type="text" name="name" class="form__input"
                                   placeholder="<?php echo $User['name'] ?>">
                        </div>

                        <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                            <label class="form__label" for="email">Youtube</label>
                            <input id="surname" type="text" name="surname" class="form__input"
                                   placeholder="<?php echo $User['surname'] ?>">
                        </div>

                        <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                            <label class="form__label" for="username">Instagram</label>
                            <input id="name" type="text" name="name" class="form__input"
                                   placeholder="<?php echo $User['name'] ?>">
                        </div>

                        <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                            <label class="form__label" for="email">Linkedin</label>
                            <input id="surname" type="text" name="surname" class="form__input"
                                   placeholder="<?php echo $User['surname'] ?>">
                        </div>

                        <div class="col-12">
                            <button class="form__btn" type="submit">Kaydet</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- end password form -->
        </div>
        <!--</div>
    </div>-->
        <!-- end content tabs -->
    </div>
</section>
<!-- end section -->
