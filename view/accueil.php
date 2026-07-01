<?php
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tp_mvcboutiqueenligne</title>
</head>
<body>

<h1>Nos Produits</h1>

<form method="get">

<input type="text" name="search" placeholder="Rechercher un produit">
<button type="submit">Rechercher</button>

</form>

<div class="produc_list">
    <?php foreach ($products as product): ?>
    <ul class="product">

        <h2><?= htmlspecialchars($product->getName()) ?></h2>
        <p<?= htmlspecialchars($product->getDescription()) ?>></p>
        <p><?= number_format($product->getPrice()) ?> €</p>

        <form method="post">
            <input type="hidden" name="id" value="<?= $product->getId() ?>">
            <button type="submit">Ajouter au panier</button>
        </form>
    </ul>
    <?php endforeach; ?>
</div>

</body>
</html>
