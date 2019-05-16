<?php 
function barre_nav() {
    echo '
<link href="stylesheet.css" rel="stylesheet" /> 
<nav class="slidemenu">
  
  <!-- Item 1 -->
  <input type="radio" name="slideItem" id="slide-item-1" class="slide-toggle" checked onclick="javascript:window.location.href=\'index.php\'; return false;"/>
  <label for="slide-item-1"><p class="icon">🏠</p><span>Accueil</span></label>
  
  <!-- Item 2 -->
  <input type="radio" name="slideItem" id="slide-item-2" class="slide-toggle" onclick="javascript:window.location.href=\'../Calendrier/public/index.php\'; return false;"/>
  <label for="slide-item-2"><p class="icon">📖</p><span>Evenements</span></label>
  
  <!-- Item 3 -->
  <input type="radio" name="slideItem" id="slide-item-3" class="slide-toggle" onclick="javascript:window.location.href=\'../models/modelEvent.php\'; return false;"/>
  <label for="slide-item-3"><p class="icon">🗓</p><span>Organiser</span></label>
  
  <!-- Item 4 -->
  <input type="radio" name="slideItem" id="slide-item-4" class="slide-toggle" onclick="javascript:window.location.href=\'../models/modelInscription.php\'; return false;" />
  <label for="slide-item-4"><p class="icon">🖋</p><span>S\'inscrire</span> </label>
  
  <div class="clear"></div>
  
  <!-- Bar -->
  <div class="slider">
    <div class="bar"></div>
  </div>
  
</nav>';
}


?>
