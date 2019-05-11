//Creation de la map
var mymap = L.map('mapid').setView([48.623447, 2.425771], 14);

//Création du calque du calque d'image
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 20,
    id: 'mapbox.streets',
    accessToken: 'your.mapbox.access.token'
}).addTo(mymap);



//Recupération des spots
//On recupere tous les spots sous forme de variable php (tableau)
"<?php $spots = fetchAll()?>"
//On compte combien on en a sous forme de variable js. Pour ca on transforme le tableau php en tableau js et on utilise la methode js .length
var len = "<?php echo json_encode(spots)?>".length; 

for(var i = 0; i < len; i++){
    //On recupere les coordonnees sous forme de variables js
    var lat = "<?php echo $spots[i]->getLatitude()?>";
    var lon = "<?php echo $spots[i]->Longitude()?>";
    
    //On ajoute un marqueur a la carte
    var marker = L.marker([lat,lon]).addTo(mymap);
    //On ajoute un popup au marqueur avec son nom
    marker.bindPopup('<h3>"<?php?$spots[i]->getNom()?>"</h3>');
}
