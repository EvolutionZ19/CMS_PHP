<?php
require_once('../bdd/connect.php');

// Vérifier si l'administrateur est connecté
if (!isset($_SESSION['id']) || $_SESSION['niveau_compte'] !== 'admin') {
    // Rediriger vers la page de connexion de l'administrateur si l'administrateur n'est pas connecté
    header('Location: connexion.php');
    exit();
}


// Récupérer l'identifiant de l'article à supprimer
$id = $_GET['id'];

// Vérifier si l'article existe
$query = 'SELECT * FROM articles WHERE id = :id';
$statement = $bdd->prepare($query);
$statement->execute([':id' => $id]);
$article = $statement->fetch(PDO::FETCH_ASSOC);

if (!$article) {
    echo "L'article n'existe pas.";
    exit();
}

// Supprimer l'article de la base de données
$delete_query = 'DELETE FROM articles WHERE id = :id';
$delete_statement = $bdd->prepare($delete_query);

if ($delete_statement->execute([':id' => $id])) {
    echo "L'article a été supprimé avec succès.";
} else {
    echo "Erreur lors de la suppression de l'article.";
}
?>
