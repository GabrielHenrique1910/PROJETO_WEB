<?php
require_once 'includes/auth.php';
require_once 'config/google_maps.php';

$nomeLocal = 'ETEC Prof. Ilza Nascimento Pintus';

$latitude = -23.219821221678373;
$longitude = -45.906752833343326;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa da ETEC - CRUD Mundo</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        #mapa {
            width: 100%;
            height: 450px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <header class="cabecalho">
        <div class="container">
            <h1>🌍 CRUD Mundo</h1>
            <p>Localização da ETEC São José dos Campos</p>
        </div>
    </header>

    <main class="container conteudo-principal">
        <section class="boas-vindas">
            <h2>Localização: <?= htmlspecialchars($nomeLocal, ENT_QUOTES, 'UTF-8') ?></h2>
            <p>
                Avenida Salmão, 570 — Parque Residencial Aquarius,
                São José dos Campos - SP
            </p>
        </section>

        <div id="mapa" aria-label="Mapa com a localização da ETEC"></div>
    </main>

    <footer class="rodape">
        <div class="container">
            <p>&copy; <?= date('Y') ?> CRUD Mundo</p>
        </div>
    </footer>

    <script>
        function iniciarMapa() {
            const localizacao = {
                lat: <?= json_encode($latitude) ?>,
                lng: <?= json_encode($longitude) ?>
            };

            const mapa = new google.maps.Map(
                document.getElementById('mapa'),
                {
                    center: localizacao,
                    zoom: 16
                }
            );

            new google.maps.Marker({
                position: localizacao,
                map: mapa,
                title: <?= json_encode($nomeLocal) ?>
            });
        }
    </script>

    <script
        async
        src="https://maps.googleapis.com/maps/api/js?key=<?= urlencode($googleMapsKey) ?>&callback=iniciarMapa&loading=async">
    </script>
</body>
</html>
