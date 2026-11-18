<?php
/**
 * pokedex.php
 *
 * Página principal de la PokéDex. Consume la PokeAPI mediante la clase pkmn,
 * muestra los Pokémon en tarjetas paginadas e incluye información de tipos,
 * estadísticas, altura y peso de cada uno.
 *
 * @author  DeloNilfgaardian
 * @version 1.0
 */

require_once 'pkmn.php';

$api = new pkmn();

$offset = isset($_GET['offset']) ? max(0, (int)$_GET['offset']) : 0;
$limit  = 12;

$lista    = $api->obtenerListaPokemon($limit, $offset);
$total    = $lista['count'] ?? 0;
$pokemons = [];

if ($lista && !empty($lista['results'])) {
    foreach ($lista['results'] as $item) {
        $detalle = $api->obtenerDetallePokemon($item['url']);
        if ($detalle) $pokemons[] = $detalle;
    }
}

$hayAnterior  = $offset > 0;
$haySiguiente = ($offset + $limit) < $total;
$pagActual    = floor($offset / $limit) + 1;
$pagTotal     = ceil($total / $limit);

$coloresTipo = [
    'Normal'=>'#6b6b6b','Fire'=>'#c2410c','Water'=>'#1d4ed8','Electric'=>'#b45309',
    'Grass'=>'#15803d','Ice'=>'#0e7490','Fighting'=>'#991b1b','Poison'=>'#7e22ce',
    'Ground'=>'#92400e','Flying'=>'#4338ca','Psychic'=>'#9d174d','Bug'=>'#3f6212',
    'Rock'=>'#44403c','Ghost'=>'#4c1d95','Dragon'=>'#1e3a8a','Dark'=>'#292524',
    'Steel'=>'#475569','Fairy'=>'#9d174d',
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PokéDex – PHP + PokeAPI</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<header>
    <a href="index.php" class="btn-volver">← Volver al inicio</a>
<h1><?= pkmn::pokeball(28) ?> PokéDex</h1>
    <p>Consumo de API REST pública</p>
</header>

<div class="info-bar">
    📡 Servicio: <code>https://pokeapi.co/api/v2/pokemon</code> — respuesta en JSON —
    Total disponibles: <strong><?= number_format($total) ?></strong>
</div>

<?php if (empty($pokemons)): ?>
    <div class="error">
        <strong>No se pudieron obtener datos.</strong><br>
        Comprueba la conexión o que la API esté disponible.
    </div>
<?php else: ?>

<main>
<?php foreach ($pokemons as $p): ?>
    <div class="card">
        <div class="card-header">
            <?php if ($p['imagen']): ?>
                <img src="<?= htmlspecialchars($p['imagen']) ?>"
                     alt="<?= htmlspecialchars($p['nombre']) ?>">
            <?php endif; ?>
        </div>
        <div class="card-body">
            <div class="card-num">#<?= str_pad($p['id'], 3, '0', STR_PAD_LEFT) ?></div>
            <div class="card-name"><?= htmlspecialchars($p['nombre']) ?></div>

            <div class="tipos">
                <?php foreach ($p['tipos'] as $tipo):
                    $color = $coloresTipo[$tipo] ?? '#4c1d95'; ?>
                    <span class="tipo" style="background:<?= $color ?>">
                        <?= htmlspecialchars($tipo) ?>
                    </span>
                <?php endforeach; ?>
            </div>

            <div class="stats">
                <?php foreach (['HP'=>$p['hp'],'ATK'=>$p['atk'],'DEF'=>$p['def']] as $label=>$val):
                    $pct = min(100, round($val / 150 * 100)); ?>
                <div class="stat-row">
                    <span class="stat-label"><?= $label ?></span>
                    <div class="stat-bar-bg">
                        <div class="stat-bar" style="width:<?= $pct ?>%"></div>
                    </div>
                    <span class="stat-val"><?= $val ?></span>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="fisicos">
                <div class="fisico">
                    <span><?= number_format($p['altura'], 1) ?> m</span>
                    Altura
                </div>
                <div class="fisico">
                    <span><?= number_format($p['peso'], 1) ?> kg</span>
                    Peso
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</main>

<div class="pagination">
    <a href="?offset=<?= $offset - $limit ?>"
       class="btn <?= $hayAnterior ? '' : 'off' ?>">← Anterior</a>
    <span class="page-info">Página <?= $pagActual ?> de <?= $pagTotal ?></span>
    <a href="?offset=<?= $offset + $limit ?>"
       class="btn <?= $haySiguiente ? '' : 'off' ?>">Siguiente →</a>
</div>

<?php endif; ?>
</body>
</html>
