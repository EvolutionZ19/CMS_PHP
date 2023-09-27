

<?php
    require_once('../bdd/connect.php');
    $query = 'SELECT * FROM articles';
    $statement = $bdd->prepare($query);
    $statement->execute();
    $articles = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<?php
    include_once('./base/header.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer un article</title>
    <link rel="stylesheet" href="css/header2.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/creation_article.css">
    <link rel="stylesheet" href="css/listeArticle.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Liste des articles</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Image</th>
                            <th>Contenu</th>
                            <th>Date</th>
                            <th>Catégorie</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($articles as $article): ?>
                            <tr>
                                <td><?php echo $article['titre']; ?></td>
                                <td><img src="<?php echo $article['image']; ?>" width="100" height="100" alt=""></td>
                                <td><?php echo $article['contenu']; ?></td>
                                <td><?php echo $article['date']; ?></td>
                                <td><?php echo $article['categorie_id']; ?></td>
                                <td><?php echo $article['statut_publication']; ?></td>
                                <td>
                                    <a href="modifier_article.php?id=<?php echo $article['id']; ?>" class="btn btn-info">Modifier</a>
                                    <br>
                                    <br>
                                    <a href="supprimer_article.php?id=<?php echo $article['id']; ?>" class="btn btn-danger">Supprimer</a>
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

