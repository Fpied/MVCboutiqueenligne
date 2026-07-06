<?php

include 'layout/header.php';

?>

<body>


    <h3>Gestion des Produits</h3>

    <h3>Ajouter un produit</h3>

    <form class="form_adminproduit" method="POST" action="index.php?route=ajouterProduit">
        <label>Nom :</label><br>
        <input class="form__input" type="text" name="name" required><br><br>

        <label>Prix :</label><br>
        <input class="form__input" type="number" step="0.01" name="price" required><br><br>

        <label>Description :</label><br>
        <textarea class="form__input" name="description" required></textarea><br><br>

        <button class="form__produit" type="submit">Ajouter</button>

    </form>

    <hr>

    <h2>Liste des produits</h2>

    <?php if (!empty($produits)) : ?>
        <table class="body__list table" border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Actions</th>
            </tr>

            <?php foreach ($produits as $p) : ?>
                <tr>
                    <td><?= htmlspecialchars((string)$p->getId()) ?></td>
                    <td><?= htmlspecialchars($p->getName()) ?></td>
                    <td><?= htmlspecialchars($p->getDescription()) ?> €</td>
                    <td><?= number_format($p->getPrice(), 2) ?></td>
                    <td>
                        <a href="index.php?route=modifierProduit&id=<?= $p->getId() ?>">Modifier</a>
|
                        <a href="index.php?route=suprimmerProduit&id=<?= $p->getId() ?>"
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