
function check_mdp(input) {
    if (input.value != document.getElementById('4').value) {
        input.setCustomValidity('Les deux mots de passe doivent être identiques.');
    } else {
        input.setCustomValidity('');
    }
}
