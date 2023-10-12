<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="css/listeUtilisateurs.css">
    <title>Liste des Utilisateurs</title>
</head>
<body>
    
<?php
// Démarrer la session
session_start();

// Vérifier si l'administrateur est connecté
if (!isset($_SESSION['id']) || $_SESSION['niveau_compte'] !== 'admin') {
    // Rediriger vers la page de connexion de l'administrateur si l'administrateur n'est pas connecté
    header('Location: connexion.php');
    exit();
}
?>

<!-- Header de la page -->
<?php
include('./base/header.php');
?>

<!-- Section pour afficher la liste des utilisateurs -->
<ul>
    <?php
    require_once('../bdd/connect.php');
    try {
        // Préparation de la requête pour récupérer les données des clients
        $data = $bdd->prepare("SELECT nom, prenom, mail, pseudo, avatar, niveau_compte FROM users");
        
        // Exécution de la requête
        $data->execute();
        
        // Récupération de tous les résultats 
        $results = $data->fetchAll(PDO::FETCH_ASSOC);

        // Affichage des données
        foreach ($results as $result) {
            echo "<li>Nom: " . htmlspecialchars($result['nom']) . "</li>";
            echo "<li>Prénom: " . htmlspecialchars($result['prenom']) . "</li>";
            echo "<li>Email: " . htmlspecialchars($result['mail']) . "</li>";
            echo "<li>Pseudo: " . htmlspecialchars($result['pseudo']) . "</li>";
            echo "<li>Niveau de compte: " . htmlspecialchars($result['niveau_compte']) . "</li>";
            echo "<li>Avatar: <img src='../" . htmlspecialchars($result['avatar']) . "' width='100' height='100' alt=''></li>";
            echo "<hr>"; // saut de ligne 
        }
    } catch (PDOException $e) {
        echo "Erreur SQL : " . $e->getMessage();
    }
    ?>
</ul>

<!-- Formulaire pour modifier le niveau de compte -->
<form action="listeUtilisateurs.php" method="post">
    <label for="pseudo">Pseudo</label>
    <input type="text" name="pseudo" id="pseudo" required>
    <br>
    <select name="niveau_compte" id="niveau_compte">
        <option value="admin">Admin</option>
        <option value="moderateur">Moderateur</option>
        <option value="membre">Membre</option>
    </select>
    <br>
    <br>
    <input type="submit" value="Modifier">
</form>

<!-- Traitement du formulaire de modification -->

<?php
if (isset($_POST['pseudo']) && isset($_POST['niveau_compte'])) {
    require('../bdd/connect.php');
    $pseudo = htmlspecialchars($_POST['pseudo'], ENT_QUOTES, 'UTF-8');
    $niveau_compte = htmlspecialchars($_POST['niveau_compte'], ENT_QUOTES, 'UTF-8');
    // Vérifiez si le pseudo est disponible
    $req = $bdd->prepare('SELECT * FROM users WHERE pseudo = ?');
    $req->execute([$pseudo]);
    $user = $req->fetch();
    if ($user) {
        $req = $bdd->prepare('UPDATE users SET niveau_compte = ? WHERE pseudo = ?');
        $req->execute([$niveau_compte, $pseudo]);
        header('Location: listeUtilisateurs.php');
        exit();
    } else {
        echo "Ce pseudo n'existe pas";
    }
}
?>

<!-- Formulaire pour supprimer un utilisateur -->
<form action="listeUtilisateurs.php" method="post">
    <label for="pseudo">Pseudo</label>
    <input type="text" name="pseudo" id="pseudo" required>
    <br>
    <br>
    <input type="submit" value="Supprimer">
</form>

<!-- Traitement du formulaire de suppression -->
<?php
if (isset($_POST['pseudo'])) {
    require('../bdd/connect.php');
    $pseudo = htmlspecialchars($_POST['pseudo'], ENT_QUOTES, 'UTF-8');
    // Vérifiez si le pseudo est disponible
    $req = $bdd->prepare('SELECT * FROM users WHERE pseudo = ?');
    $req->execute([$pseudo]);
    $user = $req->fetch();
    if ($user) {
        $req = $bdd->prepare('DELETE FROM users WHERE pseudo = ?');
        $req->execute([$pseudo]);
        header('Location: listeUtilisateurs.php');
        exit();
    } else {
        echo "Ce pseudo n'existe pas";
    }
}
?>

<!-- Formulaire pour créer un nouvel utilisateur -->
<form action="listeUtilisateurs.php" method="post">
    <label for="nom">Nom</label>
    <input type="text" name="nom" id="nom" required>
    <br>
    <label for="prenom">Prénom</label>
    <input type="text" name="prenom" id="prenom" required>
    <br>
    <label for="mail">Email</label>
    <input type="email" name="mail" id="mail" required>
    <br>
    <label for="pseudo">Pseudo</label>
    <input type="text" name="pseudo" id="pseudo" required>
    <br>
    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password" required>
    <br>
    <label for="avatar">Avatar</label>
    <br>
    <select name="niveau_compte" id="niveau_compte">
        <option value="admin">Admin</option>
        <option value="moderateur">Moderateur</option>
        <option value="membre">Membre</option>
    </select>
    <br>
    <br>
    <input type="submit" value="Créer">
</form>

<!-- Traitement du formulaire de création d'utilisateur -->
<?php
if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['mail']) && isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['niveau_compte'])) {
    require('../bdd/connect.php');
    $nom = htmlspecialchars($_POST['nom'], ENT_QUOTES, 'UTF-8');
    $prenom = htmlspecialchars($_POST['prenom'], ENT_QUOTES, 'UTF-8');
    $mail = htmlspecialchars($_POST['mail'], ENT_QUOTES, 'UTF-8');
    $pseudo = htmlspecialchars($_POST['pseudo'], ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');
    
    $niveau_compte = htmlspecialchars($_POST['niveau_compte'], ENT_QUOTES, 'UTF-8');
    // Vérifiez si le pseudo est disponible
    $req = $bdd->prepare('SELECT * FROM users WHERE pseudo = ?');
    $req->execute([$pseudo]);
    $user = $req->fetch();
    if (!$user) {
        $req = $bdd->prepare('INSERT INTO users (nom, prenom, mail, pseudo, password, niveau_compte) VALUES (?, ?, ?, ?, ?, ?)');
        $req->execute([$nom, $prenom, $mail, $pseudo, $password, $niveau_compte]);
        header('Location: listeUtilisateurs.php');
        exit();
    } else {
        echo "Ce pseudo existe déjà";
    }
}
?>

<!-- Lien de déconnexion -->
<a href="logout.php">Se déconnecter</a>

<!-- Footer de la page -->
<?php
include('./base/footer.php');
?>
</body>
</html>
