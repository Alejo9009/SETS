import React, { useState, useEffect } from "react";
import axios from "axios";

const Login = () => {
    const [formData, setFormData] = useState({
        Usuario: "",
        Clave: "",
    });

    const [mensaje, setMensaje] = useState("");
    const [cookiesValidas, setCookiesValidas] = useState(false);

    // Verificar cookies al cargar la página
    useEffect(() => {
        const verificarCookies = async () => {
            try {
                const response = await axios.get("http://localhost/sets/backend/login.php", {
                    withCredentials: true,
                });

                if (response.data.mensaje === "Sesión válida, por favor ingrese su contraseña para continuar") {
                    setCookiesValidas(true); // Cookies válidas, pero necesita confirmar la contraseña
                } else {
                    setCookiesValidas(false); // Las cookies no son válidas
                }
            } catch (error) {
                console.error("Error al verificar cookies:", error);
                setMensaje("Error al verificar la sesión.");
            }
        };

        verificarCookies();
    }, []);

    const handleChange = (e) => {
        const { name, value } = e.target;
        setFormData({ ...formData, [name]: value });
    };

    const handleSubmit = async (e) => {
        e.preventDefault();

        if (!formData.Usuario || !formData.Clave) {
            setMensaje("Por favor, ingrese usuario y contraseña.");
            return;
        }

        try {
            const response = await axios.post("http://localhost/sets/backend/login.php", formData, {
                withCredentials: true,
            });

            if (response.data.redirect) {
                window.location.href = `http://localhost/sets/${response.data.redirect}`;
            } else {
                setMensaje(response.data.error || "Error al iniciar sesión.");
            }
        } catch (error) {
            console.error("Error al iniciar sesión:", error);
            setMensaje("Error al intentar iniciar sesión.");
        }
    };

    return (
      <div className="container">
      <br /> <p /><p />
      <header className="text-center mb-4 d-flex flex-column align-items-center">

          <h1 className="title"><b>SETS<br />BIENVENIDO</b></h1>
      </header>
            {cookiesValidas && (
                <p>Se detectó una sesión previa. Por favor, ingrese su contraseña para confirmar.</p>
            )}
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
                    placeholder="Clave"
                    value={formData.Clave}
                    onChange={handleChange}
                    required
                />
                <button type="submit">Iniciar sesión</button>
            </form>
            {mensaje && <p className="error">{mensaje}</p>}
            <div className="d-flex justify-content-between">
                <a href="http://localhost:3000/registro" className="r" >Registro</a>
                <a href="http://localhost/SETS/recuperarcontrase%C3%B1a.php" className="e">Recuperar Contraseña</a>
                <a href="http://localhost/SETS/" className="r" >Volver</a>
            </div>
        </div>
        
    );
};

export default Login;
