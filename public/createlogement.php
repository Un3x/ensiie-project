<html>
<head>
    <title> Ajouter un logement </title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../public/res/css/main.css" />
</head>
<body>

    <form action="recherche.php" method = "POST">
        <p> Département </p>
        <select name="département">
            <option>01   Ain </option> 
            <option>02   Aisne </option>
            <option>03   Allier </option>
            <option>04   Alpes-de-Haute-Provence</option>
            <option>05   Hautes-Alpes </option>
            <option>06   Alpes-Maritimes </option>
            <option>07   Ardèche </option>
            <option>08   Ardennes</option>
            <option>09   Ariège</option>
            <option>10   Aube </option>
            <option>11   Aude </option>
            <option>12   Aveyron</option>
            <option>13   Bouches-du-Rhône </option>
            <option>14   Calvados </option>
            <option>15   Cantal </option>
            <option>16   Charente </option>
            <option>17   Charente-Maritime</option>
            <option>18   Cher</option>
            <option>19   Corrèze</option>
            <option>21   Côte-d'Or</option>
            <option>22   Côtes d'Armor </option>
            <option>23   Creuse </option>
            <option>24   Dordogne </option>
            <option>25   Doubs </option>
            <option>26   Drôme </option>
            <option>27   Eure </option>
            <option>28   Eure-et-Loir 	</option>
            <option>29   Finistère </option>
            <option>30   Gars </option>
            <option>31   Haute-Garonne </option>
            <option>32   Gers </option>
            <option>33   Gironde </option>
            <option>34   Hérault</option>
            <option>35 	 Ille-et-Vilaine</option>
            <option>36   Indre </option>
            <option>37   Indre-et-Loire </option>
            <option>38   Isère</option>
            <option>39   Jura</option>
            <option>40   Landes</option>
            <option>41   Loir-et-Cher</option>
            <option>42   Loire</option>
            <option>43   Haute-Loire</option>
            <option>44   Loire-Atlantique</option>
            <option>45   Loiret</option>
            <option>46   Lot</option>
            <option>47   Lot-et-Garonne</option>
            <option>48   Lozère</option>
            <option>49   Maine-et-Loire</option>
            <option>50   Manche</option>
            <option>51   Marne</option>
            <option>52   Haute-Marne</option>
            <option>53   Mayenne</option>
            <option>54   Meurthe-et-Moselle</option>
            <option>55 	 Meuse</option>
            <option>56   Morbihan</option>
            <option>57   Moselle</option>
            <option>58   Nièvre</option>
            <option>59   Nord</option>
            <option>60   Oise</option>
            <option>61   Orne</option>
            <option>62   Pas-de-Calais</option>
            <option>63   Puy-de-Dôme</option>
            <option>64   Pyrénées-Atlantiques</option>	
            <option>65 	 Hautes-Pyrénées</option>
            <option>66   Pyrénées-Orientales </option>	
            <option>67   Bas-Rhin</option>
            <option>68   Haut-Rhin</option>
            <option>69   Rhône</option>
            <option>70   Haute-Saône</option>
            <option>71 	 Saône-et-Loire</option>
            <option>72   Sarthe </option>
            <option>73   Savoie </option>
            <option>74   Haute-Savoie</option>
            <option>75   Paris</option>
            <option>76   Seine-Maritime</option>
            <option>77   Seine-et-Marne</option>
            <option>78   Yvelines</option>
            <option>79   Deux-Sèvres</option>
            <option>80   Somme</option>
            <option>81   Tarn</option>
            <option>82   Tarn-et-Garonne</option>
            <option>83   Var</option>
            <option>84   Vaucluse</option>
            <option>85   Vandée</option>
            <option>86   Vienne</option>
            <option>87 	 Haute-Vienne</option>
            <option>88 	 Vosges</option>
            <option>89 	 Yonne</option>
            <option>90 	 Territoire de Belfort</option>
            <option>91 	 Essonne</option>
            <option>92   Hauts-de-Seine</option>
            <option>93   Seine-St-Denis</option>
            <option>94   Val-de-Marne</option>
            <option>95   Val-D'Oise</option>
            <option>2A   Corse-du-Sud</option>
            <option>2B   Haute-Corse</option>
            <option>971  Guadeloupe</option>
            <option>972  Martinique</option>
            <option>973  Guyane</option>
            <option>974  La Réunion</option>
            <option>976  Mayotte</option>
        </select>

        <p> Ville </p>
        <input type="text" name="Ville">

        <p>Montant du loyer ?</p>
        <select name="loyer">
            <option>100 - 199 euros</option>
            <option>200 - 299 euros</option>
            <option>300 - 399 euros</option>
            <option>400 - 499 euros</option>
            <option>500 - 599 euros</option>
            <option>600 - 699 euros</option>
            <option>700 - 799 euros</option>
            <option>800 - 899 euros</option>
            <option>800 euros ou plus</option>
        </select>

        <p>Nombre de places</p>
        <select name="pieces">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            <option>6</option>
            <option>7 ou plus</option>
        </select>

        <p>Nombre de pièces</p>
        <select name="pieces">
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            <option>6</option>
            <option>7 ou plus</option>
        </select>

        <p> Le logement doit-il accepter les animaux ?</p>
        <select name="animal1">
            <option>Oui</option>
            <option>Non</option>
        </select>

        <p> Logement fumeur </p>
        <select name="fumeur">
            <option>Oui</option>
            <option>Non</option>
        </select>

        <input type="submit" value="Créer"/>
    </form>

    </body>
</html>