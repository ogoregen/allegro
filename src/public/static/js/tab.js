
var buttons = document.getElementById("tabNav").children;
var tabs = document.getElementById("tabs").children;
var preview = document.getElementById("preview");
var input = document.getElementById("input");

function tabInput(selected){

    for(let i = 0; i < buttons.length; i++){

        buttons[i].classList.remove("active");
        tabs[i].hidden = true;
        if(buttons[i] == selected){

            tabs[i].hidden = false;
            buttons[i].classList.add("active");
        }
    }
}

function tab(tabClass, selected){

    document.getElementsByClassName(tabClass);
}
