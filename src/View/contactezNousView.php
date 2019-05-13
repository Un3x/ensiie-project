<?php $title = "Contactez nous" ?>

<?php ob_start(); ?>

<section>
    <p> Pensez très fort à moi et dites trois fois mon nom et j'arrive ou envoyez un mail:
    </p>
    <form method="POST" action="index.php?action=contactezNousController">
             <label> adresse mail : </label>
           <input type="text" name="mail"/>
                <br/>
    
            <label> sujet: </label>

           <input type="text" name="sujet"/>
               <br/>
               <label> message : </label>
           <input type="text" name="corp"/>
                <br/>
       <input type="submit" value="envoyez"/>
    </form>
</section>

<?php $content = ob_get_clean(); ?>

<?php require "template.php"; ?>
