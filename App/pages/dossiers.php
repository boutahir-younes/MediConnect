<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'patient') {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['user_id'];

// Liste des dossiers médicaux du patient
$sql = "SELECT titre, description, date_ajout FROM dossiers_medicaux WHERE idPatient = ? ORDER BY date_ajout DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes Dossiers Médicaux</title>
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
        .dossier {
            background-color: white;
            margin: 20px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            max-width: 700px;
        }
        .dossier h3 {
            margin-bottom: 10px;
            color: #0d6efd;
        }
        .dossier p {
            margin-bottom: 5px;
        }
        .dossier small {
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
        <a href="logout.php">Déconnexion</a>
    </div>

    <h1>Mes Dossiers Médicaux</h1>

    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="dossier">
            <h3><?= htmlspecialchars($row['titre']) ?></h3>
            <p><?= nl2br(htmlspecialchars($row['description'])) ?></p>
            <small>Date d'ajout : <?= htmlspecialchars($row['date_ajout']) ?></small>
        </div>
    <?php endwhile; ?>
</body>
</html>
