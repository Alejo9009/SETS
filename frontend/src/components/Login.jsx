import React, { useState } from "react";
import axios from "axios";

const Login = () => {
  const [Usuario, setUsuario] = useState("");
  const [Clave, setClave] = useState("");
  const [error, setError] = useState("");

  const handleLogin = async (e) => {
    e.preventDefault();
    console.log("Datos enviados:", { Usuario, Clave }); 
    try {
      const response = await axios.post("http://localhost/sets/backend/login.php", {
        Usuario,
        Clave,
      });
      const { roles } = response.data;

      if (roles.includes("admin")) {
        window.location.href = "http://localhost/sets/admin/inicioprincipal.php";
      } else if (roles.includes("residente")) {
        window.location.href = "http://localhost/sets/residente/inicioprincipal.php";
      } else if (roles.includes("Gestor de Imobiliaria")) {
        window.location.href = "http://localhost/sets/gestor_inmobiliaria/inicioprincipal.php";
      } else if (roles.includes("Guarda de Seguridad")) {
        window.location.href = "http://localhost/SETS/seguridad/inicioprincipal.php";
      } else {
        window.location.href = "http://localhost/SETS/error.html";
      }
    } catch (err) {
      setError(err.response?.data?.error || "Error al iniciar sesión.");
    }
  };
  return (
    <div className="container">
      {/* Encabezado con logo y título */}
      <header className="text-center mb-4 d-flex flex-column align-items-center">
    <br /> <p /><p />
        <h2 className="title">SETS<br />BIENVENIDO</h2>
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
            />
          </div>
          <div>
            <label>Clave:</label>
            <input
              type="password"
              value={Clave}
              onChange={(e) => setClave(e.target.value)}
              required
            />
          </div>
          {error && <p style={{ color: "red" }}>{error}</p>}
          <button type="submit">Ingresar</button>
          <div className="d-flex justify-content-between">
            <a href="http://localhost:3000/registro">Registrarse</a>
            <a href="http://localhost/SETS/recuperarcontrase%C3%B1a.php">Recuperar Contraseña</a>
            <a href="http://localhost/SETS/">Volver</a>
          </div>
        </form>
      </div>
    </div>
  );
};

export default Login;
