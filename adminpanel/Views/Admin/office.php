<?php
if (!isset($_SESSION["name"]) || !isset($_SESSION["permission"]) || !isset($_SESSION["office"]))
{
    header("Location: /adminpanel/admin/");
}

if ($_SESSION["permission"] < 3)
{
    header("Location: /adminpanel/admin/home");
}

?>

<h1><?php echo $_SESSION["office"]["offices"][0]; ?> tagjai</h1>

<p>&#128275; : ezzel a szimbólummal megjelölt gomb segítségével változtathatsz hozzáférési jogot tagoknak.</p>
<p>&#128273; : ezzel a szimbólummal megjelölt gomb segítségével változtathatod meg egy tagnak a jelszavát.</p>
<p>&#10060; : ezzel a szimbólummal megjelölt gomb segítségével távolíthatsz el tagokat az irodából.</p>

<table class="table table-dark">
  <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Email</th>
        <th scope="col">Jog</th>
        <th scope="col">Csatlakozás ideje</th>
        <th scope="col">Kezelés</th>
    </tr>
  </thead>
  <tbody>

    <?php
      $count = 1;

      for ($i=0; $i < count($officeUser); $i++)
      { 
        if ($officeUser[$i]["username"] != $_SESSION["name"])
        {
          echo '
          <tr>
            <th scope="row">'. $count .'</th>
            <td id="user">' . $officeUser[$i]["username"] . '</td>
            <td>' . $officeUser[$i]["permission"] . '</td>
            <td>' . $officeUser[$i]["created_at"] . '</td>
            <td>
                <button type="button" style="width: 50px;" class="btn btn-success col-md-2 change-perm" data-toggle="modal" data-target="#modal">&#128275;</button>
                <button type="button" style="width: 50px;" class="btn btn-warning col-md-2 change-passwd" data-toggle="modal" data-target="#modal">&#128273;</button>
                <button type="button" style="width: 50px;" class="btn btn-danger remove" data-toggle="modal" data-target="#modal">&#10060;</button>
            </td>
          </tr>
          ';
          $count++;
        }
      }
    ?>
  </tbody>
</table>
<button class="btn btn-primary col-md-5 invite" data-toggle="modal" data-target="#modal">Meghívó</button>