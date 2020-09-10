<?php
session_start();

$_SESSION["userDir"] = uniqid();

?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cégalapítás form</title>

    <link rel="stylesheet" href="css/cegalapitas.css">
    <link rel="stylesheet" href="css/vendor/dropzone/dropzone.css">
    <link rel="stylesheet" href="css/vendor/bootstrap-4.5.0/bootstrap.min.css">
    <link rel="stylesheet" href="css/vendor/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="css/vendor/intlTelInput/intlTelInput.css">
    <link rel="stylesheet" href="css/select.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="form-style">
        <?php
            include "../language/hu-HU.php";
        ?>
        <form id="main" method="POST" class="needs-validation" novalidate>

            <h2><?php echo $messages["title"]; ?></h2>
            <p>kötelező *</p>
            <a href="/adminpanel/admin/" class="btn btn-primary">Ügyvéd vagyok</a>
            <a href="/" class="btn btn-primary">Vissza</a>
            <br />
            <label>Nyelv</label>
            <select class="form-control col-md-2">
                <option value="Magyar">Magyar</option>
            </select>
            <hr />

            <!-- Company Basic Data section START -->
            <section id="company_basic_data">
                <!-- Company basic START -->
                <h4><?php echo $messages["company-basic"]; ?></h4>

                <div class="form-row">
                    <div class="form-group col">
                        <label for="company_type"><?php echo $messages["company-type"]; ?></label>
                        <select class="form-control" name="company_type" id="company_type">
                            <?php SetCompanyOptions(); ?>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="company_name"><?php echo $messages["company-name"]; ?> *</label>
                        <input class="form-control " placeholder="XYZ Kereskedelmi" type="text" autocomplete="new-password" name="company_name" id="company_name" required>
                        <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                        <small id="name_prev">Korlátolt Felelősségű Társaság</small>
                        <input type="hidden" id="isCompanyNameValid" value="false">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="company_short_name"><?php echo $messages["company-short-name"]; ?></label>
                        <input class="form-control " placeholder="XYZ" type="text" autocomplete="new-password" name="company_short_name" id="company_short_name">
                        <small id="name_prev">Kft.</small>
                        <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="company_foreign_name"><?php echo $messages["company-foreign-name"]; ?></label>
                        <input class="form-control " placeholder="XYZ Trading" type="text" autocomplete="new-password" name="company_foreign_name" id="company_foreign_name">
                        <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="company_short_foreign_name"><?php echo $messages["company-short-foreign-name"]; ?></label>
                        <input class="form-control " placeholder="XYZ" type="text" autocomplete="new-password" name="company_short_foreign_name" id="company_short_foreign_name">
                        <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col">
                        <label for="company_business"><?php echo $messages["company-business"]; ?> *</label>
                        <select class="mul-select" multiple="true" id="company_business" required>
                            <?php SetCompanyBusinessOptions(); ?>
                        </select>
                        <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col">
                        <label for="company_business"><?php echo $messages["company-other-business"]; ?></label>
                        <select class="mul-select" multiple="true" id="company_other_business">
                            <?php SetCompanyBusinessOptions(); ?>
                        </select>
                        <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                    </div>
                </div>

                <!-- Company basic END -->

                <!-- Company seat START -->

                <hr />

                <label for="seat-group"><?php echo $messages["company-seat"]; ?></label>
                <div class="form-row" id="seat-group">
                    <div class="form-group col-md-2">
                        <label for="company_site_zip"><?php echo $messages["district"]; ?> *</label>
                        <input type="text" class="form-control " placeholder="1035" autocomplete="new-password" name="company_seat_zip" id="company_seat_zip" required>
                        <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="company_site_city"><?php echo $messages["city"]; ?> *</label>
                        <input type="text" class="form-control " placeholder="Budapest" autocomplete="new-password" name="company_seat_city" id="company_seat_city" required>
                        <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                    </div>
                    <div class="form-group col-md-5">
                        <label for="company_site_address"><?php echo $messages["street"]; ?> *</label>
                        <input type="text" class="form-control " placeholder="Bécsi út" autocomplete="new-password" name="company_seat_address" id="company_seat_address" required>
                        <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                    </div>
                    <div class="form-row col-md-8">
                        <div class="form-group col-md-5">
                            <label for="company_site_address2"><?php echo $messages["address-other"]; ?> *</label>
                            <input type="text" class="form-control " placeholder="135 2.em. 2" autocomplete="new-password" name="company_seat_address2" id="company_seat_address2" required>
                            <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label><?php echo $messages["company-main-site"]; ?></label>
                            <input type="checkbox" class="form-control main-place preventUncheck19" checked disabled>
                        </div>
                        <div class="form-group" style="margin-left: 50px;">
                            <input type="button" class="btn btn-primary getEviDoc" value="<?php echo $messages["download-btn"]; ?>">
                            <small class="form-text text-muted"><?php echo $messages["download-help"]; ?></small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <!-- EZT NE PISZKÁLD CSAK CSS (2020.07.30) Attila -->
                            <div class="dropzone needsclick" id="dropzone" style="margin-top: 20px;">
                                <div class="dz-message needsclick text-muted">    
                                    <?php echo $messages["upload-text"]; ?>
                                </div>
                            </div>
                            <!-- I mean it -->
                        </div>
                        <div class="form-group">
                            <p style="text-align: center; margin-top: 50px;"><?php echo $messages["upload-text2"]; ?></p>
                        </div>
                    </div>
                </div>
                <!-- Company seat end -->

                <!-- Company sites START -->
                <div id="site" style="display: none;">
                    <p id="site-tag"><strong>Telephely #0</strong></p>
                    <hr />
                    <div class="form-row" id="sites-group">
                        <div class="form-group col-md-2">
                            <label for="company_site_zip"><?php echo $messages["district"]; ?> *</label>
                            <input type="text" class="form-control" placeholder="1035" autocomplete="new-password" name="company_site_zip_0" id="company_site_zip" required>
                            <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="company_site_city"><?php echo $messages["city"]; ?> *</label>
                            <input type="text" class="form-control" placeholder="Budapest" autocomplete="new-password" name="company_site_city_0" id="company_site_city" required>
                            <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="company_site_address"><?php echo $messages["street"]; ?> *</label>
                            <input type="text" class="form-control" placeholder="Bécsi út" autocomplete="new-password" name="company_site_address_0" id="company_site_address" required>
                            <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                        </div>
                        <div class="form-row col-md-8">
                            <div class="form-group col-md-5">
                                <label for="company_site_address2"><?php echo $messages["address-other"]; ?> *</label>
                                <input type="text" class="form-control" placeholder="135 2.em. 2" autocomplete="new-password" name="company_site_address2_0" id="company_site_address2" required>
                                <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                            </div>
                            <div class="form-group">
                                <div class="btn-here">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label><?php echo $messages["company-main-site"]; ?></label>
                                <input type="checkbox" class="form-control main-place preventUncheck19">
                            </div>
                            <div class="form-group">
                                <input type="button" class="btn btn-primary getEviDoc" value="<?php echo $messages["download-btn"]; ?>">
                                <small class="form-text text-muted"><?php echo $messages["download-help"]; ?></small>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <!-- EZT NE PISZKÁLD CSAK CSS (2020.07.30) Attila -->
                                <div class="dropzone needsclick drop" id="dropzone_0" style="background: white; border-radius: 5px; border: 2px dashed #45a049;">
                                    <div class="dz-message needsclick text-muted">    
                                        <?php echo $messages["upload-text"]; ?>
                                    </div>
                                </div>
                                <!-- I mean it -->
                            </div>
                            <p style="text-align: center;"><?php echo $messages["upload-text6"]; ?></p>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="sites-group"><?php echo $messages["company-site"]; ?></label>
                        <button type="button" class="btn btn-primary addsite"><?php echo $messages["other-sites"]; ?></button>
                    </div>
                </div>

                <div id="newsiteappendhere">
                </div>
                <!-- Company sites end -->

                <!-- Company branch START -->

                <div id="branch" style="display: none;">
                    <p id="branch-tag"><strong>Fióktelep #0</strong></p>
                    <hr />
                    <div class="form-row" id="branch-group">
                        <div class="form-group col-md-2">
                            <label for="company_branch_zip"><?php echo $messages["district"]; ?> </label>
                            <input type="text" class="form-control" placeholder="1035" autocomplete="new-password" name="company_branch_zip_0" id="company_branch_zip" required>
                            <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="company_branch_city"><?php echo $messages["city"]; ?> </label>
                            <input type="text" class="form-control" placeholder="Budapest" autocomplete="new-password" name="company_branch_city_0" id="company_branch_city" required>
                            <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="company_branch_address"><?php echo $messages["street"]; ?> </label>
                            <input type="text" class="form-control" placeholder="Bécsi út" autocomplete="new-password" name="company_branch_address_0" id="company_branch_address" required>
                            <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                        </div>
                        <div class="form-row col-md-8">
                            <div class="form-group col-md-5">
                                <label for="company_branch_address2"><?php echo $messages["address-other"]; ?> </label>
                                <input type="text" class="form-control" placeholder="135 2.em. 2" autocomplete="new-password" name="company_branch_address2_0" id="company_branch_address2" required>
                                <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                            </div>
                            <div class="form-group">
                                <div class="btn-here">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label><?php echo $messages["company-main-site"]; ?></label>
                                <input type="checkbox" class="form-control main-place preventUncheck19">
                            </div>
                            <div class="form-group">
                                <input type="button" class="btn btn-primary getEviDoc" value="<?php echo $messages["download-btn"]; ?>">
                                <small class="form-text text-muted"><?php echo $messages["download-help"]; ?></small>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <!-- EZT NE PISZKÁLD CSAK CSS (2020.07.30) Attila -->
                                <div class="dropzone needsclick drop" id="dropzone_0" style="background: white; border-radius: 5px; border: 2px dashed #45a049;">
                                    <div class="dz-message needsclick text-muted">    
                                        <?php echo $messages["upload-text"]; ?>
                                    </div>
                                </div>
                                <!-- I mean it -->
                            </div>
                            <p style="text-align: center;"><?php echo $messages["upload-text6"]; ?></p>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="branch-group"><?php echo $messages["company-branch"]; ?></label>
                        <button type="button" class="btn btn-primary addbranch"><?php echo $messages["other-branch"]; ?></button>
                    </div>
                </div>            

                <div id="newbranchappendhere">
                </div>
                <!-- Company branch end -->

                <h3><?php echo $messages["additional-data"]; ?></h3>
                <hr />

                <div class="form-row">
                    <div class="form-group">
                        <label><?php echo $messages["company-time"]; ?></label>
                        <div class="form-check">
                            <input class="form-check-input preventUncheck18" type="checkbox" autocomplete="new-password" name="company_time_unknown" id="company_time_unknown" checked>
                            <label class="form-check-label" for="company_member_boss_time_unknown"><?php echo $messages["company-member-boss-time-unknown"]; ?></label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input preventUncheck18" type="checkbox" autocomplete="new-password" name="company_time_known" id="company_time_known">
                            <label class="form-check-label" for="company_member_boss_time_known"><?php echo $messages["company-member-boss-time-known"]; ?></label>
                        </div>
                    </div>
                </div>

                <div id="company-time" class="form-row" style="display: none;">
                    <div class="form-group">
                        <div class="input-group date">
                            <input class="form-control" type="text" placeholder="yyyy.mm.dd." autocomplete="new-password" name="company_time1" id="company_time1" required>
                            <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                            <label for="company_member_boss_time_knowndate">-tól *</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group date">
                            <input class="form-control" type="text" placeholder="yyyy.mm.dd." autocomplete="new-password" name="company_time2" id="company_time2" required>
                            <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                            <label for="company_member_boss_time_knowndate2">-ig *</label>
                        </div>
                    </div>
                </div>

                <hr />

                <label><?php echo $messages["company-meeting"]; ?></label>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="company_meeting_additional_payment_yes"><?php echo $messages["company-meeting-additional-payment-yes"]; ?></label>
                        <input type="checkbox" class="form-control preventUncheck" name="company-option1" id="company_meeting_additional_payment_yes">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="company_meeting_additional_payment_no"><?php echo $messages["company-meeting-additional-payment-no"]; ?></label>
                        <input type="checkbox" class="form-control preventUncheck" name="company-option1-2" id="company_meeting_additional_payment_no" checked>
                    </div>
                </div>

                <div class="form-row" id="second-option-meeting" style="display: none;">
                    <div class="form-group col-md-3">
                        <label for="company_meeting_additional_payment_yes_once"><?php echo $messages["company-meeting-additional-payment-once"]; ?></label>
                        <input type="checkbox" class="form-control preventUncheck2" name="company-option2" id="company_meeting_additional_payment_yes_once" checked>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="company_meeting_additional_payment_yes_time"><?php echo $messages["company-meeting-additional-payment-time"]; ?></label>
                        <input type="checkbox" class="form-control preventUncheck2" name="company-option2-2" id="company_meeting_additional_payment_yes_time">
                    </div>
                    <div class="form-group col-md-1" id="additional-time">
                        <input type="text" class="form-control" placeholder="3" autocomplete="new-password" name="company-option2-3" id="company_meeting_additional_payment_time" disabled required>
                        <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                    </div>
                    <p>alkalommal</p>
                </div>

                <div class="form-row" id="additional-payment" style="display: none;">
                    <div class="form-group col-md-5">
                        <label for="company_meeting_additional_payment_amount"><?php echo $messages["company-meeting-additional-payment-amount"]; ?> *</label>
                        <div class="input-group-prepend">
                            <span class="input-group-text"><?php echo $messages["money-currency"]; ?></span>
                            <input type="money" class="form-control" placeholder="3 000 000" name="company-option2-4" id="company_meeting_additional_payment_amount" style="width: 250px;" required>
                            <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                        </div>
                    </div>
                </div>

                <hr />

                <p>
                    Az üzletrészt kívülálló személyre csak akkor lehet átruházni, ha a tag a törzsbetét teljes mértékében befizette, kivéve, ha az átruházásra azért került sor, mert a vagyoni hozzájárulás 
                    , illetve a pótbefizetés teljesítésének elmulasztása vagy kizárás miatt a tag tagsági viszonya megszűnt. Az elővásárlási jogra vonatkozó rendelkezéseknek megfelelően a tagot, a társaságot vagy
                    a taggyűlés által kijelölt személyt a pénzszolgáltatás ellenében átruházni kívánt üzletrész megszerzésére
                </p>

                <div>
                    <input type="checkbox" class="preventUncheck3" name="company-option3" id="permission_granted_yes" checked>
                    <label for="permission_granted_yes"><?php echo $messages["permission-granted-yes"]; ?></label><br />
                    <input type="checkbox" class="preventUncheck3" name="company-option3-2" id="permission_granted_no">
                    <label for="permission_granted_no"><?php echo $messages["permission-granted-no"]; ?></label>
                </div>

                <hr />

                <div class="form-row">
                    <div class="form-group col-md-8">
                        <p>Az üzletrész kívülálló személyre történő átruházásához</p>
                        <select class="form-control" name="company-option4" id="business_to_external">
                            <option value="a taggyűlés (a társaság) beleegyezése szükséges.">a taggyűlés (a társaság) beleegyezése szükséges.</option>
                            <option value="a taggyűlés (a társaság) beleegyezése nem szükséges.">a taggyűlés (a társaság) beleegyezése nem szükséges.</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-8">
                        <p>Pénzszolgáltatás ellenében történő átruházáson kívüli jogcímen</p>
                        <select class="form-control" name="company-option4-2" id="business_to_external2">
                            <option value="az üzletrész átruházható.">az üzletrész átruházható.</option>
                            <option value="az üzletrész nem ruházható át.">az üzletrész nem ruházható át.</option>
                        </select>
                    </div>
                </div>

                <hr />

                <div class="form-row">
                    <div class="form-group">
                        <p>Osztalékra az a tag jogosult, aki</p>
                    </div>
                    <div class="form-group">
                        <label for="dividend_payment"><?php echo $messages["dividend-payment"]; ?></label>
                        <input type="checkbox" class="form-control preventUncheck4" name="company-option5" id="dividend_payment" checked>
                    </div>
                    <div class="form-group">
                        <label for="current_year"><?php echo $messages["current-year"]; ?></label>
                        <input type="checkbox" class="form-control preventUncheck4" name="company-option5-2" id="current_year">
                    </div>
                </div>

                <hr />

                <p>Az ügyvezető jogosult osztalékelőleg fizetéséről határozni?</p>
                <div class="form-row">
                    <div class="form-group">
                        <label for="dividend_payment_permission_yes"><?php echo $messages["confirm-yes"]; ?></label>
                        <input type="checkbox" class="form-control preventUncheck8" name="company-option6" id="dividend_payment_permission_yes">
                    </div>
                    <div class="form-group">
                        <label style="margin-left: 50px;" for="dividend_payment_permission_no"><?php echo $messages["confirm-no"]; ?></label>
                        <input type="checkbox" class="form-control preventUncheck8" style="margin-left: 25px;" name="company-option6-2" id="dividend_payment_permission_no" checked>
                    </div>
                </div>

                <hr />

                <p>A társaság a taggyűlés kizárólagos hatáskörébe tartozó ügyekben</p>
                <div class="form-row">
                    <div class="form-group">
                        <label for="company-option1"><?php echo $messages["company-option1"]; ?></label>
                        <input type="checkbox" class="form-control preventUncheck9" name="company-option7" id="company-option1" checked>
                    </div>
                    <div class="form-group">
                        <label style="margin-left: 50px;" for="company-option2"><?php echo $messages["company-option2"]; ?></label>
                        <input type="checkbox" class="form-control preventUncheck9" style="margin-left: 25px;" name="company-option7-2" id="company-option2">
                    </div>
                </div>

                <hr />

                <p>A taggyűlést évente</p>
                <div class="form-row">
                    <div class="form-group">
                        <label for="company-option3"><?php echo $messages["company-option3"]; ?></label>
                        <input type="checkbox" class="form-control preventUncheck10" name="company-option8" id="company-option3" checked>
                    </div>
                    <div class="form-group">
                        <label style="margin-left: 50px;" for="company-option4"><?php echo $messages["company-option4"]; ?></label>
                        <input type="checkbox" class="form-control preventUncheck10" style="margin-left: 25px;" name="company-option8-2" id="company-option4">
                    </div>
                </div>

                <p>össze kell hívni a</p>
                <div class="form-row">
                    <div class="form-group">
                        <label for="company-option5"><?php echo $messages["company-option5"]; ?></label>
                        <input type="checkbox" class="form-control preventUncheck11" name="company-option8-3" id="company-option5" checked>
                    </div>
                    <div class="form-group">
                        <label style="margin-left: 50px;" for="company-option6"><?php echo $messages["company-option6"]; ?></label>
                        <input type="checkbox" class="form-control preventUncheck11" style="margin-left: 25px;" name="company-option8-4" id="company-option6">
                    </div>
                </div>

                <div class="form-row" id="another-address" style="display: none;">
                    <div class="form-group col-md-2">
                        <label for="another_address_zip"><?php echo $messages["district"]; ?> *</label>
                        <input type="text" class="form-control" placeholder="1035" autocomplete="new-password" name="company-option8-zip" id="another_address_zip" required>
                        <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="another_address_city"><?php echo $messages["city"]; ?> *</label>
                        <input type="text" class="form-control" placeholder="Budapest" autocomplete="new-password" name="company-option8-city" id="another_address_city" required>
                        <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                    </div>
                    <div class="form-group col-md-5">
                        <label for="another_address_address"><?php echo $messages["street"]; ?> *</label>
                        <input type="text" class="form-control" placeholder="Bécsi út" autocomplete="new-password" name="company-option8-address" id="another_address_address" required>
                        <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                    </div>
                    <div class="form-row col-md-8">
                        <div class="form-group col-md-5">
                            <label for="another_address_address2"><?php echo $messages["address-other"]; ?> *</label>
                            <input type="text" class="form-control" placeholder="135 2.em. 2" autocomplete="new-password" name="company-option8-address2" id="another_address_address2" required>
                            <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                        </div>
                    </div>
                </div>

                <hr />

                <p>A társaságnál cégvezető kinevezésére</p>
                <div class="form-row">
                    <div class="form-group">
                        <label for="company-option7"><?php echo $messages["company-option7"]; ?></label>
                        <input type="checkbox" class="form-control preventUncheck12" name="company-option9" id="company-option7">
                    </div>
                    <div class="form-group">
                        <label style="margin-left: 50px;" for="company-option8"><?php echo $messages["company-option8"]; ?></label>
                        <input type="checkbox" class="form-control preventUncheck12" style="margin-left: 25px;" name="company-option9-2" id="company-option8" checked>
                    </div>
                </div>

                <!-- Company boss START -->
                <div id="boss" style="display: none;">
                    <h4><?php echo $messages["company-bosses"]; ?></h4>

                    <div id="boss_container_1">
                        <p id="boss-num"><?php echo $messages["company-boss"]; ?><span name="boss_id" id="boss_id">#0</span></p>

                        <div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="boss_firstname"><?php echo $messages["company-member-firstname"]; ?> *</label>
                                    <input type="text" class="form-control" autocomplete="new-password" name="boss_firstname_0" id="boss_firstname" style="width: 300px;" required>
                                    <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                                </div>
                                <div class="form-group">
                                    <label for="boss_lastname" style="margin-left: 20px;"><?php echo $messages["company-member-lastname"]; ?> *</label>
                                    <input class="form-control detect2" type="text" autocomplete="new-password" name="boss_lastname_0" id="boss_lastname" style="width: 300px; margin-left: 20px;" required>
                                    <div class="invalid-feedback" style="margin-left: 20px;">Kérlek töltsd ki a mezőt!</div>
                                </div>
                                <input type="hidden" name="boss_fullname_0" id="boss_fullname">
                            </div>

                            <hr />

                            <label><?php echo $messages["company-member-address"]; ?></label>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="boss_country"><?php echo $messages["company-member-country"]; ?> </label>
                                    <input type="text" class="form-control" placeholder="Magyarország" autocomplete="new-password" name="boss_country_0" id="boss_country" required>
                                    <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="boss_zip"><?php echo $messages["district"]; ?> *</label>
                                    <input type="text" class="form-control" placeholder="1035" autocomplete="new-password" name="boss_zip_0" id="boss_zip" required>
                                    <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="boss_city"><?php echo $messages["city"]; ?> *</label>
                                    <input type="text" class="form-control" placeholder="Budapest" autocomplete="new-password" name="boss_city_0" id="boss_city" required>
                                    <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="boss_address"><?php echo $messages["street"]; ?> *</label>
                                    <input type="text" class="form-control" placeholder="Bécsi út" autocomplete="new-password" name="boss_address_0" id="boss_address" required>
                                    <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                                </div>
                                <div class="form-row col-md-8">
                                    <div class="form-group col-md-5">
                                        <label for="boss_address2"><?php echo $messages["address-other"]; ?> *</label>
                                        <input type="text" class="form-control" placeholder="135 2.em. 2" autocomplete="new-password" name="boss_address2_0" id="boss_address2" required>
                                        <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <div class="input-group date">
                                        <input class="form-control" type="text" placeholder="yyyy.mm.dd." autocomplete="new-password" name="boss_time_0" id="boss_time" required>
                                        <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                                        <label for="company_member_boss_time_knowndate">-tól *</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group date">
                                        <input class="form-control" type="text" placeholder="yyyy.mm.dd." autocomplete="new-password" name="boss_time2_0" id="boss_time2" required>
                                        <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                                        <label for="company_member_boss_time_knowndate2">-ig *</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="btn-here">
                        </div>
                    </div>
                </div>

                <div class="form-row" id="boss-btn" style="display: none;">
                    <div class="form-group">
                        <button type="button" class="btn btn-primary addboss"><?php echo $messages["other-boss"]; ?></button>
                    </div>
                </div>            

                <div id="newbossappendhere">
                </div>
                <!-- Company boss END -->

                <div id="option">
                    <hr />

                    <p>Az ügyvezetés a cégvezető számára általános képviseleti jogot</p>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="company-option9"><?php echo $messages["company-option9"]; ?></label>
                            <input type="checkbox" class="form-control preventUncheck13" name="company-option9-3" id="company-option9">
                        </div>
                        <div class="form-group">
                            <label style="margin-left: 50px;" for="company-option10"><?php echo $messages["company-option10"]; ?></label>
                            <input type="checkbox" class="form-control preventUncheck13" style="margin-left: 25px;" name="company-option9-3" id="company-option10" checked>
                        </div>
                    </div>
                </div>

                <hr />

                <p>A társaságnál felügyelőbizottság választására</p>
                <div class="form-row">
                    <div class="form-group">
                        <label for="company-option11"><?php echo $messages["company-option11"]; ?></label>
                        <input type="checkbox" class="form-control preventUncheck14" name="company-option10" id="company-option11">
                    </div>
                    <div class="form-group">
                        <label style="margin-left: 50px;" for="company-option12"><?php echo $messages["company-option12"]; ?></label>
                        <input type="checkbox" class="form-control preventUncheck14" style="margin-left: 25px;" name="company-option10-2" id="company-option12" checked>
                    </div>
                </div>

                <div id="supervisor" style="display: none;">

                    <label><strong>Felügyelőbizottsági tag #1</strong></label>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="company_supervisor_firstname"><?php echo $messages["company-member-firstname"]; ?> *</label>
                            <input type="text" class="form-control" autocomplete="new-password" name="company_supervisor_firstname_1" id="company_supervisor_firstname" style="width: 300px;" required>
                            <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                        </div>
                        <div class="form-group">
                            <label for="company_supervisor_lastname" style="margin-left: 20px;"><?php echo $messages["company-member-lastname"]; ?> *</label>
                            <input class="form-control detect2" type="text" autocomplete="new-password" name="company_supervisor_lastname_1" id="company_supervisor_lastname" style="width: 300px; margin-left: 20px;" required>
                            <div class="invalid-feedback" style="margin-left: 20px;">Kérlek töltsd ki a mezőt!</div>
                        </div>
                        <input type="hidden" name="company_supervisor_fullname_1" id="company_supervisor_fullname">
                    </div>

                    <label><?php echo $messages["company-member-address"]; ?></label>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="company_supervisor_country"><?php echo $messages["company-member-country"]; ?> </label>
                            <input type="text" class="form-control" placeholder="Magyarország" autocomplete="new-password" name="company_supervisor_country_1" id="company_supervisor_country" required>
                            <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="company_supervisor_zip"><?php echo $messages["district"]; ?> *</label>
                            <input type="text" class="form-control" placeholder="1035" autocomplete="new-password" name="company_supervisor_zip_1" id="company_supervisor_zip" required>
                            <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="company_supervisor_city"><?php echo $messages["city"]; ?> *</label>
                            <input type="text" class="form-control" placeholder="Budapest" autocomplete="new-password" name="company_supervisor_city_1" id="company_supervisor_city" required>
                            <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="company_supervisor_address"><?php echo $messages["street"]; ?> *</label>
                            <input type="text" class="form-control" placeholder="Bécsi út" autocomplete="new-password" name="company_supervisor_address_1" id="company_supervisor_address" required>
                            <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                        </div>
                        <div class="form-row col-md-8">
                            <div class="form-group col-md-5">
                                <label for="company_supervisor_address2"><?php echo $messages["address-other"]; ?> *</label>
                                <input type="text" class="form-control" placeholder="135 2.em. 2" autocomplete="new-password" name="company_supervisor_address2_1" id="company_supervisor_address2" required>
                                <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                            </div>
                        </div>
                    </div>

                    <hr />

                    <label><strong>Felügyelőbizottsági tag #2</strong></label>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="company_supervisor_firstname"><?php echo $messages["company-member-firstname"]; ?> *</label>
                            <input type="text" class="form-control" autocomplete="new-password" name="company_supervisor_firstname_2" id="company_supervisor_firstname" style="width: 300px;" required>
                            <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                        </div>
                        <div class="form-group">
                            <label for="company_supervisor_lastname" style="margin-left: 20px;"><?php echo $messages["company-member-lastname"]; ?> *</label>
                            <input class="form-control detect2" type="text" autocomplete="new-password" name="company_supervisor_lastname_2" id="company_supervisor_lastname" style="width: 300px; margin-left: 20px;" required>
                            <div class="invalid-feedback" style="margin-left: 20px;">Kérlek töltsd ki a mezőt!</div>
                        </div>
                        <input type="hidden" name="company_supervisor_fullname_2" id="company_supervisor_fullname">
                    </div>

                    <label><?php echo $messages["company-member-address"]; ?></label>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="company_supervisor_country"><?php echo $messages["company-member-country"]; ?> </label>
                            <input type="text" class="form-control" placeholder="Magyarország" autocomplete="new-password" name="company_supervisor_country_2" id="company_supervisor_country" required>
                            <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="company_supervisor_zip"><?php echo $messages["district"]; ?> *</label>
                            <input type="text" class="form-control" placeholder="1035" autocomplete="new-password" name="company_supervisor_zip_2" id="company_supervisor_zip" required>
                            <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="company_supervisor_city"><?php echo $messages["city"]; ?> *</label>
                            <input type="text" class="form-control" placeholder="Budapest" autocomplete="new-password" name="company_supervisor_city_2" id="company_supervisor_city" required>
                            <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="company_supervisor_address"><?php echo $messages["street"]; ?> *</label>
                            <input type="text" class="form-control" placeholder="Bécsi út" autocomplete="new-password" name="company_supervisor_address_2" id="company_supervisor_address" required>
                            <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                        </div>
                        <div class="form-row col-md-8">
                            <div class="form-group col-md-5">
                                <label for="company_supervisor_address2"><?php echo $messages["address-other"]; ?> *</label>
                                <input type="text" class="form-control" placeholder="135 2.em. 2" autocomplete="new-password" name="company_supervisor_address2_2" id="company_supervisor_address2" required>
                                <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                            </div>
                        </div>
                    </div>

                    <hr />

                    <label><strong>Felügyelőbizottsági tag #3</strong></label>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="company_supervisor_firstname"><?php echo $messages["company-member-firstname"]; ?> *</label>
                            <input type="text" class="form-control" autocomplete="new-password" name="company_supervisor_firstname_3" id="company_supervisor_firstname" style="width: 300px;" required>
                            <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                        </div>
                        <div class="form-group">
                            <label for="company_supervisor_lastname" style="margin-left: 20px;"><?php echo $messages["company-member-lastname"]; ?> *</label>
                            <input class="form-control detect2" type="text" autocomplete="new-password" name="company_supervisor_lastname_3" id="company_supervisor_lastname" style="width: 300px; margin-left: 20px;" required>
                            <div class="invalid-feedback" style="margin-left: 20px;">Kérlek töltsd ki a mezőt!</div>
                        </div>
                        <input type="hidden" name="company_supervisor_fullname_3" id="company_supervisor_fullname">
                    </div>

                    <label><?php echo $messages["company-member-address"]; ?></label>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="company_supervisor_country"><?php echo $messages["company-member-country"]; ?> </label>
                            <input type="text" class="form-control" placeholder="Magyarország" autocomplete="new-password" name="company_supervisor_country_3" id="company_supervisor_country" required>
                            <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="company_supervisor_zip"><?php echo $messages["district"]; ?> *</label>
                            <input type="text" class="form-control" placeholder="1035" autocomplete="new-password" name="company_supervisor_zip_3" id="company_supervisor_zip" required>
                            <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="company_supervisor_city"><?php echo $messages["city"]; ?> *</label>
                            <input type="text" class="form-control" placeholder="Budapest" autocomplete="new-password" name="company_supervisor_city_3" id="company_supervisor_city" required>
                            <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="company_supervisor_address"><?php echo $messages["street"]; ?> *</label>
                            <input type="text" class="form-control" placeholder="Bécsi út" autocomplete="new-password" name="company_supervisor_address_3" id="company_supervisor_address" required>
                            <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                        </div>
                        <div class="form-row col-md-8">
                            <div class="form-group col-md-5">
                                <label for="company_supervisor_address2"><?php echo $messages["address-other"]; ?> *</label>
                                <input type="text" class="form-control" placeholder="135 2.em. 2" autocomplete="new-password" name="company_supervisor_address2_3" id="company_supervisor_address2" required>
                                <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                            </div>
                        </div>
                    </div>

                    <hr />
                    <label>A felügyelőbizottság működési ideje</label>
                    <div class="form-row">
                        <div class="form-group">
                            <div class="input-group date">
                                <input class="form-control" type="text" placeholder="yyyy.mm.dd." autocomplete="new-password" name="company_supervisor_time1" id="company_supervisor_time1" required>
                                <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                                <label for="company_supervisor_time2">-tól *</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group date">
                                <input class="form-control" type="text" placeholder="yyyy.mm.dd." autocomplete="new-password" name="company_supervisor_time2" id="company_supervisor_time2" required>
                                <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                                <label for="company_supervisor_time2">-ig *</label>
                            </div>
                        </div>
                    </div>

                </div>

                <hr />

                <p>Azokban az esetekben, amikor a Polgári Törvényekről szóló 2013. évi V. törvény (Ptk.) a társaságot kötelezi arra, hogy közleményt tegyen közzé, a társaság e kötelezettségének</p>
                <div class="form-row">
                    <div class="form-group">
                        <label for="company-option13"><?php echo $messages["company-option13"]; ?></label>
                        <input type="checkbox" class="form-control preventUncheck15" name="company-option11" id="company-option13">
                    </div>
                    <div class="form-group">
                        <label style="margin-left: 50px;" for="company-option14"><?php echo $messages["company-option14"]; ?></label>
                        <input type="checkbox" class="form-control preventUncheck15" style="margin-left: 25px;" name="company-option11-2" id="company-option14" checked>
                    </div>
                </div>

                <hr />

                <div class="form-row" style="text-align: center;">
                    <div class="form-group col">
                        <label for="notification_email"><?php echo $messages["notification-email"]; ?> *</label>
                        <input class=" form-control " type="email" placeholder="<?php echo $messages["company-member-email"]; ?>" autocomplete="new-password" name="notification_email" id="notification_email" style="width: 250px; margin: auto; margin-top: 5px;" required>
                        <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                    </div>
                </div>
                <p style="text-align: center;"><?php echo $messages["notification-email-text"]; ?></p>

                <hr />

            </section>
            <!-- Company Basic Data section END -->

            <!-- Company Members section START -->
            <section id="company_members_data">

                <h4 id="mem"><?php echo $messages["company-members"]; ?></h4>

                <button type="button" class="btn btn-primary addmember"><?php echo $messages["company-member-add"]; ?></button>

                <div id="member">
                    
                    <button type="button" class="collapsible"><?php echo $messages["company-member"]; ?><span name="member_id" id="member_id_1">#1</span></button>
                    <div class="member-container" id="member_container_1">
                        <p id="member-name"><?php echo $messages["company-member"]; ?><span name="member_id" id="member_id_1">#1</span></p>

                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label for="company_member_type"><?php echo $messages["company-member-type"]; ?></label>
                                <select class="form-control" name="company_member_type_1" id="company_member_type">
                                    <?php SetMemberTypeOptions(); ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="company_member_boss"><?php echo $messages["company-member-boss"]; ?></label>
                                <input class="form-control" type="checkbox" name="company_member_boss_1" id="company_member_boss" checked>
                            </div>
                            <div class="form-group">
                                <label for="company_member_boss_manager" style="margin-left: 20px;"><?php echo $messages["company-member-boss-manager"]; ?></label>
                                <input class="form-control" type="checkbox" name="company_member_boss_manager_1" id="company_member_boss_manager" style="margin-left: 20px;" checked>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="company_member_boss_manager"><?php echo $messages["company-member-boss-manager-self"]; ?></label>
                                <input class="form-control" type="checkbox" name="company_member_boss_manager_self_1" id="company_member_boss_manager_self" checked>
                            </div>
                        </div>

                        <div id="time">
                            <hr />
                            <div class="form-row">
                                <div class="form-group">
                                    <label><?php echo $messages["company-member-boss-time"]; ?></label>
                                    <div class="form-check">
                                        <input class="form-check-input preventUncheck5" type="checkbox" name="company_member_boss_time_unknown_1" id="company_member_boss_time_unknown" checked>
                                        <label class="form-check-label" for="company_member_boss_time_unknown"><?php echo $messages["company-member-boss-time-unknown"]; ?></label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input preventUncheck5" type="checkbox" name="company_member_boss_time_known_1" id="company_member_boss_time_known">
                                        <label class="form-check-label" for="company_member_boss_time_known"><?php echo $messages["company-member-boss-time-known"]; ?></label>
                                    </div>
                                </div>
                                <div class="form-group" style="margin-left: 200px;">
                                    <label><?php echo $messages["company-member-boss-lead"]; ?></label>
                                    <div class="form-check">
                                        <input class="form-check-input preventUncheck6" type="checkbox" name="company_member_boss_lead_type1_1" id="company_member_boss_lead_type1">
                                        <label class="form-check-label" for="company_member_boss_time_unknown"><?php echo $messages["company-member-boss-lead-type1"]; ?></label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input preventUncheck6" type="checkbox" name="company_member_boss_lead_type2_1" id="company_member_boss_lead_type2" checked>
                                        <label class="form-check-label" for="company_member_boss_time_known"><?php echo $messages["company-member-boss-lead-type2"]; ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="boss-time" class="form-row" style="display: none;">
                            <div class="form-group">
                                <div class="input-group date">
                                    <input class="form-control" type="text" placeholder="yyyy.mm.dd." autocomplete="new-password" name="company_member_boss_time_knowndate_1" id="company_member_boss_time_knowndate" required>
                                    <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                                    <label for="company_member_boss_time_knowndate">-tól *</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group date">
                                    <input class="form-control" type="text" placeholder="yyyy.mm.dd." autocomplete="new-password" name="company_member_boss_time_knowndate2_1" id="company_member_boss_time_knowndate2" required>
                                    <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                                    <label for="company_member_boss_time_knowndate2">-ig *</label>
                                </div>                                        
                            </div>
                        </div>

                        <div id="type2" style="display: none;">
                            <hr />
                            <div class="form-row">
                                <div class="form-group mx-auto">
                                    <label for="company_member_company_number"><?php echo $messages["company-member-company-number"]; ?> *</label>
                                    <input class="form-control" type="text" autocomplete="new-password" name="company_member_company_number_1" id="company_member_company_number" style="width: 300px;" required>
                                    <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                                </div>
                            </div>

                            <hr />

                            <label for="seat-group"><?php echo $messages["company-seat"]; ?></label>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="company_member_type2_zip"><?php echo $messages["district"]; ?> *</label>
                                    <input type="text" class="form-control" placeholder="1035" autocomplete="new-password" name="company_seat_type2_zip_1" id="company_seat_type2_zip" required>
                                    <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="company_member_type2_city"><?php echo $messages["city"]; ?> *</label>
                                    <input type="text" class="form-control" placeholder="Budapest" autocomplete="new-password" name="company_seat_type2_city_1" id="company_seat_type2_city" required>
                                    <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="company_member_type2_address"><?php echo $messages["street"]; ?> *</label>
                                    <input type="text" class="form-control" placeholder="Bécsi út" autocomplete="new-password" name="company_seat_type2_address_1" id="company_seat_type2_address" required>
                                    <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                                </div>
                                <div class="form-row col-md-8">
                                    <div class="form-group col-md-5">
                                        <label for="company_member_type2_address2"><?php echo $messages["address-other"]; ?> *</label>
                                        <input type="text" class="form-control" placeholder="135 2.em. 2" autocomplete="new-password" name="company_seat_type2_address2_1" id="company_seat_type2_address2" required>
                                        <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                                    </div>
                                </div>
                            </div>

                            <hr />

                            <label><?php echo $messages["company-member-type2-name"]; ?></label>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="company_member_type2_firstname"><?php echo $messages["company-member-firstname"]; ?> *</label>
                                    <input type="text" class="form-control" autocomplete="new-password" name="company_member_type2_firstname_1" id="company_member_type2_firstname" style="width: 300px;" required>
                                    <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                                </div>
                                <div class="form-group">
                                    <label for="company_member_type2_lastname" style="margin-left: 20px;"><?php echo $messages["company-member-lastname"]; ?> *</label>
                                    <input class="form-control detect2" type="text" autocomplete="new-password" name="company_member_type2_lastname_1" id="company_member_type2_lastname" style="width: 300px; margin-left: 20px;" required>
                                    <div class="invalid-feedback" style="margin-left: 20px;">Kérlek töltsd ki a mezőt!</div>
                                </div>
                                <input type="hidden" name="company_member_type2_fullname_1" id="company_member_type2_fullname">
                            </div>

                            <hr />

                            <label><?php echo $messages["company-member-type2-address"]; ?></label>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="company_member_type2_country"><?php echo $messages["company-member-country"]; ?> </label>
                                    <input type="text" class="form-control" placeholder="Magyarország" autocomplete="new-password" name="company_member_type2_country_1" id="company_member_type2_country" required>
                                    <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="company_member_type2_zip"><?php echo $messages["district"]; ?> *</label>
                                    <input type="text" class="form-control" placeholder="1035" autocomplete="new-password" name="company_member_type2_zip_1" id="company_member_type2_zip" required>
                                    <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="company_member_type2_city"><?php echo $messages["city"]; ?> *</label>
                                    <input type="text" class="form-control" placeholder="Budapest" autocomplete="new-password" name="company_member_type2_city_1" id="company_member_type2_city" required>
                                    <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="company_member_type2_address"><?php echo $messages["street"]; ?> *</label>
                                    <input type="text" class="form-control" placeholder="Bécsi út" autocomplete="new-password" name="company_member_type2_address_1" id="company_member_type2_address" required>
                                    <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                                </div>
                                <div class="form-row col-md-8">
                                    <div class="form-group col-md-5">
                                        <label for="company_member_type2_address2"><?php echo $messages["address-other"]; ?> *</label>
                                        <input type="text" class="form-control" placeholder="135 2.em. 2" autocomplete="new-password" name="company_member_type2_address2_1" id="company_member_type2_address2" required>
                                        <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                                    </div>
                                </div>
                            </div>

                            <!-- EZT NE PISZKÁLD CSAK CSS (2020.07.30) Attila -->
                            <div class="dropzone needsclick drop" id="dropzone_4" style="background: white; border-radius: 5px; border: 2px dashed #45a049;">
                                <div class="dz-message needsclick text-muted">
                                    <?php echo $messages["upload-text"]; ?>
                                </div>
                            </div>
                            <!-- I mean it -->
                            <p style="text-align: center;"><?php echo $messages["upload-text4"]; ?></p>
                        </div>

                        <div id="type1">

                            <div class="form-row" style="display: none;"> <!-- Csak akkor kell ha BT is lesz -->
                                <div class="form-group">
                                    <label for="company_member_internal"><?php echo $messages["company-member-internal"]; ?></label>
                                    <input class="form-control preventUncheck7" type="checkbox" name="company_member_internal_1" id="company_member_internal" checked>
                                </div>
                                <div class="form-group">
                                    <label for="company_member_external" style="margin-left: 30px;"><?php echo $messages["company-member-external"]; ?></label>
                                    <input class="form-control preventUncheck7" type="checkbox" name="company_member_external_1" id="company_member_external" style="margin-left: 18px;">
                                </div>
                            </div>

                            <hr />

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="company_member_firstname"><?php echo $messages["company-member-firstname"]; ?> *</label>
                                    <input type="text" class="form-control" placeholder="Gipsz" autocomplete="new-password" name="company_member_firstname_1" id="company_member_firstname" style="width: 300px;" required>
                                    <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                                </div>
                                <div class="form-group">
                                    <label for="company_member_lastname" style="margin-left: 20px;"><?php echo $messages["company-member-lastname"]; ?> *</label>
                                    <input class="form-control detect" type="text" placeholder="Jakab" autocomplete="new-password" name="company_member_lastname_1" id="company_member_lastname" style="width: 300px; margin-left: 20px;" required>
                                    <div class="invalid-feedback" style="margin-left: 20px;">Kérlek töltsd ki a mezőt!</div>
                                </div>
                                <input type="hidden" name="company_member_fullname_1" id="company_member_fullname">
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="company_member_date"><?php echo $messages["company-member-date"]; ?> *</label>
                                    <div class="input-group date">
                                        <input class="form-control " type="text" placeholder="yyyy.mm.dd." autocomplete="new-password" name="company_member_date_1" id="company_member_date" required>
                                        <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="company_member_birthplace" style="margin-left: 20px;"><?php echo $messages["company-member-birthplace"]; ?> *</label>
                                    <input class="form-control " type="text" placeholder="Budapest" autocomplete="new-password" name="company_member_birthplace_1" id="company_member_birthplace" style="width: 300px; margin-left: 20px;" required>        
                                    <div class="invalid-feedback" style="margin-left: 20px;">Kérlek töltsd ki a mezőt!</div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="company_member_id"><?php echo $messages["company-member-id"]; ?></label>
                                    <select class="form-control" name="company_member_id_1" id="company_member_id">
                                        <?php SetIdTypeOptions(); ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="company_member_birthplace" style="margin-left: 20px;"><?php echo $messages["company-member-idnumber"]; ?> *</label>
                                    <input class="form-control " type="text" placeholder="123456AB" autocomplete="new-password" name="company_member_idnumber_1" id="company_member_idnumber" style="width: 250px; margin-left: 20px;" required>
                                    <div class="invalid-feedback" style="margin-left: 20px;">Kérlek töltsd ki a mezőt!</div>
                                </div>
                            </div>

                            <!-- EZT NE PISZKÁLD CSAK CSS (2020.07.30) Attila -->
                            <div class="dropzone needsclick drop" id="dropzone_1" style="background: white; border-radius: 5px; border: 2px dashed #45a049;">
                                <div class="dz-message needsclick text-muted">
                                    <?php echo $messages["upload-text"]; ?>
                                </div>
                            </div>
                            <!-- I mean it -->
                            <p style="text-align: center;" id="id-upload"><?php echo $messages["upload-text3"]; ?></p>

                            <hr />

                            <label><?php echo $messages["company-member-address"]; ?></label>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="company_member_country"><?php echo $messages["company-member-country"]; ?> *</label>
                                    <input type="text" class="form-control" placeholder="Magyarország" autocomplete="new-password" name="company_member_country_1" id="company_member_country" required>
                                    <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="company_member_zip"><?php echo $messages["district"]; ?> *</label>
                                    <input type="text" class="form-control" placeholder="1035" autocomplete="new-password" name="company_member_zip_1" id="company_member_zip" required>
                                    <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="company_member_city"><?php echo $messages["city"]; ?> *</label>
                                    <input type="text" class="form-control" placeholder="Budapest" autocomplete="new-password" name="company_member_city_1" id="company_member_city" required>
                                    <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="company_member_address"><?php echo $messages["street"]; ?> *</label>
                                    <input type="text" class="form-control" placeholder="Bécsi út" autocomplete="new-password" name="company_member_address_1" id="company_member_address" required>
                                    <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                                </div>
                                <div class="form-row col-md-8">
                                    <div class="form-group col-md-5">
                                        <label for="company_member_address2"><?php echo $messages["address-other"]; ?> *</label>
                                        <input type="text" class="form-control" placeholder="135 2.em. 2" autocomplete="new-password" name="company_member_address2_1" id="company_member_address2" required>
                                        <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                                    </div>
                                </div>
                            </div>

                            <!-- EZT NE PISZKÁLD CSAK CSS (2020.07.30) Attila -->
                            <div class="dropzone needsclick drop" id="dropzone_2" style="background: white; border-radius: 5px; border: 2px dashed #45a049;">
                                <div class="dz-message needsclick text-muted">    
                                    <?php echo $messages["upload-text"]; ?>
                                </div>
                            </div>
                            <!-- I mean it -->
                            <p style="text-align: center;"><?php echo $messages["upload-text4"]; ?></p>

                            <hr />

                            <label><?php echo $messages["company-member-contact"]; ?></label>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="company_member_email"><?php echo $messages["company-member-email"]; ?> *</label>
                                    <input class="form-control " type="email" placeholder="pelda@email.hu" autocomplete="new-password" name="company_member_email_1" id="company_member_email" style="width: 250px;" required>
                                    <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                                </div>
                                <div class="form-group" style="margin-left: 25px;">
                                    <label for="company_member_phone"><?php echo $messages["company-member-phone"]; ?></label><br />
                                    <input class="form-control" type="tel" autocomplete="new-password" name="company_member_phone_1" id="company_member_phone" style="width: 250px;">
                                    <div class="invalid-feedback invalid-phone">Hibás telefonszám!</div>
                                </div>
                                <div class="form-group" style="margin-left: 25px;">
                                    <label for="company_member_email2"><?php echo $messages["company-member-email2"]; ?> *</label>
                                    <input class="form-control " type="email" placeholder="pelda@gmail.com" autocomplete="new-password" name="company_member_email2_1" id="company_member_email2" style="width: 250px;" required>
                                    <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                                </div>
                            </div>

                            <hr />

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="company_member_money"><?php echo $messages["company-member-money"]; ?></label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><?php echo $messages["money-currency"]; ?></span>
                                        <input class="form-control" type="money" placeholder="3 000 000" autocomplete="new-password" name="company_member_money_1" id="company_member_money" style="width: 250px;">
                                        <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="company_member_money_half"><?php echo $messages["company-member-basic-money"]; ?></label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><input class="form-control" style="width: 55px" name="company_member_money_percent_1" id="company_member_money_percent" value="0" readonly>%</span>
                                        <input class="form-control" type="money" placeholder="1 500 000" autocomplete="new-password" name="company_member_money_half_1" id="company_member_money_half" style="width: 250px;">
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input preventUncheck16" type="checkbox" name="company_member_pay_bank_1" id="company_member_pay_bank" checked>
                                        <label class="form-check-label" for="company_member_pay_bank"><?php echo $messages["company-member-pay-bank"]; ?></label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input preventUncheck16" type="checkbox" name="company_member_pay_notbank_1" id="company_member_pay_notbank">
                                        <label class="form-check-label" for="company_member_pay_notbank"><?php echo $messages["company-member-pay-notbank"]; ?></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group date">
                                        <label for="company_member_money_payment_time" style="margin-left: 50px;"><?php echo $messages["company-member-money-payment-time"]; ?> (* kötelező ha nem 100%)</label>
                                        <input class="form-control" type="text" placeholder="yyyy.mm.dd." autocomplete="new-password" name="company_member_money_payment_time_1" id="company_member_money_payment_time" style="width: 250px; margin-left: 50px;" disabled required>
                                        <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                                    </div>
                                </div>
                            </div>

                            <hr />

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="company_member_money2"><?php echo $messages["company-member-money2"]; ?></label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><?php echo $messages["money-currency"]; ?></span>
                                        <input class="form-control" type="money" placeholder="3 000 000" autocomplete="new-password" name="company_member_money2_1" id="company_member_money2" style="width: 250px;">
                                        <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="company_member_money2_name"><?php echo $messages["company-member-money2-name"]; ?></label>
                                    <input class="form-control" type="text" autocomplete="new-password" name="company_member_money2_name_1" id="company_member_money2_name" style="width: 250px;" disabled required>
                                    <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input preventUncheck17" type="checkbox" name="company_member_pay_atstart_1" id="company_member_pay_atstart" checked>
                                        <label class="form-check-label" for="company_member_pay_atstart"><?php echo $messages["company-member-pay-atstart"]; ?></label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input preventUncheck17" type="checkbox" name="company_member_pay_afterstart_1" id="company_member_pay_afterstart">
                                        <label class="form-check-label" for="company_member_pay_afterstart"><?php echo $messages["company-member-pay-afterstart"]; ?></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group date">
                                        <input class="form-control" type="text" placeholder="yyyy.mm.dd." autocomplete="new-password" name="company_member_pay_afterstart_time_1" id="company_member_pay_afterstart_time" style="width: 250px; margin-left: 50px;" disabled required>
                                        <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                                    </div>
                                </div>
                            </div>

                            <hr />
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="company_member_vatnumber"><?php echo $messages["company-member-vatnumber"]; ?> *</label>
                                    <input class="form-control " type="text" placeholder="0123456789" autocomplete="new-password" name="company_member_vatnumber_1" id="company_member_vatnumber" style="width: 250px;" required>
                                    <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                                </div>
                                <div class="form-group">
                                    <label for="company_member_mothername" style="margin-left: 50px;"><?php echo $messages["company-member-mothername"]; ?> *</label>
                                    <input class="form-control " type="text" autocomplete="new-password" placeholder="Gipsz Anna" name="company_member_mothername_1" id="company_member_mothername" style="width: 250px; margin-left: 50px;" required>
                                    <div class="invalid-feedback" style="margin-left: 50px;">Kérlek töltsd ki a mezőt!</div>
                                </div>
                            </div>

                            <!-- EZT NE PISZKÁLD CSAK CSS (2020.07.30) Attila -->
                            <div class="dropzone needsclick drop" id="dropzone_3" style="background: white; border-radius: 5px; border: 2px dashed #45a049;">
                                <div class="dz-message needsclick text-muted">
                                    <?php echo $messages["upload-text"]; ?>
                                </div>
                            </div>
                            <!-- I mean it -->
                            <p style="text-align: center;"><?php echo $messages["upload-text5"]; ?></p>
                        </div>

                        <div id="managerDoc">
                            <hr />

                            <button type="button" class="btn btn-primary getManagerDoc"><?php echo $messages["download-btn2"]; ?></button>
                            <small class="form-text text-muted">A dokumentum letöltéséhez töltsd ki a tag adatiat.</small>

                            <br />
                            <br />

                            <!-- EZT NE PISZKÁLD CSAK CSS (2020.07.30) Attila -->
                            <div class="dropzone needsclick drop" id="dropzone_5" style="background: white; border-radius: 5px; border: 2px dashed #45a049;">
                                <div class="dz-message needsclick text-muted">
                                    <?php echo $messages["upload-text"]; ?>
                                </div>
                            </div>
                            <!-- I mean it -->
                            <p style="text-align: center;"><?php echo $messages["upload-text8"]; ?></p>
                        </div>

                    </div>
                    <div class="btn-here">
                    </div>
                </div>

                <div id="newmemberappendhere">
                </div>

                <div id="statistics">
                    <hr />
                    <h3>Tagsági arányok</h3>

                    <div class="form-row">
                        <div class="form-group">
                            <label name="stat_name_1" id="stat_name" style="margin-top: 35px;">Tag neve</label>
                        </div>
                        <div class="form-group">
                            <label for="stat1_1" style="margin-left: 50px;"><?php echo $messages["stat-1"]; ?></label>
                            <input class="form-control" type="text" name="stat1_1" id="stat1" style="width: 60px; margin-left: 50px;" disabled>
                        </div>
                        <div class="form-group">
                            <label for="stat2_1" style="margin-left: 50px;"><?php echo $messages["stat-2"]; ?></label>
                            <input class="form-control" type="text" name="stat2_1" id="stat2" style="width: 60px; margin-left: 50px;" disabled>
                        </div>
                        <div class="form-group">
                            <label for="stat3_1" style="margin-left: 50px;"><?php echo $messages["stat-3"]; ?></label>
                            <input class="form-control" type="text" name="stat3_1" id="stat3" style="width: 60px; margin-left: 50px;" disabled>
                        </div>
                        <div class="form-group">
                            <label for="stat4_1" style="margin-left: 50px;"><?php echo $messages["stat-4"]; ?></label>
                            <input class="form-control" type="text" name="stat4_1" id="stat4" style="width: 60px; margin-left: 50px;" disabled>
                        </div>
                        <div class="form-group">
                            <label for="stat5_1" style="margin-left: 50px;"><?php echo $messages["stat-5"]; ?></label>
                            <input class="form-control" type="text" name="stat5_1" id="stat5" style="width: 60px; margin-left: 50px;" disabled>
                        </div>
                    </div>
                </div>

                <div id="newstatappendhere">
                </div>
            </section>
            <!-- Company Members section END -->

            <hr />

            <!-- Company Manager START -->
            <h4><?php echo $messages["company-managers"]; ?></h4>
            <div id="manager" style="display: none;">

                <div id="manager_container_1">
                    <p id="manager-num"><?php echo $messages["company-manager"]; ?><span name="manager_id" id="manager_id">#0</span></p>

                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label for="manager_type"><?php echo $messages["company-member-type"]; ?></label>
                            <select class="form-control" name="manager_type_0" id="manager_type">
                                <?php SetMemberTypeOptions(); ?>
                            </select>
                        </div>
                    </div>

                    <div id="manager-type2" style="display: none;">
                        <div class="form-row">
                            <div class="form-group mx-auto">
                                <label for="manager_company_number"><?php echo $messages["company-member-company-number"]; ?> *</label>
                                <input class="form-control" type="text" autocomplete="new-password" name="manager_company_number_0" id="manager_company_number" style="width: 300px;" required>
                                <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                            </div>
                        </div>

                        <hr />

                        <label><?php echo $messages["company-seat"]; ?></label>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="manager_type2_zip"><?php echo $messages["district"]; ?> *</label>
                                <input type="text" class="form-control" placeholder="1035" autocomplete="new-password" name="manager_seat_type2_zip_0" id="manager_seat_type2_zip" required>
                                <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="manager_type2_city"><?php echo $messages["city"]; ?> *</label>
                                <input type="text" class="form-control" placeholder="Budapest" autocomplete="new-password" name="manager_seat_type2_city_0" id="manager_seat_type2_city" required>
                                <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="manager_type2_address"><?php echo $messages["street"]; ?> *</label>
                                <input type="text" class="form-control" placeholder="Bécsi út" autocomplete="new-password" name="manager_seat_type2_address_0" id="manager_seat_type2_address" required>
                                <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                            </div>
                            <div class="form-row col-md-8">
                                <div class="form-group col-md-5">
                                    <label for="manager_type2_address2"><?php echo $messages["address-other"]; ?> *</label>
                                    <input type="text" class="form-control" placeholder="135 2.em. 2" autocomplete="new-password" name="manager_seat_type2_address2_0" id="manager_seat_type2_address2" required>
                                    <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                                </div>
                            </div>
                        </div>

                        <hr />

                        <label><?php echo $messages["company-member-type2-name"]; ?></label>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="manager_type2_firstname"><?php echo $messages["company-member-firstname"]; ?> *</label>
                                <input type="text" class="form-control" autocomplete="new-password" name="manager_type2_firstname_0" id="manager_type2_firstname" style="width: 300px;" required>
                                <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                            </div>
                            <div class="form-group">
                                <label for="manager_type2_lastname" style="margin-left: 20px;"><?php echo $messages["company-member-lastname"]; ?> *</label>
                                <input class="form-control detect2" type="text" autocomplete="new-password" name="manager_type2_lastname_0" id="manager_type2_lastname" style="width: 300px; margin-left: 20px;" required>
                                <div class="invalid-feedback" style="margin-left: 20px;">Kérlek töltsd ki a mezőt!</div>
                            </div>
                            <input type="hidden" name="manager_type2_fullname_1" id="manager_type2_fullname">
                        </div>

                        <hr />

                        <label><?php echo $messages["company-member-type2-address"]; ?></label>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="manager_type2_country"><?php echo $messages["company-member-country"]; ?> </label>
                                <input type="text" class="form-control" placeholder="Magyarország" autocomplete="new-password" name="manager_type2_country_0" id="manager_type2_country" required>
                                <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="manager_type2_zip"><?php echo $messages["district"]; ?> *</label>
                                <input type="text" class="form-control" placeholder="1035" autocomplete="new-password" name="manager_type2_zip_0" id="manager_type2_zip" required>
                                <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="manager_type2_city"><?php echo $messages["city"]; ?> *</label>
                                <input type="text" class="form-control" placeholder="Budapest" autocomplete="new-password" name="manager_type2_city_0" id="manager_type2_city" required>
                                <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="manager_type2_address"><?php echo $messages["street"]; ?> *</label>
                                <input type="text" class="form-control" placeholder="Bécsi út" autocomplete="new-password" name="manager_type2_address_0" id="manager_type2_address" required>
                                <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                            </div>
                            <div class="form-row col-md-8">
                                <div class="form-group col-md-5">
                                    <label for="manager_type2_address2"><?php echo $messages["address-other"]; ?> *</label>
                                    <input type="text" class="form-control" placeholder="135 2.em. 2" autocomplete="new-password" name="manager_type2_address2_0" id="manager_type2_address2" required>
                                    <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="manager-type1">

                        <div class="form-row">
                            <div class="form-group">
                                <label for="manager_firstname"><?php echo $messages["company-member-firstname"]; ?> *</label>
                                <input type="text" class="form-control" autocomplete="new-password" name="manager_firstname_0" id="manager_firstname" style="width: 300px;" required>
                                <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                            </div>
                            <div class="form-group">
                                <label for="manager_lastname" style="margin-left: 20px;"><?php echo $messages["company-member-lastname"]; ?> *</label>
                                <input class="form-control detect2" type="text" autocomplete="new-password" name="manager_lastname_0" id="manager_lastname" style="width: 300px; margin-left: 20px;" required>
                                <div class="invalid-feedback" style="margin-left: 20px;">Kérlek töltsd ki a mezőt!</div>
                            </div>
                            <input type="hidden" name="manager_fullname_0" id="manager_fullname">
                        </div>

                        <hr />

                        <label><?php echo $messages["company-member-address"]; ?></label>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="manager_country"><?php echo $messages["company-member-country"]; ?> </label>
                                <input type="text" class="form-control" placeholder="Magyarország" autocomplete="new-password" name="manager_country_0" id="manager_country" required>
                                <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="manager_zip"><?php echo $messages["district"]; ?> *</label>
                                <input type="text" class="form-control" placeholder="1035" autocomplete="new-password" name="manager_zip_0" id="manager_zip" required>
                                <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="manager_city"><?php echo $messages["city"]; ?> *</label>
                                <input type="text" class="form-control" placeholder="Budapest" autocomplete="new-password" name="manager_city_0" id="manager_city" required>
                                <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="manager_address"><?php echo $messages["street"]; ?> *</label>
                                <input type="text" class="form-control" placeholder="Bécsi út" autocomplete="new-password" name="manager_address_0" id="manager_address" required>
                                <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                            </div>
                            <div class="form-row col-md-8">
                                <div class="form-group col-md-5">
                                    <label for="manager_address2"><?php echo $messages["address-other"]; ?> *</label>
                                    <input type="text" class="form-control" placeholder="135 2.em. 2" autocomplete="new-password" name="manager_address2_0" id="manager_address2" required>
                                    <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="btn-here">
                    </div>

                    <div id="managerDoc">

                        <br />
                        <button type="button" class="btn btn-primary getManagerDoc"><?php echo $messages["download-btn2"]; ?></button>
                        <small class="form-text text-muted">A dokumentum letöltéséhez töltsd ki a az adatokat.</small>

                        <br />
                        <br />

                        <!-- EZT NE PISZKÁLD CSAK CSS (2020.07.30) Attila -->
                        <div class="dropzone needsclick drop" id="dropzone_0" style="background: white; border-radius: 5px; border: 2px dashed #45a049;">
                            <div class="dz-message needsclick text-muted">
                                <?php echo $messages["upload-text"]; ?>
                            </div>
                        </div>
                        <!-- I mean it -->
                        <p style="text-align: center;"><?php echo $messages["upload-text8"]; ?></p>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-primary addmanager"><?php echo $messages["other-manager"]; ?></button>
            <small class="form-text text-muted">Ezzel a gombbal csak akkor adj hozzá ügyvezetőt ha az nem tag!</small>

            <div id="newmanagerappendhere">
            </div>
            <!-- Company Manager END -->

            <hr />

            <p style="text-align: center;"><?php echo $messages["appointment"]; ?></p>
            <div class="form-row">
                <div class="form-group">
                    <div class="input-group date">
                        <input class="form-control " type="text" placeholder="yyyy.mm.dd. hh:mm" autocomplete="new-password" name="appointment_date_1" id="appointment_date_1" style="width: 250px;">
                        <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group date">
                        <input class="form-control " type="text" placeholder="yyyy.mm.dd. hh:mm" autocomplete="new-password" name="appointment_date_2" id="appointment_date_2" style="width: 250px; margin-left: 50px;">
                        <div class="invalid-feedback" style="margin-left: 50px;">Kérlek töltsd ki a mezőt!</div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group date">
                        <input class="form-control " type="text" placeholder="yyyy.mm.dd. hh:mm" autocomplete="new-password" name="appointment_date_3" id="appointment_date_3" style="width: 250px; margin-left: 50px;">
                        <div class="invalid-feedback" style="margin-left: 50px;">Kérlek töltsd ki a mezőt!</div>
                    </div>
                </div>
            </div>

            <div style="text-align: center;">
                <button type="submit" class="btn btn-primary" id="submit-btn" style="margin-top: 60px; width: 300px;"><?php echo $messages["submit-btn"]; ?></button>
                <p style="font-size: 10px;"><?php echo $messages["fine-print"]; ?></p>
            </div>

            <!-- File upload Preview template START EZT NE PISZKÁLD (2020.07.30) Attila -->
            <div id="preview-template" style="display: none;">
                    <div class="dz-preview dz-file-preview">
                        <div class="dz-image"><img data-dz-thumbnail=""></div>
                            <div class="dz-details">
                                <div class="dz-size">
                                    <span data-dz-size=""></span>
                                </div>
                                <div class="dz-filename">
                                    <span data-dz-name=""></span>
                                </div>
                            </div>
                            <div class="dz-progress">
                                <span class="dz-upload" data-dz-uploadprogress=""></span>
                            </div>
                            <div class="dz-error-message">
                                <span data-dz-errormessage=""></span>
                            </div>
                            <div class="dz-success-mark">
                                <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                                    <title>Check</title>
                                    <desc>Created with Sketch.</desc>
                                    <defs></defs>
                                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                                        <path d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475" fill="#FFFFFF" sketch:type="MSShapeGroup"></path>
                                    </g>
                                </svg>
                            </div>
                            <div class="dz-error-mark">
                                <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                                    <title>error</title>
                                    <desc>Created with Sketch.</desc>
                                    <defs></defs>
                                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                                        <g id="Check-+-Oval-2" sketch:type="MSLayerGroup" stroke="#747474" stroke-opacity="0.198794158" fill="#FFFFFF" fill-opacity="0.816519475">
                                            <path d="M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" sketch:type="MSShapeGroup"></path>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                    </div>
                </div>
                <!-- File upload Preview template END -->

                <!-- EZT NE PISZKÁLD (2020.07.30) Attila -->
                <input type="hidden" name="user_temp_dir" value="<?php echo $_SESSION["userDir"]; ?>">
                <input type="hidden" id="company_main_place" name="company_main_place">
                <input type="hidden" id="company_site_num" name="company_site_num">
                <input type="hidden" id="company_branch_num" name="company_branch_num">
                <input type="hidden" id="company_manager_num" name="company_manager_num">
                <input type="hidden" id="company_member_num" name="company_member_num">
                <input type="hidden" id="company_boss_num" name="company_boss_num">
                <input type="hidden" value="1" name="company_member_number" id="company_member_number">
                <!-- I mean it -->

        </form>
    </div>

    <script src="js/vendor/jquery-3.5.1/jquery-3.5.1.min.js"></script>
    <script src="js/vendor/bootstrap-4.5.0/bootstrap.min.js"></script>
    <script src="js/vendor/moment/moment-with-locales.js"></script>
    <script src="js/vendor/bootstrap-datetimepicker.min.js"></script>
    <script src="js/vendor/dropzone/dropzone.js"></script>
    <script src="js/vendor/intlTelInput/intlTelInput.js"></script>
    <script src="js/cookie.js"></script>
    <script src="js/save.js"></script>
    <script src="js/select.js"></script>
    <script src="js/validation.js"></script>
    <script src="js/cegalapitas.js"></script>
</body>
</html>