const estudiantes = [
    { nombre: 'Juan', apellido: 'Avila', nota: 70 },
    { nombre: 'Karol', apellido: 'Vega', nota: 99 },
    { nombre: 'Carlos', apellido: 'Martinez', nota: 85 },
    { nombre: 'Vanesa', apellido: 'Rojas', nota: 65 }
];

let resultado = '';
let totalNotas = 0;

estudiantes.forEach((estudiante) => {
    resultado += `<p>${estudiante.nombre} ${estudiante.apellido}</p>`;
    totalNotas += estudiante.nota;
});

const promedio = totalNotas / estudiantes.length;
resultado += `<p>Promedio de notas: ${promedio}</p>`;

document.getElementById('listaEstudiantes').innerHTML = resultado;