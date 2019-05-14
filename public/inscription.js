function valid_inscription(){
    var FName = document.getElementById('FName').value;
    var LName = document.getElementById('LName').value;
    var Pseudo = document.getElementById('Pseudo').value;
    var Mail = document.getElementById('Mail').value;
    var psw = document.getElementById('psw').value;
    var pswConf = document.getElementById('pswConf').value;
    var genre;
    if(document.getElementById('cF').checked) {
        genre = document.getElementById('cF').value;
    }
    else {
        genre = document.getElementById('cH').value;
    }
    var BDay = document.getElementById('BDay').value;

    if(psw != pswConf) {
        document.getElementById('errors').innerHTML = "Les deux mots de passes ne se correspondents pas";
    }
    else {
        $.ajax({
            url: 'inscription.php',
            type: 'post',
            data: { "fun" : "inscription", "FName" : FName, "LName" : LName, 'Pseudo' : Pseudo, 'Mail' : Mail, 'psw' : psw, 'genre' : genre, 'BDay' : BDay},
            success: function(response) {
                if(response == 1) {
                    window.location.href = "accueil.html";
                }
                else {
                    document.getElementById("errors").innerHTML = "Ce Pseudo est déjà utilisé";
                }
            }
        });
    }

};