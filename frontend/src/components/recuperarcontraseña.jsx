import React, { useState } from "react";
import "./Login.css";
import logo from "../assets/img/c.png";

const RecuperarContraseña = () => {
  const [correo, setCorreo] = useState("");

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      const response = await fetch("http://localhost:3000/recuperar.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ correo }),
      });
      const data = await response.json();
      console.log(data);
    } catch (error) {
      console.error("Error:", error);
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
              value="Enviar"
            />
            <div className="d-flex justify-content-between">
              <a href="http://localhost:3000/login" className="r">
                Iniciar Sesion
              </a>
             
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
