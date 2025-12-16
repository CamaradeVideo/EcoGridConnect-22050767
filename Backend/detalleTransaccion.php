<?php
require_once "../DB/conexion.php";
$id = intval($_GET['id']);
$id_prosumidor = 1;
$id_consumidor = 3;
$stmt = $pdo->prepare("SELECT * FROM ofertas WHERE id_oferta=?");
$stmt->execute([$id]);
$oferta = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="es">

<head>
<meta charset="UTF-8">
<title>Detalle de Transacción</title>
<link rel="stylesheet" href="../Frontend/estilos.css">
</head>

<head>
<meta charset="UTF-8">
<title>Detalle de Transacción</title>
</head>

<body>
<h2>Detalle de Transacción</h2>

<p><strong>Energía:</strong> <?= $oferta['kwh'] ?> kWh</p>
<p><strong>Precio:</strong> $<?= $oferta['precio'] ?> MXN</p>

<form action="finalizarTransaccion.php" method="POST">

<input type="hidden" name="id_oferta" value="<?= $id ?>">
<input type="hidden" name="id_consumidor" value="2">

<label>Calificación (1 a 5)</label><br>
<input type="number" name="puntuacion" min="1" max="5" required><br><br>

<label>Comentario</label><br>
<input type="text" name="comentario" maxlength="20"><br><br>

<button type="submit">Finalizar Transacción</button>
</form>

</body>
</html>