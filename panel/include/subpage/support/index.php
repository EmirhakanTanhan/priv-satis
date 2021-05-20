<?php
$Ticket_id = UrlRead(4);
var_dump("ticket_önce_1");
if ($Ticket_id) {
    var_dump("ticket_önce_2");
    $Ticket = Sorgu("*", "Ticket", "id='$Ticket_id'", 1);
    var_dump("ticket_önce_3");
    $Messages = TicketMessage($Ticket_id);
    var_dump("ticket_önce_4");
}

$Pagination_ticket = Paginator(5, "Ticket", UrlRead(3), "", "0");
if ($Pagination_ticket)
    $Tickets = Sorgu("*", "Ticket", "", "$Pagination_ticket[Start],$Pagination_ticket[Limit]", "id DESC");


if ($_POST) {
    $description = $_POST['description'];
    $ticket_id = $_POST['ticketId'];

    if (!empty($description)) {
        $NewTicketMessage_process = Process("insert", "Ticket_message", array(
            "Ticket_id" => $ticket_id,
            "Admin_id" => $_SESSION['Admin_id'],
            "description" => $description
        ));

        if ($NewTicketMessage_process) {
            require "../_system/Assets.php";
            $asset = new Assets();

            $Data['email'] = User($Ticket['Users_id'])['email'];
            $Data['subject'] = "Destek talebinize yanıt verildi";
            $Data['message'] = $description;

            $asset->MailGonder(array(
                "email" => $Data['email'],
                "subject" => $Data['subject'],
                "message" => $Data['message']));
        }
    }
}
?>

<div class="vb__layout__content">
    <div class="vb__breadcrumbs">
        <div class="vb__breadcrumbs__path">
            <a href="/panel">Panel</a>
            <span>
                <span class="vb__breadcrumbs__arrow"></span>
                <span>Destek</span>
            </span>
            <span>
                <span class="vb__breadcrumbs__arrow"></span>
                <span class="alert alert-light">
                    <span><strong>Dikkat:</strong> Cevabınız ayrıca mail olarak gönderilecektir. Birçok mesaj değil, tek ama uzun bir mesaj yazınız.</span>
                </span>
            </span>
        </div>
    </div>
    <div class="vb__utils__content">
        <div class="vb__messaging">
            <?php if (!$Tickets) { ?>
                <div style="margin:auto; width: 317px">
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
                    <p style="text-align: center">Herhangi Bir Destek Talebi Bulunmamaktadır.</p>
                </div>
            <?php } else { ?>
                <div class="vb__messaging__sidebar mr-4">
                    <div class="vb__customScroll vb__messaging__dialogItems" style="height: unset">
                        <?php
                        foreach ($Tickets as $ticket) {
                            ?>
                            <a class="vb__messaging__dialogItem d-flex flex-nowrap align-items-center"
                               href="/panel/support/<?php echo UrlRead(3) . '/' . $ticket['id'] ?>">
                                <div class="vb__messaging__dialogInfo flex-grow-1">
                                    <div class="font-size-12 text-truncate"><?php echo User($ticket['Users_id'])['email']; ?></div>
                                    <div class="vb__messaging__dialogName text-dark font-size-18 font-weight-bold text-truncate"
                                         title="<?php echo $ticket['name'] ?>">
                                        <?php echo $ticket['name'] ?>
                                    </div>
                                </div>
                            </a>
                        <?php } ?>
                    </div>
                    <div class="mb-5"> <!--PAGINATOR, KOMPLE ALABILIRSIN BURAYI, HER SAYFA ICIN AYNI-->
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <?php
                                if ($Pagination_ticket['Count'] > $Pagination_ticket['Limit']) {
                                    if ($Pagination_ticket['Page'] != 1) { ?>
                                        <li class="page-item">
                                            <a class="page-link" href="/panel/support/1" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
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
                                            <li class="page-item <?php if ($Pagination_ticket['Page'] == ($index + 1)) echo "active" ?>">
                                                <a class="page-link"
                                                   href="/panel/support/<?php echo $index + 1; ?>"><?php echo $index + 1; ?></a>
                                            </li>
                                        <?php }
                                    } ?>

                                    <?php if ($Pagination_ticket['Page'] != $Pagination_ticket['LastPage']) { ?>
                                        <li class="page-item">
                                            <a class="page-link"
                                               href="/panel/support/<?php echo $Pagination_ticket['LastPage']; ?>"
                                               aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    <?php }
                                } ?>
                            </ul>
                        </nav>
                    </div>
                </div>
                <?php if ($Ticket_id) { ?>
                    <div class="card flex-grow-1">
                        <div class="card-header card-header-flex flex-wrap">
                            <div class="d-flex flex-column justify-content-center mr-auto">
                                <h5 class="mb-0 mr-2 font-size-18">
                                    <?php echo User($Ticket['Users_id'])['name'] . " " . User($Ticket['Users_id'])['surname'] ?>
                                    <span class="font-size-14 text-gray-6"><a style="text-decoration: underline"
                                                                              href="/panel/users/<?php echo $Ticket['Users_id'] ?>"><?php echo User($Ticket['Users_id'])['email'] ?></a></span>
                                </h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-column justify-content-end" style="height: 350px">
                                <div class="vb__g14__contentWrapper vb__customScroll">
                                    <?php foreach ($Messages as $message) {
                                        if ($message['Admin_id']) {
                                            $Admin_name = Sorgu("name", "Admin", "id='$message[Admin_id]'", 1)['name'];
                                            ?>
                                            <div class="vb__g14__message">
                                                <div class="vb__g14__messageContent">
                                                    <div class="text-gray-4 font-size-12 text-uppercase"><?php echo $Admin_name . " | " . date_format(date_create($message['history']), "Y/m/d, H:i"); ?>
                                                    </div>
                                                    <div><?php echo $message['description']; ?></div>
                                                </div>
                                            </div>
                                        <?php }
                                        if ($message['Users_id']) { ?>
                                            <div class="vb__g14__message vb__g14__message--answer">
                                                <div class="vb__g14__messageContent">
                                                    <div class="text-gray-4 font-size-12 text-uppercase"><?php echo date_format(date_create($message['history']), "Y/m/d, H:i") ?>
                                                    </div>
                                                    <div><?php echo $message['description'] ?></div>
                                                </div>
                                            </div>
                                        <?php }
                                    } ?>
                                </div>
                            </div>
                            <div class="pt-2 pb-2"></div>
                            <div>
                                <form action="" method="post" autocomplete="off">
                                    <div class="input-group mb-3">
                                        <input type="hidden" name="ticketId" value="<?php echo $Ticket_id; ?>"/>
                                        <input type="text" class="form-control" name="description"
                                               placeholder="Cevap Yaz"/>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="fe fe-send align-middle"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php }
            } ?>
        </div>
    </div>
</div>