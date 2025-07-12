<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'medecin') {
    header("Location: login.php");
    exit();
}

$idMedcine = $_SESSION['user_id'];

// Liste des patients du médecin
$patients_stmt = $conn->prepare("SELECT DISTINCT p.idPatient, p.nom_complete
                                 FROM patients p
                                 JOIN rendezvous r ON p.idPatient = r.idPatient
                                 WHERE r.idMedcine = ?");
$patients_stmt->bind_param("i", $idMedcine);
$patients_stmt->execute();
$patients_result = $patients_stmt->get_result();

// Afficher les dossiers existants
$sql = "SELECT d.titre, d.description, d.date_ajout, p.nom_complete
        FROM dossiers_medicaux d
        JOIN patients p ON d.idPatient = p.idPatient
        JOIN rendezvous r ON r.idPatient = p.idPatient
        WHERE r.idMedcine = ?
        GROUP BY d.idDossier
        ORDER BY d.date_ajout DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idMedcine);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Dossiers Médicaux des Patients</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8f9fa;
      padding: 30px;
    }
    h1, h2 {
      color: #0d6efd;
      text-align: center;
    }
    .nav {
      text-align: center;
      margin-bottom: 20px;
    }
    .nav a {
      margin: 0 10px;
      text-decoration: none;
      color: #0d6efd;
      font-weight: bold;
    }
    .nav a:hover {
      color: #ffc107;
    }
    .dossier {
      background-color: white;
      margin: 20px auto;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      max-width: 700px;
    }
    .form-container {
      background-color: white;
      max-width: 700px;
      margin: 30px auto;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    label {
      display: block;
      margin-top: 10px;
      font-weight: bold;
    }
    input, textarea, select {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    button {
      margin-top: 15px;
      padding: 10px 20px;
      background-color: #0d6efd;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    button:hover {
      background-color: #0b5ed7;
    }
  </style>
</head>
<body>
  <div class="nav">
    <a href="dashboard-doctor.php">Dashboard</a>
    <a href="planning.php">Planning</a>
    <a href="patients.php">Mes patients</a>
    <a href="dossiers-medecin.php">Dossiers</a>
    <a href="logout.php">Déconnexion</a>
  </div>

  <h1>Dossiers Médicaux des Patients</h1>

  <?php while ($row = $result->fetch_assoc()): ?>
    <div class="dossier">
      <h3><?= htmlspecialchars($row['titre']) ?></h3>
      <p><strong>Patient :</strong> <?= htmlspecialchars($row['nom_complete']) ?></p>
      <p><?= nl2br(htmlspecialchars($row['description'])) ?></p>
      <small>Date : <?= htmlspecialchars($row['date_ajout']) ?></small>
    </div>
  <?php endwhile; ?>

  <div class="form-container">
    <h2>Ajouter un nouveau dossier médical</h2>
    <form action="dossier_traitement.php" method="POST">
      <label for="patient">Patient :</label>
      <select name="patient" id="patient" required>
        <option value="">-- Sélectionner un patient --</option>
        <?php while ($p = $patients_result->fetch_assoc()): ?>
          <option value="<?= $p['idPatient'] ?>"><?= htmlspecialchars($p['nom_complete']) ?></option>
        <?php endwhile; ?>
      </select>

      <label for="titre">Titre :</label>
      <input type="text" name="titre" id="titre" required>

      <label for="description">Description :</label>
      <textarea name="description" id="description" rows="5" required></textarea>

      <button type="submit">Ajouter</button>
    </form>
  </div>
</body>
</html>
