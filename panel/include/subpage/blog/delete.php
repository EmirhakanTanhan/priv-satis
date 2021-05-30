<?php
$Blog_id = UrlRead(4);

if ($Blog_id != 1) {

    $PicsToDelete = Query("id", "Images", "Pages_id='$Blog_id'");
    if ($PicsToDelete) {
        foreach ($PicsToDelete as $pictodelete) {
            $Query_pic_delete = Process("delete", "Images", "", "id='$pictodelete[id]'");
        }
    }

    $Query = Process("delete", "Pages", "", "id='$Blog_id'");
}
if ($Query) header("location:/panel/blog"); else header("location:/404");