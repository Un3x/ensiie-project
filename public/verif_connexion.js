document.getElementById("courrielc").addEventListener("blur", function (e) {
    // Correspond à une chaîne de la forme xxx@yyy.zzz
    var regexCourriel = /.+@.+\..+/;
    var validiteCourriel = "";
    if (!regexCourriel.test(e.target.value)) {
        validiteCourriel = "  Adresse invalide.";
    }
    document.getElementById("aideCourriel").textContent = validiteCourriel;
});
