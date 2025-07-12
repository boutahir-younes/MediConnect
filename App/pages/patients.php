<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'medecin') {
    header("Location: login.php");
    exit();
}

$idMedcine = $_SESSION['user_id'];

// Patients ayant un rendez-vous avec ce médecin
$sql = "SELECT DISTINCT p.idPatient, p.nom_complete, p.sexe, p.age, p.telephone
        FROM patients p
        JOIN rendezvous r ON p.idPatient = r.idPatient
        WHERE r.idMedcine = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idMedcine);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Mes Patients</title>
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

  <h1>Mes Patients</h1>
  <table>
    <tr>
      <th>Nom</th>
      <th>Sexe</th>
      <th>Âge</th>
      <th>Téléphone</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($row['nom_complete']) ?></td>
        <td><?= htmlspecialchars($row['sexe']) ?></td>
        <td><?= htmlspecialchars($row['age']) ?></td>
        <td><?= htmlspecialchars($row['telephone']) ?></td>
      </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>
