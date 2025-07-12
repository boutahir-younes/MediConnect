<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$medecins = $conn->query("SELECT m.idMedcine, m.nom_complete, m.sexe, m.telephone, m.specialite, u.email
                          FROM medecins m JOIN users u ON m.idMedcine = u.idUser");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Gestion des Médecins</title>
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
  </style>
</head>
<body>
  <div class="nav">
    <a href="dashboard-admin.php">Dashboard</a>
    <a href="patients-admin.php">Patients</a>
    <a href="medecins-admin.php">Médecins</a>
    <a href="logout.php">Déconnexion</a>
  </div>

  <h1>Gestion des Médecins</h1>

  <a href="ajouter-medecin.php" class="btn-ajouter">+ Ajouter un médecin</a>

  <table>
    <tr>
      <th>Nom</th>
      <th>Sexe</th>
      <th>Téléphone</th>
      <th>Spécialité</th>
      <th>Email</th>
      <th>Actions</th>
    </tr>
    <?php while ($row = $medecins->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($row['nom_complete']) ?></td>
        <td><?= htmlspecialchars($row['sexe']) ?></td>
        <td><?= htmlspecialchars($row['telephone']) ?></td>
        <td><?= htmlspecialchars($row['specialite']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>
        <td class="actions">
          <a href="modifier-medecin.php?id=<?= $row['idMedcine'] ?>">Modifier</a>
          <a href="supprimer-medecin.php?id=<?= $row['idMedcine'] ?>" onclick="return confirm('Supprimer ce médecin ?');">Supprimer</a>
        </td>
      </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>
