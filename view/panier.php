<?php
include 'layout/header.php';

$panier = $panier ?? [];
$produitPaniers = $produitPaniers ?? [];
$lignes = $lignes ?? [];
$total = $total ?? 0;



?>
<main>
    <h3>Panier</h3>
    <?php if (empty($lignes)) : ?>
        <p class="list__p">Aucun Panier en cours</p>
    <?php else : ?>
    <table class="body__list table" border="1">
        <tr>
            <th class="list__ul">Produit</th>
            <th class="list__ul">Prix</th>
            <th class="list__ul">Quantité</th>
            <th class="list__ul">retiré quantité</th>
            <th class="list__ul">Ajouté quantité</th>
            <th class="list__ul">Supprimer</th>
            <th class="list__ul">Total</th>
        </tr>
        <?php foreach( $lignes as $ligne) :?>
            <tr>
                <td ><?= $ligne['nom']  ?></td> 
                <td ><?= $ligne['prix'] ?></td>
                <td ><?= $ligne['quantite'] ?></td>
                <td >
                    <a href="index.php?route=moins-panier&id=<?= $ligne['id'] ?>">-</a>
                    
                </td>
                <td ><a href="index.php?route=plus-panier&id=<?= $ligne['id'] ?>">+</a></td>
                <td ><a href="index.php?route=supprimer-panier&id=<?= $ligne['id'] ?>">Supprimer</a></td>
                
                <td ><?=  $ligne['total_ligne'] ?></td> 
        </tr>
        <?php endforeach; ?>

        <tr>
            <td  colspan="6"><strong>Total du panier</strong></td>
            <td ><strong><?= $total ?> €</strong></td>
        </tr>
        </table>
    <?php endif; ?>
    <p><a href="index.php?route=vider-panier">Vider le panier</a></p>
    <?php if(isset($_SESSION['user_id'])) : ?>
        <a href="index.php?route=valider">Valider la commande</a>
    <?php endif; ?>
</main>


<?php 
include 'layout/footer.php';
?>