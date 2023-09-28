<?php
// Inclure le fichier de configuration de la base de données
require_once('../bdd/connect.php');

// Afficher l'article qui a été sélectionné
$id = $_GET['id'];

// Requête SQL pour récupérer les informations de l'article depuis la base de données
$sql = "SELECT * FROM articles WHERE id = :id";
$stmt = $bdd->prepare($sql);
$stmt->execute([':id' => $id]);
$article = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérifier si l'article existe
if (!$article) {
    echo "L'article n'existe pas.";
    exit();
}

// Afficher le formulaire de modification de l'article
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $titre = $_POST['titre'];
    $contenu = $_POST['contenu'];
    $date = $_POST['date'];
    $statut_publication = $_POST['statut'];
    $categorie_id = $_POST['categorie_id'];

    // Gestion du téléchargement de l'image
    if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_name = $_FILES['image']['name'];
        $upload_directory = 'images/'; // Répertoire de téléchargement
        $image_path = $upload_directory . $image_name;

        // Déplacer l'image téléchargée vers le répertoire approprié
        if (move_uploaded_file($image_tmp_name, $image_path)) {
            // Insérer les données dans la table 'articles'
            $insert_query = 'UPDATE articles SET titre = ?, image = ?, contenu = ?, date = ?, statut_publication = ?, categorie_id = ? WHERE id = ?';
            $insert_statement = $bdd->prepare($insert_query);
            if ($insert_statement->execute([$titre, $image_path, $contenu, $date, $statut_publication, $categorie_id, $id])) {
                // Article modifié avec succès, rediriger vers une page de confirmation
                echo "Article modifié avec succès.";
            } else {
                echo "Erreur lors de la modification de l'article.";
            }
        } else {
            echo "Erreur lors du téléchargement de l'image.";
        }
    } else {
        echo "Erreur lors du téléchargement de l'image.";
    }
}
?>

<?php
include_once('./base/header.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header2.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/creation_article.css">
    <title>Modification d'article</title>
</head>
<body>
<?php
// Afficher l'article qui a été sélectionné
echo "<h1>" . htmlspecialchars($article['titre']) . "</h1>";
echo "<img src='" . htmlspecialchars($article['image']) . "' width='100' height='100' alt=''>";
echo "<p>" . htmlspecialchars($article['contenu']) . "</p>";
echo "<p>" . htmlspecialchars($article['date']) . "</p>";
echo "<p>" . htmlspecialchars($article['statut_publication']) . "</p>";
echo "<hr>"; // saut de ligne
?>

<form action="" method="post" enctype="multipart/form-data">
    <label for="titre">Titre</label>
    <input type="text" name="titre" id="titre" value="<?php echo htmlspecialchars($article['titre']); ?>">
    <br>
    <label for="image">Image</label>
    <input type="file" name="image" id="image">
    <br>
    <label for="contenu">Contenu</label>
    <textarea name="contenu" id="contenu" cols="30" rows="10"><?php echo htmlspecialchars($article['contenu']); ?></textarea>
    <br>
    <label for="date">Date</label>
    <input type="date" name="date" id="date" value="<?php echo htmlspecialchars($article['date']); ?>">
    <br>
    <label for="statut">Statut de publication</label>
    <select name="statut" id="statut">
        <option value="en attente" <?php if ($article['statut_publication'] === 'en attente') echo 'selected'; ?>>En attente de publication</option>
        <option value="publié" <?php if ($article['statut_publication'] === 'publié') echo 'selected'; ?>>Publié</option>
        <option value="brouillon" <?php if ($article['statut_publication'] === 'brouillon') echo 'selected'; ?>>Brouillon</option>
    </select>
    <br>
    <label for="categorie_id">Catégorie</label>
    <select name="categorie_id" id="categorie_id">
        <option value="1" <?php if ($article['categorie_id'] === 1) echo 'selected'; ?>>Catégorie 1</option>
        <option value="2" <?php if ($article['categorie_id'] === 2) echo 'selected'; ?>>Catégorie 2</option>
        <option value="3" <?php if ($article['categorie_id'] === 3) echo 'selected'; ?>>Catégorie 3</option>
    </select>
    <br>
    <br>
    <input type="submit" value="Modifier l'article">
</form>

<?php
include_once('./base/footer.php');
?>
</body>
</html>
