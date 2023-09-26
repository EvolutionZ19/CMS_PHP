<?php
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    header('Location: connexion.php');
    exit();
}


// Incluez le fichier header.php
include('base/header.php');
echo "<h1>Profil de " . $_SESSION['pseudo'] . "</h1>";

// Vérifiez si 'avatar' est défini dans la session
if (isset($_SESSION['avatar']) && !empty($_SESSION['avatar'])) {
    echo "<img src='" . $_SESSION['avatar'] . "' width='50' height='50' alt='Avatar'>";
}
// affichez le prénom, le nom, l'email et le pseudo de l'utilisateur d'après la base de données
require('bdd/connect.php');

$userId = $_SESSION['id'];
$query = 'SELECT prenom, nom, mail, pseudo, avatar, niveau_compte FROM users WHERE id = ?';
$statement = $bdd->prepare($query);
$statement->execute([$userId]);
$user = $statement->fetch(PDO::FETCH_ASSOC);

echo "<h2>Informations personnelles</h2>";

echo "<p>Prénom: " . $user['prenom'] . "</p>";
echo "<p>Nom: " . $user['nom'] . "</p>";
echo "<p>Email: " . $user['mail'] . "</p>";
echo "<p>Pseudo: " . $user['pseudo'] . "</p>";
echo "<p>Role: " . $user['niveau_compte'] . "</p>";



// Vérifiez si le formulaire a été soumis

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require('bdd/connect.php'); // Incluez le fichier de connexion à la base de données

    echo "<h2>Modifiez votre profil</h2>";

    // Récupérez les nouvelles valeurs des champs
    $newPrenom = $_POST['prenom'];
    $newNom = $_POST['nom'];
    $newEmail = htmlspecialchars($_POST['newEmail'], ENT_QUOTES, 'UTF-8');
    $newPassword = $_POST['newPassword']; // Vous pouvez ajouter des validations ici si nécessaire

    // Mettez à jour le prénom si un nouveau prénom est saisi
    if (!empty($newPrenom)) {
        $userId = $_SESSION['id'];
        $updatePrenomQuery = 'UPDATE users SET prenom = ? WHERE id = ?';
        $updatePrenomStatement = $bdd->prepare($updatePrenomQuery);
        if ($updatePrenomStatement->execute([$newPrenom, $userId])) {
            $_SESSION['prenom'] = $newPrenom; // Mettez à jour le prénom dans la session
        } else {
            // Gestion de l'erreur de mise à jour du prénom
            echo "Erreur lors de la mise à jour du prénom.";
        }
    }

    // Mettez à jour le nom si un nouveau nom est saisi
    if (!empty($newNom)) {
        $userId = $_SESSION['id'];
        $updateNomQuery = 'UPDATE users SET nom = ? WHERE id = ?';
        $updateNomStatement = $bdd->prepare($updateNomQuery);
        if ($updateNomStatement->execute([$newNom, $userId])) {
            $_SESSION['nom'] = $newNom; // Mettez à jour le nom dans la session
        } else {
            // Gestion de l'erreur de mise à jour du nom
            echo "Erreur lors de la mise à jour du nom.";
        }
    }

    // Mettez à jour l'email si un nouvel email est saisi
    if (!empty($newEmail)) {
        $userId = $_SESSION['id'];
        $updateEmailQuery = 'UPDATE users SET mail = ? WHERE id = ?';
        $updateEmailStatement = $bdd->prepare($updateEmailQuery);
        if ($updateEmailStatement->execute([$newEmail, $userId])) {
            $_SESSION['mail'] = $newEmail; // Mettez à jour l'email dans la session
        } else {
            // Gestion de l'erreur de mise à jour de l'email
            echo "Erreur lors de la mise à jour de l'email.";
        }
    }

    // Mettez à jour le mot de passe si un nouveau mot de passe est saisi
    if (!empty($newPassword)) {
        $userId = $_SESSION['id'];
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $updatePasswordQuery = 'UPDATE users SET pass = ? WHERE id = ?';
        $updatePasswordStatement = $bdd->prepare($updatePasswordQuery);
        if (!$updatePasswordStatement->execute([$hashedPassword, $userId])) {
            // Gestion de l'erreur de mise à jour du mot de passe
            echo "Erreur lors de la mise à jour du mot de passe.";
        }
    }

    // Traitez l'avatar s'il est téléchargé
    if (!empty($_FILES['newAvatar']['name'])) {
        // Vérifiez si le fichier est une image
        $check = getimagesize($_FILES['newAvatar']['tmp_name']);
        if ($check !== false) {
            // Générez un nom de fichier unique pour éviter les conflits
            $avatarFileName = uniqid() . '_' . $_FILES['newAvatar']['name'];

            // Obtenez l'ancien chemin de l'avatar s'il existe
            $oldAvatarPath = $_SESSION['avatar'];

            // Déplacez le fichier téléchargé vers le dossier "upload"
            $uploadDirectory = 'avatar/';
            $avatarPath = $uploadDirectory . $avatarFileName;
            if (move_uploaded_file($_FILES['newAvatar']['tmp_name'], $avatarPath)) {
                // Mettez à jour le chemin de l'avatar dans la base de données
                $userId = $_SESSION['id'];
                $updateAvatarQuery = 'UPDATE users SET avatar = ? WHERE id = ?';
                $updateAvatarStatement = $bdd->prepare($updateAvatarQuery);
                if (!$updateAvatarStatement->execute([$avatarPath, $userId])) {
                    // Gestion de l'erreur de mise à jour de l'avatar
                    echo "Erreur lors de la mise à jour de l'avatar.";
                }

                // Supprimez l'ancien avatar s'il existe
                if (!empty($oldAvatarPath) && file_exists($oldAvatarPath)) {
                    unlink($oldAvatarPath);
                }

                // Mettez à jour la session avec le nouveau chemin de l'avatar
                $_SESSION['avatar'] = $avatarPath;
            } else {
                echo "<p>Erreur lors du téléchargement de l'avatar.</p>";
            }
        } else {
            echo "<p>Le fichier n'est pas une image valide.</p>";
        }
    }

    // Affichez un message de confirmation
    echo "<p>Les modifications ont été enregistrées avec succès.</p>";
}

?>
    <link rel="stylesheet" href="css/profile.css">

<form action="profile.php" method="post" enctype="multipart/form-data">
    <label for="prenom">Prénom</label>
    <input type="text" name="prenom" id="prenom">
    <br>
    <label for="nom">Nom</label>
    <input type="text" name="nom" id="nom">
    <br>
    <label for="newEmail">Nouvel Email</label>
    <input type="email" name="newEmail" id="newEmail">
    <br>
    <label for="newAvatar">Nouvel Avatar</label>
    <input type="file" name="newAvatar" id="newAvatar">
    <br>
    <label for="newPassword">Nouveau Mot de passe</label>
    <input type="password" name="newPassword" id="newPassword">
    <br>
    <input type="submit" value="Enregistrer les modifications">
</form>

<!--  bouton de déconnexion -->
<a href="logout.php">Déconnexion</a>

<?php
// Incluez le fichier footer.php
include('base/footer.php');
?>
