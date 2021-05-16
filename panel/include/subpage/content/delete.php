<?php
$Page_id = UrlRead(4);

$PicsToDelete = Sorgu("id", "Images", "Pages_id='$Page_id'");
if ($PicsToDelete) {
    foreach ($PicsToDelete as $pictodelete) {
        $Query_pic_delete = Process("delete", "Images", "", "id='$pictodelete[id]'");
    }
}

$Query = Process("delete", "Pages", "", "id='$Page_id'");

if ($Query) header("location:/panel/contents"); else header("location:/404");