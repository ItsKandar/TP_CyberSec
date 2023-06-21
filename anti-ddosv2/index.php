<?php
// ANTI DDOS
// Ce script permet de limiter le nombre de requêtes par IP, lorsque le nombre de requêtes est atteint, 
// l'utilisateur est bloqué pendant 2 minutes.
// Son ip est enregistrée dans une base de données SQLite, avec un compteur et une date d'expiration.
// Lorsque le compteur atteint 10, l'utilisateur est bloqué pendant 2 minutes et son ip est mise dans une "blacklist"

// Problemes lors de la connexion à la base de données mais en theorie le reste du script fonctionne commme voulu

// Connexion à la base de données
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "database.db";
$blacklist = "blacklist.db";

$conn = new SQLite3($dbname);
$connbl = new SQLite3($blacklist);

// Création de la table users
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    expire_at DATETIME,
    counter INTEGER,
    ip_hash VARCHAR(64)
)";
$conn->query($sql);

// Création de la table users
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    ip VARCHAR(64)
)";
$connbl->query($sql);

// ajoute l'ip "192.168.29.100" dans la blacklist
$sql = "INSERT INTO users (ip) VALUES ('192.168.29.100')";
$connbl->query($sql);

// Vérification de l'IP de l'utilisateur
$user_ip = $_SERVER['REMOTE_ADDR'];
$user_ip_hash = hash('sha256', $user_ip);

// Vérification si l'IP est dans la blacklists
if ($user_ip === "SELECT ip FROM users WHERE ip = '$user_ip'") {
    die('Vous avez été blacklisté!');
    exit();
}

// Vérification si l'IP est déjà présente dans la base de données
$sql = "SELECT * FROM users WHERE ip_hash = '$user_ip_hash'";
$result = $conn->query($sql);

$row = $result->fetchArray();

// Si l'IP n'est pas présente dans la base de données
if ($row === false) {
    // On insère l'IP dans la base de données
    $sql = "INSERT INTO users (expire_at, counter, ip_hash) VALUES (datetime('now', '+2 minutes'), 1, '$user_ip_hash')";
    $conn->query($sql);
    // On affiche la page
    include 'content.php';
    exit();
}
// Si l'IP est présente dans la base de données
else {
    // On récupère les données de l'IP
    $expire_at = $row['expire_at'];
    $counter = $row['counter'];
    $ip_hash = $row['ip_hash'];

    // Si la date d'expiration est dépassée
    if (strtotime($expire_at) < time()) {
        // On réinitialise le compteur et on met à jour la date d'expiration
        $sql = "UPDATE users SET expire_at = datetime('now', '+2 minutes'), counter = 1 WHERE ip_hash = '$user_ip_hash'";
        $conn->query($sql);
        // On affiche la page
        include 'content.php';
        exit();
    }

    // Si la date d'expiration n'est pas dépassée
    else {
        // Si le compteur est à 10
        if ($counter >= 10) {
            // On affiche la page d'erreur
            die('vous etes bloqué!');
            exit();
        }

        // Si le compteur n'est pas à 10
        else {
            // On incrémente le compteur
            $sql = "UPDATE users SET counter = counter + 1 WHERE ip_hash = '$user_ip_hash'";
            $conn->query($sql);
            // On affiche la page
            include 'content.php';
            exit();
        }
    }
}

?>