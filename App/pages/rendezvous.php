<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'patient') {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['user_id'];

// Liste des rendez-vous du patient
$sql = "SELECT r.idRdv, r.date_heure, r.statut, m.nom_complete AS nom_medecin, m.specialite
        FROM rendezvous r
        JOIN medecins m ON r.idMedcine = m.idMedcine
        WHERE r.idPatient = ? ORDER BY r.date_heure DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// Liste des médecins disponibles
$medecins = $conn->query("SELECT idMedcine, nom_complete, specialite FROM medecins");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes Rendez-vous</title>
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
        .form-container {
            max-width: 600px;
            margin: 40px auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        label, select, input {
            display: block;
            width: 100%;
            margin-top: 10px;
            padding: 10px;
            font-size: 16px;
        }
        button {
            margin-top: 20px;
            background-color: #0d6efd;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
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
        <a href="dashboard-patient.php">Dashboard</a>
        <a href="profil.php">Profil</a>
        <a href="rendezvous.php">Rendez-vous</a>
        <a href="dossiers.php">Dossiers</a>
        <a href="logout.php">Déconnexion</a>
    </div>

    <h1>Mes Rendez-vous</h1>
    <table>
        <tr>
            <th>Date & Heure</th>
            <th>Médecin</th>
            <th>Spécialité</th>
            <th>Statut</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['date_heure']) ?></td>
                <td><?= htmlspecialchars($row['nom_medecin']) ?></td>
                <td><?= htmlspecialchars($row['specialite']) ?></td>
                <td><?= htmlspecialchars($row['statut']) ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

    <div class="form-container">
        <h2>Prendre un nouveau rendez-vous</h2>
        <form action="rendezvous_traitement.php" method="POST">
            <label for="medecin">Choisissez un médecin :</label>
            <select name="medecin" id="medecin" required>
                <option value="">-- Sélectionner --</option>
                <?php while ($med = $medecins->fetch_assoc()): ?>
                    <option value="<?= $med['idMedcine'] ?>">
                        <?= htmlspecialchars($med['nom_complete']) ?> (<?= htmlspecialchars($med['specialite']) ?>)
                    </option>
                <?php endwhile; ?>
            </select>
            <label for="date_heure">Date et heure :</label>
            <input type="datetime-local" name="date_heure" id="date_heure" required>
            <button type="submit">Valider le rendez-vous</button>
        </form>
    </div>
</body>
</html>
