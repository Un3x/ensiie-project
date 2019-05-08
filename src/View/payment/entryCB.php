(METTEZ VOS VRAIS INFOS DE CB !!!! svp...) <br/>
numéro de carte : 
<input type=text name=nCard id=nCard oninput='isNumCardValid(this)' /> <span id='nCardCheckMsg' ></span> <br/>

date d'expiration
<select name=monthCard >
    <?php for($i=1; $i<=12; $i++){
        echo "<option>".sprintf("%02d" ,$i)."\n";
        }
    ?>
</select>
<select name=yearCard >
    <?php for($i=0; $i<=20; $i++){
        echo "<option>".($i + date("Y"))."\n";
        }
    ?>
</select> <br/>

cryptogramme visuel
<input type=text name=codeCard id=codeCard oninput='isCodeCardValid(this)' /> <span id='codeCardCheckMsg' ></span>
<script src="/js/entryCB.js"></script>