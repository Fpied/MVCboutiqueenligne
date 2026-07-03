<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>
    <h1>Conexion</h1>

    <form method="POST" action="index.php?route=login";>

    <label>Email</label>
    <input type="email" name="email" required>

    <label>Mots de passe</label>
    <input type="password" name="password" required>

    <?php if (!empty($error)) : ?>
        <p style="color:red;"><?= $error ?>
        <?php endif; ?>

        <button type="submit">Connexion</button>

    </form>



</body>
</html>