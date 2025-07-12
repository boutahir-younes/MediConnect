<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    echo "ID médecin manquant.";
    exit();
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom_complete'];
    $sexe = $_POST['sexe'];
    $tel = $_POST['telephone'];
    $spec = $_POST['specialite'];
    $email = $_POST['email'];

    $stmt1 = $conn->prepare("UPDATE medecins SET nom_complete=?, sexe=?, telephone=?, specialite=? WHERE idMedcine=?");
    $stmt1->bind_param("ssssi", $nom, $sexe, $tel, $spec, $id);
    $stmt1->execute();

    $stmt2 = $conn->prepare("UPDATE users SET email=? WHERE idUser=?");
    $stmt2->bind_param("si", $email, $id);
    $stmt2->execute();

    header("Location: medecins-admin.php");
    exit();
}

// Charger les données actuelles
$sql = "SELECT m.nom_complete, m.sexe, m.telephone, m.specialite, u.email
        FROM medecins m JOIN users u ON m.idMedcine = u.idUser WHERE m.idMedcine = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($nom, $sexe, $tel, $spec, $email);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Modifier Médecin</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8f9fa;
      padding: 30px;
    }
    .form-container {
      max-width: 600px;
      margin: auto;
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    h1 {
      text-align: center;
      color: #0d6efd;
    }
    label {
      font-weight: bold;
      display: block;
      margin-top: 15px;
    }
    input, select {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }
    button {
      margin-top: 20px;
      width: 100%;
      background-color: #0d6efd;
      color: white;
      padding: 12px;
      border: none;
      border-radius: 5px;
      font-size: 16px;
    }
    button:hover {
      background-color: #0b5ed7;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h1>Modifier le médecin</h1>
    <form method="POST">
      <label>Nom complet :</label>
      <input type="text" name="nom_complete" value="<?= htmlspecialchars($nom) ?>" required>

      <label>Sexe :</label>
      <select name="sexe">
        <option value="homme" <?= $sexe == 'homme' ? 'selected' : '' ?>>Homme</option>
        <option value="femme" <?= $sexe == 'femme' ? 'selected' : '' ?>>Femme</option>
      </select>

      <label>Téléphone :</label>
      <input type="text" name="telephone" value="<?= htmlspecialchars($tel) ?>" required>

      <label>Spécialité :</label>
      <input type="text" name="specialite" value="<?= htmlspecialchars($spec) ?>" required>

      <label>Email :</label>
      <input type="email" name="email" value="<?= htmlspecialchars($email) ?>" required>

      <button type="submit">Enregistrer les modifications</button>
    </form>
  </div>
</body>
</html>
