<?php
// Parámetros de conexión: vienen de las variables de entorno del contenedor
$dbHost     = getenv('DB_HOST');
$dbUser     = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$dbName     = getenv('DB_NAME');

mysqli_report(MYSQLI_REPORT_OFF);
$conn = @new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

if ($conn->connect_errno) {
    http_response_code(503);
    exit('Error: no se pudo conectar a la base de datos de la veterinaria.');
}

$conn->set_charset('utf8mb4');
$result = $conn->query('SELECT id, nombre, especie, estado FROM pacientes ORDER BY id');

if (!$result) {
    http_response_code(500);
    exit('Error al consultar la tabla pacientes.');
}

$pacientes = $result->fetch_all(MYSQLI_ASSOC);
$conn->close();

function h($valor) {
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Veterinaria - Pacientes</title>
  <style>
    body { font-family: sans-serif; margin: 2rem; }
    table { border-collapse: collapse; }
    th, td { border: 1px solid #ccc; padding: .5rem 1rem; text-align: left; }
    th { background: #eee; }
  </style>
</head>
<body>
  <h1>Pacientes de la Veterinaria</h1>
  <p>Total de pacientes: <strong id="total"><?= count($pacientes) ?></strong></p>
  <table>
    <tr><th>ID</th><th>Nombre</th><th>Especie</th><th>Estado</th></tr>
    <?php foreach ($pacientes as $p): ?>
    <tr class="paciente">
      <td><?= h($p['id']) ?></td>
      <td><?= h($p['nombre']) ?></td>
      <td><?= h($p['especie']) ?></td>
      <td><?= h($p['estado']) ?></td>
    </tr>
    <?php endforeach; ?>
  </table>
</body>
</html>
