<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'patient') {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['user_id'];

$sql = "SELECT u.email, p.nom_complete, p.sexe, p.age, p.telephone
        FROM users u
        JOIN patients p ON u.idUser = p.idPatient
        WHERE u.idUser = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($email, $nom, $sexe, $age, $telephone);
$stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Profil - Patient</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 40px;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            max-width: 700px;
            margin: auto;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        h1 {
            color: #0d6efd;
            text-align: center;
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: 600;
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
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0b5ed7;
        }
        .nav {
            text-align: center;
            margin-bottom: 30px;
        }
        .nav a {
            color: #0d6efd;
            margin: 0 10px;
            text-decoration: none;
            font-weight: 600;
        }
        .nav a:hover {
            color: #ffc107;
        }
    </style>
</head>
<body>
    <div class="nav">
        <a href="dashboard-patient.php">Dashboard</a>
        <a href="rendezvous.php">Rendez-vous</a>
        <a href="dossiers.php">Dossiers</a>
        <a href="logout.php">Déconnexion</a>
    </div>

    <div class="container">
        <h1>Mon Profil</h1>
        <form method="POST" action="update_profil.php">
            <label>Nom complet :</label>
            <input type="text" name="nom_complete" value="<?= htmlspecialchars($nom) ?>" required>

            <label>Email :</label>
            <input type="email" name="email" value="<?= htmlspecialchars($email) ?>" required>

            <label>Sexe :</label>
            <select name="sexe" required>
                <option value="homme" <?= $sexe == 'homme' ? 'selected' : '' ?>>Homme</option>
                <option value="femme" <?= $sexe == 'femme' ? 'selected' : '' ?>>Femme</option>
            </select>

            <label>Âge :</label>
            <input type="number" name="age" value="<?= htmlspecialchars($age) ?>" required>

            <label>Téléphone :</label>
            <input type="text" name="telephone" value="<?= htmlspecialchars($telephone) ?>" required>

            <input type="hidden" name="id" value="<?= $id ?>">
            <button type="submit">Mettre à jour</button>
        </form>
    </div>
</body>
</html>
