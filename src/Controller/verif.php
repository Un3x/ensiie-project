<?php

// cost à gerer ?
function hasherPassword($pass)
{
 return password_hash($pass);
}

function verifierPassword($pass,$hash)
{
    return password_verify($pass,$hash);
}
