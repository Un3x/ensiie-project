

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
    var regex = /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/g;
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
    return regex.test(nom.value);
}
check['phoneNumber'] = function()
{
    var phone = document.getElementById("phoneNumber");
    var regex =  /^(\d){10}$/g ;
    return regex.test(phone.value);

}
check['birthDate'] = function()
{
    var birth = document.getElementById("birthDate");
    var regex = /^[0-9]{4}-[0-9]{2}-[0-9]{2}$/g;
    return regex.test(birth.value);
}
/*
check['age'] = function ( )
{
    var age = document.getElementById("age");
    if( age.value < 0)
    {
        return false;
    }
    return true;
}
*/
check['password'] = function()
{
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

