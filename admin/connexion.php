
<link rel="stylesheet" href="css/connAdmin.css">

<?php
// Démarrer la session
session_start();

// Vérifier si l'administrateur est déjà connecté
if (isset($_SESSION['id']) && $_SESSION['niveau_compte'] === 'admin') {
    // Rediriger vers la page d'administration si l'administrateur est déjà connecté
    header('Location: connect.php');
    exit();
}

// Inclure le fichier de configuration de la base de données
require_once('../bdd/connect.php');

// Traitement de la soumission du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $pseudo = $_POST['pseudo'];
    $password = $_POST['pass'];

    // Requête SQL pour récupérer les informations de l'utilisateur depuis la base de données
    $sql = "SELECT * FROM users WHERE pseudo = :pseudo";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([':pseudo' => $pseudo]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Vérifier le mot de passe
        if (password_verify($password, $user['pass'])) {
            // Authentification réussie
            $_SESSION['id'] = $user['id'];
            $_SESSION['pseudo'] = $user['pseudo'];
            $_SESSION['niveau_compte'] = $user['niveau_compte'];

            // Rediriger vers la page d'administration si l'utilisateur a le niveau 'admin'
            if ($user['niveau_compte'] === 'admin') {
                header('Location: connect.php');
                exit();
            } else {
                // Message d'accès refusé pour les utilisateurs non administrateurs
                $erreur = 'Accès refusé : Vous n\'êtes pas un administrateur.';
            }
        } else {
            // Mot de passe incorrect
            $erreur = 'Pseudo ou mot de passe incorrect.';
        }
    } else {
        // Utilisateur non trouvé dans la base de données
        $erreur = 'Pseudo inconnu.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Connexion Administrateur</title>
    
</head>
<body>

    
    <h1>Connexion Administrateur</h1>

    <?php if (isset($erreur)) : ?>
        <p style="color: red;"><?php echo $erreur; ?></p>
    <?php endif; ?>

    <form action="connexion.php" method="post">
        <label for="pseudo">Pseudo</label>
        <input type="text" name="pseudo" id="pseudo" required>
        <br>
        <label for="pass">Mot de passe</label>
        <input type="password" name="pass" id="pass" required>
        <br>
        <input type="submit" value="Se connecter">
    </form>

    
</body>
</html>
