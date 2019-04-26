<?php $title = "Un merveilleux site pour réserver des licornes ! " ?>

<?php ob_start(); ?>


<script>
function autoSuggestLieu(element, value){
    id = element.id;
    name = element.value
    var datalist = document.getElementById(id+"AutoCompl");

    console.log("aa");

    if (name.length < 3 || name!=value){
        datalist.innerHTML = "";
        return;
    }
    var xhttp;
    xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {// 4 = request finished and response is ready, 200 = "OK"
            datalist.innerHTML = "";

            var res = JSON.parse(this.responseText);

            if (res["status"]=="succes"){
                for (var ligne of res["data"]){
                    datalist.innerHTML += "<option>"+ligne+"</option>";
                }
            } 
        }
    };

    xhttp.open('GET', 'api.php?action=getCities&n=5&name='+name, true);
    xhttp.timeout=1000;
    xhttp.send();
}


function searchCourse(){
    var resDiv = document.getElementById('resDiv');
    var departureCourse = document.getElementById('departure').value;
    var arrivalCourse = document.getElementById('arrival').value;
    var dateCourse = document.getElementById('date').value;
    var timeCourse = document.getElementById('time').value;

    var xhttp;
    xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {// 4 = request finished and response is ready, 200 = "OK"
            
            resDiv.innerHTML = "";

            var res = JSON.parse(this.responseText);

            if (res["status"]=="succes"){
                for (var ligne of res["data"]){
                    resDiv.innerHTML += "<div>nom : "+ligne['carrierName'] + "<br/>";
                    resDiv.innerHTML += "prix : "+ligne['price'] + " €<br/>";
                    resDiv.innerHTML += "heure de départ : "+ligne['departureTime'] + "<br/>";
                    resDiv.innerHTML += "heure d'arrivée : "+ligne['arrivalTime'] + "<br/>";
                    resDiv.innerHTML += "<a href='index.php?action=infoCourse&departure="+departureCourse+'&arrival='+arrivalCourse+'&date='+dateCourse+'&time='+timeCourse+"&carrierId="+ligne['carrierId']+"' >infos</a></div><br/><br/>";
                }
            }
            else{
                resDiv.innerHTML = "aucun trajet trouvé"
            }

            history.pushState("aa", "titre", "index.php?action=searchCourse&departure="+departureCourse+'&arrival='+arrivalCourse+'&date='+dateCourse+'&time='+timeCourse);
        }
    }

    xhttp.open('GET', 'api.php?action=getCourses&departure='+departureCourse+'&arrival='+arrivalCourse+'&date='+dateCourse+'&time='+timeCourse, true);
    xhttp.send();

}

</script>



<div id=bite></div>
ville de départ :
<input type=text id=departure oninput="setTimeout(autoSuggestLieu, 150, this, this.value)" list="departureAutoCompl" autocomplete="off" value="<?=$departure?>" />
<datalist id="departureAutoCompl"></datalist>
<br/>

ville d'arrivée :
<input type=text id=arrival oninput="setTimeout(autoSuggestLieu, 150, this, this.value)" list="arrivalAutoCompl" autocomplete="off" value="<?=$arrival?>" />
<datalist id="arrivalAutoCompl"></datalist>
<br/>

date :
<input type=date id=date min= <?=date('Y-m-d')?> value="<?=$date?>" />
<br/>

heure :
<input type=time id=time value="<?=$time?>" />
<br/>

<input type=button id=search value=Rechercher onclick="searchCourse()" />

<div id=resDiv></div>


<?=$showResult?>
    

<?php $content = ob_get_clean(); ?>

<?php require('../src/View/template.php'); ?>





