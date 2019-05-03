        <footer>
            <div class="rowF">
                <div class="columnF">
                    <h4>2019</h4>
                </div>
                <div class="columnF">
                    <h3>"Trouve Ton Truc"©</h3>
                </div>
                <div class="columnF">
                    <h4>"TTT"©</h4>
                </div>
            </div>
            <div class="rowF">
                <div class="columnF">
                    <a href="concat.php">Nous contacter</a> <br/>
                    <a href="aboutUs.php">A propos de nous</a>
                </div>
                <div class="columnF">
                    <h4>Nos locaux</h4>
                    <div id="googleMap" style="width:100%;height:300px;"></div>
                </div>
                <div class="columnF">
                </div>
            </div>
        </footer>

        <script>
function myMap() {
var mapProp= {
  center:new google.maps.LatLng(48.6333,2.45),
  zoom:15,
};
var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
}
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY&callback=myMap"></script>

    </body>

</html>
