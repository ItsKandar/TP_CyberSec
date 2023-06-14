<?php
$cookie_name = "ddos";
$cookie_value = 1;
setcookie($cookie_name, $cookie_value, time() + (90), "/");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page</title>
</head>
<body>
    <?php
    # si la valeur du cookie >=10 alors on redirige vers la page anti-ddos
    if($_COOKIE[$cookie_name] >= 10){
        header("Location: anti-ddos.php");
    }
    # sinon on incremente la valeur du cookie
    else{
        $cookie_value = $_COOKIE[$cookie_name] + 1;
        setcookie($cookie_name, $cookie_value, time() + (90), "/");
    }
    ?>
    <h1>Bonjour, je suis une page web</h1>
</body>
</html>