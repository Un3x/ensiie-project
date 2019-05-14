var form = document.querySelector("form");

form.elements.acourriel.addEventListener("blur", function (e) {
    // Correspond à une chaîne de la forme xxx@yyy.zzz
    var regexCourriel = /.+@.+\..+/;
    var validiteCourriel = "";
    if (!regexCourriel.test(e.target.value)) {
        validiteCourriel = "  Adresse invalide.";
    }
    document.getElementById("aideCourriel1").textContent = validiteCourriel;
});

form.elements.courriel1.addEventListener("keyup", function (e) {
    // Correspond à une chaîne de la forme xxx@yyy.zzz
    var regexCourriel = /.+@.+\..+/;
    var validiteCourriel = "";
    if (!regexCourriel.test(e.target.value)) {
        validiteCourriel = "Adresse invalide.";
    }
    document.getElementById("aideCourriel2").textContent = validiteCourriel;
});

form.elements.courriel2.addEventListener("keyup", function (e) {
    var cour1 = form.elements.courriel1.value;
    var cour2 = form.elements.courriel2.value;
    var message = "";
    if (cour1 !== cour2) {
        message = "Les courriels sont différents.";
    }
    document.getElementById("infoCourriel").textContent = message;
    e.preventDefault();
});