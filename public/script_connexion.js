var curr_onglet = 'inscription';

function change_onglet(name, val_curr_onglet)
{    
  if (val_curr_onglet == 1){
    curr_onglet = 'connexion';
  }
  else if (val_curr_onglet == 2) {
    curr_onglet = 'inscription';
  }
  
  // on cache tous les onglets
  document.getElementById('onglet_'+name).className = 'onglet onglet_selec';
  document.getElementById('onglet_'+curr_onglet).className = 'onglet onglet_non_selec';

  document.getElementById('contenu_onglet_'+name).style.display = 'block';
  document.getElementById('contenu_onglet_'+curr_onglet).style.display = 'none';

  curr_onglet = name;
} 



function check_mdp(input) {
  if (input.value != document.getElementById('m1').value) {
      input.setCustomValidity('Les deux mots de passe doivent être identiques.');
  } else {
      input.setCustomValidity('');
  }
}