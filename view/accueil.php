<?php

require __DIR__ . "/view/admin_produits.php";
require __DIR__ . "/view/login.php";
require __DIR__ . "/view/historique.php";
require __DIR__ . "/view/panier.php";

?>



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
    <div class="product">

        <h2><?= htmlspecialchars($product->getName()) ?></h2>
        <p><?= htmlspecialchars($product->getDescription()) ?></p>
        <p><?= number_format($product->getPrice(), 2, ",", " ") ?> €</p>

        <form method="post" action="index.php?page=ajout-panier">
            <input type="hidden" name="id" value="<?= $product->getId() ?>">
            <button type="submit">Ajouter au panier</button>
        </form>
    </div>
    <?php endforeach; ?>
    <?php else: ?>
        <p>Aucun produit trouvé.</p>
    <?php endif; ?>
</div>

<?php require __DIR__ . "/../view/layout/footer.php" ?>

</body>






