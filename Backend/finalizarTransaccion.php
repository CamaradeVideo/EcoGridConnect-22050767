<?php
require_once "../DB/conexion.php";
$id_prosumidor = 1;

$idOferta = intval($_POST['id_oferta']);
$idConsumidor = intval($_POST['id_consumidor']);
$p = intval($_POST['puntuacion']);
$c = substr($_POST['comentario'], 0, 20);
$idConsumidor = 3;
$stmt = $pdo->prepare(
    "INSERT INTO transacciones (id_oferta, id_consumidor, total)
     SELECT id_oferta, ?, (kwh * precio)
     FROM ofertas WHERE id_oferta=?"
);
$stmt->execute([$idConsumidor, $idOferta]);

$idTrans = $pdo->lastInsertId();

$stmt = $pdo->prepare(
    "INSERT INTO calificaciones (id_transaccion, puntuacion, comentario)
     VALUES (?,?,?)"
);
$stmt->execute([$idTrans, $p, $c]);

$pdo->prepare(
    "UPDATE ofertas SET estado='vendida' WHERE id_oferta=?"
)->execute([$idOferta]);

echo "<h3>Transacción finalizada correctamente</h3>";
echo "<a href='panelDeOfertas.php'>Volver al panel</a>";
