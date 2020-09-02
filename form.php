<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body onload='loaded(1)'>
    <img class='background' src='bg.png'>
    <p class='logo'>Feladat</p>
    <p class='menu_element_0' onclick="navigate('index.php')">Home</p>
    <p class='menu_element_1' onclick="navigate('form.php')">Form</p>
    <p class='menu_element_2' onclick="navigate('about.php')">About</p>
    <p class='menu_element_3' onclick="navigate('contact.php')">Contact</p>

    <table class='animal_container'>
        <tr>
            <td><input type='text' class='form_element' placeholder='Name'></td>
            <td><input type='text' class='form_element' placeholder='Species'></td>
            <td><input type='text' class='form_element' placeholder='Age'></td>
            <td><input type='button' class='form_button_add' onclick='animal_add()' value='Add'></td>
        </tr>        
    </tabel>
    <script src="script.js"></script>
</body>
</html>