<?php
include_once('./base/header.php');
?>
<?php
require_once('bdd/connect.php');

$req = $bdd->prepare('SELECT * FROM pages WHERE statut_publication = ?  AND id IN (?, ?, ?)');
$req->execute(['publie', 1, 2, 3]);

$pages = $req->fetchAll(PDO::FETCH_ASSOC);
foreach ($pages as $page) {
    echo "<a href='page.php?id=" . $page['id'] . "'>";
    echo "<li>" . ($page['titre']) . "</li>";
    echo "</a>";
    
    echo "<li>Image: <img src='admin/images/" . htmlspecialchars($page['image']) . "' width='100' height='100' alt=''></li>";
    echo "<li> " . ($page['contenu']) . "</li>";
    echo "<li>Date: " . ($page['date']) . "</li>";
   
    echo "<hr>"; 
}
?>

<?php
include_once('./base/footer.php');
?>
</body>
</html>
