<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin_produits</title>
</head>
<body>


<h1>Gestion des Produits</h1>

<h2>Ajouter un produit</h2>

<form method="POST" action="index.php?route=admin">
    <label>Nom :</label><br>
    <input type="text" name="name" required><br><br>

    <label>Prix :</label><br>
    <input type="number" step="0.01" name="price" required><br><br>

    <label>Description :</label><br>
    <textarea name="description" required></textarea><br><br>

    <button type="submit">Ajouter</button>
</form>

<hr>

<h2>Liste des produits</h2>

<?php if (!empty($produits)) : ?>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Description</th>
            <th>Prix</th>
            <th>Actions</th>
        </tr>

        <?php foreach ($produits as $p) : ?>
            <tr>
                <td><?= $p['id'] ?></td>
                <td><?= htmlspecialchars($p['name']) ?></td>
                <td><?= htmlspecialchars($p['description']) ?></td>
                <td><?= number_format($p['price'], 2) ?> €</td>
                <td>
                    <a href="index.php?route=modifierProduit&id=<?= $p['id'] ?>">Modifier</a>
                    |
                    <a href="index.php?route=suprimmerProduit&id=<?= $p['id'] ?>"
                       onclick="return confirm('Supprimer ce produit ?');">
                       Supprimer
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

<?php else : ?>
    <p>Aucun produit trouvé.</p>
<?php endif; ?>

</body>
</html>