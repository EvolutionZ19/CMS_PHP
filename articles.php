<?php
include_once('./base/header.php');
?>
<?php
require_once('bdd/connect.php');

$req = $bdd->prepare('SELECT * FROM articles WHERE statut_publication = ? && categorie_id = ?');
$req->execute(['publie', 2]);

$articles = $req->fetchAll(PDO::FETCH_ASSOC);
foreach ($articles as $article) {
    echo "<li>Titre: " . ($article['titre']) . "</li>";
    
    echo "<li>Image: <img src='" . ($article['image']) . "' width='100' height='100' alt=''></li>";
    echo "<li>Contenu: " . ($article['contenu']) . "</li>";
    echo "<li>Date: " . ($article['date']) . "</li>";
    echo "<hr>"; 
}
?>

<?php
include_once('./base/footer.php');
?>
</body>
</html>

