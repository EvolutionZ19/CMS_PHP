<?php
/*
        Cette page s'affiche que si l'admin est connecté

        cette page doit permettre:
        - De créer une nouvelle page
        - de créer un nouvel article
        - de de gerer les comptes utilisateurs

        Sur cette page vous devez également afficher : 
        - les derniers articles (5 derniers articles)
        - les 5 dernieres pages
        - les 5 derniers utilisateurs

        Vous devez avoir la possibilité de :
        - afficher la liste complete des articles
        - afficher la liste complete des pages
        - afficher la liste complete des utilisateurs
*/
?>

<?php
// Démarrer la session
session_start();

// Vérifier si l'administrateur est connecté
if (!isset($_SESSION['id']) || $_SESSION['niveau_compte'] !== 'admin') {
    // Rediriger vers la page de connexion de l'administrateur si l'administrateur n'est pas connecté
    header('Location: connexion.php');
    exit();
}

// Maintenant, vous pouvez afficher le contenu de la page pour l'administrateur connecté
?>

<!DOCTYPE html>
<html>
<head>
    <title>Page d'administration</title>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">
</head>
<body>
        <?php
        include('./base/header.php');
        ?>
    <h1>Page d'administration</h1>
    
    
    
    
    <!-- Déconnexion de l'administrateur -->
    <a href="logout.php">Déconnexion</a>

        <?php
        include('./base/footer.php');
        ?>

</body>
</html>
