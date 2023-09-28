<?php
// Démarrer la session
session_start();

// Vérifier si l'administrateur est connecté
if (!isset($_SESSION['id']) || $_SESSION['niveau_compte'] !== 'admin') {
    // Rediriger vers la page de connexion de l'administrateur si l'administrateur n'est pas connecté
    header('Location: connexion.php');
    exit();
}

// Inclure le fichier de configuration de la base de données
require_once('../bdd/connect.php');

// Fonction pour afficher les derniers articles
function afficherDerniersArticles($bdd) {
    $data = $bdd->prepare("SELECT titre, image, contenu, date, statut_publication, categorie_id FROM articles ORDER BY date DESC LIMIT 5");
    $data->execute();
    $results = $data->fetchAll(PDO::FETCH_ASSOC);

    echo "<h2>5 derniers articles créés</h2>";
    foreach ($results as $result) {
        echo "<li>Titre: " . htmlspecialchars($result['titre']) . "</li>";
        echo "<li>Image: <img src='images/" . htmlspecialchars($result['image']) . "' width='100' height='100' alt=''></li>";
        echo "<li>Contenu: " . htmlspecialchars($result['contenu']) . "</li>";
        echo "<li>Date: " . htmlspecialchars($result['date']) . "</li>";
        echo "<li>Statut: " . htmlspecialchars($result['statut_publication']) . "</li>";
        echo "<li>Catégorie: " . htmlspecialchars($result['categorie_id']) . "</li>";
        echo "<hr>"; // saut de ligne 
    }
}

// Fonction pour afficher les dernières pages
function afficherDernieresPages($bdd) {
    $data = $bdd->prepare("SELECT titre, image, contenu, date, statut_publication FROM pages ORDER BY date DESC LIMIT 5");
    $data->execute();
    $results = $data->fetchAll(PDO::FETCH_ASSOC);

    echo "<h2>5 dernières pages créées</h2>";
    foreach ($results as $result) {
        echo "<li>Titre: " . htmlspecialchars($result['titre']) . "</li>";
        echo "<li>Image: <img src='images/" . htmlspecialchars($result['image']) . "' width='100' height='100' alt=''></li>";
        echo "<li>Contenu: " . htmlspecialchars($result['contenu']) . "</li>";
        echo "<li>Date: " . htmlspecialchars($result['date']) . "</li>";
        echo "<li>Statut: " . htmlspecialchars($result['statut_publication']) . "</li>";
        echo "<hr>"; // saut de ligne 
    }
}

// Fonction pour afficher les derniers utilisateurs
function afficherDerniersUtilisateurs($bdd) {
    $data = $bdd->prepare("SELECT nom, prenom, mail, pseudo, avatar, niveau_compte FROM users ORDER BY id DESC LIMIT 5");
    $data->execute();
    $results = $data->fetchAll(PDO::FETCH_ASSOC);

    echo "<h2>5 derniers utilisateurs créés</h2>";
    foreach ($results as $result) {
        echo "<li>Nom: " . htmlspecialchars($result['nom']) . "</li>";
        echo "<li>Prénom: " . htmlspecialchars($result['prenom']) . "</li>";
        echo "<li>Email: " . htmlspecialchars($result['mail']) . "</li>";
        echo "<li>Pseudo: " . htmlspecialchars($result['pseudo']) . "</li>";
        echo "<li>Niveau de compte: " . htmlspecialchars($result['niveau_compte']) . "</li>";
        echo "<li>Avatar: <img src='../" . htmlspecialchars($result['avatar']) . "' width='100' height='100' alt=''></li>";
        echo "<hr>"; // saut de ligne 
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Page d'administration</title>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <?php
    include('./base/header.php');
    ?>
    <h1>Page d'administration</h1>
    <p>Bienvenue, <?php echo $_SESSION['pseudo']; ?> !</p>

    <div class="column">
        <?php
        // Afficher les derniers articles
        afficherDerniersArticles($bdd);
        ?>
    </div>

    <div class="column">
        <?php
        // Afficher les dernières pages
        afficherDernieresPages($bdd);
        ?>
    </div>

    <div class="column">
        <?php
        // Afficher les derniers utilisateurs
        afficherDerniersUtilisateurs($bdd);
        ?>
    </div>

    <?php
    include('./base/footer.php');
    ?>
</body>
</html>
