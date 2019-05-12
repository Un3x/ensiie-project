<div id=payment>
    <?php if($numCard!=null){ ?> 
    <input type='radio' name='afficher' value='savedCard' onclick="document.getElementById('entryCB').style.display='none'; document.getElementById('usedCard').value='savedCard'" checked /> utiliser la carte <?=$numCard ?> <br/>
    <input type='radio' name='afficher' value='newCard' onclick="document.getElementById('entryCB').style.display='block'; document.getElementById('usedCard').value='newCard'" /> utiliser une autre carte

    <?php } ?>
    
    <div id=entryCB <?php if($numCard!=null){ ?> style='display:none' <?php }?> >
        <?php require("entryCB.php"); ?>
    </div>

    <br/>
    <input type=submit name=sendInfoCard value="Valider" />
    <input type=hidden id="usedCard" name="usedCard" value=<?php if($numCard!=null){echo "savedCard";}else{echo "newCard";} ?> />
    <input type=hidden name=idCourse value="<?=$idCourse?>" />
</div>