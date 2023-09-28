


<?php
// Inclure le fichier de configuration de la base de données
require_once('../bdd/connect.php');

// Vérifier si l'administrateur est déjà connecté
if (isset($_SESSION['id']) && $_SESSION['niveau_compte'] === 'admin') {
    // Rediriger vers la page d'administration si l'administrateur est déjà connecté
    header('Location: cconnect.php');
    exit();
}

// récuperer les pages sur la base de données

$requete = $bdd->prepare('SELECT * FROM pages');
$requete->execute();
$pages = $requete->fetchAll(PDO::FETCH_ASSOC);


// Traitement de la soumission du formulaire
?>

<?php
    include_once('./base/header.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des pages</title>
    <link rel="stylesheet" href="css/header2.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/listeArticles.css">   
    
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Liste des pages</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Image</th>
                            <th>Contenu</th>
                            <th>Date</th>
                            <th>Catégorie</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pages as $page): ?>
                            <tr>
                                <td><?php echo $page['titre']; ?></td>
                                <td><img src="images/<?php echo $page['image']; ?>" width="100" height="100" alt=""></td>
                                <td><?php echo $page['contenu']; ?></td>
                                <td><?php echo $page['date']; ?></td>
                                <td><?php echo $page['statut_publication']; ?></td>
                                <td>
                                    <a href="modifier_page.php?id=<?php echo $page['id']; ?>" class="btn btn-info">Modifier</a>
                                    <br>
                                    <br>
                                    <a href="supprimer_page.php?id=<?php echo $page['id']; ?>" class="btn btn-danger">Supprimer</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
<?php
    include_once('./base/footer.php');
?>

