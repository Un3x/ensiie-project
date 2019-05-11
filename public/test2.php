<script type="text/javascript">   
  var anc_onglet = 'quoi';

  function change_onglet(name)
  {
    if(name == anc_onglet) { 
      // on ferme l'onglet si on clique dessus alors qu'il est déjà ouvert
      document.getElementById('onglet_'+name).className = 'onglet_0 onglet';
      document.getElementById('contenu_onglet_'+name).style.display = 'none';
      anc_onglet = '';
    }
    else {  
      // on ouvre un autre onglet  
      document.getElementById('contenu_onglet_'+name).style.display = 'block';
      document.getElementById('onglet_'+name).className = 'onglet_1 onglet';
      if (anc_onglet != '') {
        // si on avait pas d'onglet d'ouvert avant, on ne fait ce qu'il y a en dessous
        document.getElementById('contenu_onglet_'+anc_onglet).style.display = 'none';
        document.getElementById('onglet_'+anc_onglet).className = 'onglet_0 onglet';
      }      
      anc_onglet = name;
    }    
  }        
</script>



<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Un syst&egrave;me d'onglet en javascript</title>   
</head>
<body>
    <div class="systeme_onglets">
        <div class="onglets">
            <span class="onglet_0 onglet" id="onglet_quoi" onclick="javascript:change_onglet('quoi');">Quoi</span>
            <span class="onglet_0 onglet" id="onglet_qui" onclick="javascript:change_onglet('qui');">Qui</span>
            <span class="onglet_0 onglet" id="onglet_pourquoi" onclick="javascript:change_onglet('pourquoi');">Pourquoi</span>
        </div>
        <div class="contenu_onglets">
            <div class="contenu_onglet" id="contenu_onglet_quoi">
                <h1>Onglet1</h1>
                ABCD
            </div>
            <div class="contenu_onglet" id="contenu_onglet_qui">
                <h1>Onglet2</h1>
                ABCD
                
            </div>
            <div class="contenu_onglet" id="contenu_onglet_pourquoi">
                <h1>Onglet3</h1>
                ABCD
            </div>
        </div>
    </div>
    
    <script type="text/javascript">
        //<!--
                
                change_onglet(anc_onglet);
        //-->
        </script>
    
</body>
</html>



<style type="text/css">
.onglet
{
        display:inline-block;
        margin-left:3px;
        margin-right:3px;
        padding:3px;
        border:1px solid black;
        cursor:pointer;
}
.onglet_0
{
        background:#bbbbbb;
        border-bottom:1px solid black;
}
.onglet_1
{
        background:#dddddd;
        border-bottom:0px solid black;
        padding-bottom:4px;
}
.contenu_onglet
{
        background-color:#dddddd;
        border:1px solid black;
        margin-top:-1px;
        padding:5px;
        display:none;
}
ul
{
        margin-top:0px;
        margin-bottom:0px;
        margin-left:-10px
}
h1
{
        margin:0px;
        padding:0px;
}
</style>