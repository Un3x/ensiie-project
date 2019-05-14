<?php
    $uri = 'https://api.football-data.org/v2/matches';
    $reqPrefs['http']['method'] = 'GET';
    $reqPrefs['http']['header'] = 'X-Auth-Token: 9ee0f6304f0841e3af2104fd21c0560e';
    $stream_context = stream_context_create($reqPrefs);
    $response = file_get_contents($uri, false, $stream_context);
    $matches = json_decode($response);
    foreach($matches->matches as $val){
        echo "<option value = \"" ; echo $val->homeTeam->name; echo " - "; echo $val->awayTeam->name; echo "\"/>";}

?>