<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'patient') {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['user_id'];

// On suppose qu'il existe une table notifications avec : idNotif, idPatient, message, date_envoi, statut
$sql = "SELECT message, date_envoi, statut FROM notifications WHERE idPatient = ? ORDER BY date_envoi DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Mes Notifications</title>
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
    .notif {
      background-color: white;
      margin: 20px auto;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      max-width: 700px;
    }
    .notif h3 {
      margin: 0 0 10px;
      color: #0d6efd;
    }
    .notif p {
      margin: 5px 0;
    }
    .notif small {
      color: #666;
    }
  </style>
</head>
<body>
  <div class="nav">
    <a href="dashboard-patient.php">Dashboard</a>
    <a href="profil.php">Profil</a>
    <a href="rendezvous.php">Rendez-vous</a>
    <a href="dossiers.php">Dossiers</a>
    <a href="notifications.php">Notifications</a>
    <a href="logout.php">Déconnexion</a>
  </div>

  <h1>Mes Notifications</h1>

  <?php while ($row = $result->fetch_assoc()): ?>
    <div class="notif">
      <h3><?= htmlspecialchars($row['statut']) ?></h3>
      <p><?= nl2br(htmlspecialchars($row['message'])) ?></p>
      <small><?= htmlspecialchars($row['date_envoi']) ?></small>
    </div>
  <?php endwhile; ?>
</body>
</html>
