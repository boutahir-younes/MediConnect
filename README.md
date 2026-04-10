<div align="center">

![GitHub top language](https://img.shields.io/github/languages/top/BOUTAHIR-Younes/MediConnect?style=flat-square)
![GitHub repo size](https://img.shields.io/github/repo-size/BOUTAHIR-Younes/MediConnect?style=flat-square)

# MediConnect

**Smart Hospital Management System with AI Disease Prediction**

[![PHP](https://img.shields.io/badge/PHP-777BB4?style=flat-square&logo=php&logoColor=white)](https://php.net)
[![Python](https://img.shields.io/badge/Python-3776AB?style=flat-square&logo=python&logoColor=white)](https://python.org)
[![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat-square&logo=mysql&logoColor=white)](https://mysql.com)
[![Flask](https://img.shields.io/badge/Flask-000000?style=flat-square&logo=flask&logoColor=white)](https://flask.palletsprojects.com)
[![License](https://img.shields.io/badge/License-Academic%20PFE-blue?style=flat-square)](LICENSE)

*Final Year Project (PFE) — Moulay Ismail University, FST Errachidia · 2024/2025*

</div>

---

## Overview

MediConnect is a web-based hospital management system that integrates an intelligent disease prediction module. Built as a full-stack application, it covers patient management, appointment scheduling, medical records, and an AI-powered symptom-based diagnostic tool — all accessible through role-based dashboards.

---

## Key Features

**Patient**
- Account creation and profile management
- Online appointment booking and cancellation
- Access to personal medical records
- Public disease prediction tool (no login required)

**Doctor**
- View and manage patient appointments
- Access and update patient medical records
- Edit personal profile

**Administrator**
- Full user account management (add, update, delete)
- Hospital data supervision and oversight

---

## AI — Disease Prediction Module

The prediction system is built entirely from scratch — no Scikit-learn, no black-box frameworks.

- **Custom MLP model** implemented manually in Python (NumPy only)
- **Dataset**: 133 symptoms × 41 disease classes
- **Architecture**: Input layer → 2 hidden layers (ReLU) → Output layer (Softmax)
- **Training**: Cross-entropy loss + gradient descent, optimized at learning rate `0.01`
- **Final accuracy**: > 95% on test set
- **Preprocessing**: Label encoding, binary symptom vectorization
- **Integration**: Flask REST API consumed by the PHP frontend
- Input (133 symptoms) → Dense(64, ReLU) → Dense(32, ReLU) → Output(41 diseases, Softmax)
---

## Tech Stack

| Layer | Technologies |
|---|---|
| Frontend | HTML, CSS, JavaScript |
| Backend (Web) | PHP (procedural), MySQL |
| Backend (AI) | Python, Flask, Jupyter Notebook |
| ML Model | Custom MLP — NumPy only |
| Database | MySQL (`mediconnect.sql`) |

---

## Project Structure

```text
MediConnect/
├── App/                        # PHP web application
│   ├── index.html
│   ├── dashboard-patient.php
│   ├── dashboard-doctor.php
│   └── ...
├── prediction/                 # AI module
│   ├── main.ipynb
│   ├── server.py
│   ├── mlp_model.pkl
│   └── Data/
├── sql/
│   └── mediconnect.sql
├── .gitignore
└── README.md
```
---

## Getting Started

**1. Database setup**
```bash
mysql -u root -p < mediconnect.sql
```

**2. Web app configuration**
```php
// Set your credentials in db_connect.php
$host = "localhost";
$user = "root";
$password = "";
$database = "mediconnect";
```
Then serve the project via XAMPP or WAMP at `http://localhost/MediConnect/`

**3. Start the prediction API**
```bash
cd prediction
pip install flask numpy pandas
python server.py
# API running at http://localhost:5000
```


## Notes

- CSS is embedded directly in PHP/HTML files
- The system is designed to run locally via XAMPP/WAMP + Flask
- The prediction model can be improved with larger, clinically validated datasets

---

<div align="center">
<sub>Academic project — Licence Sciences et Techniques, Génie Logiciel · FST Errachidia · 2025</sub>
</div>
