<?php
/**
 * index.php
 *
 * Página principal del proyecto DWES T9.
 * Actúa como menú de navegación y da acceso a las distintas
 * secciones: PokéDex, documentación PHPDoc, pruebas JMeter y repositorio GitHub.
 *
 * @author  Delshad Abdi Novillo
 * @version 1.0
 */
require_once 'pkmn.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T9 - Apps Web Híbridas</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<header>
    <h1>DWES T9 – Aplicaciones web híbridas</h1>
</header>

<div class="menu">
    <h2>Selecciona una aplicación:</h2>
    <div class="botones">

        <a href="pokedex.php" class="btn-menu">
            <span class="icono"><?= pkmn::pokeball(36) ?></span>
            <div>
                <span class="titulo">PokéDex</span>
                <span class="desc">Consulta información de Pokémon usando la PokeAPI (pokeapi.co)</span>
            </div>
        </a>
        <a href="./doc/index.html" class="btn-menu">
            <span class="icono">📖</span>
            <div>
                <span class="titulo">Documentación PHPDoc</span>
                <span class="desc">Documentación generada automáticamente del código fuente</span>
            </div>
        </a>

        <a href="./jmeter.php" class="btn-menu">
            <span class="icono">📊</span>
            <div>
                <span class="titulo">Pruebas de rendimiento</span>
                <span class="desc">Resultados de las pruebas de carga con Apache JMeter</span>
            </div>
        </a>
        <a href="https://github.com/DeloNilfgaardian/DWES_UD9_T09" target="_blank" class="btn-menu">
            <span class="icono">🐙</span>
            <div>
                <span class="titulo">Repositorio GitHub</span>
                <span class="desc">Código fuente del proyecto disponible en GitHub</span>
            </div>
        </a>
    </div>
</div>

</body>
</html>