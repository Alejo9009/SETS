function updateTimeStep(opcion, horaInput) {
  const stepValue = getStepValue(opcion);
  horaInput.step = stepValue;
}

function getStepValue(opcion) {
  switch (opcion) {
    case "Administrativo":
      return "3600"; // 1 hora en segundos
    case "Reclamo":
      return "1800"; // 30 minutos en segundos
    case "Duda":
      return "600"; // 10 minutos en segundos
    default:
      return "3600"; // Valor por defecto
  }
}

function init() {
  const opcionSelect = document.getElementById("opcion");
  const dateInput = document.getElementById("fecha");
  const horaInput = document.getElementById("hora");
  const today = new Date().toISOString().split("T")[0];

  dateInput.setAttribute("min", today);

  opcionSelect.addEventListener("change", () =>
    updateTimeStep(opcionSelect.value, horaInput)
  );

  dateInput.addEventListener("input", function (e) {
    var day = new Date(this.value).getUTCDay();
    if ([6, 0].includes(day)) {
      e.preventDefault();
      this.value = "";
      alert("Los fines de semana no son permitidos");
    }
  });
}

document.addEventListener("DOMContentLoaded", init);
