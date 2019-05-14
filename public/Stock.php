<html>
<head>
    <title>Stock</title>
</head>
<body>


<form action="StockModel1.php" method="post">
    <div>
        <h1>Bienvenu dans la réserve</h1>
        <table>
            <tr>
                <td>Recherche：</td>
                <td>
                    <input type="text" name="recherche">
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" value="Rechercher">
                    <input type="reset" value="Annuler">
                </td>
            </tr>
        </table>
    </div>
</form>

<form action="StockModel2.php" method="post">
    <div>
        <table>
            <caption>Ajout au Stock</caption>
            <tr>
                <td>Surnom: </td>
                <td>
                    <input type="text" name="surnom">
                </td>
            </tr>
            <tr>
                <td>Ingrediant: </td>
                <td>
                    <input type="text" name="ingrediant">
                </td>
            </tr>
            <tr>
                <td>Quantité: </td>
                <td>
                    <input type="text" name="qte">
                </td>
            </tr>
            <tr>
                <td>Expiration: </td>
                <td>
                    <input type="date" name="expiration">
                </td>
            </tr>
            <tr>
                <td>Role: </td>
                <td>
                    <input type="text" name="role">
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" value="Ajouter">
                    <input type="reset" value="Annuler">
                </td>
            </tr>
        </table>
    </div>
</form>

</body>
</html>
