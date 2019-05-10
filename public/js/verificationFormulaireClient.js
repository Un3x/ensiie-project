

var contrainte = document.querySelectorAll('span.contrainte');

for(var i =0; i < contrainte.length; i++)
{
    contrainte[i].style.display = 'none';
}

function contrainteAssocie(element)
{
    while(element.className != 'contrainte')
    {
        element = element.nextSibling;
        if(element == null)
        {
            return false;
        }
    }
    return element;
}

var check = {};

check['mail'] = function ( )
{
    var mail = document.getElementById("mail");
    var regex = /^(([^<>()[]\.,;:s@]+(.[^<>()[]\.,;:s@]+)*)|(.+))@(([[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}])|(([a-zA-Z-0-9]+.)+[a-zA-Z]{2,}))$/;
    if(regex.test(mail.value))
    {
        return true;
    }
    return false;
}

check['prenom'] = function ( )
{
    var prenom = document.getElementById("prenom");
    var regex = /^\w{0,15}$/g;
    if(regex.exec(prenom.value))
    {
        return true;
    }
    return false;
}

check['nom'] = function ( )
{
    var nom = document.getElementById("nom");
    var regex = /^\w{0,15}$/g;
    if(regex.test(nom.value))
    {
        return true;
    }
    return false;
}

check['age'] = function ( )
{
    var age = document.getElementById("age");
    if( age.value < 0)
    {
        return false;
    }
    return true;
}

check['password2'] = function ( )
{
    var password = document.getElementById("password");
    var password2 = document.getElementById("password2");
    alert("mot");
    if(password.value.toString() === password2.value.toString())
    {
        return true;
    }
    return false;

}


var inputs = document.querySelectorAll('input');
for (var i = 0; i < inputs.length; i++)
{
    inputs[i].addEventListener('change', function(e)
    {
        if(check[e.target.id]())
            contrainteAssocie(e.target).style.display = 'none';
        else
            contrainteAssocie(e.target).style.display = 'inline-block';
    })
}

