<?php if (isset($_SESSION['connected'])): ?>
<footer id="connected">
    <div class="container">
        <table>
            <td><a href="#"><img class="icon" src="img/facebook-icon.png" alt="Facebook icon" /></a></td>
            <td><a href="#"><img class="icon" src="img/Mail-Icon.png" alt="Mail icon" /></a></td>
            <td><a href="#"><img class="icon" src="img/anemflogo.png" /></a></td>
            <td><a href="#"><img class="icon" src="img/anesflogo.png" /></a></td>
        </table>
    </div>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="main.js"></script>

<?php else: ?>
<footer>
    <div class="container">
        <img id="contact-us-img" src="img/contact_us.svg" alt="Icone question" />
        <section id="footer-text">
            <h2>Une question à nous poser?</h2>
            <p>Rien de plus simple! Il vous suffit de nous contacter par mail ou sur notre page Facebook. </p>
        </section>
        <table>
            <td><a href="https://www.facebook.com/tspsud/"><img class="icon" src="img/facebook-icon.png" alt="Facebook icon" /></a></td>
            <td><a href="#"><img class="icon" src="img/Mail-Icon.png" alt="Mail icon" /></a></td>
            <td><a href="https://www.anemf.org/"><img class="icon" src="img/anemflogo.png" /></a></td>
            <td><a href="http://www.anesf.com/"><img class="icon" src="img/anesflogo.png" /></a></td>
        </table>
    </div>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="main.js"></script>

<?php endif ?>