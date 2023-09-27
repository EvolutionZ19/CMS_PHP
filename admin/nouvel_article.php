<?php
// Inclure le fichier de configuration de la base de données
require_once('../bdd/connect.php');

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $titre = $_POST['titre'];
    $contenu = $_POST['contenu'];
    $date = $_POST['date'];
    $statut_publication = $_POST['statut'];

    // Gestion du téléchargement de l'image
    if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_name = $_FILES['image']['name'];
        $upload_directory = 'images/'; // Répertoire de téléchargement
        $chemin_image = $upload_directory . $image_name;

        // Déplacer l'image téléchargée vers le répertoire approprié
        if (move_uploaded_file($image_tmp_name, $chemin_image)) {
            // Insérer les données dans la table 'article'
            $insert_query = 'INSERT INTO articles (titre, image, contenu, date, categorie_id, statut_publication) VALUES (?, ?, ?, ?, ?, ?)';
            $insert_statement = $bdd->prepare($insert_query);
            
            // Vous devez également récupérer la catégorie à partir du formulaire (si disponible)
            $categorie_id = $_POST['categorie_id']; 
            
            if ($insert_statement->execute([$titre, $chemin_image, $contenu, $date, $categorie_id, $statut_publication])) {
                echo "Article créé avec succès.";
            } else {
                echo "Erreur lors de l'insertion de l'article.";
            }
        } else {
            echo "Erreur lors du téléchargement de l'image.";
        }
    } else {
        echo "Erreur lors du téléchargement de l'image.";
    }
}

// Vérifier si l'administrateur est déjà connecté
if (isset($_SESSION['id']) && $_SESSION['niveau_compte'] === 'admin') {
    // Rediriger vers la page d'administration si l'administrateur est déjà connecté
    header('Location: connect.php');
    exit();
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
    <title>Créer un article</title>
    <link rel="stylesheet" href="css/header2.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/creation_article.css">
</head>
<body>
    <h1>Créer un article</h1>
    <form action="nouvel_article.php" method="post" enctype="multipart/form-data">
        <label for="titre">Titre</label>
        <input type="text" name="titre" id="titre" required>
        <br>
        <label for="image">Image</label>
        <input type="file" name="image" id="image" required>
        <br>
        <label for="contenu">Contenu</label>
        <textarea name="contenu" id="contenu" cols="30" rows="10" required></textarea>
        <br>
        <label for="date">Date</label>
        <input type="date" name="date" id="date" required>
        <br>
        <label for="categorie_id">Catégorie</label>
        <select name="categorie_id" id="categorie_id" required>
            <option value="1">Catégorie 1</option>
            <option value="2">Catégorie 2</option>
            <option value="3">Catégorie 3</option>
        </select>
        <br>
        <label for="statut">Statut de publication</label>
        <select name="statut" id="statut" required>
            <option value="en attente">En attente de publication</option>
            <option value="publié">Publié</option>
            <option value="brouillon">Brouillon</option>
            </select>
        <br>
        <input type="submit" value="Créer l'article">
    </form>
    
    <?php
    include('./base/footer.php');
    ?>
</body>
</html>