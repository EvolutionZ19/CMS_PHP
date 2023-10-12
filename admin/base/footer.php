<link rel="stylesheet" href="css/footer.css">
<?php

// fonction sur la date et heure du jour paris

function dateDuJour()
{
    date_default_timezone_set('Europe/Paris');
    $date = date("d-m-Y");
    $heure = date("H:i");
    echo "Nous sommes le $date et il est $heure";
}
?>

   
    <footer>
        <p class="date">
            <?php
                dateDuJour();
            ?>
        </p>
        <div class="footer-links">
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="a-propos.php">À propos</a></li>
                <li><a href="services.php">Services</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-info">
        <p> &copy; CMS
        <p>Adresse : 123 Rue de la Rue, Ville</p>
        <p>Téléphone : +33 7 00 00 00 00</p>
        <p>Email : admin@mail.com</p>
    </div>
        
        <p class="copyright">
            &copy; CMS. Tous droits réservés.
        </p>
        <a class="back-to-top" href="#top">Retour en haut de page</a>
    </footer>


