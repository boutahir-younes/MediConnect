from flask import Flask, request, jsonify, render_template, send_from_directory
import numpy as np
import json
import pickle

# --- Load model parameters from .pkl ---
with open("ressource/mlp_parametres.pkl", "rb") as f:
    parametres = pickle.load(f)

# --- Load the one-hot encoder ---
with open("ressource/encoder.pkl", "rb") as f:
    encoder = pickle.load(f)

# --- Softmax and forward propagation ---
def softmax(x):
    expX = np.exp(x - np.max(x, axis=0, keepdims=True))
    return expX / expX.sum(axis=0, keepdims=True)

def forward_propagation(X, parametres):
    activations = {'A0': X}
    C = len(parametres) // 2
    for c in range(1, C + 1):
        Z = parametres['W' + str(c)] @ activations['A' + str(c - 1)] + parametres['b' + str(c)]
        A = softmax(Z) if c == C else 1 / (1 + np.exp(-Z))  # softmax for final layer
        activations['A' + str(c)] = A
    return activations

# --- Prediction function ---
def predict_single_disease(x_single, parametres, encoder):
    x_single = np.array(x_single).reshape(-1, 1)
    activations = forward_propagation(x_single, parametres)
    C = len(parametres) // 2
    Af = activations['A' + str(C)]
    predicted_index = np.argmax(Af, axis=0)[0]
    predicted_class = encoder.categories_[0][predicted_index]
    return predicted_class

# --- Flask app setup ---
server = Flask(__name__)

@server.route("/")
def home():
    return render_template("index.html")

@server.route("/predict", methods=["POST"])
def predict():
    try:
        data = request.get_json()
        x_input = data["features"]
        prediction = predict_single_disease(x_input, parametres, encoder)
        return jsonify({"prediction": prediction})
    except Exception as e:
        return jsonify({"error": str(e)}), 400

# --- Serve static files from /ressource folder ---
@server.route('/ressource/<path:filename>')
def serve_ressource(filename):
    return send_from_directory('ressource', filename)

if __name__ == "__main__":
    server.run(debug=True)
