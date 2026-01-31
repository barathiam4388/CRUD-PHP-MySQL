<?php
require "db.php";

$id = $_GET["id"] ?? null;

if ($id === null || !is_numeric($id)) {
    header("Location: index.php");
    exit;
}

$sql = "DELETE FROM produits WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([":id" => (int)$id]);

header("Location: index.php");
exit;
