<?php
/**
 * jmeter.php
 *
 * Página que muestra los resultados de la prueba de carga
 * realizada con Apache JMeter sobre la aplicación PokéDex.
 * Configuración: 200 usuarios, 10 min ramp-up, 5 min hold.
 *
 * @author  Delshad Abdi Novillo
 * @version 1.0
 */

$resultados = [
    'label'       => 'HTTP Request',
    'samples'     => 2595,
    'average'     => 50634,
    'min'         => 6014,
    'max'         => 86407,
    'std_dev'     => 24342.59,
    'error'       => '0.000%',
    'throughput'  => 2.74598,
    'recv_kb'     => 70.53,
    'sent_kb'     => 0.37,
    'avg_bytes'   => 26301.0,
];

$config = [
    'Target Concurrency'    => '200 usuarios',
    'Ramp Up Time'          => '10 minutos',
    'Ramp-Up Steps Count'   => '10 pasos',
    'Hold Target Rate Time' => '5 minutos',
    'URL probada'           => 'localhost/DWES_UD9_T09/pokedex.php',
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pruebas JMeter – DWES T9</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<header>
    <a href="index.php" class="btn-volver">← Volver al inicio</a>
    <h1>📊 Pruebas de rendimiento</h1>
    <p>Resultados de la prueba de carga con <strong>Apache JMeter 5.6.3</strong> · Concurrency Thread Group</p>
</header>

<div class="info-bar">
    🧪 Componente: <code>bzm - Concurrency Thread Group</code> —
    Fecha de la prueba: <strong><?= date('d/m/Y') ?></strong>
</div>

<div class="jmeter-wrap">

    <!-- Configuración de la prueba -->
    <section class="jm-section">
        <h2>⚙️ Configuración de la prueba</h2>
        <table class="jm-table">
            <thead>
                <tr>
                    <th>Parámetro</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($config as $param => $valor): ?>
                <tr>
                    <td><?= htmlspecialchars($param) ?></td>
                    <td><strong><?= htmlspecialchars($valor) ?></strong></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

    <!-- Tarjetas resumen -->
    <section class="jm-section">
        <h2>📈 Resumen de resultados</h2>
        <div class="jm-cards">
            <div class="jm-card">
                <div class="jm-card-val"><?= number_format($resultados['samples']) ?></div>
                <div class="jm-card-label">Peticiones totales</div>
            </div>
            <div class="jm-card">
                <div class="jm-card-val"><?= number_format($resultados['average'] / 1000, 2) ?>s</div>
                <div class="jm-card-label">Tiempo medio</div>
            </div>
            <div class="jm-card jm-card-green">
                <div class="jm-card-val"><?= number_format($resultados['min'] / 1000, 2) ?>s</div>
                <div class="jm-card-label">Tiempo mínimo</div>
            </div>
            <div class="jm-card jm-card-red">
                <div class="jm-card-val"><?= number_format($resultados['max'] / 1000, 2) ?>s</div>
                <div class="jm-card-label">Tiempo máximo</div>
            </div>
            <div class="jm-card">
                <div class="jm-card-val"><?= number_format($resultados['throughput'], 2) ?>/s</div>
                <div class="jm-card-label">Throughput</div>
            </div>
            <div class="jm-card jm-card-green">
                <div class="jm-card-val"><?= $resultados['error'] ?></div>
                <div class="jm-card-label">Tasa de error</div>
            </div>
        </div>
    </section>

    <!-- Tabla completa -->
    <section class="jm-section">
        <h2>🗂️ Datos completos</h2>
        <div class="jm-table-wrap">
            <table class="jm-table">
                <thead>
                    <tr>
                        <th>Label</th>
                        <th># Muestras</th>
                        <th>Media (ms)</th>
                        <th>Mín (ms)</th>
                        <th>Máx (ms)</th>
                        <th>Desv. típica</th>
                        <th>Error %</th>
                        <th>Throughput/s</th>
                        <th>KB/s recibidos</th>
                        <th>KB/s enviados</th>
                        <th>Media bytes</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong><?= $resultados['label'] ?></strong></td>
                        <td><?= number_format($resultados['samples']) ?></td>
                        <td><?= number_format($resultados['average']) ?></td>
                        <td class="td-green"><?= number_format($resultados['min']) ?></td>
                        <td class="td-red"><?= number_format($resultados['max']) ?></td>
                        <td><?= number_format($resultados['std_dev'], 2) ?></td>
                        <td class="td-green"><?= $resultados['error'] ?></td>
                        <td><?= $resultados['throughput'] ?></td>
                        <td><?= $resultados['recv_kb'] ?></td>
                        <td><?= $resultados['sent_kb'] ?></td>
                        <td><?= number_format($resultados['avg_bytes']) ?></td>
                    </tr>
                    <tr class="tr-total">
                        <td><strong>TOTAL</strong></td>
                        <td><?= number_format($resultados['samples']) ?></td>
                        <td><?= number_format($resultados['average']) ?></td>
                        <td class="td-green"><?= number_format($resultados['min']) ?></td>
                        <td class="td-red"><?= number_format($resultados['max']) ?></td>
                        <td><?= number_format($resultados['std_dev'], 2) ?></td>
                        <td class="td-green"><?= $resultados['error'] ?></td>
                        <td><?= $resultados['throughput'] ?></td>
                        <td><?= $resultados['recv_kb'] ?></td>
                        <td><?= $resultados['sent_kb'] ?></td>
                        <td><?= number_format($resultados['avg_bytes']) ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <!-- Análisis -->
    <section class="jm-section">
        <h2>🔍 Análisis de resultados</h2>
        <div class="jm-analysis">
            <p>La prueba se realizó con <strong>200 usuarios concurrentes</strong> durante un total de <strong>15 minutos</strong>. Se procesaron <strong>2.595 peticiones</strong> con una tasa de error del <strong>0%</strong>, lo que indica que el servidor respondió correctamente a todas las solicitudes.</p>
            <p>El tiempo medio de respuesta fue de <strong><?= number_format($resultados['average'] / 1000, 2) ?> segundos</strong>, condicionado principalmente por las llamadas externas a la PokeAPI que realiza cada petición. El throughput se situó en <strong><?= $resultados['throughput'] ?> peticiones/segundo</strong>.</p>
        </div>
    </section>

</div>

</body>
</html>