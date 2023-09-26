<?php


if (isset($_SESSION['id'])) {
    header('Location: profile.php');
    exit();
}

session_start();

include('base/header.php');

if (isset($_POST['submit'])) {
    // Le formulaire de connexion a été soumis, traitez les données du formulaire ici

    require('bdd/connect.php');

    $pseudo = htmlspecialchars($_POST['pseudo'], ENT_QUOTES, 'UTF-8'); // Échappez le pseudo
    $req = $bdd->prepare('SELECT * FROM users WHERE pseudo = ?');
    $req->execute([$pseudo]);
    $user = $req->fetch();

    if ($user) {
        if (password_verify($_POST['password'], $user['pass'])) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['pseudo'] = $user['pseudo'];
            $_SESSION['mail'] = $user['mail'];
            $_SESSION['niveau_compte'] = $user['niveau_compte'];

            // Gestion de l'avatar
            $avatarPath = "avatar/" . $user['id'] . ".jpg";

            // Définissez la clé 'avatar' dans la session
            $_SESSION['avatar'] = $avatarPath;

            header('Location: profile.php');
            exit();
        } else {
            $errorMessage = "Le mot de passe est incorrect";
        }
    } else {
        $errorMessage = "Le pseudo est incorrect";
    }
}
?>
<link rel="stylesheet" href="css/connexion.css">

<h1>Connexion</h1>

<form action="connexion.php" method="post">
    <label for="pseudo">Pseudo</label>
    <input type="text" name="pseudo" id="pseudo" required>
    <br>
    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password" required>
    <br>
    <input type="submit" name="submit" value="Se connecter">
</form>

<?php
if (isset($errorMessage)) {
    echo "<p>$errorMessage</p>";
}

include('base/footer.php');
?>
