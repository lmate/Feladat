<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body onload='loaded(3)'>
    <img class='background' src='bg.png'>
    <p class='logo'>Feladat</p>
    <p class='menu_element_0' onclick="navigate('index.php')">Home</p>
    <p class='menu_element_1' onclick="navigate('form.php')">Form</p>
    <p class='menu_element_2' onclick="navigate('about.php')">About</p>
    <p class='menu_element_3' onclick="navigate('contact.php')">Contact</p>

    <p class='article_title'>Contact</p>
    <input type='text' class='contact_email' placeholder='E-mail'>
    <textarea class='contact_note' placeholder='Leave your message here'></textarea>
    <input type='button' class='contact_send' value='Send'>

    <script src="script.js"></script>
</body>
</html>