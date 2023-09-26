<!--  seulement si l'admin est connecter afficher la liste des utilisateur et l'autoriser a modifier le niveau de compte ou supprimer le compte -->


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

<ul>
        <?php
        
        require_once('../bdd/connect.php');
        try {
            // Préparation de la requête pour récupérer les données des clients
            $data = $bdd->prepare("SELECT nom, prenom, mail, pseudo, niveau_compte FROM users");

            // Exécution de la requête
            $data->execute();

            // Récupération de tous les résultats 
            $results = $data->fetchAll(PDO::FETCH_ASSOC);

            // Affichage des données
            foreach ($results as $result) {
                echo "<li>Nom: " . htmlspecialchars($result['nom']) . "</li>";
                echo "<li>Prénom: " . htmlspecialchars($result['prenom']) . "</li>";
                echo "<li>Email: " . htmlspecialchars($result['mail']) . "</li>";
                echo "<li>pseudo: " . htmlspecialchars($result['pseudo']) . "</li>";
                echo "<li>niveau_compte: " . htmlspecialchars($result['niveau_compte']) . "</li>";
                echo "<hr>"; // saut de ligne 
            }
        } catch (PDOException $e) {
            echo "Erreur SQL : " . $e->getMessage();
        }
        ?>
    </ul>
    <!-- CHANGER le niveau de compte ou pouvoir supprimer le compte -->

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

    <form action="listeUtilisateurs.php" method="post">
        <label for="pseudo">Pseudo</label>
        <input type="text" name="pseudo" id="pseudo" required>
        <br>
        <br>
        <input type="submit" value="Supprimer">
    </form>
    
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

    <a href="logout.php">Se déconnecter</a>


