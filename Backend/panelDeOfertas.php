<?php
require_once "../DB/conexion.php";
$id_prosumidor = 1;
$id_consumidor = 3;
$precioMax = $_GET['precio'] ?? 999;

$stmt = $pdo->prepare(
    "SELECT o.*, u.nombre 
     FROM ofertas o
     JOIN usuarios u ON o.id_prosumidor = u.id_usuario
     WHERE o.estado='disponible' AND o.precio <= ?"
);
$stmt->execute([$precioMax]);
$ofertas = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Panel de Ofertas</title>

<head>
<meta charset="UTF-8">
<title>Panel de Ofertas</title>
<link rel="stylesheet" href="../Frontend/estilos.css">
</head>

</head>

<body>
<h2>EcoGrid Connect</h2>
<h3>Panel de Ofertas Disponibles</h3>

<form method="GET">
  <label>Precio máximo (MXN)</label>
  <input type="number" name="precio" step="0.01">
  <button type="submit">Filtrar</button>
</form>

<br>

<table border="1" cellpadding="5">
<tr>
  <th>Prosumidor</th>
  <th>kWh</th>
  <th>Precio</th>
  <th>Horario</th>
  <th>Acción</th>
</tr>

<?php foreach ($ofertas as $o): ?>
<tr>
  <td><?= htmlspecialchars($o['nombre']) ?></td>
  <td><?= $o['kwh'] ?></td>
  <td>$<?= $o['precio'] ?></td>
  <td><?= $o['hora_inicio'] ?> - <?= $o['hora_fin'] ?></td>
  <td>
    <a href="detalleTransaccion.php?id=<?= $o['id_oferta'] ?>">Comprar</a>
  </td>
</tr>
<?php endforeach; ?>
</table>

<br>
<a href="../Frontend/publicarNuevaOferta.html">Publicar nueva oferta</a>

</body>
</html>
