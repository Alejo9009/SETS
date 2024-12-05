import React, { useState } from "react";
import axios from "axios";
import "./Login.css";
import logo from "../assets/img/c.png";

const Login = () => {
  const [Usuario, setUsuario] = useState("");
  const [Clave, setClave] = useState("");
  const [error, setError] = useState("");

  const handleLogin = async (e) => {
    e.preventDefault();

    try {
      const response = await axios.post("http://localhost/sets/backend/login.php", { Usuario, Clave });

      if (response.data.success) {
        const { token, roles } = response.data;

        if (token) {
          localStorage.setItem("token", token);
        }

        if (roles.includes("admin")) {
          window.location.href =
            "http://localhost/sets/admin/BIENVENIDOADMI.php";
        } else if (roles.includes("residente")) {
          window.location.href =
            "http://localhost/sets/residente/BIENVENIDORESIDENTE.php";
        } else if (roles.includes("Gestor de Inmobiliaria")) {
          window.location.href =
            "http://localhost/sets/gestor_inmobiliaria/BIENVENIDOADMINISTRADOR.php";
        } else if (roles.includes("Guarda de Seguridad")) {
          window.location.href =
            "http://localhost/sets/seguridad/BIENVENIDOGUARDA.php";
        } else {
          window.location.href = "http://localhost/SETS/error.html";
        }
      } else {
        setError(response.data.error || "Error al iniciar sesión.");
      }
    } catch (err) {
      setError(err.response?.data?.error || "Error al iniciar sesión.");
    }
  };

  return (
    <div className="container">
      <header className="text-center mb-4 d-flex flex-column align-items-center">
        <img src={logo} alt="Logo" />
        <br />
        <h2 className="title">
          SETS
          <br />
          BIENVENIDO
        </h2>
      </header>
      <div className="login-container">
        <form onSubmit={handleLogin}>
          <h2>Iniciar Sesión</h2>
          <div>
            <label>Usuario:</label>
            <input
              type="text"
              value={Usuario}
              onChange={(e) => setUsuario(e.target.value)}
              required
              autoComplete="username" 
            />
          </div>
          <div>
            <label>Clave:</label>
            <input
              type="password"
              value={Clave}
              onChange={(e) => setClave(e.target.value)}
              required
              autoComplete="current-password" 
            />
          </div>
          {error && <p style={{ color: "red" }}>{error}</p>}
          <button type="submit">Ingresar</button>
          <div className="d-flex justify-content-between">
            <a href="http://localhost:3000/registro">Registrarse</a>
            <a href="http://localhost/SETS/recuperarcontrase%C3%B1a.php">
              Recuperar Contraseña
            </a>
            <a href="http://localhost/SETS/">Volver</a>
          </div>
        </form>
      </div>
    </div>
  );
};

export default Login;
