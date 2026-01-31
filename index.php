<?php
require "db.php";

// Lire les produits
$sql = "SELECT id, nom, quantite, prix FROM produits ORDER BY id DESC";
$stmt = $pdo->query($sql);
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Produits - CRUD PHP MySQL</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 30px; }
    table { border-collapse: collapse; width: 100%; margin-top: 15px; }
    th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
    th { background: #f3f3f3; }
    a.btn { display:inline-block; padding:8px 12px; background:#222; color:#fff; text-decoration:none; border-radius:6px; }
    a.btn:hover { opacity:0.9; }
  </style>
</head>
<body>

  <h1>Liste des produits</h1>

  <a class="btn" href="create.php">+ Ajouter un produit</a>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Quantité</th>
        <th>Prix</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if (count($produits) == 0): ?>
        <tr>
          <td colspan="5">Aucun produit pour l’instant.</td>
        </tr>
      <?php else: ?>
        <?php foreach ($produits as $p): ?>
          <tr>
            <td><?php echo $p["id"]; ?></td>
            <td><?php echo htmlspecialchars($p["nom"]); ?></td>
            <td><?php echo $p["quantite"]; ?></td>
            <td><?php echo number_format($p["prix"], 2); ?></td>
            <td>
              <a href="edit.php?id=<?php echo $p["id"]; ?>">Modifier</a> |
              <a href="delete.php?id=<?php echo $p["id"]; ?>" onclick="return confirm('Supprimer ce produit ?');">Supprimer</a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>

</body>
</html>
