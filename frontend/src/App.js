import React from "react";
import { BrowserRouter as Router, Route, Routes } from "react-router-dom";
import Login from "./components/Login";
import Registro from "./components/Registro";
import Bienvenido from "./components/Bienvenido";

function App() {
  return (
    <Router>
      <Routes>
        <Route path="/" element={<Bienvenido />} />
        <Route path="/login" element={<Login />} />
        <Route path="/registro" element={<Registro />} />
      </Routes>
    </Router>
  );
}

export default App;
