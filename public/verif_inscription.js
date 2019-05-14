var form = document.querySelector("form");

form.elements.courriel.addEventListener("keyup", function (e) {
    // Correspond à une chaîne de la forme xxx@yyy.zzz
    var regexCourriel = /.+@.+\..+/;
    var validiteCourriel = "";
    if (!regexCourriel.test(e.target.value)) {
        validiteCourriel = "  Adresse invalide.";
    }
    document.getElementById("aideCourriel").textContent = validiteCourriel;
});

form.elements.code2.addEventListener("keyup", function (e) {
    var mdp1 = form.elements.code1.value;
    var mdp2 = form.elements.code2.value;
    var message = "";
    if (mdp1 !== mdp2) {
        message = "Les mots de passe sont différents.";
    }
    document.getElementById("infoMdp").textContent = message;
    e.preventDefault();
});