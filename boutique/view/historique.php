<?php
include 'layout/header.php';
$commandes = $commandes ?? [];
$detailsParCommande = $detailsParCommande ?? [];
?>
<main>
    <h3>Voici l'historique</h3>
    <?php if (empty($commandes)) : ?>
        <p>Aucune commande passé</p>
    <?php endif; ?>
    <ul>
    <?php foreach($commandes as $commande) : ?>
        <li class="ul__li"><p class="list__p">
            Commande n°<?= htmlspecialchars($commande->getId()) ?>
            <?= "date ". htmlspecialchars($commande->getCreated_at()) ?>
            <?= "prix : ". htmlspecialchars($commande->getTotal()).  "€" ?>

        </p>
        
        <?php foreach ($detailsParCommande[$commande->getId()] as $detail) : ?>
       
         <p class="list__p">Detail: <?= htmlspecialchars($detail['name']) ?> X <?= htmlspecialchars($detail['quantity'])  ?> - <?= htmlspecialchars($detail['unit_price']) ?>€</p>

         <?php endforeach; ?>
        </li>
    <?php endforeach; ?>
        
    </ul>

</main>
<?php
include 'layout/footer.php';

?>