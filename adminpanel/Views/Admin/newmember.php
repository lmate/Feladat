<?php
if (!isset($userData))
{
    header("Location: https://google.com");
}
?>

<form action="/adminpanel/admin/ActivateInvite" method="post">
  <div class="imgcontainer">
    <img src="/adminpanel/Images/img_avatar.png" alt="Avatar" class="avatar">
  </div>

  <h1 class="h3 mb-3 font-weight-normal"><?php echo $userData["email"]; ?></h1>
  
  <div>
    <div class="form-group col-md-6" style="margin: auto;">
      <input type="password" name="password" class="form-control" placeholder="Jelszó" required autofocus="">
    </div>
  </div>

  <div>
    <div class="form-group col-md-6" style="margin: auto;">
      <input type="password" name="password2" class="form-control" placeholder="Jelszó megerősítése" required>
    </div>
  </div>

  <input type="hidden" name="username" value="<?php echo $userData["email"]; ?>">
  <input type="hidden" name="office" value="<?php echo $userData["office"]; ?>">

  <button class="btn btn-lg btn-primary col-md-6" type="submit">Tovább</button>
  <p class="mt-5 mb-3 text-muted">gyorscegalapitas.hu © 2020</p>
</form>