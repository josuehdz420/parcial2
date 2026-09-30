<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Préstamos</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <div class="contenedor-listado">
        <h2>Listado de Préstamos Registrados</h2>
        
        <p><a href="index.php"> Registrar nuevo préstamo</a></p>

        <?php if (empty($prestamos)): ?>
            <p>No hay préstamos registrados en la sesión actual.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Carnet</th>
                        <th>Código</th>
                        <th>Nombre del Equipo</th>
                        <th>Tipo</th>
                        <th>Días Máximos</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($prestamos as $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item['carnet']) ?></td>
                            <td><?= htmlspecialchars($item['codigo']) ?></td>
                            <td><?= htmlspecialchars($item['nombre']) ?></td>
                            <td><?= htmlspecialchars(ucfirst($item['tipo'])) ?></td>
                            <td><?= htmlspecialchars((string)$item['dias_maximos']) ?> días</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>