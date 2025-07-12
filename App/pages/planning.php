<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'medecin') {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['user_id'];

// On suppose qu'il existe une table rendezvous : idRdv, idPatient, idMedcine, date_heure, statut
$sql = "SELECT r.date_heure, r.statut, p.nom_complete AS patient
        FROM rendezvous r
        JOIN patients p ON r.idPatient = p.idPatient
        WHERE r.idMedcine = ? ORDER BY r.date_heure ASC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Mon Planning</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8f9fa;
      padding: 30px;
    }
    h1 {
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
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 30px;
    }
    th, td {
      padding: 12px;
      border-bottom: 1px solid #ccc;
      text-align: left;
    }
    th {
      background-color: #0d6efd;
      color: white;
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

  <h1>Mon Planning</h1>
  <table>
    <tr>
      <th>Date & Heure</th>
      <th>Patient</th>
      <th>Statut</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($row['date_heure']) ?></td>
        <td><?= htmlspecialchars($row['patient']) ?></td>
        <td><?= htmlspecialchars($row['statut']) ?></td>
      </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>
