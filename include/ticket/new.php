<?php
if (!$_SESSION['User_id']) header("location:/login");
?>
<div class="col-12 col-lg-6">
    <form action="javascript:;" method="post" class="form" id="NewTicket">
        <div class="row">
            <div class="col-12">
                <h4 class="form__title">Yeni Destek Talebi</h4>
            </div>

            <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                <label class="form__label" for="name">Başlık</label>
                <input id="name" type="text" name="name" class="form__input">
            </div>

            <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                <label class="form__label" for="description">Açıklama</label>
                <textarea id="description" type="text" name="description" cols="3" class="form__textarea"></textarea>
            </div>

            <div class="col-12">
                <button class="form__btn" type="submit">Kaydet</button>
            </div>
        </div>
    </form>
</div>
<!-- end details form -->