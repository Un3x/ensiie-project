<!DOCTYPE html>
<html>
<body>
<div class="panel panel-default">
        <div class="panel-heading text-center">
            <strong>Choisissez votre repas ! • Plus de détails <a href="http://www.obigdelice.fr">ici</a></strong><br/>
            <small>(Pour commander la même chose plusieurs fois, faites une nouvelle commande)</small>
        </div>
    <div class="panel-body">
        <form action="Controller/set_commande.php" method="POST">
        <?php
            foreach ($parts as $part) 
            {?>
               <div class="panel-heading text-center">
                    <strong><?php echo $part['Nom']?></strong>
                </div>
                <div class='panel-body'>
                <?php
                foreach($part['typeFood'] as $typeFood)
                {?>
                     <div class="input-group">
                        <label class="input-group-addon"><?php echo $typeFood['nomType']?></label>
                        <select name=<?php echo $typeFood['idType'];?> class="form-control" onchange="show_special(this)">
                            <option value="0" slected>Cliquez pour voir les choix</option>
                            <?php
                            foreach($typeFood['foods'] as $food)
                            {?>
                                <option value="<?php echo $food['foodID'];?>"><?php echo $food['nameFood']." (".$food['priceFood'].")";?></option>
                                <?php 
							
                            }?>
                        </select>
						<div class="specials<?php echo $typeFood['idType']?>">
						<?php
						foreach($typeFood['foods'] as $food)
                            {
							$class = $typeFood['idType'] . "-" . $food['foodID'];
							?>
								<div class="well" style="margin: 15px 10px; visibility: hidden;" id="hidden-<?php echo($class); ?>">
									<strong>Choisissez vos options</strong>
									<?php 
									$i = 0;
									foreach($food['idSpecial'] as $idSpec){ ?>
									</br>
									<strong>Choisissez vos <?php echo $specials[$idSpec]['nameSpecial'];?> <span class="text-danger">(entre <?php echo $food['nbMinSpecial'][$i];?> et <?php echo $food['nbMax'][$i]?> )</span> :</strong>
									<div class="specials">
										<div class="row" style="padding: 10px 15px 0;">
											<?php 
											foreach($specials[$idSpec]['items'] as $one_spec){
											?>	
												<div class="col-md-3 col-sm-6 col-xs-6">
												<label class="checkbox-inline">
													<?php $name = $typeFood['idType'] . "-" . $food['foodID']."-".$idSpec."-".$one_spec['idItem'] ;
													echo("<input name=\"".($name)."\" value=\"" . $one_spec['idItem']. "\" type=\"checkbox\">");
													echo($one_spec['nomItem']);
													?>
													</input>
												</label>
												</div>
											<?php } ?>
										</div>
									</div>
									<?php
									$i = $i + 1;
									} ?>
								</div>
                            <?php 
							
							} ?>
						</div>
					</div>
                <?php
                }?>
                </div>
            <?php
            }?>
			<button class="btn btn-primary btn-block btn-lg" type="submit">Commander</button>
        </form>
    </div>
</div>

<script type="text/javascript">
var lastShown = 0;
function show_special(selectObject)
{
	var idTypeFood = selectObject.name;
	var idFood = selectObject.value;
	if(idFood != 0){
		var toVisible = document.getElementById("hidden-" + idTypeFood + "-" +idFood);
		toVisible.style = "margin: 15px 10px; visibility: visible;"
		if(lastShown != 0){
			lastShown.style = "margin: 15px 10px; visibility: hidden;"
		}
		lastShown = toVisible;
	}else{
		if(lastShown != 0){
			lastShown.style = "margin: 15px 10px; visibility: hidden;"
		}
		lastShown = 0;
	}
}
</script>
</body>
</html>