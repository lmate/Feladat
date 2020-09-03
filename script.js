// Function for showing articles
function article_select(e) {
    // Hide all articles
    for (var i = 0; i < 3; i++) {
        document.getElementsByClassName('article_text')[i].style.display = 'none';
        document.getElementsByClassName('article_element_'+i)[0].style.borderLeft = '0px';
    }
    // Show the selected article
    document.getElementsByClassName('article_text')[e].style.display = 'block';
    document.getElementsByClassName('article_element_'+e)[0].style.borderLeft = '3px solid #146ae3';
    // Set the article title
    switch (e) {
        case 0:
            document.getElementsByClassName('article_title')[0].innerHTML = 'Lorem ipsum';
            break;
        case 1:
            document.getElementsByClassName('article_title')[0].innerHTML = 'Portfolio';
            break;
        case 2:
            document.getElementsByClassName('article_title')[0].innerHTML = 'Forbes';
            break;
    }
}
// Selecting the right element from the menu depending on the screen
function loaded(e) {
    for (var i = 0; i < 4; i++) {
        document.getElementsByClassName('menu_element_'+i)[0].style.borderBottom = '0px';
    }
    document.getElementsByClassName('menu_element_'+e)[0].style.borderBottom = '2px solid white';
}

// Array for containing the list of animals
var animals = [];
function animal_add() {
    // Checking if all the formes are filled before adding a new animal
    if (document.getElementsByClassName('form_element')[0].value == '' || document.getElementsByClassName('form_element')[1].value == '' || document.getElementsByClassName('form_element')[2].value == '') {
        alert('Please fill in all the required data');
    }
    else {
        // Adding the new animal to the list
        animals.push([[document.getElementsByClassName('form_element')[0].value],[document.getElementsByClassName('form_element')[1].value],[document.getElementsByClassName('form_element')[2].value]]);
        // Clearig all data before showing the new list
        document.getElementsByClassName('animal_container')[0].innerHTML = "";
        // Showing all data
        for (var i = 0; i < animals.length; i++) {
            document.getElementsByClassName('animal_container')[0].innerHTML = "<tr><td><input type='text' class='form_element' placeholder='Name' value='"+animals[i][0]+"'></td><td><input type='text' class='form_element' placeholder='Species' value='"+animals[i][1]+"'></td><td><input type='text' class='form_element' placeholder='Age' value='"+animals[i][2]+"'></td><td><input type='button' class='form_button' onclick='animal_remove("+i+")' value='X'></td></tr>" + document.getElementsByClassName('animal_container')[0].innerHTML;
        }
        // Adding the 'add animal' form
        document.getElementsByClassName('animal_container')[0].innerHTML = "<tr><td><input type='text' class='form_element' placeholder='Name'></td><td><input type='text' class='form_element' placeholder='Species'></td><td><input type='text' class='form_element' placeholder='Age'></td><td><input type='button' class='form_button_add' onclick='animal_add()' value='Add'></td></tr>" + document.getElementsByClassName('animal_container')[0].innerHTML;
    }
}
function animal_remove(e) {
    // Remove the selected record from the array
    animals.splice(e, 1);
    // Clearig all data before showing the new list
    document.getElementsByClassName('animal_container')[0].innerHTML = "";
    // Showing all data
    for (var i = 0; i < animals.length; i++) {
        document.getElementsByClassName('animal_container')[0].innerHTML = "<tr><td><input type='text' class='form_element' placeholder='Name' value='"+animals[i][0]+"'></td><td><input type='text' class='form_element' placeholder='Species' value='"+animals[i][1]+"'></td><td><input type='text' class='form_element' placeholder='Age' value='"+animals[i][2]+"'></td><td><input type='button' class='form_button' onclick='animal_remove("+i+")' value='X'></td></tr>" + document.getElementsByClassName('animal_container')[0].innerHTML;
    }
    // Adding the 'add animal' form
    document.getElementsByClassName('animal_container')[0].innerHTML = "<tr><td><input type='text' class='form_element' placeholder='Name'></td><td><input type='text' class='form_element' placeholder='Species'></td><td><input type='text' class='form_element' placeholder='Age'></td><td><input type='button' class='form_button_add' onclick='animal_add()' value='Add'></td></tr>" + document.getElementsByClassName('animal_container')[0].innerHTML;
}