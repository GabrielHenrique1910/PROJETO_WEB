<?php

$arquivoEnv = __DIR__ . '/../.env';
$env = parse_ini_file($arquivoEnv);

if ($env === false || empty($env['GOOGLE_MAPS_API_KEY'])) {
    die('Chave do Google Maps não configurada. Adicione GOOGLE_MAPS_API_KEY ao arquivo .env.');
}

$googleMapsKey = $env['GOOGLE_MAPS_API_KEY'];