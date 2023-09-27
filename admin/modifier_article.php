






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