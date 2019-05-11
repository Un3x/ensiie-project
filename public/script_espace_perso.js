var curr_onglet = '';

function change_onglet(name)
{
  if(name == curr_onglet) { 
      // on ferme l'onglet si on clique dessus alors qu'il est déjà ouvert
      //document.getElementById('onglet_'+name).className = 'onglet_0 onglet';
      document.getElementById('contenu_onglet_'+name).style.display = 'none';
      document.getElementById('onglet_reservation').style.display = 'block';
      document.getElementById('onglet_emprunt').style.display = 'block';
      document.getElementById('onglet_info').style.display = 'block';
      document.getElementById('onglet_mdp').style.display = 'block';
      curr_onglet = '';
  }
  else {  
      // on cache tous les onglets
      document.getElementById('onglet_reservation').style.display = 'none';
      document.getElementById('onglet_emprunt').style.display = 'none';
      document.getElementById('onglet_info').style.display = 'none';
      document.getElementById('onglet_mdp').style.display = 'none';
    
      // on ouvre l'onglet cliqué et son contenu
      document.getElementById('onglet_'+name).style.display = 'block';
      document.getElementById('contenu_onglet_'+name).style.display = 'block';

      curr_onglet = name;
  }    
} 


function check_mdp(input) {
    if (input.value != document.getElementById('4').value) {
        input.setCustomValidity('Les deux mots de passe doivent être identiques.');
    } else {
        input.setCustomValidity('');
    }
}
