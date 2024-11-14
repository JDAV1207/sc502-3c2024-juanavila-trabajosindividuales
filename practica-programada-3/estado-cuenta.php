<?php
$transacciones = [];

function registrarTransaccion($id, $descripcion, $monto) {
    global $transacciones;
    $transaccion = [
        'id' => $id,
        'descripcion' => $descripcion,
        'monto' => $monto
    ];
    array_push($transacciones, $transaccion);
}

function generarEstadoDeCuenta() {
    global $transacciones;
    
    $montoContado = 0;

    foreach ($transacciones as $transaccion) {
        $montoContado += $transaccion['monto'];
    }

    $interes = 0.026;
    $montoConInteres = $montoContado * (1 + $interes);
    $cashBack = $montoContado * 0.001;

    $montoFinal = $montoConInteres - $cashBack;

    echo "<h2>Estado de Cuenta</h2>";
    echo PHP_EOL;
    echo "<table border='1'>";
    echo PHP_EOL;
    echo "<tr><th>ID</th><th>Descripción</th><th>Monto</th></tr>";
    echo PHP_EOL;
    foreach ($transacciones as $transaccion) {
        echo "<tr><td>{$transaccion['id']}</td><td>{$transaccion['descripcion']}</td><td>₡{$transaccion['monto']}</td></tr>";
        echo PHP_EOL;
    }
    echo "</table>";
    echo PHP_EOL;
    echo "<p><strong>Monto Total de Contado:</strong> ₡{$montoContado}</p>";
    echo PHP_EOL;
    echo "<p><strong>Monto Total con Interés (2.6%):</strong> ₡{$montoConInteres}</p>";
    echo PHP_EOL;
    echo "<p><strong>Cash Back (0.1%):</strong> ₡{$cashBack}</p>";
    echo PHP_EOL;
    echo "<p><strong>Monto Final a Pagar:</strong> ₡{$montoFinal}</p>";
    echo PHP_EOL;

    $contenidoArchivo = "Estado de Cuenta\n";
    $contenidoArchivo .= "-----------------\n";
    foreach ($transacciones as $transaccion) {
        $contenidoArchivo .= "ID: {$transaccion['id']}, Descripción: {$transaccion['descripcion']}, Monto: ₡{$transaccion['monto']}\n";
    }
    $contenidoArchivo .= "\nMonto Total de Contado: ₡{$montoContado}\n";
    $contenidoArchivo .= "Monto Total con Interés (2.6%): ₡{$montoConInteres}\n";
    $contenidoArchivo .= "Cash Back (0.1%): ₡{$cashBack}\n";
    $contenidoArchivo .= "Monto Final a Pagar: ₡{$montoFinal}\n";

    $archivo = fopen("estado_cuenta.txt","w") or die("NO se puede abrir el archivo");
    fwrite($archivo, $contenidoArchivo);
    echo "<p>El estado de cuenta ha sido guardado en 'estado_cuenta.txt'.</p>";
}

registrarTransaccion(1, "Compra en Cine", 7000);
registrarTransaccion(2, "Pago de Telefono", 20000);
registrarTransaccion(3, "Renta de Carro", 150000);
registrarTransaccion(4, "Pago de Grua", 100000);

generarEstadoDeCuenta();