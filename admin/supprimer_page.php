<?php
require_once('../bdd/connect.php');

// Récupérer l'identifiant de la page à supprimer
$id = $_GET['id'];

// Vérifier si la page existe
$query = 'SELECT * FROM pages WHERE id = :id';
$statement = $bdd->prepare($query);
$statement->execute([':id' => $id]);
$article = $statement->fetch(PDO::FETCH_ASSOC);

if (!$article) {
    echo "La page n'existe pas.";
    exit();
}

// Supprimer la page de la base de données
$delete_query = 'DELETE FROM pages WHERE id = :id';
$delete_statement = $bdd->prepare($delete_query);

if ($delete_statement->execute([':id' => $id])) {
    echo "La page a été supprimé avec succès.";
} else {
    echo "Erreur lors de la suppression de l'article.";
}
?>