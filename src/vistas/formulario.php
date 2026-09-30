<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Préstamo</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <div class="contenedor-formulario">
        <h2>Registro de Préstamo de Equipo</h2>

        <?php if (!empty($error)): ?>
            <div class="alerta-error">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form action="index.php" method="POST">
            <div class="campo">
                <label for="carnet">Carnet del Estudiante:</label>
                <input type="text" id="carnet" name="carnet" value="<?= htmlspecialchars($datos['carnet'] ?? '') ?>" placeholder="Ej. PR21001">
            </div>

            <div class="campo">
                <label for="codigo">Código del Equipo:</label>
                <input type="text" id="codigo" name="codigo" value="<?= htmlspecialchars($datos['codigo'] ?? '') ?>">
            </div>

            <div class="campo">
                <label for="nombre">Nombre del Equipo:</label>
                <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($datos['nombre'] ?? '') ?>">
            </div>

            <div class="campo">
                <label for="tipo">Tipo de Equipo:</label>
                <select id="tipo" name="tipo">
                    <option value="">-- Seleccione un tipo --</option>
                    <?php foreach ($tipos as $tipoCase): ?>
                        <option value="<?= htmlspecialchars($tipoCase->value) ?>" <?= (isset($datos['tipo']) && $datos['tipo'] === $tipoCase->value) ? 'selected' : '' ?>>
                            <?= htmlspecialchars(ucfirst($tipoCase->value)) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit">Guardar Préstamo</button>
        </form>
    </div>
</body>
</html>