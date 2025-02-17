import React, { useState } from "react";
import axios from "axios";
import { jwtDecode } from "jwt-decode";  
import Cookies from "js-cookie";  // Importar Cookies
import "./Login.css";
import logo from "../assets/img/c.png";

const Login = () => {
  const [Usuario, setUsuario] = useState("");
  const [Clave, setClave] = useState("");
  const [error, setError] = useState("");

  const handleLogin = async (e) => {
    e.preventDefault();

    try {
      console.log("📤 Datos enviados:", { Usuario, Clave });

      const response = await axios.post(
        "http://localhost/sets/backend/login.php",
        { Usuario, Clave },
        { withCredentials: true } 
      );

      console.log("📩 Respuesta del backend:", response.data);

      if (response.data.token) {
        // Guardar el token en una cookie
        Cookies.set("authToken", response.data.token, { expires: 1 });

        // Decodificar el token JWT
        const decoded = jwtDecode(response.data.token);
        const { idRol } = decoded;

 
        const rutas = {
          1: "http://localhost/sets/admin/inicioprincipal.php",
          2: "http://localhost/sets/residente/inicioprincipal.php",
          3: "http://localhost/sets/gestor_inmobiliaria/inicioprincipal.php",
          4: "http://localhost/sets/seguridad/inicioprincipal.php",
          default: "http://localhost/sets/error.html"
        };

        window.location.href = rutas[idRol] || rutas.default;
      } else {
        setError(response.data.error);
      }
    } catch (err) {
      console.error("❌ Error:", err.response?.data || err.message);
      setError(err.response?.data?.error || "Error al iniciar sesión.");
    }
  };

  return (
    <div className="container">
      <header className="text-center mb-4 d-flex flex-column align-items-center">
        <img src={logo} alt="Logo" />
        <h2 className="title">
          SETS<br />BIENVENIDO
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
            <a href="http://localhost:3000/recuperarcontrase%C3%B1a">Recuperar Contraseña</a>
            <a href="http://localhost/SETS/">Volver</a>
          </div>
        </form>
      </div>
    </div>
  );
};

export default Login;
