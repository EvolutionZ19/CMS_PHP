<?php
// Inclure le fichier de configuration de la base de données
require_once('../bdd/connect.php');

// Vérifier si l'administrateur est déjà connecté
if (isset($_SESSION['id']) && $_SESSION['niveau_compte'] === 'admin') {
    // Rediriger vers la page d'administration si l'administrateur est déjà connecté
    header('Location: connect.php');
    exit();
}

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
        $image_path = $upload_directory . $image_name;

        // Déplacer l'image téléchargée vers le répertoire approprié
        if (move_uploaded_file($image_tmp_name, $image_path)) {
            // Insérer les données dans la table 'pages'
            $insert_query = 'INSERT INTO pages (titre, image, contenu, date, statut_publication) VALUES (?, ?, ?, ?, ?)';
            $insert_statement = $bdd->prepare($insert_query);
            if ($insert_statement->execute([$titre, $image_path, $contenu, $date, $statut_publication])) {
                // Page créée avec succès, rediriger vers une page de confirmation
                echo "Page créée avec succès.";
            } else {
                echo "Erreur lors de l'insertion de la page.";
            }
        } else {
            echo "Erreur lors du téléchargement de l'image.";
        }
    } else {
        echo "Erreur lors du téléchargement de l'image.";
    }
}
?>

<!-- Votre formulaire HTML -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer une nouvelle page</title>

    <link rel="stylesheet" href="css/header2.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/creation_article.css">
</head>
<body>
    <?php
    include_once('./base/header.php');
    ?>
    
    <h1>Créer une nouvelle page</h1>
    <form action="nouvelle_page.php" method="post" enctype="multipart/form-data">
    
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
        <label for="statut">Statut de publication</label>
        <select name="statut" id="statut" required>
            <option value="en attente">En attente de publication</option>
            <option value="publie">Publié</option>
            <option value="brouillon">Brouillon</option>
        </select>
        <br>
        <input type="submit" value="Créer la page">
    </form>
    <?php
    include('./base/footer.php');
    ?>
</body>
</html>
