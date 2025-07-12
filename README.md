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



