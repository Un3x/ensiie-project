<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8" />
            <title>FindYourThing</title>
            <link rel="stylesheet" type="text/css" href="user_head.css"/>
            <link rel="stylesheet" type="text/css" href="signin.css"/>
        </head>
  
        <body>
            <header><h1><a href="index.php">"Find Your Thing"</a></h1></header>

            <nav>
                <a href="index.php"> Home </a>
                <a href="cat1.php"> Cat_1 </a>
                <a href="cat2.php"> Cat_2 </a>
                <a href="cat3.php"> Cat_3 </a>
                <a href="contact.php"> Contact </a>
                <a href="aboutus.php"> About Us </a>
                <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>
            </nav>

            <div id="id01" class="modal">
        
        <form class="modal-content animate" action="/action_page.php">
            <div class="imgcontainer">
            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
            <img src="img_avatar2.png" alt="Avatar" class="avatar">
            </div>

            <div class="row">
                    <h2 style="text-align:center">Login with Social Media or Manually</h2>
                <div class="vl">
                     <span class="vl-innertext">or</span>
                </div>
  
                <div class="col">
                <a href="#" class="fb btn">
                    <i class="fa fa-facebook fa-fw"></i> Login with Facebook
                </a>
                <a href="#" class="twitter btn">
                    <i class="fa fa-twitter fa-fw"></i> Login with Twitter
                </a>
                <a href="#" class="google btn">
                    <i class="fa fa-google fa-fw"></i> Login with Google+
                </a>
                </div>
        
                <div class="col">
                <div class="hide-md-lg">
                    <p>Or sign in manually:</p>
                </div>

            <div class="container">
            <label for="uname"><b>Username</b></label>
            <input class="signin" type="text" placeholder="Enter Username" name="uname" required>

            <label for="psw"><b>Password</b></label>
            <input class="signin" type="password" placeholder="Enter Password" name="psw" required>
                
            <button type="submit">Login</button> <br/>
            <label for="remember">Remember me</label>
            <input type="checkbox" checked="checked" name="remember">
            </div>

            <div class="container" style="background-color:#f1f1f1">
            <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
            <span class="psw">Forgot <a href="#">password?</a></span>
            </div>
            <div class="bottom-container">
            <div class="row">
            <div class="col">
                <a href="sinscrire.php" style="color:white" class="btn">Sign up</a>
            </div>
            <div class="col">
                <a href="#" style="color:white" class="btn">Forgot password?</a>
            </div>
            </div>
        </div>
        </form>
        </div>
        </div>
        </div>
        <script src=”signin.js”>
        
        </script><br/>

        <div class="flexbox_sect_asi">