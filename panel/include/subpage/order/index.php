<?php
$Orders = Query("*", "Orders");
?>
<div class="vb__layout__content">
    <div class="vb__breadcrumbs">
        <div class="vb__breadcrumbs__path">
            <a href="/panel">Panel</a>
            <span>
                <span class="vb__breadcrumbs__arrow"></span>
                <span>Siparişler</span>
            </span>
        </div>
    </div>
    <div class="vb__utils__content">
        <div class="card">
            <div class="card-body">
                <div class="row" style="justify-content: space-between">
                    <h1 class="mb-4 ml-3">
                        <strong>Siparişler</strong>
                    </h1>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-5">
                            <?php if (!$Orders) { ?>
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
                                    <p style="text-align: center">Herhangi Bir Sipariş Bulunmamaktadır.</p>
                                </div>
                            <?php } else { ?>
                                <table class="table table-hover" id="pages">
                                    <thead class="thead-default">
                                    <tr>
                                        <th style="width: 70px">İşlem No</th>
                                        <th style="width: 70px">Tarih</th>
                                        <th>Üye</th>
                                        <th style="width: 100px">Ürün Sayısı</th>
                                        <th style="width: 80px">Durum</th>
                                        <th style="width: 120px">Ödeme Yöntemi</th>
                                        <th>Tutar</th>
                                        <th style="width: 65px">İşlem</th>
                                    </tr>
                                    </thead>
                                    <tbody class="panel_table_normal">
                                    <?php
                                    foreach ($Orders as $order) {
                                        $NumberOfProduct = count(Basket($order['id'], $order['Users_id'])) - 2;
                                        ?>
                                        <tr>
                                            <td><?php echo $order['id'] ?></td>
                                            <td><?php echo date_format(date_create($order['history']), "Y/m/d H:i"); ?></td>
                                            </td>
                                            <td><a href="/panel/users/<?php echo $order['Users_id'] ?>"
                                                   class="link-info"
                                                   style="text-decoration: underline"><?php echo User($order['Users_id'])['email'] ?></a>
                                            </td>
                                            <td><?php echo $NumberOfProduct ?></td>
                                            <td>
                                                <?php if ($order['status'] == '0') { ?> <span
                                                        class="badge badge-warning">Beklemede</span>
                                                <?php }
                                                if ($order['status'] == '1') { ?> <span
                                                        class="badge badge-success">Ödendi</span>
                                                <?php }
                                                if ($order['status'] == '2') { ?> <span
                                                        class="badge badge-danger">İptal</span> <?php } ?>
                                            </td>
                                            <td><?php echo PaymentMethod($order['Payments_id']) ?></td>
                                            <td><?php echo $order['price'] ?> TL</td>
                                            <td>
                                                <a href="/panel/orders/<?php echo $order['id'] ?>"
                                                   class="btn btn-sm btn-light mr-2"><i class="fe fe-eye mr-2">
                                                    </i> Gözat</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                                <script>
                                    ;(function ($) {
                                        'use strict'
                                        $(function () {
                                            $('#pages').DataTable({
                                                autoWidth: true,
                                                scrollX: true,
                                                fixedColumns: true,
                                                order: [[1, "desc"]]
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