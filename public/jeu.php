<?php
session_start();
require ('print_functions.php');
require('database_access.php');

echo "<!DOCTYPE html>
  <html>
  <head>
  <title>My New LIIfE</title>
  <meta-charset = \"utf-8\"/>
  <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js\"></script>
<script src=\"game_functions.js\"></script>
<link rel = \"stylesheet\" type = \"text/css\" href = \"stylesheet.css\"/>
<link rel = \"stylesheet\" type = \"text/css\" href = \"game_style.css\"/>
<script src=\"game_functions.js\"></script>
<script>
$(document).ready(function(){
  actualizeFront();
  $(document).on('click', '.choice', function (e){
    e.preventDefault(); //stop default behaviour
    actualizeBack(this);
          });
        });
    </script>
  </head>
  <body class = \"bg\">";
      printHeader();
echo "<main>
      <div id = \"side_info\" class = \"round_rect\">
        <div id = \"placeholder_protag\">
          <p>Protagonist placeholder</p>
        </div>
      </div>
      <div id = \"game\" class = \"round_rect\">
        <div id = \"visuel\">
        </div>
        <div id = \"choices\">
          <!-- Choices button will be displayed here -->
        </div>
        <div id = test>
        </div>
      </div>
    </main>";
      printFooter();
echo "</body></html>";
