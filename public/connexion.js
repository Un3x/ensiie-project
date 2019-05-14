function connexion() {
    var Pseudo = document.getElementById('Pseudo').value;
    var psw = document.getElementById('psw').value;
    $.ajax({
        url: 'connexion.php',
        type: 'post',
        data: { "fun" : "connexion", "Pseudo" : Pseudo, "psw" : psw},
        success: function(response) {
            if(response == 1) {
                window.location.href = "Accueil.html";
            }
            else {
                document.getElementById('errors').innerHTML = "Nom d'utilisateur/Mot de Passe incorrect";
            }
        }
    });
}