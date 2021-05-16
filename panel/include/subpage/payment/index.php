<?php
$Payments = Sorgu("*", "Payment");
?>
<div class="vb__layout__content">
    <div class="vb__breadcrumbs">
        <div class="vb__breadcrumbs__path">
            <a href="/panel">Panel</a>
            <span>
                <span class="vb__breadcrumbs__arrow"></span>
                <span>Ödeme Yönetimi</span>
            </span>
        </div>
    </div>
    <div class="vb__utils__content">
        <div class="card">
            <div class="card-body">
                <div class="row" style="justify-content: space-between">
                    <h1 class="mb-4 ml-3">
                        <strong>Ödeme Yöntemleri</strong>
                    </h1>
                    <a href="/panel/payment/new" type="button" class="btn btn-dark yeni_duzenle_button">
                        <i class="fe fe-plus-square mr-1" aria-hidden="true"></i>
                        Yeni Ödeme
                    </a>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-5">
                            <?php if (!$Payments) { ?>
                                <div style="margin: 60px auto; text-align: center">
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                         width="65" height="65"
                                         viewBox="0 0 172 172"
                                         style=" fill:#000000; margin: 20px 124px">
                                        <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1"
                                           stroke-linecap="butt"
                                           stroke-linejoin="miter" stroke-miterlimit="10"
                                           stroke-dasharray=""
                                           stroke-dashoffset="0"
                                           font-family="none" font-size="none"
                                           style="mix-blend-mode: normal">
                                            <path d="M0,172v-172h172v172z" fill="none"></path>
                                            <g fill="#ffd83c">
                                                <path d="M86,7.85577c-43.15504,0 -78.14423,34.98919 -78.14423,78.14423c0,43.15505 34.98919,78.14423 78.14423,78.14423c43.15505,0 78.14423,-34.98918 78.14423,-78.14423c0,-43.15504 -34.98918,-78.14423 -78.14423,-78.14423zM102.28005,128.97416c-4.03125,1.57632 -7.23558,2.79087 -9.63883,3.61779c-2.40324,0.82692 -5.16827,1.24038 -8.34675,1.24038c-4.85817,0 -8.65685,-1.18871 -11.37019,-3.56611c-2.6875,-2.35156 -4.03125,-5.375 -4.03125,-9.04447c0,-1.42128 0.10337,-2.86839 0.3101,-4.34135c0.18088,-1.4988 0.51683,-3.15265 0.95613,-5.03906l5.03906,-17.77885c0.4393,-1.70553 0.82692,-3.30769 1.13702,-4.83233c0.3101,-1.52463 0.4393,-2.92007 0.4393,-4.18629c0,-2.2482 -0.46515,-3.85036 -1.39544,-4.72897c-0.95613,-0.90445 -2.73918,-1.34375 -5.375,-1.34375c-1.29206,0 -2.63581,0.20673 -4.0054,0.59435c-1.3696,0.41346 -2.53246,0.80108 -3.51442,1.16286l1.34375,-5.47837c3.28185,-1.34375 6.43449,-2.48077 9.45793,-3.4369c2.9976,-0.95613 5.86599,-1.44712 8.52765,-1.44712c4.83233,0 8.57933,1.1887 11.1893,3.51442c2.60997,2.32572 3.92788,5.375 3.92788,9.09615c0,0.77524 -0.07753,2.14483 -0.25842,4.08293c-0.18088,1.9381 -0.51683,3.72115 -1.00781,5.375l-5.01322,17.72717c-0.41346,1.42128 -0.77524,3.04928 -1.11118,4.85817c-0.3101,1.80889 -0.46514,3.20433 -0.46514,4.13462c0,2.35156 0.51683,3.97956 1.57632,4.83233c1.03365,0.85276 2.86839,1.26622 5.47837,1.26622c1.21454,0 2.58413,-0.20673 4.13462,-0.62019c1.52464,-0.4393 2.63582,-0.80108 3.33353,-1.13702zM101.3756,57.00601c-2.32572,2.17067 -5.14243,3.25601 -8.42428,3.25601c-3.28185,0 -6.1244,-1.08533 -8.47596,-3.25601c-2.35156,-2.17067 -3.51442,-4.80649 -3.51442,-7.88162c0,-3.07512 1.18871,-5.73678 3.51442,-7.93329c2.35156,-2.19652 5.19412,-3.28185 8.47596,-3.28185c3.28185,0 6.09856,1.08533 8.42428,3.28185c2.35156,2.19651 3.51442,4.85817 3.51442,7.93329c0,3.07512 -1.16286,5.71094 -3.51442,7.88162z"></path>
                                            </g>
                                        </g>
                                    </svg>
                                    <p style="text-align: center">Herhangi Bir Ödeme Yöntemi Bulunmamaktadır.</p>
                                </div>
                            <?php } else { ?>
                                <table class="table table-hover" id="products">
                                    <thead>
                                    <tr>
                                        <th style="width: 120px"></th>
                                        <th style="width: 140px">İsim</th>
                                        <th>Açıklama</th>
                                        <th style="width: 70px">Durum</th>
                                        <th style="min-width: 140px">İşlem</th>
                                    </tr>
                                    </thead>
                                    <tbody class="panel_table">
                                    <?php
                                    foreach ($Payments as $payment) { ?>
                                        <?php if ($payment['id'] != '1' and $payment['id'] != '2') {
                                            ?>
                                            <tr>
                                                <td></td>
                                                <td><?php echo $payment['name']; ?></td>
                                                <td><?php echo $payment['description']; ?></td>
                                                <td>
                                                    <span class="badge badge-<?php echo($payment['status'] ? "success" : "warning"); ?>"><?php echo($payment['status'] ? "AKTİF" : "PASİF"); ?></span>
                                                </td>
                                                <td>
                                                    <a href="/panel/payment/edit/<?php echo $payment['id'] ?>"
                                                       class="btn btn-sm btn-light mr-2"><i class="fe fe-edit mr-2">
                                                        </i> Düzenle</a>
                                                    <button onclick="Delete(<?php echo $payment['id'] ?>)" type="button"
                                                            class="btn btn-sm btn-default swal-btn-cancel">
                                                        <small><i class="fe fe-trash mr-2"></i></small>
                                                        Sil
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php }
                                    } ?>
                                    <tr>
                                        <td><img src="/Cdn/iyzico_logo.png" alt=""
                                                 style="max-height: 100px"></td>
                                        <td><?php echo $Payments[0]['name'] ?></td>
                                        <td></td>
                                        <td>
                                            <span class="badge badge-<?php echo($Payments[0]['status'] ? "success" : "warning"); ?>"><?php echo($Payments[0]['status'] ? "AKTİF" : "PASİF"); ?></span>
                                        </td>
                                        <td>
                                            <a href="/panel/payment/edit/1"
                                               class="btn btn-sm btn-light mr-2"><i class="fe fe-edit mr-2">
                                                </i> Düzenle</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="/Cdn/paytr_logo.png" alt=""
                                                 style="max-height: 100px"></td>
                                        <td><?php echo $Payments[1]['name'] ?></td>
                                        <td></td>
                                        <td>
                                            <span class="badge badge-<?php echo($Payments[1]['status'] ? "success" : "warning"); ?>"><?php echo($Payments[1]['status'] ? "AKTİF" : "PASİF"); ?></span>
                                        </td>
                                        <td>
                                            <a href="/panel/payment/edit/2"
                                               class="btn btn-sm btn-light mr-2"><i class="fe fe-edit mr-2">
                                                </i> Düzenle</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <script>
                                    ;(function ($) {
                                        'use strict'
                                        $(function () {
                                            $('#products').DataTable({
                                                autoWidth: true,
                                                scrollX: true,
                                                fixedColumns: true,
                                            })
                                        })
                                    })(jQuery)
                                </script>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function Delete(id) {
        if (id) {
            swal(
                {
                    title: 'Emin misiniz?',
                    text: 'Bu ödeme yöntemi silindiği zaman geri getirilemez!',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: 'btn-danger',
                    confirmButtonText: 'Sil',
                    cancelButtonText: 'İptal Et',
                    closeOnConfirm: false,
                    closeOnCancel: false,
                },
                function (isConfirm) {
                    if (isConfirm) {
                        swal({
                            title: 'Başarılı!',
                            text: 'Ödeme yöntemi başarıyla silindi.',
                            type: 'success',
                            confirmButtonClass: 'btn-success',
                        })
                        setTimeout(function () {
                            window.location.href = "/panel/payment/delete/" + id;
                        }, 1000);

                    } else {
                        swal({
                            title: 'İptal Edildi',
                            text: 'Ödeme yöntemi silinmedi.',
                            type: 'error',
                            confirmButtonClass: 'btn-danger',
                        })
                    }
                },
            )
        }
    }
</script>