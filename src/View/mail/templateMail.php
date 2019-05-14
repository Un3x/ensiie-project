<!DOCTYPE html>

<html>
    
    <head>
        <meta charset="UTF-8"/>
    
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <link rel="stylesheet" href="http://localhost:8080/css/templateStyle.css" />
    </head>

    
    <body>
        <nav class="row">
            <div>
                <div class="col-md-7">  
                    <a href="http://localhost:8080/" class="whiteStyle"><img alt="logo" src="http://localhost:8080/image/logo_licorne_modified.png">Uber Licorne</a>
                </div>
                <div class="col-md-1">  
                    <br />
                    <a href="http://localhost:8080/clients" class="whiteStyle">Clients</a>
                </div>
                <div class="col-md-1">
                    <br /> 
                    <a href="http://localhost:8080/creatures" class="whiteStyle">Transporteurs</a> 
                </div>
                <div class="col-md-1"> 
                    <br />
                    <a href="http://localhost:8080/informations" class="whiteStyle">Informations +</a>
                </div>

            </div>
            <br />
            <br />
        </nav>


        <main>
            <?=$content?>
        </main>


        <footer class="row">
            <ul class="col-md-4"></ul>
            <ul class="col-md-2">
                <li><a href="http://localhost:8080/aPropos" class="whiteStyle">A propos de nous</a></li>
                <li><a href="http://localhost:8080/contactezNous" class="whiteStyle">Contactez-nous</a></li>
             </ul>
            <ul class="col-md-2"> 
                <li><a href="http://localhost:8080/conditionUtilisation" class="whiteStyle">Nos conditions d'utilisations</a></li>      
                <li><a href="http://localhost:8080/venteAme" class="whiteStyle">Cliquez ici pour vendre votre âme</a></li>
            </ul>
            <ul class="col-md-4"></ul>
            <br />
            <br />
            <br />
            <br />
        </footer>
    </body>

</html>
