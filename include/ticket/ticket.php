<?php
if (!$_SESSION['User_id']) header("location:/login");
$User = User();

$Ticket_id = UrlRead(2);
if (!is_numeric($Ticket_id))
    header("location:/404");

$Ticket = Sorgu("*", "Ticket", "id='$Ticket_id' AND Users_id='$User[id]'", 1);
if (!$Ticket)
    header("location:/404");

$Ticket_title = Sorgu("name", "Ticket", "id='$Ticket_id'", 1)['name'];
$Messages = TicketMessage($Ticket_id);

$x = 0;
$y = 0;
?>
<script>
    function scrollToBottom() {
        window.scrollTo(0, document.body.scrollHeight);
    }

    history.scrollRestoration = "manual";
    window.onload = scrollToBottom;
</script>

<div id="ticket" class="container">
    <!-- comments -->
    <div class="comments" style="margin-top: unset; padding-top: 25px; border-top: unset">
        <div class="comments__title">
            <h4><?php echo $Ticket_title ?></h4>
        </div>

        <ul class="comments__list" style="padding-bottom: 130px">
            <?php
            foreach ($Messages as $message) {
                if ($message['Admin_id']) {
                    $Admin_name = Sorgu("name", "Admin", "id='$message[Admin_id]'", 1)['name'];
                    ?>
                    <li class="comments__item">
                        <?php if (!$x == 1) { ?>
                            <div class="comments__autor">
                                <span class="comments__name"><?php echo $Admin_name ?></span>
                                <span class="comments__time"><?php echo date_format(date_create($message['history']), "Y/m/d, H:i") ?></span>
                            </div>
                        <?php }
                        $y = 0;
                        $x = 1; ?>
                        <p class="comments__text"><?php echo $message['description'] ?></p>
                    </li>
                <?php }
                if ($message['Users_id']) { ?>
                    <li class="comments__item comments__item--answer">
                        <?php if (!$y == 1) { ?>
                            <div class="comments__autor">
                                <span class="comments__name"><?php echo $User['name'] . " " . $User['surname'] ?></span>
                                <span class="comments__time"><?php echo date_format(date_create($message['history']), "Y/m/d, H:i") ?></span>
                            </div>
                        <?php }
                        $y = 1;
                        $x = 0; ?>
                        <p class="comments__text"><?php echo $message['description'] ?></p>
                    </li>
                <?php }
            } ?>
        </ul>
    </div>
    <!-- end comments -->
</div>
<form action="javascript:;" method="post" class="form" id="NewTicketMessage"
      style="position: fixed; bottom: 0; width: 100%; border-top: 1px solid rgba(167,130,233,0.06); border-radius: unset; padding-bottom: ">
    <div class="row" style="place-content: center">
        <input type="hidden" name="ticketId" value="<?php echo $Ticket_id; ?>"/>
        <textarea id="description" name="description" class="form__textarea" rows="2" placeholder="Cevap Yaz"
                  style="resize: vertical; height: unset; width: 360px; margin-right: 17px"></textarea>
        <button type="submit" class="form__btn" style="width: 90px">Gönder</button>
    </div>
</form>