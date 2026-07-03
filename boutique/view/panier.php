<?php
include 'layout/header.php';

$panier = $panier ?? [];
$produitPaniers = $produitPaniers ?? [];
$lignes = $lignes ?? [];
$total = $total ?? 0;



?>
<main>
    <h1>Panier</h1>
    <?php if (empty($lignes)) : ?>
        <p>Aucun Panier en cours</p>
    <?php else : ?>
    <table border="1">
        <tr>
            <th>Produit</th>
            <th>Prix</th>
            <th>Quantité</th>
            <th>retiré quantité</th>
            <th>Ajouté quantité</th>
            <th>Supprimer</th>
            <th>Total</th>
        </tr>
        <?php foreach( $lignes as $ligne) :?>
            <tr>
                <td><?= $ligne['nom']  ?></td> 
                <td><?= $ligne['prix'] ?></td>
                <td><?= $ligne['quantite'] ?></td>
                <td>
                    <a href="index.php?route=moins-panier&id=<?= $ligne['id'] ?>">-</a>
                    
                </td>
                <td><a href="index.php?route=plus-panier&id=<?= $ligne['id'] ?>">+</a></td>
                <td><a href="index.php?route=supprimer-panier&id=<?= $ligne['id'] ?>">Supprimer</a></td>
                
                <td><?=  $ligne['total_ligne'] ?></td> 
        </tr>
        <?php endforeach; ?>

        <tr>
            <td colspan="6"><strong>Total du panier</strong></td>
            <td><strong><?= $total ?> €</strong></td>
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