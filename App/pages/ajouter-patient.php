<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$success = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom_complete'];
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];
    $sexe = $_POST['sexe'];
    $age = $_POST['age'];
    $telephone = $_POST['telephone'];

    $stmtUser = $conn->prepare("INSERT INTO users (email, mode_passe, role) VALUES (?, ?, 'patient')");
    $stmtUser->bind_param("ss", $email, $mot_de_passe);

    if ($stmtUser->execute()) {
        $userId = $conn->insert_id;
        $stmtPat = $conn->prepare("INSERT INTO patients (idPatient, nom_complete, sexe, age, telephone) VALUES (?, ?, ?, ?, ?)");
        $stmtPat->bind_param("issis", $userId, $nom, $sexe, $age, $telephone);

        if ($stmtPat->execute()) {
            $success = true;
        } else {
            $error = "Erreur d'ajout dans la table des patients.";
        }
    } else {
        $error = "Erreur : cet email est peut-être déjà utilisé.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Ajouter un patient</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8f9fa;
      padding: 30px;
      display: flex;
      justify-content: center;
    }
    .container {
      background-color: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      max-width: 600px;
      width: 100%;
    }
    h2 {
      text-align: center;
      color: #0d6efd;
    }
    label {
      display: block;
      margin-top: 10px;
      font-weight: bold;
    }
    input, select {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    .btn {
      margin-top: 20px;
      background-color: #0d6efd;
      color: white;
      padding: 12px;
      width: 100%;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
    }
    .btn:hover {
      background-color: #0b5ed7;
    }
    .message {
      text-align: center;
      color: green;
      font-weight: bold;
      margin-top: 20px;
    }
    .error {
      text-align: center;
      color: red;
      font-weight: bold;
      margin-top: 20px;
    }
    .back-link {
      display: block;
      margin-top: 20px;
      text-align: center;
      color: #0d6efd;
      text-decoration: none;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Ajouter un patient</h2>
    <?php if ($success): ?>
      <div class="message">✅ Patient ajouté avec succès !</div>
    <?php elseif ($error): ?>
      <div class="error">❌ <?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
      <label>Nom complet :</label>
      <input type="text" name="nom_complete" required>

      <label>Email :</label>
      <input type="email" name="email" required>

      <label>Mot de passe :</label>
      <input type="password" name="mot_de_passe" required>

      <label>Sexe :</label>
      <select name="sexe" required>
        <option value="homme">Homme</option>
        <option value="femme">Femme</option>
      </select>

      <label>Âge :</label>
      <input type="number" name="age" required>

      <label>Téléphone :</label>
      <input type="text" name="telephone" required>

      <button type="submit" class="btn">Ajouter le patient</button>
    </form>
    <a href="patients-admin.php" class="back-link">← Retour à la gestion des patients</a>
  </div>
</body>
</html>
