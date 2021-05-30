<?php
if ($_POST) {
    $_TopMenu = $_POST['TopMenu'];
    $_BottomMenu = $_POST['BottomMenu'];

    $Query = Process("update", "Settings", array(
            "topmenu" => $_TopMenu,
            "footermenu" => $_BottomMenu
    ), "id=1");

    if ($Query) header("location:/panel/menus#o"); else  header("location:/panel/menus#n");
}

$TopMenu = json_decode(Query("topmenu", "Settings", "id=1", 1)['topmenu'], true);
$BottomMenu = json_decode(Query("footermenu", "Settings", "id=1", 1)['footermenu'], true);

$SubMenu = subMenu();
?>

<div class="vb__layout__content">
    <form action="" method="post">
        <div class="vb__breadcrumbs">
            <div class="vb__breadcrumbs__path">
                <a href="/panel">Panel</a>
                <span class="vb__breadcrumbs__arrow"></span>
                <span>Menü Yönetimi</span>
                <button type="submit" class="btn btn-success px-4" style=" float: right">
                    <i class="fe fe-save"></i>
                    Kaydet
                </button>
            </div>
        </div>
        <div class="vb__utils__content">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <h1 class="mb-4 ml-3">
                            <strong>Menüler</strong>
                        </h1>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <h5 class="mb-4"><strong>Üst Menü Sayfaları</strong>
                                <input type="hidden" id="TopMenu" name="TopMenu"></h5>
                            <div class="mb-5">
                                <div class="dd" id="nestable1">
                                    <ol class="dd-list">
                                        <?php if (!$TopMenu) { ?>
                                            <li class="dd-item dd3-item"></li>
                                        <?php } ?>
                                        <?php
                                        foreach ($TopMenu as $topmenu) {
                                            $Parent_page = Query("*", "Pages", "id='$topmenu[id]'", 1);
                                            ?>
                                            <li class="dd-item dd3-item" data-id="<?php echo $Parent_page['id'] ?>">
                                                <div class="dd-handle dd3-handle"></div>
                                                <div class="dd3-content" title="<?php echo $Parent_page['name'] ?>">
                                                    <p class="wrap_ellipsis"><?php echo $Parent_page['name'] ?></p>
                                                </div>
                                                <?php if (array_key_exists("children", $topmenu)) { ?>
                                                    <ol class="dd-list">
                                                        <?php
                                                        foreach ($topmenu['children'] as $child_page) {
                                                            $Child_page = Query("*", "Pages", "id='$child_page[id]'", 1);
                                                            ?>
                                                            <li class="dd-item dd3-item"
                                                                data-id="<?php echo $Child_page['id'] ?>">
                                                                <div class="dd-handle dd3-handle"></div>
                                                                <div class="dd3-content"
                                                                     title="<?php echo $Child_page['name'] ?>">
                                                                    <p class="wrap_ellipsis"><?php echo $Child_page['name'] ?></p>
                                                                </div>
                                                            </li>
                                                        <?php } ?>
                                                    </ol>
                                                <?php } ?>
                                            </li>
                                        <?php } ?>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <h5 class="mb-4"><strong>Alt Menü Sayfaları</strong>
                                <input type="hidden" id="BottomMenu" name="BottomMenu"></h5>
                            <div class="mb-5">
                                <div class="dd" id="nestable2">
                                    <ol class="dd-list">
                                        <?php if (!$BottomMenu) { ?>
                                            <li class="dd-item dd3-item"></li>
                                        <?php } ?>
                                        <?php
                                        foreach ($BottomMenu as $bottommenu) {
                                            $Parent_page = Query("*", "Pages", "id='$bottommenu[id]'", 1);
                                            ?>
                                            <li class="dd-item dd3-item" data-id="<?php echo $Parent_page['id'] ?>">
                                                <div class="dd-handle dd3-handle"></div>
                                                <div class="dd3-content" title="<?php echo $Parent_page['name'] ?>">
                                                    <p class="wrap_ellipsis"><?php echo $Parent_page['name'] ?></p>
                                                </div>
                                                <?php if (array_key_exists("children", $bottommenu)) { ?>
                                                    <ol class="dd-list">
                                                        <?php
                                                        foreach ($bottommenu['children'] as $child_page) {
                                                            $Child_page = Query("*", "Pages", "id='$child_page[id]'", 1);
                                                            ?>
                                                            <li class="dd-item dd3-item"
                                                                data-id="<?php echo $Child_page['id'] ?>">
                                                                <div class="dd-handle dd3-handle"></div>
                                                                <div class="dd3-content"
                                                                     title="<?php echo $Child_page['name'] ?>">
                                                                    <p class="wrap_ellipsis"><?php echo $Child_page['name'] ?></p>
                                                                </div>
                                                            </li>
                                                        <?php } ?>
                                                    </ol>
                                                <?php } ?>
                                            </li>
                                        <?php } ?>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <h5 class="mb-4"><strong>Bütün Sayfalar</strong></h5>
                            <div class="mb-5">
                                <div class="dd" id="nestable3">
                                    <ol class="dd-list">
                                        <?php
                                        $Parent_page = Query("*", "Pages", "Pages_id IS NULL");
                                        foreach ($Parent_page as $parent_page) {
                                            ?>
                                            <li class="dd-item dd3-item" data-id="<?php echo $parent_page['id'] ?>">
                                                <div class="dd-handle dd3-handle"></div>
                                                <div class="dd3-content" title="<?php echo $parent_page['name'] ?>">
                                                    <p class="wrap_ellipsis"><?php echo $parent_page['name'] ?></p>
                                                </div>
                                                <?php if (array_key_exists($parent_page['id'], $SubMenu)) { ?>
                                                    <ol class="dd-list">
                                                        <?php
                                                        $Child_page = Query("*", "Pages", "Pages_id='$parent_page[id]'");
                                                        foreach ($Child_page as $child_page) {
                                                            ?>
                                                            <li class="dd-item dd3-item"
                                                                data-id="<?php echo $child_page['id'] ?>">
                                                                <div class="dd-handle dd3-handle"></div>
                                                                <div class="dd3-content"
                                                                     title="<?php echo $child_page['name'] ?>">
                                                                    <p class="wrap_ellipsis"><?php echo $child_page['name'] ?></p>
                                                                </div>
                                                            </li>
                                                        <?php } ?>
                                                    </ol>
                                                <?php } ?>
                                            </li>
                                        <?php } ?>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>

<script>
    $(document).ready(function () {

        var updateOutput = function (e) {
            var list = e.length ? e : $(e.target),
                output = list.data('output');
            if (window.JSON) {
                output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
            } else {
                output.val('JSON Tarayıcı Desteği Gerekli!');
            }
        };

        $('#nestable1').nestable({
            maxDepth: 2,
        }).on('change', updateOutput);
        updateOutput($('#nestable1').data('output', $('#TopMenu')));

        $('#nestable2').nestable({
            maxDepth: 2,
        }).on('change', updateOutput);
        updateOutput($('#nestable2').data('output', $('#BottomMenu')));

        $('#nestable3').nestable({});

    });
</script>
