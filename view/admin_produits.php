<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin_produit</title>
</head>
<body>
    <h1>Produit</h1>

    <table>
        <tr>
            <th>Id</th>
            <th>Nom</th>
            <th>Description</th>
            <th>Prix</th>
        </tr>

        <?php foreach ($produits as $p): ?>
            <tr>
                <td><?= $p->getID()  ?></td>
                <td><?= $p->getName() ?></td>
                <td><?= $p->getDescription() ?></td>
                <td><?= $p->getprice() ?></td>

            </tr>
        <?php endforeach; ?>
    </table>


</body>
</html>