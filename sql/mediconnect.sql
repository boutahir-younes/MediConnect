-- SUPPRIMER l'ancienne BDD si elle existe
DROP DATABASE IF EXISTS mediconnect;

-- CRÉER la base
CREATE DATABASE mediconnect CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE mediconnect;

-- TABLE users
CREATE TABLE users (
    idUser INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL UNIQUE,
    mode_passe VARCHAR(100) NOT NULL,
    role ENUM('patient', 'medecin', 'admin') NOT NULL
);

-- TABLE patients
CREATE TABLE patients (
    idPatient INT PRIMARY KEY, -- = idUser
    nom_complete VARCHAR(100) NOT NULL,
    sexe ENUM('homme', 'femme') NOT NULL,
    age INT NOT NULL,
    telephone VARCHAR(20),
    FOREIGN KEY (idPatient) REFERENCES users(idUser) ON DELETE CASCADE
);

-- TABLE medecins
CREATE TABLE medecins (
    idMedcine INT PRIMARY KEY, -- = idUser
    nom_complete VARCHAR(100) NOT NULL,
    sexe ENUM('homme', 'femme') NOT NULL,
    telephone VARCHAR(20),
    specialite VARCHAR(100),
    FOREIGN KEY (idMedcine) REFERENCES users(idUser) ON DELETE CASCADE
);

-- TABLE admin
CREATE TABLE admin (
    idAdmin INT PRIMARY KEY, -- = idUser
    nom_complete VARCHAR(100) NOT NULL,
    FOREIGN KEY (idAdmin) REFERENCES users(idUser) ON DELETE CASCADE
);
-- Table des rendez-vous
CREATE TABLE IF NOT EXISTS rendezvous (
    idRdv INT AUTO_INCREMENT PRIMARY KEY,
    idPatient INT,
    idMedcine INT,
    date_heure DATETIME,
    statut VARCHAR(20),
    FOREIGN KEY (idPatient) REFERENCES patients(idPatient) ON DELETE CASCADE,
    FOREIGN KEY (idMedcine) REFERENCES medecins(idMedcine) ON DELETE CASCADE
);



-- Table des dossiers médicaux
CREATE TABLE IF NOT EXISTS dossiers_medicaux (
    idDossier INT AUTO_INCREMENT PRIMARY KEY,
    idPatient INT,
    titre VARCHAR(255),
    description TEXT,
    date_ajout DATETIME,
    FOREIGN KEY (idPatient) REFERENCES patients(idPatient) ON DELETE CASCADE
);


-- Table des notifications
CREATE TABLE IF NOT EXISTS notifications (
    idNotif INT AUTO_INCREMENT PRIMARY KEY,
    idPatient INT,
    message TEXT,
    date_envoi DATETIME,
    statut VARCHAR(50),
    FOREIGN KEY (idPatient) REFERENCES patients(idPatient) ON DELETE CASCADE
);

INSERT INTO users (idUser, email, mode_passe, role) VALUES (1, 'patient1@mediconnect.ma', 'pass1', 'patient');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (2, 'patient2@mediconnect.ma', 'pass2', 'patient');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (3, 'patient3@mediconnect.ma', 'pass3', 'patient');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (4, 'patient4@mediconnect.ma', 'pass4', 'patient');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (5, 'patient5@mediconnect.ma', 'pass5', 'patient');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (6, 'patient6@mediconnect.ma', 'pass6', 'patient');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (7, 'patient7@mediconnect.ma', 'pass7', 'patient');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (8, 'patient8@mediconnect.ma', 'pass8', 'patient');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (9, 'patient9@mediconnect.ma', 'pass9', 'patient');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (10, 'patient10@mediconnect.ma', 'pass10', 'patient');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (11, 'patient11@mediconnect.ma', 'pass11', 'patient');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (12, 'patient12@mediconnect.ma', 'pass12', 'patient');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (13, 'patient13@mediconnect.ma', 'pass13', 'patient');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (14, 'patient14@mediconnect.ma', 'pass14', 'patient');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (15, 'patient15@mediconnect.ma', 'pass15', 'patient');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (16, 'patient16@mediconnect.ma', 'pass16', 'patient');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (17, 'patient17@mediconnect.ma', 'pass17', 'patient');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (18, 'patient18@mediconnect.ma', 'pass18', 'patient');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (19, 'patient19@mediconnect.ma', 'pass19', 'patient');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (20, 'patient20@mediconnect.ma', 'pass20', 'patient');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (21, 'patient21@mediconnect.ma', 'pass21', 'patient');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (22, 'patient22@mediconnect.ma', 'pass22', 'patient');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (23, 'patient23@mediconnect.ma', 'pass23', 'patient');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (24, 'patient24@mediconnect.ma', 'pass24', 'patient');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (25, 'patient25@mediconnect.ma', 'pass25', 'patient');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (26, 'patient26@mediconnect.ma', 'pass26', 'patient');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (27, 'patient27@mediconnect.ma', 'pass27', 'patient');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (28, 'patient28@mediconnect.ma', 'pass28', 'patient');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (29, 'patient29@mediconnect.ma', 'pass29', 'patient');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (30, 'patient30@mediconnect.ma', 'pass30', 'patient');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (31, 'medecin1@mediconnect.ma', 'pass31', 'medecin');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (32, 'medecin2@mediconnect.ma', 'pass32', 'medecin');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (33, 'medecin3@mediconnect.ma', 'pass33', 'medecin');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (34, 'medecin4@mediconnect.ma', 'pass34', 'medecin');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (35, 'medecin5@mediconnect.ma', 'pass35', 'medecin');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (36, 'medecin6@mediconnect.ma', 'pass36', 'medecin');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (37, 'medecin7@mediconnect.ma', 'pass37', 'medecin');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (38, 'medecin8@mediconnect.ma', 'pass38', 'medecin');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (39, 'medecin9@mediconnect.ma', 'pass39', 'medecin');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (40, 'medecin10@mediconnect.ma', 'pass40', 'medecin');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (41, 'medecin11@mediconnect.ma', 'pass41', 'medecin');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (42, 'medecin12@mediconnect.ma', 'pass42', 'medecin');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (43, 'medecin13@mediconnect.ma', 'pass43', 'medecin');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (44, 'medecin14@mediconnect.ma', 'pass44', 'medecin');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (45, 'medecin15@mediconnect.ma', 'pass45', 'medecin');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (46, 'medecin16@mediconnect.ma', 'pass46', 'medecin');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (47, 'medecin17@mediconnect.ma', 'pass47', 'medecin');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (48, 'medecin18@mediconnect.ma', 'pass48', 'medecin');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (49, 'medecin19@mediconnect.ma', 'pass49', 'medecin');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (50, 'medecin20@mediconnect.ma', 'pass50', 'medecin');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (51, 'medecin21@mediconnect.ma', 'pass51', 'medecin');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (52, 'medecin22@mediconnect.ma', 'pass52', 'medecin');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (53, 'medecin23@mediconnect.ma', 'pass53', 'medecin');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (54, 'medecin24@mediconnect.ma', 'pass54', 'medecin');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (55, 'medecin25@mediconnect.ma', 'pass55', 'medecin');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (56, 'medecin26@mediconnect.ma', 'pass56', 'medecin');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (57, 'medecin27@mediconnect.ma', 'pass57', 'medecin');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (58, 'medecin28@mediconnect.ma', 'pass58', 'medecin');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (59, 'medecin29@mediconnect.ma', 'pass59', 'medecin');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (60, 'medecin30@mediconnect.ma', 'pass60', 'medecin');
INSERT INTO users (idUser, email, mode_passe, role) VALUES (61, 'admin@mediconnect.ma', 'adminpass', 'admin');
INSERT INTO patients (idPatient, nom_complete, sexe, age, telephone) VALUES (1, 'Hiba Touhami', 'femme', 32, '0627618444');
INSERT INTO patients (idPatient, nom_complete, sexe, age, telephone) VALUES (2, 'Fatima Bennani', 'femme', 49, '0612721229');
INSERT INTO patients (idPatient, nom_complete, sexe, age, telephone) VALUES (3, 'Hicham El Idrissi', 'homme', 42, '0628342806');
INSERT INTO patients (idPatient, nom_complete, sexe, age, telephone) VALUES (4, 'Reda Boulahfa', 'homme', 57, '0650395398');
INSERT INTO patients (idPatient, nom_complete, sexe, age, telephone) VALUES (5, 'Reda Fassi', 'homme', 58, '0696491823');
INSERT INTO patients (idPatient, nom_complete, sexe, age, telephone) VALUES (6, 'Hiba Fassi', 'femme', 31, '0672476077');
INSERT INTO patients (idPatient, nom_complete, sexe, age, telephone) VALUES (7, 'Fatima Fassi', 'femme', 27, '0668474419');
INSERT INTO patients (idPatient, nom_complete, sexe, age, telephone) VALUES (8, 'Nour Bennani', 'femme', 30, '0691430769');
INSERT INTO patients (idPatient, nom_complete, sexe, age, telephone) VALUES (9, 'Nada Chakir', 'femme', 34, '0697972428');
INSERT INTO patients (idPatient, nom_complete, sexe, age, telephone) VALUES (10, 'Omar Boulahfa', 'homme', 23, '0667953722');
INSERT INTO patients (idPatient, nom_complete, sexe, age, telephone) VALUES (11, 'Ilyas Bennani', 'homme', 51, '0663816560');
INSERT INTO patients (idPatient, nom_complete, sexe, age, telephone) VALUES (12, 'Soufiane Raji', 'homme', 56, '0614155582');
INSERT INTO patients (idPatient, nom_complete, sexe, age, telephone) VALUES (13, 'Nada Touhami', 'femme', 47, '0658152373');
INSERT INTO patients (idPatient, nom_complete, sexe, age, telephone) VALUES (14, 'Soufiane Boulahfa', 'homme', 54, '0672908415');
INSERT INTO patients (idPatient, nom_complete, sexe, age, telephone) VALUES (15, 'Sara El Amrani', 'femme', 68, '0659975862');
INSERT INTO patients (idPatient, nom_complete, sexe, age, telephone) VALUES (16, 'Anas Touhami', 'homme', 28, '0680800106');
INSERT INTO patients (idPatient, nom_complete, sexe, age, telephone) VALUES (17, 'Khadija Raji', 'femme', 65, '0662324076');
INSERT INTO patients (idPatient, nom_complete, sexe, age, telephone) VALUES (18, 'Nour Touhami', 'femme', 52, '0676481329');
INSERT INTO patients (idPatient, nom_complete, sexe, age, telephone) VALUES (19, 'Anas Chakir', 'homme', 62, '0628849980');
INSERT INTO patients (idPatient, nom_complete, sexe, age, telephone) VALUES (20, 'Sara Boulahfa', 'femme', 42, '0673243097');
INSERT INTO patients (idPatient, nom_complete, sexe, age, telephone) VALUES (21, 'Hiba Touhami', 'femme', 37, '0638367714');
INSERT INTO patients (idPatient, nom_complete, sexe, age, telephone) VALUES (22, 'Anas El Amrani', 'homme', 66, '0653283190');
INSERT INTO patients (idPatient, nom_complete, sexe, age, telephone) VALUES (23, 'Fatima Touhami', 'femme', 58, '0679961944');
INSERT INTO patients (idPatient, nom_complete, sexe, age, telephone) VALUES (24, 'Khadija Touhami', 'femme', 70, '0651681365');
INSERT INTO patients (idPatient, nom_complete, sexe, age, telephone) VALUES (25, 'Mehdi El Amrani', 'homme', 54, '0675990893');
INSERT INTO patients (idPatient, nom_complete, sexe, age, telephone) VALUES (26, 'Hicham El Idrissi', 'homme', 61, '0670621449');
INSERT INTO patients (idPatient, nom_complete, sexe, age, telephone) VALUES (27, 'Salma Zouhairi', 'femme', 49, '0687989313');
INSERT INTO patients (idPatient, nom_complete, sexe, age, telephone) VALUES (28, 'Nour Zouhairi', 'femme', 60, '0625577569');
INSERT INTO patients (idPatient, nom_complete, sexe, age, telephone) VALUES (29, 'Meryem Touhami', 'femme', 27, '0612419736');
INSERT INTO patients (idPatient, nom_complete, sexe, age, telephone) VALUES (30, 'Ilyas El Amrani', 'homme', 33, '0624196832');
INSERT INTO medecins (idMedcine, nom_complete, sexe, telephone, specialite) VALUES (31, 'Fatima Fassi', 'femme', '0677143216', 'Cardiologie');
INSERT INTO medecins (idMedcine, nom_complete, sexe, telephone, specialite) VALUES (32, 'Nour Boulahfa', 'femme', '0681768511', 'Dermatologie');
INSERT INTO medecins (idMedcine, nom_complete, sexe, telephone, specialite) VALUES (33, 'Khadija Ouadih', 'femme', '0637587603', 'Gastroentérologie');
INSERT INTO medecins (idMedcine, nom_complete, sexe, telephone, specialite) VALUES (34, 'Asmae Bennani', 'femme', '0663226048', 'Neurologie');
INSERT INTO medecins (idMedcine, nom_complete, sexe, telephone, specialite) VALUES (35, 'Youssef Raji', 'homme', '0666840302', 'Ophtalmologie');
INSERT INTO medecins (idMedcine, nom_complete, sexe, telephone, specialite) VALUES (36, 'Karim Raji', 'homme', '0615253553', 'Pédiatrie');
INSERT INTO medecins (idMedcine, nom_complete, sexe, telephone, specialite) VALUES (37, 'Hiba Touhami', 'femme', '0649424907', 'Psychiatrie');
INSERT INTO medecins (idMedcine, nom_complete, sexe, telephone, specialite) VALUES (38, 'Ayoub Touhami', 'homme', '0683889094', 'ORL');
INSERT INTO medecins (idMedcine, nom_complete, sexe, telephone, specialite) VALUES (39, 'Sara El Amrani', 'femme', '0641299223', 'Radiologie');
INSERT INTO medecins (idMedcine, nom_complete, sexe, telephone, specialite) VALUES (40, 'Soufiane Zouhairi', 'homme', '0616900561', 'Urologie');
INSERT INTO medecins (idMedcine, nom_complete, sexe, telephone, specialite) VALUES (41, 'Hiba Bennani', 'femme', '0642471859', 'Cardiologie');
INSERT INTO medecins (idMedcine, nom_complete, sexe, telephone, specialite) VALUES (42, 'Mehdi Ouadih', 'homme', '0628523572', 'Dermatologie');
INSERT INTO medecins (idMedcine, nom_complete, sexe, telephone, specialite) VALUES (43, 'Asmae El Amrani', 'femme', '0616195988', 'Gastroentérologie');
INSERT INTO medecins (idMedcine, nom_complete, sexe, telephone, specialite) VALUES (44, 'Salma Zouhairi', 'femme', '0615411403', 'Neurologie');
INSERT INTO medecins (idMedcine, nom_complete, sexe, telephone, specialite) VALUES (45, 'Khadija Bennani', 'femme', '0686483693', 'Ophtalmologie');
INSERT INTO medecins (idMedcine, nom_complete, sexe, telephone, specialite) VALUES (46, 'Youssef Chakir', 'homme', '0661337199', 'Pédiatrie');
INSERT INTO medecins (idMedcine, nom_complete, sexe, telephone, specialite) VALUES (47, 'Imane Touhami', 'femme', '0627791405', 'Psychiatrie');
INSERT INTO medecins (idMedcine, nom_complete, sexe, telephone, specialite) VALUES (48, 'Mehdi Raji', 'homme', '0649395806', 'ORL');
INSERT INTO medecins (idMedcine, nom_complete, sexe, telephone, specialite) VALUES (49, 'Asmae Ouadih', 'femme', '0614128198', 'Radiologie');
INSERT INTO medecins (idMedcine, nom_complete, sexe, telephone, specialite) VALUES (50, 'Omar El Amrani', 'homme', '0680336747', 'Urologie');
INSERT INTO medecins (idMedcine, nom_complete, sexe, telephone, specialite) VALUES (51, 'Hiba El Idrissi', 'femme', '0649129857', 'Cardiologie');
INSERT INTO medecins (idMedcine, nom_complete, sexe, telephone, specialite) VALUES (52, 'Reda Fassi', 'homme', '0645378157', 'Dermatologie');
INSERT INTO medecins (idMedcine, nom_complete, sexe, telephone, specialite) VALUES (53, 'Ayoub Chakir', 'homme', '0689216533', 'Gastroentérologie');
INSERT INTO medecins (idMedcine, nom_complete, sexe, telephone, specialite) VALUES (54, 'Omar Bennani', 'homme', '0648672767', 'Neurologie');
INSERT INTO medecins (idMedcine, nom_complete, sexe, telephone, specialite) VALUES (55, 'Salma El Idrissi', 'femme', '0656653099', 'Ophtalmologie');
INSERT INTO medecins (idMedcine, nom_complete, sexe, telephone, specialite) VALUES (56, 'Meryem Touhami', 'femme', '0641748197', 'Pédiatrie');
INSERT INTO medecins (idMedcine, nom_complete, sexe, telephone, specialite) VALUES (57, 'Khadija Ouadih', 'femme', '0616615194', 'Psychiatrie');
INSERT INTO medecins (idMedcine, nom_complete, sexe, telephone, specialite) VALUES (58, 'Mehdi Boulahfa', 'homme', '0612357287', 'ORL');
INSERT INTO medecins (idMedcine, nom_complete, sexe, telephone, specialite) VALUES (59, 'Reda Raji', 'homme', '0628559761', 'Radiologie');
INSERT INTO medecins (idMedcine, nom_complete, sexe, telephone, specialite) VALUES (60, 'Ayoub Boulahfa', 'homme', '0615404732', 'Urologie');
INSERT INTO admin (idAdmin, nom_complete) VALUES (61, 'EL ALLAOUI AHMAD');

INSERT INTO notifications (idPatient, message, date_envoi, statut) VALUES
(1, 'Votre rendez-vous a été confirmé.', '2024-04-25 10:00:00', 'info'),
(1, 'Vous avez un rappel de rendez-vous demain.', '2024-04-27 08:00:00', 'rappel'),

(2, 'Un nouveau dossier médical a été ajouté.', '2024-04-24 15:30:00', 'info'),
(2, 'Merci de confirmer votre présence au prochain rendez-vous.', '2024-04-26 09:00:00', 'urgent'),

(3, 'Veuillez compléter vos informations de profil.', '2024-04-23 14:45:00', 'info'),
(3, 'Votre rendez-vous a été annulé par le médecin.', '2024-04-22 17:00:00', 'urgent'),

(4, 'Votre rendez-vous avec le Dr. Karim est confirmé.', '2024-04-20 11:30:00', 'info'),
(4, 'Un nouveau message est disponible.', '2024-04-21 08:15:00', 'info'),

(5, 'Rappel : consultation demain à 14h00.', '2024-04-26 12:00:00', 'rappel'),
(5, 'Mise à jour du dossier médical effectuée.', '2024-04-23 16:00:00', 'info'),

-- Répéter pour les patients 6 à 30 avec des messages variés :
(6, 'Votre rendez-vous a été confirmé.', '2024-04-24 09:00:00', 'info'),
(6, 'Un nouveau message du médecin.', '2024-04-25 13:30:00', 'info'),
(7, 'Vous avez un rappel de rendez-vous.', '2024-04-27 08:00:00', 'rappel'),
(8, 'Nouveau document dans votre dossier médical.', '2024-04-20 10:15:00', 'info'),
(9, 'Rendez-vous annulé.', '2024-04-18 12:00:00', 'urgent'),
(10, 'Confirmation de rendez-vous envoyée.', '2024-04-22 15:45:00', 'info'),

-- ... jusqu’à :
(30, 'Votre prochain rendez-vous est confirmé.', '2024-04-25 10:00:00', 'info'),
(30, 'Vous avez un rappel pour demain.', '2024-04-27 08:00:00', 'rappel');

INSERT INTO rendezvous (idPatient, idMedcine, date_heure, statut) VALUES
(1, 59, '2025-05-26 05:40:17', 'annulé'),
(1, 36, '2025-05-24 07:40:17', 'annulé'),
(2, 44, '2025-05-29 09:40:17', 'confirmé'),
(2, 35, '2025-05-31 04:40:17', 'en attente'),
(3, 54, '2025-05-11 07:40:17', 'annulé'),
(3, 52, '2025-05-18 08:40:17', 'en attente'),
(4, 33, '2025-06-06 01:40:17', 'annulé'),
(5, 34, '2025-05-27 03:40:17', 'annulé'),
(5, 59, '2025-05-30 05:40:17', 'annulé'),
(6, 44, '2025-06-03 08:40:17', 'confirmé'),
(7, 48, '2025-05-22 02:40:17', 'annulé'),
(8, 38, '2025-06-08 02:40:17', 'annulé'),
(8, 57, '2025-05-20 04:40:17', 'en attente'),
(9, 43, '2025-05-12 02:40:17', 'annulé'),
(10, 59, '2025-05-25 05:40:17', 'en attente'),
(10, 31, '2025-06-05 03:40:17', 'annulé'),
(11, 31, '2025-05-10 05:40:17', 'confirmé'),
(12, 41, '2025-06-08 06:40:17', 'en attente'),
(13, 43, '2025-05-15 00:40:17', 'en attente'),
(13, 46, '2025-06-06 00:40:17', 'annulé'),
(14, 31, '2025-05-11 07:40:17', 'confirmé'),
(14, 44, '2025-05-19 05:40:17', 'annulé'),
(15, 33, '2025-05-12 07:40:17', 'annulé'),
(16, 31, '2025-05-17 06:40:17', 'en attente'),
(16, 39, '2025-05-14 00:40:17', 'confirmé'),
(17, 50, '2025-05-21 05:40:17', 'annulé'),
(18, 52, '2025-06-08 02:40:17', 'annulé'),
(18, 52, '2025-05-26 05:40:17', 'confirmé'),
(19, 40, '2025-05-24 00:40:17', 'confirmé'),
(20, 49, '2025-06-08 08:40:17', 'confirmé'),
(20, 46, '2025-06-04 01:40:17', 'annulé'),
(21, 56, '2025-05-16 02:40:17', 'annulé'),
(21, 58, '2025-05-13 08:40:17', 'confirmé'),
(22, 36, '2025-05-20 04:40:17', 'confirmé'),
(22, 38, '2025-05-27 09:40:17', 'en attente'),
(23, 44, '2025-06-04 06:40:17', 'confirmé'),
(24, 50, '2025-06-08 00:40:17', 'confirmé'),
(25, 33, '2025-05-14 01:40:17', 'en attente'),
(26, 42, '2025-05-28 09:40:17', 'en attente'),
(26, 44, '2025-05-12 07:40:17', 'annulé'),
(27, 52, '2025-05-28 03:40:17', 'en attente'),
(27, 56, '2025-05-23 08:40:17', 'annulé'),
(28, 49, '2025-05-20 05:40:17', 'annulé'),
(28, 52, '2025-05-26 00:40:17', 'confirmé'),
(29, 43, '2025-05-29 06:40:17', 'annulé'),
(29, 48, '2025-05-16 06:40:17', 'annulé'),
(30, 45, '2025-05-27 05:40:17', 'annulé'),
(30, 43, '2025-05-15 02:40:17', 'en attente');

INSERT INTO dossiers_medicaux (idPatient, titre, description, date_ajout) VALUES
(1, 'Consultation générale', 'Le patient présente des signes de fatigue et maux de tête fréquents.', '2024-04-01 10:30:00'),
(1, 'Ordonnance médicale', 'Prescription de vitamines et suivi à refaire dans 3 semaines.', '2024-04-15 11:00:00'),
(2, 'Résultat d\'analyse', 'Les résultats sanguins sont dans les normes sauf une légère anémie.', '2024-03-25 09:15:00'),
(3, 'Rapport de suivi', 'Réponse positive au traitement prescrit le mois dernier.', '2024-04-10 14:20:00'),
(4, 'Bilan sanguin', 'Recommandation de régime alimentaire strict.', '2024-03-12 08:45:00'),
(5, 'Contrôle annuel', 'Pas de symptôme alarmant, à suivre régulièrement.', '2024-04-18 16:00:00'),
(6, 'Lettre du spécialiste', 'Nécessite un avis cardiologique pour examen plus approfondi.', '2024-03-30 10:00:00'),
(7, 'Diagnostic', 'Antécédents d\'hypertension à surveiller de près.', '2024-04-02 12:00:00');
