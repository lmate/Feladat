function article_select(e) {
    for (var i = 0; i < 3; i++) {
        document.getElementsByClassName('article_text')[i].style.display = 'none';
        document.getElementsByClassName('article_element_'+i)[0].style.borderLeft = '0px';
    }
    document.getElementsByClassName('article_text')[e].style.display = 'block';
    document.getElementsByClassName('article_element_'+e)[0].style.borderLeft = '3px solid #146ae3';
}