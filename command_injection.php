<!-- =========
    Dev d'une page avec un formulaire permettant de 'PING' une ip
=========== -->

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Command Injection</title>
</head>
<body>
    <h1>Command Injection</h1>
    <form action="command_injection.php" method="post">
        <input type="text" name="ip" placeholder="IP">
        <input type="submit" value="Envoyer">
    </form>
    <?php
        if(isset($_POST['ip'])){
            echo "<pre>";
            echo shell_exec("ping ".$_POST['ip']);
            echo "</pre>";
        }
    ?>
</body>
</html>