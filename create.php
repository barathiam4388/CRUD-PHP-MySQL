<?php
require "db.php";

$erreur = "";
$nom = "";
$quantite = "";
$prix = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = trim($_POST["nom"] ?? "");
    $quantite = trim($_POST["quantite"] ?? "");
    $prix = trim($_POST["prix"] ?? "");

    // Validation
    if ($nom === "") {
        $erreur = "Veuillez entrer un nom.";
    } elseif (!is_numeric($quantite) || (int)$quantite < 0) {
        $erreur = "Quantité invalide.";
    } elseif (!is_numeric($prix) || (float)$prix < 0) {
        $erreur = "Prix invalide.";
    } else {
        $sql = "INSERT INTO produits (nom, quantite, prix) VALUES (:nom, :quantite, :prix)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ":nom" => $nom,
            ":quantite" => (int)$quantite,
            ":prix" => (float)$prix
        ]);

        header("Location: index.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Ajouter un produit</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 30px; }
    .box { max-width: 420px; }
    label { display:block; margin-top: 12px; }
    input { width: 100%; padding: 10px; margin-top: 5px; }
    button { margin-top: 15px; padding: 10px 14px; }
    a { display:inline-block; margin-top: 15px; }
    .err { background:#ffe3e3; border:1px solid #ffb3b3; padding:10px; margin-top:10px; }
  </style>
</head>
<body>

  <h1>Ajouter un produit</h1>

  <div class="box">
    <?php if ($erreur !== ""): ?>
      <div class="err"><?php echo htmlspecialchars($erreur); ?></div>
    <?php endif; ?>

    <form method="POST">
      <label>Nom</label>
      <input type="text" name="nom" value="<?php echo htmlspecialchars($nom); ?>" required>

      <label>Quantité</label>
      <input type="number" name="quantite" value="<?php echo htmlspecialchars($quantite); ?>" min="0" required>

      <label>Prix</label>
      <input type="number" step="0.01" name="prix" value="<?php echo htmlspecialchars($prix); ?>" min="0" required>

      <button type="submit">Ajouter</button>
    </form>

    <a href="index.php">← Retour</a>
  </div>

</body>
</html>
