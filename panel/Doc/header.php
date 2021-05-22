<?php
include "sidebar.php";

$Admin = $_SESSION['name'];
?>

<div class="vb__layout">
    <div class="vb__layout__header">
        <div class="vb__topbar">
            <a class="mr-4" href="/panel/profile">
                <i class="icon fe fe-user"></i>
                <?php echo $Admin ?>
            </a>

            <a class="" href="/panel/logout">
                <i class="dropdown-icon fe fe-log-out"></i> Çıkış Yap
            </a>

        </div>
    </div>
