(function() {
	loadFormModif();
}());


function loadFormModif() {
	$.ajax({
        url: 'compte.php',
        type: 'post',
        data: { "fun" : "getForm"},
        success: function(response) {
            document.getElementById("formModif").innerHTML = response;
        }
    });
}


function updateUser() {
	var fname = document.getElementById('FName').value;
	var lname = document.getElementById('LName').value;
	var mail = document.getElementById('Mail').value;
	var psw = document.getElementById('psw').value;
	var forces = document.getElementById('Forces').value;
	$.ajax({
        url: 'compte.php',  
        type: 'post',
        data: { "fun" : "updateUser", "fname" : fname, "lname" : lname, "psw" : psw, "mail" : mail, "forces" : forces},
        success: function(response) {
            document.location.reload();
        }
    });
}