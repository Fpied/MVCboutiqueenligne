<?php
include 'layout/header.php';
?>
<body>
    <h3>Conexion</h3>

    <form class="ul__li" method="POST" action="index.php?route=login";>

    <label>Email</label>
    <input class="form__input" type="email" name="email" required>

    <label>Mots de passe</label>
    <input class="form__input" type="password" name="password" required>

    <?php if (!empty($error)) : ?>
        <p style="color:red;"><?= $error ?>
        <?php endif; ?>

        <button class="form__envoyer" type="submit">Connexion</button>

    </form>

<?php require __DIR__ . "/../view/layout/footer.php" ?>

