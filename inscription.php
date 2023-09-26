<?php
include('base/header.php');
?>


<?php
if (isset($_POST['pseudo']) && isset($_POST['mail']) && isset($_POST['password']) && isset($_POST['password2'])) {

    if ($_POST['password'] == $_POST['password2']) {

        require_once('bdd/connect.php');

        $pseudo = htmlspecialchars($_POST['pseudo'], ENT_QUOTES, 'UTF-8');
        $mail = htmlspecialchars($_POST['mail'], ENT_QUOTES, 'UTF-8');

        // Vérifiez si le pseudo est disponible
        $req = $bdd->prepare('SELECT * FROM users WHERE pseudo = ?');
        $req->execute([$pseudo]);
        $user = $req->fetch();

        if (!$user) {
            $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT); // le hash du mot de passe doit toujours être 255 varchar dans la base de données

            // Définition du rôle à "membre" par défaut
            $niveau_compte = 'membre';

            $req = $bdd->prepare('INSERT INTO users(pseudo, mail, pass, niveau_compte) VALUES(?, ?, ?, ?)');
            $req->execute([$pseudo, $mail, $hashedPassword, $niveau_compte]);
            
            // Créez automatiquement une session pour l'utilisateur inscrit
            session_start();
            $_SESSION['id'] = $bdd->lastInsertId();
            $_SESSION['pseudo'] = $pseudo;
            $_SESSION['mail'] = $mail;
            $_SESSION['niveau_compte'] = $niveau_compte; // Stockez le rôle dans la session
            
            header('Location: profile.php');
            exit();
        } else {
            echo "Ce pseudo est déjà utilisé";
        }
    } else {
        echo "Les mots de passe ne sont pas identiques";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>page d'inscription</title>
        <link rel="stylesheet" href="css/inscription.css">
    </head>
    <body>
        <h1>Inscription</h1>
        <form action="inscription.php" method="post">
            <label for="pseudo">Pseudo</label>
            <input type="text" name="pseudo" id="pseudo" required>
            <br>
            <label for="email">Email</label>
            <input type="email" name="mail" id="mail" required>
            <br>
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" required>
            <br>
            <label for="password2">Confirmez le mot de passe</label>
            <input type="password" name="password2" id="password2" required>
            <br>
            <input type="submit" value="S'inscrire">
        </form>
    
</body>
</html>



<?php
include('base/footer.php');
?>
