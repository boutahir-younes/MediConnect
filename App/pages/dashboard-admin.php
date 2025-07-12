<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Statistiques globales
$count_users = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'];
$count_patients = $conn->query("SELECT COUNT(*) AS total FROM patients")->fetch_assoc()['total'];
$count_medecins = $conn->query("SELECT COUNT(*) AS total FROM medecins")->fetch_assoc()['total'];
$count_rdv = $conn->query("SELECT COUNT(*) AS total FROM rendezvous")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      background-color: #f8f9fa;
    }
    header {
      background-color: #0d6efd;
      color: white;
      padding: 20px;
      text-align: center;
    }
    nav {
      background-color: white;
      padding: 15px;
      display: flex;
      justify-content: center;
      gap: 30px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    nav a {
      text-decoration: none;
      color: #0d6efd;
      font-weight: bold;
    }
    nav a:hover {
      color: #ffc107;
    }
    main {
      padding: 40px;
      text-align: center;
    }
    .stat {
      background-color: white;
      border-radius: 10px;
      padding: 20px;
      margin: 20px auto;
      max-width: 400px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .stat h3 {
      color: #0d6efd;
    }
  </style>
</head>
<body>
  <header>
    <h1>Bienvenue Administrateur</h1>
    <p>Gestion centrale du système MediConnect</p>
  </header>

  <nav>
    <a href="dashboard-admin.php">Tableau de bord</a>
    <a href="patients-admin.php">Patients</a>
    <a href="medecins-admin.php">Médecins</a>
    <a href="logout.php">Déconnexion</a>
  </nav>

  <main>
    <div class="stat">
      <h3>Total des utilisateurs :</h3>
      <p><?= $count_users ?></p>
    </div>
    <div class="stat">
      <h3>Total des patients :</h3>
      <p><?= $count_patients ?></p>
    </div>
    <div class="stat">
      <h3>Total des médecins :</h3>
      <p><?= $count_medecins ?></p>
    </div>
    <div class="stat">
      <h3>Total des rendez-vous :</h3>
      <p><?= $count_rdv ?></p>
    </div>
  </main>
</body>
</html>
