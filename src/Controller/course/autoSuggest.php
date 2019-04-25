<script>



function autoSuggestLieu(name){
    var champ=document.getElementById('champ')
             var datalist = document.getElementById("autoCompl");

    var xhttp;

    xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {// 4 = request finished and response is ready, 200 = "OK"
            datalist.innerHTML = "";

            for (var ligne of this.responseText.split(";")){
                datalist.innerHTML += "<option>"+ligne+"</option>";
                }
        }
    };

    xhttp.open('GET', 'getCity.php?name='+name, true);
    xhttp.send();
}


</script>



<input type="text", id="champ", oninput="autoSuggestLieu(this.value)" list="autoCompl" autocomplete="off" />
     <datalist id="autoCompl"></datalist>
