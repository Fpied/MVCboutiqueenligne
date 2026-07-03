
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TP Boutique en locale</title>
</head>

<?php require __DIR__ . "/view/layout/header.php"; ?>

<body>

<h1>Nos Produits</h1>

<form method="get">

<input type="text" name="search" placeholder="Rechercher un produit">
<button type="submit">Rechercher</button>

</form>

<div class="produc_list">
    <?php if(!empty($products)): ?>
    <?php foreach ($products as $product): ?>
    <ul class="product">

        <h2><?= htmlspecialchars($product->getName()) ?></h2>
        <p><?= htmlspecialchars($product->getDescription()) ?>></p>
        <p><?= number_format($product->getPrice(), 2, ",", " ") ?> €</p>

        <form method="post" action="index.php?route=ajout-panier">
            <input type="hidden" name="id" value="<?= $product->getId() ?>">
            <button type="submit">Ajouter au panier</button>
        </form>
    </ul>
    <?php endforeach; ?>
    <?php else: ?>
        <p>Aucun produit trouvé.</p>
    <?php endif; ?>

    <a href="index.php?route=historique">historique</a>
</div>

</body>


<?php require __DIR__ . "/../view/layout/footer.php" ?>



