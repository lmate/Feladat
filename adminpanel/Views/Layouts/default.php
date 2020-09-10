<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panel</title>

    <link rel="stylesheet" type="text/css" href="/adminpanel/Vendors/bootstrap-4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/adminpanel/Css/admin.css">
</head>
<body>
    <main role="main" class="container">

        <!-- NavBar Content START -->
        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a href="/adminpanel/admin/home">Kezdőlap</a>
            <a href="/adminpanel/admin/profile">Profil</a>
            <a href="/adminpanel/admin/messages">Videóhívás</a>
            <?php
                if (isset($_SESSION["permission"]) && $_SESSION["permission"] == 3)
                {
                    echo '
                        <a href="/adminpanel/admin/office">Iroda</a>
                        <button style="color: #fff; margin-left: 30px; font-size: 15px; text-align: center;" class="btn btn-primary col-md-5 invite" data-toggle="modal" data-target="#modal">Meghívó</button>
                    ';
                }
            ?>
            <a href="/adminpanel/admin/logout">Kilépés</a>
            <hr style="border-color: #fff;" />
            <a href="/adminpanel/admin/documentation">Dokumentáció</a>
        </div>
        <!-- Navbar Content END -->

        <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>

        <div class="starter-template">

            <?php
                echo $content_for_layout;
            ?>

        </div>

        <!-- Modal -->
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Cím</h5>
                <button type="button" class="close col-md-2" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cancel" data-dismiss="modal">Mégse</button>
                <button type="button" class="btn btn-primary ok">Oké</button>
                <p id="type" hidden></p>
            </div>
            </div>
        </div>
        </div>

    </main>

    <script src="/adminpanel/Vendors/jquery-3.5.1/jquery-3.5.1.min.js"></script>
    <script src="/adminpanel/Vendors/jquery-redirect/jquery-redirect.js"></script>
    <script src="/adminpanel/Vendors/bootstrap-4.5.0/js/bootstrap.min.js"></script>
    <script src="/adminpanel/Js/admin.js"></script>
</body>
</html>