<?php
/**
 * pkmn.php
 *
 * Clase que gestiona el acceso a la PokeAPI mediante peticiones HTTP.
 * Proporciona métodos para obtener listados paginados de Pokémon,
 * sus datos de detalle, y utilidades de presentación como el icono SVG.
 *
 * @author  DeloNilfgaardian
 * @version 1.0
 */

class pkmn {

    /**
     * Hace una petición GET a una URL y devuelve el resultado decodificado como array.
     *
     * @param string $url URL del endpoint a consultar
     * @return array|null Array con los datos JSON decodificados, o null si falla la petición
     */
    public function fetchJson(string $url): ?array {
        $ctx = stream_context_create(['http' => [
            'method'  => 'GET',
            'header'  => "User-Agent: PHP-PokeApp/1.0\r\n",
            'timeout' => 10,
        ]]);
        $res = @file_get_contents($url, false, $ctx);
        return $res ? json_decode($res, true) : null;
    }

    /**
     * Devuelve la lista paginada de Pokémon con nombre y URL de detalle.
     *
     * @param int $limit  Número de Pokémon a obtener por página
     * @param int $offset Desplazamiento desde el que empezar la consulta
     * @return array|null Array con el total y la lista de Pokémon, o null si falla la petición
     */
    public function obtenerListaPokemon(int $limit, int $offset): ?array {
        return $this->fetchJson("https://pokeapi.co/api/v2/pokemon?limit={$limit}&offset={$offset}");
    }

    /**
     * Devuelve los datos de detalle de un Pokémon a partir de su URL.
     *
     * @param string $url URL del endpoint de detalle del Pokémon
     * @return array|null Array con id, nombre, tipos, imagen, stats, altura y peso, o null si falla
     */
    public function obtenerDetallePokemon(string $url): ?array {
        $d = $this->fetchJson($url);
        if (!$d) return null;

        return [
            'id'     => $d['id'],
            'nombre' => ucfirst($d['name']),
            'tipos'  => array_map(fn($t) => ucfirst($t['type']['name']), $d['types']),
            'imagen' => $d['sprites']['other']['official-artwork']['front_default']
                     ?? $d['sprites']['front_default'] ?? '',
            'hp'     => $d['stats'][0]['base_stat'],
            'atk'    => $d['stats'][1]['base_stat'],
            'def'    => $d['stats'][2]['base_stat'],
            'altura' => $d['height'] / 10,
            'peso'   => $d['weight'] / 10,
        ];
    }

    /**
     * Genera el código SVG de una Pokeball para usar como icono en el HTML.
     *
     * @param int $size Tamaño en píxeles del icono (ancho y alto)
     * @return string Cadena con el código SVG listo para insertar en HTML
     */
    public static function pokeball(int $size = 28): string {
        return '
        <svg width="' . $size . '" height="' . $size . '" viewBox="0 0 100 100" style="vertical-align:middle; margin-right:.4rem;">
            <path d="M 50,5 A 45,45 0 0,1 95,50 L 5,50 A 45,45 0 0,1 50,5 Z" fill="#e3342f"/>
            <path d="M 50,95 A 45,45 0 0,1 5,50 L 95,50 A 45,45 0 0,1 50,95 Z" fill="#f8f8f8"/>
            <line x1="5" y1="50" x2="95" y2="50" stroke="#1a202c" stroke-width="6"/>
            <circle cx="50" cy="50" r="14" fill="#1a202c"/>
            <circle cx="50" cy="50" r="8" fill="#f8f8f8"/>
            <circle cx="50" cy="50" r="45" fill="none" stroke="#1a202c" stroke-width="6"/>
        </svg>';
    }
}
