<?php
// dashboard-patient.php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Patient</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #0d6efd;
            color: white;
            padding: 20px;
            text-align: center;
        }
        nav {
            background-color: white;
            padding: 20px;
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
            padding: 30px;
            text-align: center;
        }
        h1 {
            font-size: 32px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Tableau de bord du patient</h1>
    </header>
    <nav>
        <a href="profil.php">Profil</a>
        <a href="rendezvous.php">Rendez-vous</a>
        <a href="dossiers.php">Dossiers médicaux</a>
        <a href="logout.php">Déconnexion</a>
    </nav>
    <main>
        <h2>Bienvenue sur votre espace personnel</h2>
        <p>Sélectionnez une section dans le menu ci-dessus pour gérer votre santé.</p>
    </main>
</body>
</html>
