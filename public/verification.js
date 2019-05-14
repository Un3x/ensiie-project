function surligne(champ,erreur)
{
    if(erreur){
        champ.style.border = "1px solid #f00";
        champ.style.backgroundColor = "#ff582c";
    }
    else
        champ.style.backgroundColor = "";
}


function verifPseudo(champ)
{
    if(champ.value.length < 3 || champ.value.length > 20)
    {
        surligne(champ, true);
        return false;
    }
    else
    {
        surligne(champ, false);
        return true;
    }
}

function verifNom(champ)
{
    if(champ.value.length < 1 || champ.value.length  > 200)
    {
        surligne(champ, true);
        return false;
    }
    else
    {
        surligne(champ, false);
        return true;
    }
}

function verifPrenom(champ)
{
    if(champ.value.length < 1 || champ.value.length  > 200)
    {
        surligne(champ, true);
        return false;
    }
    else
    {
        surligne(champ, false);
        return true;
    }
}

function verifVille(champ)
{
    if(champ.value.length < 1 || champ.value.length  > 500)
    {
        surligne(champ, true);
        return false;
    }
    else
    {
        surligne(champ, false);
        return true;
    }
}

function verifMdp(champ)
{
    var pwd = champ.value;
    var listRe = [{
        re: /[a-zA-Z]/g,
        count: 4,
        msg : ""
    }, {
        re: /\d/g,
        count: 3,
        msg : ""
    }, {
        re: /[^A-Za-z0-9]/g,
        count: 1,
        msg : ""
    }];

    for (var i = 0; i < listRe.length; i++) {
        var item = listRe[i];
        var match = pwd.match(item.re);
        if (null === match || match.length < item.count) {
            surligne(champ, true);
            return false;
        }
    }
    return true;
}


function verifFormIdentite(f) {
    var pseudoOk = verifPseudo(f.pseudo);
    var nomOk = verifNom(f.nom);
    var prenomOk = verifPrenom(f.prenom);
    var villeOk = verifVille(f.ville);
    if(pseudoOk && prenomOk && nomOk && villeOk) {
        return true;
    }
    else{
        alert("Oups! Vous avez mal rempli certains champs. Les champs mal remplis sont ceux coloriés!");
        return false;
    }

}

function verifMdpidentique(elmt1,elmt2) {

        var conformite;
       if ( elmt1.value === elmt2.value ) {
           conformite= true;
       }
       else {
           conformite= false;
       }
        var fstmdp = verifMdp(elmt1);
        if (fstmdp && conformite) {
            return true;
        }

        else{
            if (!conformite) {
                surligne(elmt2,true);
                alert("Mot de passe non identiques!");
            }
            else{
                surligne(elmt1,true);
                surligne(elmt2,true);
                alert("Respectez la règle du mot de passe solide!");
            }
            return false;
        }
}

