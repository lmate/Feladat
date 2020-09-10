<div>
<h1>Összefoglaló</h1>
<?php
if (!isset($_SESSION["name"]))
{
    header("Location: /adminpanel/admin/");
}

$json = "";

if ($mainData[0]["value"])
{
    $json = json_decode($mainData[0]["value"], true);
    $_SESSION["userDir"] = $json["user_temp_dir"];
    $_SESSION["company_name"] = $json["basic"]["name"];

    echo '
        <div style="text-align: left;">
            <h2>Cég neve: ' . $json["basic"]["name"] . '</h2>
            <h2>Cégvezető neve: ' . $json["members"]["member_1"]["fullName"] . '</h2>
            <p>Cég típusa: ' . $json["basic"]["type"] . '</p>
            <p>Cég főtevékenysége köre: ' . $json["basic"]["business"][0] . '</p>
            <p>Cég egyéb tevékenységi köre: ' . $json["basic"]["business"][1] . '</p>
            <h3>Székhely cím:</h3>
            <ul>
                <li>Kerület: ' . $json["basic"]["zip"] . ' </li>
                <li>Település: ' . $json["basic"]["city"] . ' </li>
                <li>Közterület: ' . $json["basic"]["address"] . ' </li>
                <li>Házszám, emelet és ajtó: ' . $json["basic"]["address2"] . ' </li>
            </ul>
        </div>
    ';
}
else
{
    echo "Hiba";
}

?>
<h3>Csatolmányok</h3>

<div class="filemanager">

    <div class="breadcrumbs" style="color: #0e0e0e;"></div>

    <ul id="list" class="data"></ul>

    <div class="nothingfound">
        <div class="nofiles"></div>
        <span>Nem találtam fájlokat!</span>
    </div>

</div>

<button type="button" class="btn btn-primary col-md-6" id="attachment-btn" type="button">Csatolmányok mutatása</button>
<button class="btn btn-primary col-md-6 download" type="button">Csatolmányok letöltése</button>
<form id="cancel-form" action="/adminpanel/admin/CancelReview" method="post">
    <button type="button" class="cancel-btn btn btn-danger col-md-6">Nem szeretnék ezzel a kérvénnyel foglalkozni</button>
    <input type="hidden" name="company_name" value="<?php echo $json["basic"]["name"]; ?>">
    <input type="hidden" name="review_by" value="<?php echo $_SESSION["name"] ?>">
</form>
<form id="accept-form" action="/adminpanel/admin/AcceptRequest" method="post">
    <textarea placeholder="Megjegyzés az elfogadáshoz" class="comment form-control" name="comment" style="height:200px;"></textarea>
    <!-- Digital Signature START -->
    <!--<div style="margin-top: 20px;">
        <h2>Elektronikus aláírás</h2>
        <div class="sign" id="canvasDiv"></div>
        <button type="button" class="btn btn-primary" id="reset-btn" style="width: 100px;">Törlés</button>
        <input placeholder="Ki írta alá?" class="form-control" type="text" name="digital-signature">
    </div>-->
    <!-- Digital Signature END -->
    <button class="btn btn-success col-md-6 accept" type="button">Csatolmányok és megjegyzés küldése emailben a kérvényezőnek</button>
    <input type="hidden" name="company_name" value="<?php echo $json["basic"]["name"]; ?>">
    <input type="hidden" name="company_email" value="<?php echo $mainData[0]["email"]; ?>">
</form>
<form id="reject-form" action="/adminpanel/admin/RejectRequest" method="post">
    <textarea placeholder="Megjegyzés az elutasításhoz" class="comment2 form-control" name="comment" style="height:200px;"></textarea>
    <button class="btn btn-danger col-md-6 reject" type="button">Kérvény elutasítása</button>
    <input type="hidden" name="company_name" value="<?php echo $json["basic"]["name"]; ?>">
    <input type="hidden" name="company_email" value="<?php echo $mainData[0]["email"]; ?>">
</form>
<div>