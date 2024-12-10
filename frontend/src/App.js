import React from "react";
import { BrowserRouter as Router, Route, Routes } from "react-router-dom";
import Login from "./components/Login";
import Registro from "./components/Registro";
import Redirect from "./components/Redirect"; // Importa el componente de redirección


function App() {
  return (
    <Router>
      <Routes>
        <Route path="/" element={<Redirect />} /> {/* Redirige a /SETS */}
        <Route path="/login" element={<Login />} />
        <Route path="/registro" element={<Registro />} />
      </Routes>
    </Router>
  );
}

export default App;
