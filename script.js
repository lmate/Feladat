function article_select(e) {
    for (var i = 0; i < 3; i++) {
        document.getElementsByClassName('article_text')[i].style.display = 'none';
        document.getElementsByClassName('article_element_'+i)[0].style.borderLeft = '0px';
    }
    document.getElementsByClassName('article_text')[e].style.display = 'block';
    document.getElementsByClassName('article_element_'+e)[0].style.borderLeft = '3px solid #146ae3';
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
function navigate(e) {
    window.location.href = e;
}
function loaded(e) {
    for (var i = 0; i < 4; i++) {
        document.getElementsByClassName('menu_element_'+i)[0].style.borderBottom = '0px';
    }
    document.getElementsByClassName('menu_element_'+e)[0].style.borderBottom = '2px solid white';
}


var animals = [];
function animal_add() {
    if (document.getElementsByClassName('form_element')[0].value == '' || document.getElementsByClassName('form_element')[1].value == '' || document.getElementsByClassName('form_element')[2].value == '') {
        alert('Please fill in all the required data');
    }
    else {
        animals.push([[document.getElementsByClassName('form_element')[0].value],[document.getElementsByClassName('form_element')[1].value],[document.getElementsByClassName('form_element')[2].value]]);
        document.getElementsByClassName('animal_container')[0].innerHTML = "";
        for (var i = 0; i < animals.length; i++) {
            document.getElementsByClassName('animal_container')[0].innerHTML = "<tr><td><input type='text' class='form_element' placeholder='Name' value='"+animals[i][0]+"'></td><td><input type='text' class='form_element' placeholder='Species' value='"+animals[i][1]+"'></td><td><input type='text' class='form_element' placeholder='Age' value='"+animals[i][2]+"'></td><td><input type='button' class='form_button' onclick='animal_remove("+i+")' value='X'></td></tr>" + document.getElementsByClassName('animal_container')[0].innerHTML;
        }
        document.getElementsByClassName('animal_container')[0].innerHTML = "<tr><td><input type='text' class='form_element' placeholder='Name'></td><td><input type='text' class='form_element' placeholder='Species'></td><td><input type='text' class='form_element' placeholder='Age'></td><td><input type='button' class='form_button_add' onclick='animal_add()' value='Add'></td></tr>" + document.getElementsByClassName('animal_container')[0].innerHTML;
    }
}
function animal_remove(e) {
    animals.splice(e, 1);
    document.getElementsByClassName('animal_container')[0].innerHTML = "";
        for (var i = 0; i < animals.length; i++) {
            document.getElementsByClassName('animal_container')[0].innerHTML = "<tr><td><input type='text' class='form_element' placeholder='Name' value='"+animals[i][0]+"'></td><td><input type='text' class='form_element' placeholder='Species' value='"+animals[i][1]+"'></td><td><input type='text' class='form_element' placeholder='Age' value='"+animals[i][2]+"'></td><td><input type='button' class='form_button' onclick='animal_remove("+i+")' value='X'></td></tr>" + document.getElementsByClassName('animal_container')[0].innerHTML;
        }
        document.getElementsByClassName('animal_container')[0].innerHTML = "<tr><td><input type='text' class='form_element' placeholder='Name'></td><td><input type='text' class='form_element' placeholder='Species'></td><td><input type='text' class='form_element' placeholder='Age'></td><td><input type='button' class='form_button_add' onclick='animal_add()' value='Add'></td></tr>" + document.getElementsByClassName('animal_container')[0].innerHTML;
}