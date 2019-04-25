<script>

function getLieuxSimilaires(lieu, nb){
    return ['test1', 'test2', 'test3'];

}

function autoSuggestLieu(lieu){
    var res = getLieuxSimilaires(lieu, 5);

    var divResults = document.getElementById("autoCompl");

    divResults.innerHTML = "";

    for (var ligne of res){
        divResults.innerHTML += ligne+"</br>";
    }
}


</script>



<input type="text", id="champ", onkeyup="autosuggest(this.value);" />
     <div id="autoCompl"></div>
