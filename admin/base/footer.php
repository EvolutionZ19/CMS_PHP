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


<link rel="stylesheet" href="css/footer.css">
<title>footer</title>

<body>
    
    <footer>
        <p class="date">
            <?php
                dateDuJour();
            ?>
        </p>
        <p class="copyright">
            &copy; CMS. Tous droits réservés.
        </p>
        <a class="back-to-top" href="#top">Retour en haut de page</a>
    </footer>



