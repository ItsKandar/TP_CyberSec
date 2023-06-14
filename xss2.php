<!-- =========
    Meme chose que xss.php mais non vulnerable
    (contient un filtre de l'input)
=========== -->

<!DOCTYPE html>
<html>
<head>
    <title>XSS 2</title>
</head>
<body>
    <h1>XSS (non vulnerable)</h1>
    <form action="xss2.php" method="post">
        <input type="text" name="Prenom" placeholder="Votre prenom">
        <input type="submit" value="Envoyer">
    </form>
    <?php
        if(isset($_POST['Prenom'])){
            echo "Bonjour ".htmlspecialchars($_POST['Prenom']);
        }
    ?>
</body>
</html>