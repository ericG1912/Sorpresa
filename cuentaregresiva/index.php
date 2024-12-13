<?php
$fechaObjetivo = new DateTime('2025-06-30 14:00:00');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuenta Regresiva</title>
    <style>
        /* Estilos generales */
        body {
            background-color: #000;
            color: #FFC0CB; /* Rosa claro */
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        h1 {
            color: #FF69B4; /* Rosa fuerte */
            margin-top: 20px;
            font-size: 2.8em;
        }

        p {
            color: #FFB6C1; /* Rosa pastel */
            font-size: 1.2em;
        }

        button {
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #FF69B4; /* Rosa fuerte */
            color: #000;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #FF1493; /* Rosa aún más fuerte */
        }

        audio {
            margin: 10px auto;
            outline: none;
        }

        /* Sección responsive */
        @media (max-width: 768px) {
            h1 {
                font-size: 2.2em;
            }

            p {
                font-size: 1em;
            }

            button {
                font-size: 0.9em;
                padding: 8px 15px;
            }
        }
    </style>
    <script>
        function iniciarCuentaRegresiva(fechaObjetivo) {
            function actualizarCuentaRegresiva() {
                const ahora = new Date();
                const tiempoRestante = fechaObjetivo - ahora;

                if (tiempoRestante <= 0) {
                    clearInterval(intervalo);
                    document.getElementById("cuentaRegresiva").innerText = "¡Llegó la fecha, Gabella!";
                    return;
                }

                const dias = Math.floor(tiempoRestante / (1000 * 60 * 60 * 24));
                const horas = Math.floor((tiempoRestante % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutos = Math.floor((tiempoRestante % (1000 * 60 * 60)) / (1000 * 60));
                const segundos = Math.floor((tiempoRestante % (1000 * 60)) / 1000);

                document.getElementById("cuentaRegresiva").innerText = 
                    `Gabella, tendrás que esperar ${dias} días, ${horas} horas, ${minutos} minutos y ${segundos} segundos.`;
            }

            const intervalo = setInterval(actualizarCuentaRegresiva, 1000);
            actualizarCuentaRegresiva();
        }

        document.addEventListener("DOMContentLoaded", () => {
            const fechaObjetivo = new Date("<?php echo $fechaObjetivo->format('Y-m-d H:i:s'); ?>");
            iniciarCuentaRegresiva(fechaObjetivo);

            document.addEventListener("keydown", (e) => {
                if (e.key === "Enter") {
                    activarAudio();
                }
            });
        });

        function activarAudio() {
            const audio = document.getElementById('audio');
            audio.play().catch(err => {
                console.log("No se pudo reproducir el audio:", err);
            });
        }

        function reproducirRuido() {
            const audio = new Audio('sonido-gracioso.mp4');
            audio.play();
        }
    </script>
</head>
<body>
    <!-- Audio que se reproduce al presionar Enter -->
    <audio id="audio" loop>
        <source src="Snow Flower (feat. Peakboy) by V_[_YouConvert.net_].mp3" type="audio/mp3">
    </audio>

    <h1 id="cuentaRegresiva"></h1>
    <p>Algo importante está por llegar, pero tendrás que esperar, Gabella.</p>

    <p>Por mientras, puedes tocar este botón:</p>
    <button onclick="reproducirRuido()">Toca aquí</button>
    
</body>
</html>
