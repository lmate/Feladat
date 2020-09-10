<?php
if (!isset($_SESSION["name"]) || !isset($_SESSION["id"]))
{
    header("Location: /adminpanel/admin/");
}

$type = "";
if ($_SESSION["permission"] == 3)
{
    $type = "Iroda";
}
else
{
    $type = "Ügyvéd";
}
?>

<div class="container">
    <div>
        <div>
            <div>
                <div class="imgcontainer">
                
                    <?php
                        if ($_SESSION["permission"] == 3)
                        {
                            echo '
                                <img src="/adminpanel/Images/company_avatar.png" alt="Avatar" class="avatar">
                            ';
                        }
                        else
                        {
                            echo '
                                <img src="/adminpanel/Images/img_avatar.png" alt="Avatar" class="avatar">
                            ';
                        }
                    ?>

                </div>
                <h1><?php echo $_SESSION["name"] ?></h1>
                <hr />
                <p><strong>Adatok:</strong></p>
                <p>Profil típusa: <?php echo $type; ?></p>
                <p>Név: <?php echo $_SESSION["name"] ?></p>
                <p>Iroda: <?php echo $_SESSION["office"]["offices"][0] ?></p>
                <?php
                    if ($_SESSION["permission"] == 3)
                    {
                        echo '
                            <p>Székhely: '.$officeData[0]["seat"].'</p>
                            <p>Telefonszám: '.$officeData[0]["phone"].'</p>
                            <p>Postázási cím: '.$officeData[0]["billing_address"].'</p>
                        ';
                    }
                ?>
                <hr />
                <form>
                    <div class="spinner-border" id="loading"></div>
                    <div class="alert alert-warning" id="response">
                        Kérem várjon...
                    </div>

                    <?php
                        if ($_SESSION["permission"] == 3)
                        {
                            echo '
                                <label>Telefonszám</label>
                                <input class="form-control col-md-6 mx-auto" type="tel" name="phone" id="phone">
                                <button style="margin-bottom: 100px;" type="button" class="btn btn-danger col-md-6 phone">Telefonszám mentése</button>

                                <hr />
                                <label>Postázási cím</label>
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-md-4">
                                        <label>Ország</label>
                                        <input type="text" class="form-control" placeholder="Magyarország" name="country" id="country" required>
                                        <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Kerület</label>
                                        <input type="text" class="form-control" placeholder="1035" name="zip" id="zip" required>
                                        <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                                    </div>
                                </div>

                                <div class="form-row justify-content-center">
                                    <div class="form-group col-md-4">
                                        <label>Település</label>
                                        <input type="text" class="form-control" placeholder="Budapest" name="city" id="city" required>
                                        <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Közterület neve és jellege</label>
                                        <input type="text" class="form-control" placeholder="Bécsi út" name="address" id="address" required>
                                        <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                                    </div>
                                </div>

                                <div class="form-row justify-content-center">
                                    <div class="form-group col-md-4">
                                        <label>Házszám, emelet és ajtó</label>
                                        <input type="address2" class="form-control" placeholder="135 2.em. 2" name="address2" id="address2" required>
                                        <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
                                    </div>
                                </div>
                                <button style="margin-bottom: 100px;" type="button" class="btn btn-danger col-md-6 postAddress">Postázási cím mentése</button>
                            ';
                        }
                    ?>

                    <hr />
                    <label>Jelszó</label>
                    <div class="form-row justify-content-center">
                        <div class="form-group">
                            <input placeholder="Új jelszó" class="form-control col-md-8" type="password" name="password" id="password">
                            <input placeholder="Új jelszó megerősítése" class="form-control col-md-8" type="password" name="password2" id="password2">
                            <input type="hidden" name="username" id="username" value="<?php echo $_SESSION["name"] ?>">
                        </div>
                    </div>
                    <button type="button" class="btn btn-danger col-md-6 change">Jelszó megváltoztatása</button>
                </form>
            </div>
            <div>
            </div>
        </div>
    </div>
</div>