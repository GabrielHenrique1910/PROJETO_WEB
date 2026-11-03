<?php
// A chave da REST Countries é mantida no .env local, fora do GitHub.
$arquivoEnv = __DIR__ . '/../.env';
$variaveisEnv = is_file($arquivoEnv) ? parse_ini_file($arquivoEnv) : false;

// A chave de demonstração permite experimentar a integração.
// Para dados de uso próprio, configure uma chave pessoal no .env.
$apiKey = is_array($variaveisEnv)
    ? trim($variaveisEnv['REST_COUNTRIES_API_KEY'] ?? 'rc_live_demo')
    : 'rc_live_demo';

if ($apiKey === '') {
    $apiKey = 'rc_live_demo';
}
