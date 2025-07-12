#  MediConnect

**MediConnect** is a web-based **hospital management system** that integrates an intelligent **disease prediction feature** using a manually implemented **MLP (Multi-Layer Perceptron)** model.

---

##  Project Objectives

- Optimize the management of patients, doctors, appointments, and medical records.
- Provide user-friendly interfaces for each type of user (patient, doctor, administrator).
- Offer a public AI-powered symptom-based disease prediction tool.

---

##  Artificial Intelligence

The prediction system is based on:

- A **custom MLP model** (built manually without Scikit-learn).
- Training and preprocessing done in **Jupyter Notebook**.
- Encoded datasets using a label encoder (`encoder.pkl`).
- Integration with a simple HTML interface via **Flask backend** (`server.py`).

The model uses a reduced dataset to predict the most likely disease based on selected symptoms.

---

##  Main Features

### Patient
- Account creation and profile management
- Book and cancel appointments
- Access medical records
- Public symptom-based disease prediction (no login required)

###  Doctor
- View and manage appointments
- Access and update patient data
- Edit personal profile

###  Administrator
- Manage all user accounts (add, update, delete doctors and patients)
- Supervise hospital data

---

##  Technologies Used

| Category         | Technologies                                                   |
|------------------|----------------------------------------------------------------|
| Frontend         | HTML, CSS (inline in PHP files), basic JS                      |
| Backend (Web)    | Procedural PHP, MySQL                                          |
| Backend (ML)     | Python, Flask, Jupyter Notebook                                |
| Machine Learning | Manually implemented MLP model (no Scikit-learn)               |
| Database         | MySQL (`mediconnect.sql`)                                      |

---
##  Project Structure

est ce que poster tous ca : MediConnect/
├── ajouter-medecin.php
├── ajouter-patient.php
├── dashboard-admin.php
├── dashboard-doctor.php
├── dashboard-patient.php
├── db_connect.php
├── dossier_traitement.php
├── dossiers.php
├── medecin.php
├── login.php
├── logout.php
├── medecins-admin.php
├── modifier-medecin.php
├── modifier-patient.php
├── patients.php
├── patients-admin.php
├── planning.php
├── profil.php
├── register.php
├── rendezvous.php
├── rendezvous_traitement.php
├── supprimer-medecin.php
├── updte_profil.php
├── index.html (Home page)
├── script.js
├── 12 images used across the project
├── mediconnect.sql
├── prediction/
│ ├── main.ipynb
│ ├── server.py
│ ├── mlp_model.pkl
│ ├── encoder.pkl
│ ├── Data/
│ │ ├── dataset.csv
│ │ ├── symptoms.json
│ │ └── disease_labels.json
│ └── templates/
│ └── index.html (prediction UI)
└── README.md

yaml
Copy
Edit

---

##  How to Run the Project

1. Clone the repository:
   ```bash
   git clone https://github.com/boutahir-younes/MediConnect.git
Import mediconnect.sql into your MySQL server.

Set your database credentials in db_connect.php.

Run the Flask server:

bash
Copy
Edit
cd prediction
python server.py
Open the app in your browser:

PHP interfaces: http://localhost/MediConnect/...

Prediction tool: http://localhost:5000

 Authors
Younes Boutahir – Bachelor of Software Engineering – FST Errachidia

(Add your teammate's name if applicable)

 License
Academic project developed as part of the Final Year Project (PFE) — Moulay Ismail University, FST Errachidia, 2025.

📌 Notes
CSS is written directly inside the PHP/HTML files.

The system is intended to run locally using XAMPP/WAMP and Flask.

The prediction model can be enhanced with richer and validated medical datasets.

yaml
Copy
Edit

---

Would you like me to generate and send this `README.md` file directly to you (in `.md` f

