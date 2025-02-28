import React, { useState } from "react";
import "./Login.css";
import logo from "../assets/img/c.png";
import { useNavigate } from "react-router-dom";

const RecuperarContraseña = () => {
  const [correo, setCorreo] = useState("");
  const [mensaje, setMensaje] = useState("");
  const [cargando, setCargando] = useState(false);
  const navigate = useNavigate();

  const handleSubmit = async (e) => {
    e.preventDefault();
    setCargando(true);
    setMensaje("");

    try {
      const response = await fetch("http://localhost/sets/backend/recuperarcontrsena.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ correo }),
      });

      const data = await response.json();

      if (response.ok) {
        setMensaje(data.mensaje);
        // Redirigir a la página de cambio de contraseña con el token
        navigate(`/cambiar-contrasena?token=${data.token}`);
      } else {
        setMensaje(data.error || "Error al procesar la solicitud.");
      }
    } catch (error) {
      setMensaje("Error de conexión. Inténtalo de nuevo más tarde.");
    } finally {
      setCargando(false);
    }
  };

  return (
    <main>
      <section className="container">
        <article className="login-content">
          <form onSubmit={handleSubmit}>
            <figure>
              <img src={logo} alt="Logo" />
            </figure>
            <h2 className="title"><b>Recuperar Contraseña</b></h2>
            <div className="input-div one">
              <div className="div">
                <input
                  type="email"
                  className="input"
                  name="correo"
                  required
                  placeholder="Correo"
                  value={correo}
                  onChange={(e) => setCorreo(e.target.value)}
                />
              </div>
            </div>
            <input
              type="submit"
              className="btn btn-success btn-lg"
              value={cargando ? "Enviando..." : "Enviar"}
              disabled={cargando}
            />
            {mensaje && <p className="mensaje">{mensaje}</p>}
            <div className="d-flex justify-content-between">
              <a href="http://localhost:3000/login" className="r">
                Iniciar Sesion
              </a>
              <a href="http://localhost:3000/registro">Registrarse</a>
              <a href="http://localhost/SETS/" className="r">
                Volver
              </a>
            </div>
          </form>
        </article>
      </section>
    </main>
  );
};

export default RecuperarContraseña;