<?php
include_once('./base/header.php');

require_once('bdd/connect.php');

$query = 'SELECT * FROM articles WHERE categorie_id = :categorie_id AND statut_publication = :statut';

$statement = $bdd->prepare($query);
$statement->execute([':categorie_id' => $_GET['id'], ':statut' => 'publié']);
$articles = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach ($articles as $article) {
    echo "<li>Titre: " . ($article['titre']) . "</li>";
    
    echo "<li>Image: <img src='admin/images/" . htmlspecialchars($article['image']) . "' width='100' height='100' alt=''></li>";
    echo "<li>Contenu: " . ($article['contenu']) . "</li>";
    echo "<li>Date: " . ($article['date']) . "</li>";
    echo "<li>Catégorie: " . ($article['categorie_id']) . "</li>";
    echo "<hr>"; 
}

include_once('./base/footer.php');
?>
