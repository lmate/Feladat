<?php
if (isset($_SESSION["error"]))
{
  echo $_SESSION["error"];
}
?>
<!--
<form action="/adminpanel/admin/HandleLogin" method="post">
  <div class="imgcontainer">
    <img src="/adminpanel/Images/img_avatar.png" alt="Avatar" class="avatar">
  </div>

  <h1 class="h3 mb-3 font-weight-normal">Bejelentkezé</h1>
  
  <div>
    <div class="form-group col-md-6" style="margin: auto;">
      <input type="text" name="username" class="form-control" placeholder="Email" required autofocus="">
    </div>
  </div>

  <div>
    <div class="form-group col-md-6" style="margin: auto;">
      <input type="password" name="password" class="form-control" placeholder="Jelszó" required>
    </div>
  </div>

  <div class="mb-5">
    <a href="#">Kell segítség?</a>
  </div>

  <button class="btn btn-lg btn-primary col-md-6" type="submit">Bejelentkezés</button>
  <p class="mt-5 mb-3 text-muted">gyorscegalapitas.hu © 2020</p>
</form>
-->
<link rel="stylesheet" type="text/css" href="/adminpanel/Css/logreg.css">
<div class="background_container">
  <div class='otheroption_container'>
    <img class="otheroption_background" src="/adminpanel/Images/logreg_background.png">
    <p class='otheroption_title'>Még nem regisztrált?</p>
    <hr class='otheroption_line'>
    <input type='button' class='otheroption_button' value='Regisztráció' onclick="window.location.href='/adminpanel/admin/register'">
  </div>
  <div class='main_container'>
    <p class='main_title'>Bejelentkezés</p>
    <hr class='main_line'>
    <form action="/adminpanel/admin/HandleLogin" method="post">
      <input type="text" name="username" class="main_login" placeholder="Email" style='left: 36%; top: 22%;' required>
      <input type="password" name="password" class="main_login" placeholder="Jelszó" style='left: 36%; top: 29%;' required>
      <p class='main_help' style='top: 36%;'>Segítséget kérek!</p>
      <button type='submit' class='main_button' style='top: 47%;'>Bejelentkezés</button>
      <p class="main_copy">gyorscegalapitas.hu © 2020</p>
    </form>
  </div>
</div>