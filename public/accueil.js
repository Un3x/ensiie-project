(function() {
    loadEDT();
    loadDemandes();
    isAdmin();
}());


function loadEDT() {
    $.ajax({
        url: 'accueil.php',
        type: 'post',
        data: { "fun" : "lEDT"},
        success: function(response) {
            document.getElementById("edt").innerHTML = response;
        }
    });
}

function loadDemandes() {
    $.ajax({
        url: 'accueil.php',
        type: 'post',
        data: { "fun" : "dem"},
        success: function(response) {
            document.getElementById("demandes").innerHTML = response;
        }
    });
}
function acceptRequest(button) {
	$.ajax({
        url: 'accueil.php',
        type: 'post',
        data: { "fun" : "accept", "id_aide" : button.parentNode.id},
        success: function(response) {
            document.location.reload();
        }
    });
}
function isAdmin() {
    $.ajax({
        url: 'accueil.php',
        type: 'post',
        data: { "fun" : "testAdmin"},
        success: function(response) {
            if(response == 1) {
                document.getElementById('admin').innerHTML = '<form action="javascript:" onsubmit="banUser() "method="post"><label for=nom style ="width : 20%">Supprimer un compte : </label><input id="userID" type="text" size="25" maxlength="15" name="comptebanni" style ="width : 50%"/></br></br><input type="submit" value="Bannir" name="bouton1" class = "bouton8" style ="width:15%"></br></br></form>'
            }
        }
    });
}

function banUser() {
    var user = document.getElementById("userID").value;
    $.ajax({
        url: 'accueil.php',
        type: 'post',
        data: { "fun" : "banUser", "user" : user},
        success: function(response) {
            alert("banned");
        }
    });
}