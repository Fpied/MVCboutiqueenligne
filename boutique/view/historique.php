<?php
include 'layout/header.php';
$commandes = $commandes ?? [];
$detailsParCommande = $detailsParCommande ?? [];
?>
<main>
    <h1>Voici l'historique</h1>
    <?php if (empty($commandes)) : ?>
        <p>Aucune commande passé</p>
    <?php endif; ?>
    <ul>
    <?php foreach($commandes as $commande) : ?>
        <li><p>
            Commande n°<?= htmlspecialchars($commande->getId()) ?>
            <?= "date ". htmlspecialchars($commande->getCreated_at()) ?>
            <?= "prix : ". htmlspecialchars($commande->getTotal()).  "€" ?>

        </p>
        
        <?php foreach ($detailsParCommande[$commande->getId()] as $detail) : ?>
       
         <p>Detail: <?= htmlspecialchars($detail['name']) ?> X <?= htmlspecialchars($detail['quantity'])  ?> - <?= htmlspecialchars($detail['unit_price']) ?>€</p>

         <?php endforeach; ?>
        </li>
    <?php endforeach; ?>
        
    </ul>

</main>
<?php
include 'layout/footer.php';

?>