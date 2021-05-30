<?php
$Page_id = UrlRead(3);
if (!$Page_id)
    $Page_id = 0;

$Pages = Query("*", "Pages");
$SubMenu = subMenu();
?>
<div class="vb__layout__content">
    <div class="vb__breadcrumbs">
        <div class="vb__breadcrumbs__path">
            <a href="/panel">Panel</a>
            <?php if ($Page_id == 0) { ?>
                <span class="vb__breadcrumbs__arrow"></span>
                <span>İçerik Yönetimi</span>
            <?php } else { ?>
                <span class="vb__breadcrumbs__arrow"></span>
                <a href="/panel/contents">İçerik Yönetimi</a>
                <span class="vb__breadcrumbs__arrow"></span>
                <span><?php echo Query("name", "Pages", "id='$Page_id'", 1)['name'] ?></span>
            <?php } ?>
        </div>
    </div>
    <div class="vb__utils__content">
        <div class="card">
            <div class="card-body">
                <div class="row" style="justify-content: space-between">
                    <h1 class="mb-4 ml-3">
                        <strong>Sayfalar</strong>
                    </h1>
                    <a href="/panel/contents/new" class="btn btn-dark yeni_duzenle_button">
                        <i class="fe fe-plus-square mr-1" aria-hidden="true"></i>
                        Yeni Sayfa
                    </a>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-5">
                            <table class="table table-hover" id="pages">
                                <thead class="thead-default">
                                <tr>
                                    <th style="width: 100px">İsim</th>
                                    <th>Açıklama</th>
                                    <th style="width: 70px">Durum</th>
                                    <th style="width: 170px">İşlem</th>
                                </tr>
                                </thead>
                                <tbody class="panel_table_normal">
                                <?php
                                foreach ($Pages as $page) {
                                    if ($page['id'] != 1) {
                                        if (in_array($page['id'], $SubMenu[$Page_id])) {
                                            ?>
                                            <tr>
                                                <td><?php echo $page['name']; ?></td>
                                                <td><?php echo $page['description']; ?></td>
                                                <td>
                                                    <span class="badge badge-<?php echo($page['status'] ? "success" : "warning"); ?>"><?php echo($page['status'] ? "Yayında" : "Yayında Değil"); ?></span>
                                                </td>
                                                <td>
                                                    <a href="/panel/contents/edit/<?php echo $page['id'] ?>"
                                                       class="btn btn-sm btn-light mr-2"><i
                                                                class="fe fe-edit mr-2">
                                                        </i> Düzenle</a>
                                                    <?php if (array_key_exists($page['id'], $SubMenu)) { ?>
                                                        <a href="/panel/contents/<?php echo $page['id'] ?>"
                                                           class="btn btn-sm btn-light mr-2"><i
                                                                    class="fe fe-eye mr-2">
                                                            </i> Gözat</a>
                                                    <?php } else if (!array_key_exists($page['id'], $SubMenu)) { ?>
                                                        <button onclick="Delete(<?php echo $page['id'] ?>)"
                                                                type="button"
                                                                class="btn btn-sm btn-default swal-btn-cancel">
                                                            <small><i class="fe fe-trash mr-2"></i></small>
                                                            Sil
                                                        </button>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        <?php }
                                    }
                                } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            ;(function ($) {
                'use strict'
                $(function () {
                    $('#pages').DataTable({
                        autoWidth: true,
                        scrollX: true,
                        fixedColumns: true,
                    })
                })
            })(jQuery)
        </script>
    </div>
</div>

<script>
    function Delete(id) {
        if (id) {
            swal(
                {
                    title: 'Emin misiniz?',
                    text: 'Bu sayfa silindiği zaman geri getirilemez!',
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
                            text: 'Sayfa başarıyla silindi.',
                            type: 'success',
                            confirmButtonClass: 'btn-success',
                        })
                        setTimeout(function () {
                            window.location.href = "/panel/contents/delete/" + id;
                        }, 1000);

                    } else {
                        swal({
                            title: 'İptal Edildi',
                            text: 'Sayfa silinmedi.',
                            type: 'error',
                            confirmButtonClass: 'btn-danger',
                        })
                    }
                },
            )
        }
    }
</script>