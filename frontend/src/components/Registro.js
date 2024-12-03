import React, { useState, useEffect } from "react";
import axios from "axios";
import "./registro.css";
import logo from "../assets/img/c.png";  // Cambia esta ruta si tu logo está en otro directorio

const Registro = () => {
    const [formData, setFormData] = useState({
        PrimerNombre: "",
        SegundoNombre: "",
        PrimerApellido: "",
        SegundoApellido: "",
        Correo: "",
        Usuario: "",
        Clave: "",
        Id_tipoDocumento: "",
        numeroDocumento: "",
        telefonoUno: "",
        telefonoDos: "",
        idRol: "",  // Guardamos el rol como un valor numérico
    });

    const [tipodocs, setTipodocs] = useState([]);  // Estado para los tipos de documento
    const [roles, setRoles] = useState([]);  // Estado para los roles
    const [mensaje, setMensaje] = useState("");

    // Fetch datos de la API cuando el componente se monta
    useEffect(() => {
        const fetchData = async () => {
            try {
                // Solicitar roles desde el endpoint correspondiente
                const rolResponse = await axios.get("http://localhost/sets/backend/regi.php?tipo=roles");
                console.log("Roles:", rolResponse.data);  // Ver la respuesta de roles
                setRoles(rolResponse.data);

                // Solicitar tipos de documentos desde el endpoint correspondiente
                const tipoDocResponse = await axios.get("http://localhost/sets/backend/regi.php?tipo=tipodocs");
                console.log("Tipo de documentos:", tipoDocResponse.data);  // Ver la respuesta de tipos de documentos
                setTipodocs(tipoDocResponse.data);
            } catch (error) {
                setMensaje("Error al cargar los datos.");
                console.error("Error al cargar los datos:", error);
            }
        };

        fetchData();
    }, []);  // Este efecto se ejecuta solo una vez al montar el componente

    const handleChange = (e) => {
        setFormData({ ...formData, [e.target.name]: e.target.value });
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        console.log("Datos enviados:", formData);  // Log de los datos enviados

        try {
            const response = await axios.post(
                "http://localhost/sets/backend/regi.php",
                formData,
                {
                    headers: { "Content-Type": "application/json" },
                }
            );
            setMensaje(response.data.message);

            // Redirigir según el rol
            if (formData.idRol === "1") {
                window.location.href = "http://localhost/sets/admin/BIENVENIDOADMI.php";
            } else if (formData.idRol === "4") {
                window.location.href = "http://localhost/sets/residente/BIENVENIDORESIDENTE.php";
            } else if (formData.idRol === "2") {
                window.location.href = "http://localhost/sets/gestor_inmobiliaria/BIENVENIDOADMINISTRADOR.php";
            } else if (formData.idRol === "3") {
                window.location.href = "http://localhost/sets/seguridad/BIENVENIDOGUARDA.php";
            } else {
                window.location.href = "http://localhost/SETS/error.html";
            }

            // Limpiar el formulario
            setFormData({
                PrimerNombre: "",
                SegundoNombre: "",
                PrimerApellido: "",
                SegundoApellido: "",
                Correo: "",
                Usuario: "",
                Clave: "",
                Id_tipoDocumento: "",
                numeroDocumento: "",
                telefonoUno: "",
                telefonoDos: "",
                idRol: "", // Limpiar también el rol
            });
        } catch (error) {
            setMensaje(error.response?.data?.error || "Error al registrar el usuario.");
        }
    };


    return (
        <div>
            <br /> <p /><p />
            <br /> <p /><p />
            <br /> <p /><p />
            <header className="text-center mb-4 d-flex flex-column align-items-center">
                <img src={logo} alt="Logo" /><br /> <p /><p />
                <h2 className="title">SETS<br />BIENVENIDO</h2>
            </header>

            <h2>Registro de Usuario</h2>

            {mensaje && <p>{mensaje}</p>}

            <form onSubmit={handleSubmit}>
                {/* Campo para Rol */}
                <select
                    name="idRol"
                    value={formData.idRol}
                    onChange={handleChange}
                    required
                >
                    <option value="">Seleccionar Rol</option>
                    {roles.map((role) => (
                        <option key={role.id} value={role.id}>
                            {role.Roldescripcion}
                        </option>
                    ))}
                </select>

                {/* Campo adicional para seleccionar el número del rol (se envía el mismo id del rol) */}
                <label htmlFor="idRol">Ingresa el número del Rol:</label>
                <input
                    type="number"
                    id="idRol"
                    name="idRol"
                    onChange={handleChange}
                    placeholder="Ingresa el numero del Rol  "
                    required
                />

                {/* Otros campos de formulario */}
                <input
                    type="text"
                    name="PrimerNombre"
                    placeholder="Primer Nombre"
                    value={formData.PrimerNombre}
                    onChange={handleChange}
                    required
                />
                <input
                    type="text"
                    name="SegundoNombre"
                    placeholder="Segundo Nombre"
                    value={formData.SegundoNombre}
                    onChange={handleChange}
                />
                <input
                    type="text"
                    name="PrimerApellido"
                    placeholder="Primer Apellido"
                    value={formData.PrimerApellido}
                    onChange={handleChange}
                    required
                />
                <input
                    type="text"
                    name="SegundoApellido"
                    placeholder="Segundo Apellido"
                    value={formData.SegundoApellido}
                    onChange={handleChange}
                />
                <input
                    type="email"
                    name="Correo"
                    placeholder="Correo"
                    value={formData.Correo}
                    onChange={handleChange}
                    required
                />
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

                {/* Campo para Tipo de Documento */}
                <select
                    name="Id_tipoDocumento"
                    value={formData.Id_tipoDocumento}
                    onChange={handleChange}
                    required
                >
                    <option value="">Seleccionar Tipo de Documento</option>
                    {tipodocs.map((doc) => (
                        <option key={doc.idtDoc} value={doc.idtDoc}>
                            {doc.descripcionDoc}
                        </option>
                    ))}
                </select>

                <input
                    type="number"
                    name="numeroDocumento"
                    placeholder="Número de Documento"
                    value={formData.numeroDocumento}
                    onChange={handleChange}
                    required
                />
                <input
                    type="number"
                    name="telefonoUno"
                    placeholder="Teléfono 1"
                    value={formData.telefonoUno}
                    onChange={handleChange}
                    required
                />
                <input
                    type="number"
                    name="telefonoDos"
                    placeholder="Teléfono 2"
                    value={formData.telefonoDos}
                    onChange={handleChange}
                />

                <button type="submit">Registrar</button>
            </form>

            <div className="d-flex justify-content-between">
                <a href="http://localhost:3000/login">Iniciar Sesion</a>
                <a href="http://localhost/SETS/recuperarcontrase%C3%B1a.php">Recuperar Contraseña</a>
                <a href="http://localhost/SETS/">Volver</a>
            </div>
        </div>
    );
};

export default Registro;