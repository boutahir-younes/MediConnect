<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$patients = $conn->query("SELECT p.idPatient, p.nom_complete, p.sexe, p.age, p.telephone, u.email
                          FROM patients p JOIN users u ON p.idPatient = u.idUser");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Gestion des Patients</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8f9fa;
      padding: 30px;
    }
    h1 {
      text-align: center;
      color: #0d6efd;
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
     .btn-ajouter {
      display: inline-block;
      margin: 20px 0;
      padding: 10px 20px;
      background-color: #0d6efd;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      font-weight: bold;
    }
    .btn-ajouter:hover {
      background-color: #0b5ed7;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 30px;
      background: white;
      border-radius: 10px;
      overflow: hidden;
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
    .actions a {
      margin-right: 10px;
      color: #0d6efd;
      text-decoration: none;
      font-weight: bold;
    }
    .actions a:hover {
      color: red;
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
    button {
      margin-top: 20px;
      background-color: #0d6efd;
      color: white;
      padding: 10px;
      border: none;
      border-radius: 5px;
      width: 100%;
      font-size: 16px;
      cursor: pointer;
    }
    button:hover {
      background-color: #0b5ed7;
    }
  </style>
</head>
<body>
  <div class="nav">
    <a href="dashboard-admin.php">Dashboard</a>
    <a href="patients-admin.php">Patients</a>
    <a href="medecins-admin.php">Médecins</a>
    <a href="logout.php">Déconnexion</a>
  </div>
  <a href="ajouter-patient.php" class="btn-ajouter">+ Ajouter un patient</a>

  <h1>Gestion des Patients</h1>

  <table>
    <tr>
      <th>Nom</th>
      <th>Sexe</th>
      <th>Âge</th>
      <th>Téléphone</th>
      <th>Email</th>
      <th>Actions</th>
    </tr>
    <?php while ($row = $patients->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($row['nom_complete']) ?></td>
        <td><?= htmlspecialchars($row['sexe']) ?></td>
        <td><?= htmlspecialchars($row['age']) ?></td>
        <td><?= htmlspecialchars($row['telephone']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>
        <td class="actions">
          <a href="modifier-patient.php?id=<?= $row['idPatient'] ?>">Modifier</a>
          <a href="supprimer-patient.php?id=<?= $row['idPatient'] ?>" onclick="return confirm('Supprimer ce patient ?');">Supprimer</a>
        </td>
      </tr>

    <?php endwhile; ?>
  </table>
</body>
</html>
