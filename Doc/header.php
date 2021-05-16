<?php
$Basket = Basket();
if (User()) $User = User();
?>

<!-- header -->
<header class="header">
    <div class="header__wrap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="header__content">
                        <button class="header__menu" type="button">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>

                        <a href="/" class="header__logo">
                            <img src="/Design/img/logo.svg" alt="Satis.me">
                        </a>

                        <ul class="header__nav">
                            <li class="header__nav-item">
                                <a class="header__nav-link" href="/">ANASAYFA</a>
                            </li>
                            <li class="header__nav-item">
                                <a class="header__nav-link" href="#" role="button" id="dropdownMenu1"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">KATEGORİ
                                    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'>
                                        <path fill='none' stroke-linecap='round' stroke-linejoin='round'
                                              stroke-width='48' d='M112 184l144 144 144-144'/>
                                    </svg>
                                </a>

                                <ul class="dropdown-menu header__nav-menu" aria-labelledby="dropdownMenu1">
                                    <li><a href="catalog.html">Catalog</a></li>
                                    <li class="dropdown-submenu">
                                        <a class="dropdown-item" href="#" role="button" id="dropdownMenuSub"
                                           data-toggle="dropdown" aria-haspopup="true"
                                           aria-expanded="false">Category</a>

                                        <ul class="dropdown-menu header__nav-menu" aria-labelledby="dropdownMenuSub">
                                            <li><a href="category.html">Category page</a></li>
                                            <li><a href="category.html">Playstation</a></li>
                                            <li><a href="category.html">XBOX</a></li>
                                            <li><a href="category.html">PC</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="details.html">Details style 1</a></li>
                                    <li><a href="details2.html">Details style 2</a></li>
                                </ul>
                            </li>

                            <li class="header__nav-item">
                                <a class="header__nav-link header__nav-link--more" href="#" role="button"
                                   id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <svg xmlns='http://www.w3.org/2000/svg' width='512' height='512'
                                         viewBox='0 0 512 512'>
                                        <circle cx='256' cy='256' r='32'
                                                style='fill:none; stroke-miterlimit:10;stroke-width:32px'/>
                                        <circle cx='416' cy='256' r='32'
                                                style='fill:none;stroke-miterlimit:10;stroke-width:32px'/>
                                        <circle cx='96' cy='256' r='32'
                                                style='fill:none;stroke-miterlimit:10;stroke-width:32px'/>
                                    </svg>
                                </a>
                            </li>
                        </ul>

                        <div class="header__actions" style="justify-content: flex-end">
                            <?php if (!$User) { ?>
                                <a href="/login" class="header__login">
                                    <svg xmlns='http://www.w3.org/2000/svg' width='512' height='512'
                                         viewBox='0 0 512 512'>
                                        <path d='M192,176V136a40,40,0,0,1,40-40H392a40,40,0,0,1,40,40V376a40,40,0,0,1-40,40H240c-22.09,0-48-17.91-48-40V336'
                                              style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/>
                                        <polyline points='288 336 368 256 288 176'
                                                  style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/>
                                        <line x1='80' y1='256' x2='352' y2='256'
                                              style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/>
                                    </svg>
                                    <span>Giriş Yap</span>
                                </a>
                            <?php }
                            if ($User) { ?>
                                <div class="profile__avatar">
                                    <a href="/account">
                                        <img src="/Design/img/user.svg"
                                             alt="<?php echo $User['name'] . " " . $User['surname'] ?>">
                                    </a>
                                </div>
                                <a href="/account" class="header__login" style="padding: 14px">
                                    <svg xmlns='http://www.w3.org/2000/svg' width='512' height='512'
                                         viewBox='0 0 512 512'>
                                        <path d='M192,176V136a40,40,0,0,1,40-40H392a40,40,0,0,1,40,40V376a40,40,0,0,1-40,40H240c-22.09,0-48-17.91-48-40V336'
                                              style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/>
                                        <polyline points='288 336 368 256 288 176'
                                                  style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/>
                                        <line x1='80' y1='256' x2='352' y2='256'
                                              style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/>
                                    </svg>
                                    <span style="text-align: center; overflow: hidden; text-overflow: ellipsis"><?php echo $User['name'] . " " . $User['surname'] ?></span>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="header__wrap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="header__content">
                        <form action="#" class="header__form" style="width: auto">
                            <input type="text" class="header__input" placeholder="Şunu Arıyorum...">
                            <button class="header__btn" type="button">
                                <svg xmlns='http://www.w3.org/2000/svg' width='512' height='512' viewBox='0 0 512 512'>
                                    <path d='M221.09,64A157.09,157.09,0,1,0,378.18,221.09,157.1,157.1,0,0,0,221.09,64Z'
                                          style='fill:none;stroke-miterlimit:10;stroke-width:32px'/>
                                    <line x1='338.29' y1='338.29' x2='448' y2='448'
                                          style='fill:none;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px'/>
                                </svg>
                            </button>
                        </form>

                        <div class="header__actions header__actions--2" style="display: contents">
                            <a href="/basket" class="header__link" id="BasketHeader">

                                <span style="font-size: 14px; margin-right: 10px">
                                    <?php echo number_format($Basket['total'], "2") ?> TL</span>
                                <svg xmlns='http://www.w3.org/2000/svg' width='512' height='512' viewBox='0 0 512 512'>
                                    <circle cx='176' cy='416' r='16'
                                            style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/>
                                    <circle cx='400' cy='416' r='16'
                                            style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/>
                                    <polyline points='48 80 112 80 160 352 416 352'
                                              style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/>
                                    <path d='M160,288H409.44a8,8,0,0,0,7.85-6.43l28.8-144a8,8,0,0,0-7.85-9.57H128'
                                          style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/>
                                </svg>
                                <span class="BasketCount_header"><?php echo $Basket['count'] ?> </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- end header -->