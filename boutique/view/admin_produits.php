<?php

include 'layout/header.php';

?>

<body>


    <h3>Gestion des Produits</h3>

    <h3>Ajouter un produit</h3>

    <form class="ul__li" method="POST" action="index.php?route=admin">
        <label>Nom :</label><br>
        <input class="form__input" type="text" name="name" required><br><br>

        <label>Prix :</label><br>
        <input class="form__input" type="number" step="0.01" name="price" required><br><br>

        <label>Description :</label><br>
        <textarea class="form__input" name="description" required></textarea><br><br>

        <button class="form__envoyer" type="submit">Ajouter</button>

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

    <?php require __DIR__ . "/../view/layout/footer.php" ?>
