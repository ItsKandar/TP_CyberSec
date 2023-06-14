<!-- =========
    Dev d'un formulaire vulnerable qui demande le nom de la personne et  qui l'affiche
=========== -->

<!DOCTYPE html>
<html>
<head>
    <title>XSS</title>
</head>
<body>
    <h1>XSS</h1>
    <form action="xss.php" method="post">
        <input type="text" name="Prenom" placeholder="Votre prenom">
        <input type="submit" value="Envoyer">
    </form>
    <?php
        if(isset($_POST['Prenom'])){
            echo "Bonjour ".$_POST['Prenom'];
        }
    ?>
</body>
</html>