<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Velty Framework</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Tailwind + tipografía -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .card {
            transition: all 0.3s ease;
            border: 1px solid rgba(52, 211, 153, 0.1); /* emerald-400 a 10% */
        }

        .card:hover {
            border-color: rgba(52, 211, 153, 0.4);
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body class="bg-gray-950 text-white min-h-screen flex flex-col items-center justify-start px-6 pt-20">

    <!-- Título -->
    <header class="text-center mb-12">
        <h1 class="text-4xl font-extrabold text-emerald-300 mb-2 tracking-tight">Velty Framework</h1>
        <p class="text-gray-400 text-md max-w-2xl mx-auto">El framework PHP moderno, rápido y elegante. Hecho con 💚 por {{ nombre }}.</p>
    </header>

    <!-- Cards -->
    <section class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-5xl w-full">
        <a href="#" class="card rounded-xl p-6 bg-gray-900 hover:bg-gray-800">
            <h2 class="text-lg font-semibold text-emerald-200 mb-2">Documentación -></h2>
            <p class="text-sm text-gray-300">Guías, referencias y todo lo necesario para dominar Velty desde la instalación hasta producción.</p>
        </a>

        <a href="#" class="card rounded-xl p-6 bg-gray-900 hover:bg-gray-800">
            <h2 class="text-lg font-semibold text-emerald-200 mb-2">Primer Proyecto -></h2>
            <p class="text-sm text-gray-300">Crea tu primer proyecto Velty con comandos CLI, rutas, vistas y controladores.</p>
        </a>

        <a href="#" class="card rounded-xl p-6 bg-gray-900 hover:bg-gray-800">
            <h2 class="text-lg font-semibold text-emerald-200 mb-2">Estructura del Framework -></h2>
            <p class="text-sm text-gray-300">Entiende la organización del núcleo de Velty: carpetas, flujos y convenciones.</p>
        </a>

        <a href="#" class="card rounded-xl p-6 bg-gray-900 hover:bg-gray-800">
            <h2 class="text-lg font-semibold text-emerald-200 mb-2">Comunidad & GitHub -></h2>
            <p class="text-sm text-gray-300">Accede al repositorio oficial, únete a la comunidad, comparte ideas y mejora Velty junto a otros devs.</p>
        </a>
    </section>

    <!-- Footer -->
    <footer class="mt-20 text-sm text-gray-600 text-center border-t border-gray-800 w-full pt-6">
        Velty Framework v0.1-dev • PHP <?= phpversion() ?> • Diseñado por Viespa
    </footer>

</body>
</html>
