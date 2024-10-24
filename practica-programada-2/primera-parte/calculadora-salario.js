function calcularSalario() {
    const salarioBruto = parseFloat(document.getElementById("salarioBruto").value);

    if (isNaN(salarioBruto) || salarioBruto <= 0) {
        alert("Por favor, ingrese un salario válido.");
        return;
    }

    const porcentajeCargasSociales = 0.1067;
    const cargasSociales = salarioBruto * porcentajeCargasSociales;

    let impuestoRenta = 0;
    let impuestoAplicado = [];

    if (salarioBruto > 4783000) {
        impuestoRenta += (salarioBruto - 4783000) * 0.25;
        impuestoRenta += (4783000 - 2392000) * 0.20;
        impuestoRenta += (2392000 - 1363000) * 0.15;
        impuestoRenta += (1363000 - 929000) * 0.10;
        impuestoAplicado.push("25% (sobre el excedente de ₡4,783,000)");
        impuestoAplicado.push("20% (sobre el rango de ₡2,392,000 a ₡4,783,000)");
        impuestoAplicado.push("15% (sobre el rango de ₡1,363,000 a ₡2,392,000)");
        impuestoAplicado.push("10% (sobre el rango de ₡929,000 a ₡1,363,000)");
    } else if (salarioBruto > 2392000) {
        impuestoRenta += (salarioBruto - 2392000) * 0.20;
        impuestoRenta += (2392000 - 1363000) * 0.15;
        impuestoRenta += (1363000 - 929000) * 0.10;
        impuestoAplicado.push("20% (sobre el rango de ₡2,392,000 a ₡4,783,000)");
        impuestoAplicado.push("15% (sobre el rango de ₡1,363,000 a ₡2,392,000)");
        impuestoAplicado.push("10% (sobre el rango de ₡929,000 a ₡1,363,000)");
    } else if (salarioBruto > 1363000) {
        impuestoRenta += (salarioBruto - 1363000) * 0.15;
        impuestoRenta += (1363000 - 929000) * 0.10;
        impuestoAplicado.push("15% (sobre el rango de ₡1,363,000 a ₡2,392,000)");
        impuestoAplicado.push("10% (sobre el rango de ₡929,000 a ₡1,363,000)");
    } else if (salarioBruto > 929000) {
        impuestoRenta += (salarioBruto - 929000) * 0.10;
        impuestoAplicado.push("10% (sobre el rango de ₡929,000 a ₡1,363,000)");
    }

    const salarioNeto = salarioBruto - cargasSociales - impuestoRenta;

    document.getElementById("resultados").innerHTML = 
    `
        <p>Salario Bruto: ₡${salarioBruto.toFixed(2)}</p>
        <p>Cargas Sociales (10.67%): ₡${cargasSociales.toFixed(2)}</p>
        <p>Impuesto sobre la Renta: ₡${impuestoRenta.toFixed(2)}</p>
        <p>Impuestos Aplicados: ${impuestoAplicado.join(", ")}</p>
        <p>Salario Neto: ₡${salarioNeto.toFixed(2)}</p>
    `;
}
