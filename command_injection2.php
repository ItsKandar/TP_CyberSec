<!-- =========
    Pareil que command_injection.php mais non vulnerable
=========== -->

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Command Injection 2</title>
</head>
<body>
    <h1>Command Injection (non vulnerable)</h1>
    <form action="command_injection2.php" method="post">
        <input type="text" name="ip" placeholder="IP">
        <input type="submit" value="Envoyer">
    </form>
    <?php
        if(isset($_POST['ip'])){
            echo "<pre>";
            echo shell_exec("ping ".htmlspecialchars($_POST['ip']));
            echo "</pre>";
        }
    ?>
</body>
</html>