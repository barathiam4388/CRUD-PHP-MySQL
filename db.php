<?php
// db.php : connexion à MySQL avec PDO (simple et propre)

$host = "localhost";
$dbname = "crud_php";
$user = "root";
$pass = ""; // sur XAMPP Mac, souvent vide

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $user,
        $pass
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur connexion BD : " . $e->getMessage());
}
