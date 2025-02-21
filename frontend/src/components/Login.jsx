import React, { useState } from "react";
import axios from "axios";
import { useNavigate } from "react-router-dom";
import Cookies from "js-cookie";
import "./Login.css";
import logo from "../assets/img/c.png";

const Login = () => {
    const [formData, setFormData] = useState({
        Usuario: "",
        Clave: "",
    });
    const [mensaje, setMensaje] = useState("");
    const navigate = useNavigate();

    const handleChange = (e) => {
        const { name, value } = e.target;
        setFormData({ ...formData, [name]: value });
    };

    const handleSubmit = async (e) => {
        e.preventDefault();

        try {
            const response = await axios.post(
                "http://localhost/sets/backend/login.php",
                formData,
                {
                    headers: { "Content-Type": "application/json" },
                    withCredentials: true,
                }
            );

            const { redirect, token } = response.data;

            if (token) {
                Cookies.set("token", token, { expires: 1 }); // Almacenar el token en una cookie
            }

            if (redirect) {
                const rutas = {
                    1111: "/admin",
                    2222: "/seguridad",
                    3333: "/residente",
                    4444: "/dueño",
                    error: "/error",
                };
                navigate(rutas[redirect] || rutas["error"]);
            }
        } catch (error) {
            setMensaje(error.response?.data?.error || "Error al iniciar sesión.");
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
        
            <h2>Iniciar Sesión</h2>
            <form onSubmit={handleSubmit}>
                <input
                    type="text"
                    name="Usuario"
                    placeholder="Usuario"
                    value={formData.Usuario}
                    onChange={handleChange}
                    required
                />
                <input
                    type="password"
                    name="Clave"
                    placeholder="Contraseña"
                    value={formData.Clave}
                    onChange={handleChange}
                    required
                />
                <button type="submit">Iniciar Sesión</button>
            </form>
            {mensaje && <p className="error">{mensaje}</p>}
            <div className="d-flex justify-content-between">
            <a href="http://localhost:3000/registro">Registrarse</a>
            <a href="http://localhost:3000/recuperarcontrase%C3%B1a">Recuperar Contraseña</a>
            <a href="http://localhost/SETS/">Volver</a>
          </div>
        </div>
    );
};

export default Login;