function isNumCardValid(input){
    value = input.value;
    idMsg = input.id+'CheckMsg';
    msg = document.getElementById(idMsg);

    if (/^[0-9]{16}$/g.exec(value)){
        msg.innerHTML = "";
        return true;
    }
    else{
        msg.innerHTML = "numéro de carte invalide, entier à 16 chiffres requis";
        return false;
    }
}


function isCodeCardValid(input){
    value = input.value;
    idMsg = input.id+'CheckMsg';
    msg = document.getElementById(idMsg);

    if (/^[0-9]{3}$/g.exec(value)){
        msg.innerHTML = "";
        return true;
    }
    else{
        msg.innerHTML = "numéro de carte invalide, entier à 3 chiffres requis";
        return false;
    }
}


function isDateCardValid(input){
    value = input.value;
    idMsg = input.id+'CheckMsg';
    msg = document.getElementById(idMsg);

    if (/^[0-9]{3}$/g.exec(value)){
        msg.innerHTML = "";
        return true;
    }
    else{
        msg.innerHTML = "numéro de carte invalide, entier à 3 chiffres requis";
        return false;
    }



}