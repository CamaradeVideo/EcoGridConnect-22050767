<?php
require_once "../DB/conexion.php";
$id_prosumidor = 1;
$id_consumidor = 3;
$kwh = filter_input(INPUT_POST, 'kwh', FILTER_VALIDATE_FLOAT);
$precio = filter_input(INPUT_POST, 'precio', FILTER_VALIDATE_FLOAT);
$inicio = $_POST['inicio'] ?? '';
$fin = $_POST['fin'] ?? '';
$id = intval($_POST['id_prosumidor']);

if ($kwh && $precio && strlen($inicio) <= 5 && strlen($fin) <= 5) {

    $stmt = $pdo->prepare(
        "INSERT INTO ofertas (id_prosumidor, kwh, precio, hora_inicio, hora_fin)
         VALUES (?,?,?,?,?)"
    );
    $stmt->execute([$id, $kwh, $precio, $inicio, $fin]);

    echo "<h3>Oferta publicada correctamente</h3>";
    echo "<a href='panelDeOfertas.php'>Ver ofertas</a>";
} else {
    echo "Datos inválidos";
}