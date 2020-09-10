<?php

?>
<!--
<form action="/adminpanel/admin/HandleRegister" method="post">
    <div class="imgcontainer">
        <img src="/adminpanel/Images/company_avatar.png" alt="Avatar" class="avatar">
    </div>

    <h1 class="h3 mb-3 font-weight-normal">Iroda regisztráció</h1>
  
    <div>
        <div class="form-group col-md-6" style="margin: auto;">
            <label>Iroda neve</label>
            <input type="text" name="name" class="form-control" placeholder="Iroda neve" required autofocus>
        </div>
    </div>

    <div>
        <div class="form-group col-md-6" style="margin: auto;">
            <label>Email</label>
            <input type="email" name="email" class="form-control" placeholder="Email" required>
        </div>
    </div>

    <div class="form-row justify-content-center">
        <div class="form-group col-md-4">
            <label>Ország</label>
            <input type="text" class="form-control" placeholder="Magyarország" name="office_country" id="office_country" required>
            <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
        </div>
        <div class="form-group col-md-4">
            <label>Kerület</label>
            <input type="text" class="form-control" placeholder="1035" name="office_zip" id="office_zip" required>
            <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
        </div>
    </div>

    <div class="form-row justify-content-center">
        <div class="form-group col-md-4">
            <label>Település</label>
            <input type="text" class="form-control" placeholder="Budapest" name="office_city" id="office_city" required>
            <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
        </div>
        <div class="form-group col-md-4">
            <label>Közterület neve és jellege</label>
            <input type="text" class="form-control" placeholder="Bécsi út" name="office_address" id="office_address" required>
            <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
        </div>
    </div>

    <div class="form-row justify-content-center">
        <div class="form-group col-md-4">
            <label>Házszám, emelet és ajtó</label>
            <input type="address2" class="form-control" placeholder="135 2.em. 2" name="office_address2" id="office_address2" required>
            <div class="invalid-feedback">Kérlek töltsd ki a mezőt!</div>
        </div>
    </div>

    <div class="mb-5">
        <a href="#">Kell segítség?</a>
    </div>

    <button class="btn btn-lg btn-primary col-md-6" type="submit">Regisztráció</button>
    <p class="mt-5 mb-3 text-muted">gyorscegalapitas.hu © 2020</p>
</form>
-->
<link rel="stylesheet" type="text/css" href="/adminpanel/Css/logreg.css">
<div class="background_container">
  <div class='otheroption_container'>
    <img class="otheroption_background" src="/adminpanel/Images/logreg_background.png">
    <p class='otheroption_title'>Már van felhasználója?</p>
    <hr class='otheroption_line'>
    <input type='button' class='otheroption_button' value='Bejelentkezés' onclick="window.location.href='/adminpanel/admin/login'">
  </div>
  <div class='main_container'>
    <p class='main_title'>Iroda regisztráció</p>
    <hr class='main_line'>
    <form action="/adminpanel/admin/HandleRegister" method="post">
      <input type="text" name="name" class="main_login" placeholder="Iroda neve" style='left: 36%; top: 22%;' required>
      <input type="text" name="email" class="main_login" placeholder="Email" style='left: 36%; top: 29%;' required>
      <input type="text" name="office_country" id="office_country" class="main_login" placeholder="Ország" style='left: 36%; top: 36%;' required>
      <input type="text" name="office_zip" id="office_zip" class="main_login" placeholder="Irányítószám" style='left: 36%; top: 43%;' required>
      <input type="text" name="office_city" id="office_city" class="main_login" placeholder="Település" style='left: 36%; top: 50%;' required>
      <input type="text" name="office_address" id="office_address" class="main_login" placeholder="Közterület neve és jellege" style='left: 36%; top: 57%;' required>
      <input type="text" name="office_address2" id="office_address2" class="main_login" placeholder="Házszám, Emelet, Ajtó" style='left: 36%; top: 64%;' required>
      <p class='main_help' style='top: 71%;'>Segítséget kérek!</p>
      <button type='submit' class='main_button' style='top: 79%;'>Regisztráció</button>
      <p class="main_copy">gyorscegalapitas.hu © 2020</p>
    </form>
  </div>
</div>