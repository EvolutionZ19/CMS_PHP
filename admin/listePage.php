


<?php
// Inclure le fichier de configuration de la base de données
require_once('../bdd/connect.php');

// Vérifier si l'administrateur est déjà connecté
if (isset($_SESSION['id']) && $_SESSION['niveau_compte'] === 'admin') {
    // Rediriger vers la page d'administration si l'administrateur est déjà connecté
    header('Location: cconnect.php');
    exit();
}


// Récupérer les données du formulaire
$titre = $_POST['titre'];
$contenu = $_POST['contenu'];
$date = $_POST['date'];
$statut_publication = $_POST['statut'];


?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


    
</body>
</html>



