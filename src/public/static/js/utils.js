
function hide(selector){

    document.querySelector(selector).hidden = true; 
}

function toggleInputVisibility(input){

    input.type = input.type == "password" ? "text" : "password";
}
