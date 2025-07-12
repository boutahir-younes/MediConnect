<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'medecin') {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['user_id'];

$sql = "SELECT nom_complete FROM medecins WHERE idMedcine = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($nom);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Médecin</title>
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
      transition: 0.3s;
    }
    nav a:hover {
      color: #ffc107;
    }
    main {
      padding: 40px;
      text-align: center;
    }
    h1 {
      font-size: 32px;
    }
  </style>
</head>
<body>
  <header>
    <h1>Bienvenue Dr. <?= htmlspecialchars($nom) ?></h1>
    <p>Accès à votre espace médecin MediConnect</p>
  </header>

  <nav>
    <a href="planning.php">Mon planning</a>
    <a href="patients.php">Mes patients</a>
    <a href="dossiers-medecin.php">Dossiers médicaux</a>
    <a href="logout.php">Déconnexion</a>
  </nav>

  <main>
    <h2>Tableau de bord du médecin</h2>
    <p>Choisissez une section à gérer depuis la navigation ci-dessus.</p>
  </main>
</body>
</html>
