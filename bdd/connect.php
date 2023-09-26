<?php

// manipulation de la base de données avec PDO

// connexion à la base de données
try {
    $bdd = new PDO('mysql:host=localhost;dbname=cmsphp;charset=utf8',
    'adminCMS', // NOM D'UTILISATEUR
    'admin', // MOT DE PASSE
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // affichage des erreurs
        
        
    ]
);


} catch (Exception $e) {
    echo "connexion à la base de données impossible";
    exit();
    // possibilité d'afficher l'erreur dans un fichier log
    // echo $e->getMessage();
}


?>