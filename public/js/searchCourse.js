function searchCourse(departureId, arrivalId, dateId, timeId, resultId){
    var resDiv = document.getElementById(resultId);
    var departureCourse = document.getElementById(departureId).value;
    var arrivalCourse = document.getElementById(arrivalId).value;
    var dateCourse = document.getElementById(dateId).value;
    var timeCourse = document.getElementById(timeId).value;

    if(!departureCourse || !arrivalCourse || !dateCourse || !timeCourse){ 
        return;
    }

    var xhttp;
    xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {// 4 = request finished and response is ready, 200 = "OK"
            
            resDiv.innerHTML = "";

            var res = JSON.parse(this.responseText);

            if (res["status"]=="success"){
                for (var ligne of res["data"]){
                    resDiv.innerHTML += "<div>nom : "+ligne['carrierName'] + "<br/>";
                    resDiv.innerHTML += "prix : "+ligne['price'] + " €<br/>";
                    resDiv.innerHTML += "heure de départ : "+ligne['departureTime'] + "<br/>";
                    resDiv.innerHTML += "heure d'arrivée : "+ligne['arrivalTime'] + "<br/>";
                    resDiv.innerHTML += "<a href='/course/"+departureCourse+'_'+arrivalCourse+'_'+dateCourse+'_'+timeCourse+"_"+ligne['carrierId']+"' >infos</a></div><br/><br/>";
                }
            }
            else{
                resDiv.innerHTML = "aucun trajet trouvé"
            }

            history.pushState("aa", "titre", "/searchCourse?departure="+departureCourse+'&arrival='+arrivalCourse+'&date='+dateCourse+'&time='+timeCourse);
        }
    }

    xhttp.open('GET', '/api/course/search/departure='+departureCourse+'&arrival='+arrivalCourse+'&date='+dateCourse+'&time='+timeCourse+'&n='+'5', true);
    xhttp.send();

}