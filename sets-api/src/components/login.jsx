import React, { useState } from 'react';
import axios from 'axios';

const Login = () => {
    const [usuario, setUsuario] = useState('');
    const [clave, setClave] = useState('');
    const [mensaje, setMensaje] = useState('');

    const handleSubmit = async (e) => {
        e.preventDefault();

        try {
            const response = await axios.post('http://localhost/sets/backend/login.php', {
                usuario,
                clave,
            });

            const data = response.data;

            if (data.success) {
                setMensaje('Inicio de sesión exitoso');

                // Redirigir según el rol (la redirección se maneja desde PHP)
            } else {
                setMensaje(data.message);
            }
        } catch (error) {
            setMensaje('Error de conexión con el servidor');
        }
    };

    return (
        <div className="login-container">
            <h1>Iniciar Sesión</h1>
            <form onSubmit={handleSubmit}>
                <input
                    type="text"
                    placeholder="Usuario"
                    value={usuario}
                    onChange={(e) => setUsuario(e.target.value)}
                    required
                />
                <input
                    type="password"
                    placeholder="Contraseña"
                    value={clave}
                    onChange={(e) => setClave(e.target.value)}
                    required
                />
                <button type="submit">Iniciar Sesión</button>
            </form>
            {mensaje && <p>{mensaje}</p>}
        </div>
    );
};

export default Login;
