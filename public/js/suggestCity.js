function suggestCity(element, value, datalistId){
    id = element.id;
    name = element.value
    var datalist = document.getElementById(datalistId);


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

            if (res["status"]=="success"){
                for (var ligne of res["data"]){
                    datalist.innerHTML += "<option>"+ligne+"</option>";
                }
            } 
        }
    };

    xhttp.open('GET', '/api/city/names/?name='+name+'&n='+'5', true);
    xhttp.timeout=1000;
    xhttp.send();
}