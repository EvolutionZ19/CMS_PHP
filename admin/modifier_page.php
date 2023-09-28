<?php
// Inclure le fichier de configuration de la base de données
require_once('../bdd/connect.php');

// Afficher la page qui a été sélectionné
$id = $_GET['id'];

// Requête SQL pour récupérer les informations de la page depuis la base de données
$sql = "SELECT * FROM pages WHERE id = :id";
$stmt = $bdd->prepare($sql);
$stmt->execute([':id' => $id]);
$page = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérifier si la page existe
if (!$page) {
    echo "la page n'existe pas.";
    exit();
}

// Afficher le formulaire de modification de la page
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
            $insert_query = 'UPDATE pages SET titre = ?, image = ?, contenu = ?, date = ?, statut_publication = ? WHERE id = ?';
            $insert_statement = $bdd->prepare($insert_query);
            if ($insert_statement->execute([$titre, $image_path, $contenu, $date, $statut_publication, $id])) {
                // page modifié avec succès, rediriger vers une page de confirmation
                echo "page modifié avec succès.";
            } else {
                echo "Erreur lors de la modification de la page.";
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
    <title>Modification de la page</title>
</head>
<body>
<?php
// Afficher la page qui a été sélectionné
echo "<h1>" . htmlspecialchars($page['titre']) . "</h1>";
echo "<img src='images/" . htmlspecialchars($page['image']) . "' width='100' height='100' alt=''>";
echo "<p>" . htmlspecialchars($page['contenu']) . "</p>";
echo "<p>" . htmlspecialchars($page['date']) . "</p>";
echo "<p>" . htmlspecialchars($page['statut_publication']) . "</p>";
echo "<hr>"; // saut de ligne
?>

<form action="" method="post" enctype="multipart/form-data">
    <label for="titre">Titre</label>
    <input type="text" name="titre" id="titre" value="<?php echo htmlspecialchars($page['titre']); ?>">
    <br>
    <label for="image">Image</label>
    <input type="file" name="image" id="image">
    <br>
    <label for="contenu">Contenu</label>
    <textarea name="contenu" id="contenu" cols="30" rows="10"><?php echo htmlspecialchars($page['contenu']); ?></textarea>
    <br>
    <label for="date">Date</label>
    <input type="date" name="date" id="date" value="<?php echo htmlspecialchars($page['date']); ?>">
    <br>
    <label for="statut">Statut de publication</label>
    <select name="statut" id="statut">
        <option value="en attente" <?php if ($page['statut_publication'] === 'en attente') echo 'selected'; ?>>En attente de publication</option>
        <option value="publié" <?php if ($page['statut_publication'] === 'publié') echo 'selected'; ?>>Publié</option>
        <option value="brouillon" <?php if ($page['statut_publication'] === 'brouillon') echo 'selected'; ?>>Brouillon</option>
    </select>
    <br>
    <br>
    <br>
    <input type="submit" value="Modifier la page">
</form>

<?php
include_once('./base/footer.php');
?>
</body>
</html>
