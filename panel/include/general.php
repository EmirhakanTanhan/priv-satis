<?php
$Data = Post($_POST);

if ($Data) {

    $Logo['site_logo'] = $Data["site_logo"];
    $Logo['site_favicon'] = $Data["site_favicon"];

    $Seo['site_title'] = $Data["site_title"];
    $Seo['site_description'] = $Data["site_description"];
    $Seo['site_keywords'] = $Data["site_keywords"];

    $Contact['address'] = $Data["address"];
    $Contact['email'] = $Data["email"];
    $Contact['phone'] = $Data["phone"];
    $Contact['whatsapp'] = $Data["whatsapp"];

    $Contact['smtp_host'] = $Data["smtp_host"];
    $Contact['smtp_user'] = $Data["smtp_user"];
    $Contact['smtp_pass'] = $Data["smtp_pass"];
    $Contact['smtp_port'] = $Data["smtp_port"];
    $Contact['smtp_secure'] = $Data["smtp_secure"];

    $Social['facebook'] = $Data["facebook"];
    $Social['twitter'] = $Data["twitter"];
    $Social['instagram'] = $Data["instagram"];
    $Social['youtube'] = $Data["youtube"];
    $Social['linkedin'] = $Data["linkedin"];
    $Social['pinterest'] = $Data["pinterest"];

    $InnerCode['style'] = $Data['site_style'];
    $InnerCode['script'] = $Data['site_script'];

    $Query = Process("update", "Settings", array(
        "logo" => json_encode($Logo, JSON_UNESCAPED_UNICODE),
        "seo" => json_encode($Seo, JSON_UNESCAPED_UNICODE),
        "contact" => json_encode($Contact, JSON_UNESCAPED_UNICODE),
        "social" => json_encode($Social, JSON_UNESCAPED_UNICODE),
        "style" => $InnerCode['style'],
        "script" => $InnerCode['script']
    ), "id=1");

    if ($Query) header("location:/panel/general#o"); else  header("location:/panel/general#n");
} else {
    $Data = Query("*", "Settings", "id=1", 1);

    $Data['logo'] = json_decode($Data['logo'], true);
    $Data['seo'] = json_decode($Data['seo'], true);
    $Data['contact'] = json_decode($Data['contact'], true);
    $Data['social'] = json_decode($Data['social'], true);
    $Data['site_script'] = $Data['script'];
    $Data['site_style'] = $Data['style'];
}
?>

<div class="vb__layout__content">
    <form action="" method="post">
        <div class="vb__breadcrumbs">
            <div class="vb__breadcrumbs__path">
                <a href="/panel">Panel</a>
                <span>
                    <span class="vb__breadcrumbs__arrow"></span>
                    <span>Genel Ayarlar</span>
                </span>
                <button type="submit" class="btn btn-success px-4" style=" float: right">
                    <i class="fe fe-save"></i>
                    Kaydet
                </button>
            </div>
        </div>
        <div class="vb__utils__content">
            <!--1-->
            <div class="form-row col-md-6 general_flex_left">
                <div class="col-md-12">
                    <div class="card" style="padding-bottom: 15px">
                        <div class="card-body">
                            <h4 class="mb-4">
                                <strong>Site</strong>
                            </h4>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="site_title">Site Ba??l??k</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="site_title" placeholder=""
                                           id="site_title" value="<?php echo $Data['seo']['site_title']; ?>"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="site_description">Site A????klama</label>
                                <div class="col-md-9">
                            <textarea class="form-control" name="site_description" id="site_description" cols="30"
                                      rows="3"><?php echo $Data['seo']['site_description']; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="site_keywords">Site Anahtar
                                    Kelimeler</label>
                                <div class="col-md-9">
                            <textarea class="form-control" name="site_keywords" id="site_keywords" cols="30"
                                      rows="3"><?php echo $Data['seo']['site_keywords']; ?></textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <div class="form-group col-sm-12">
                                        <input type="hidden"
                                               id="site_logo"
                                               name="site_logo"
                                               value="<?php echo $Data['logo']['site_logo'] ?>">
                                        <label class="form-label">Site Logo</label>
                                        <button type="button"
                                                data-toggle="modal"
                                                data-target="#DosyaModal"
                                                id="DosyaBtn"
                                                onclick="UrlYukle('/panel/storage/index.php?integration=custom&amp;type=files&amp;Input=site_logo')"
                                                class="btn btn-light btn-block btn-xs">Se??iniz
                                        </button>
                                        <div id="ResimBilgi" class="mt-1" style="text-align: center">
                                            <img src="<?php echo $Data['logo']['site_logo'] ?>" id="imgsite_logo"
                                                 style="height: 100px;max-width: 150px;object-fit: contain"/>
                                            <p class="text-center"
                                               id="DosyaText"><?php echo substr($Data['logo']['site_logo'], strrpos($Data['logo']['site_logo'], '/') + 1); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group col-sm-12">
                                        <input type="hidden"
                                               id="site_favicon"
                                               name="site_favicon"
                                               value="<?php echo $Data['logo']['site_favicon'] ?>">
                                        <label class="form-label">Site ??kon</label>
                                        <button type="button"
                                                data-toggle="modal"
                                                data-target="#DosyaModal"
                                                id="DosyaBtn"
                                                onclick="UrlYukle('/panel/storage/index.php?integration=custom&amp;type=files&amp;Input=site_favicon')"
                                                class="btn btn-light btn-block btn-xs">Se??iniz
                                        </button>
                                        <div id="ResimBilgi" class="mt-1" style="text-align: center">
                                            <img src="<?php echo $Data['logo']['site_favicon'] ?>" id="imgsite_favicon"
                                                 style="height: 50px;max-width: 150px;object-fit: contain"/>
                                            <p class="text-center"
                                               id="DosyaText"><?php echo substr($Data['logo']['site_favicon'], strrpos($Data['logo']['site_favicon'], '/') + 1); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-4">
                                <strong>Sosyal Medya</strong>
                            </h4>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="facebook">Facebook</label>
                                    <input type="text" class="form-control" name="facebook" placeholder=""
                                           id="facebook" value="<?php echo $Data['social']['facebook']; ?>"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="twitter">Twitter</label>
                                    <input type="text" class="form-control" name="twitter" placeholder=""
                                           id="twitter" value="<?php echo $Data['social']['twitter']; ?>"/>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="instagram">??nstagram</label>
                                    <input type="text" class="form-control" name="instagram" placeholder=""
                                           id="instagram" value="<?php echo $Data['social']['instagram']; ?>"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="youtube">Youtube</label>
                                    <input type="text" class="form-control" name="youtube" placeholder=""
                                           id="youtube" value="<?php echo $Data['social']['youtube']; ?>"/>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="linkedin">Linkedin</label>
                                    <input type="text" class="form-control" name="linkedin" placeholder=""
                                           id="linkedin" value="<?php echo $Data['social']['linkedin']; ?>"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="pinterest">Pinterest</label>
                                    <input type="text" class="form-control" name="pinterest" placeholder=""
                                           id="pinterest" value="<?php echo $Data['social']['pinterest']; ?>"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--2-->
            <div class="form-row col-md-6 general_flex_right">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-4">
                                <strong>??leti??im</strong>
                            </h4>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="address">Adres</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" name="address" id="address" cols="30"
                                              rows="3"><?php echo $Data['contact']['address']; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="email">Email</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="email" placeholder=""
                                           id="email" value="<?php echo $Data['contact']['email']; ?>"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="phone">Telefon</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="phone" placeholder=""
                                           id="phone" value="<?php echo $Data['contact']['phone']; ?>"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="whatsapp">WhatsApp</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="whatsapp" placeholder=""
                                           id="whatsapp" value="<?php echo $Data['contact']['whatsapp']; ?>"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-4">
                                <strong>E-Posta</strong>
                            </h4>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="smtp_host">SMTP Host</label>
                                    <input type="text" class="form-control" name="smtp_host" placeholder=""
                                           id="smtp_host" value="<?php echo $Data['contact']['smtp_host']; ?>"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="smtp_user">SMTP User</label>
                                    <input type="text" class="form-control" name="smtp_user" placeholder=""
                                           id="smtp_user" value="<?php echo $Data['contact']['smtp_user']; ?>"/>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="smtp_pass">SMTP Password</label>
                                    <input type="password" class="form-control" name="smtp_pass" placeholder=""
                                           id="smtp_pass" value="<?php echo $Data['contact']['smtp_pass']; ?>"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="smtp_port">SMTP Port</label>
                                    <input type="text" class="form-control" name="smtp_port" placeholder=""
                                           id="smtp_port" value="<?php echo $Data['contact']['smtp_port']; ?>"/>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="smtp_secure">SMTP Secure</label>
                                    <input type="text" class="form-control" name="smtp_secure" placeholder=""
                                           id="smtp_secure" value="<?php echo $Data['contact']['smtp_secure']; ?>"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-4">
                                <strong>Site ????i Kodlar</strong>
                            </h4>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="site_style">Style (.css) Kodlar??</label>
                                    <textarea class="form-control" name="site_style" id="site_style" cols="30"
                                              rows="8"><?php echo $Data['site_style']; ?></textarea>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="site_script">Script (.js) Kodlar??</label>
                                    <textarea class="form-control" name="site_script" id="site_script" cols="30"
                                              rows="8"><?php echo $Data['site_script']; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>