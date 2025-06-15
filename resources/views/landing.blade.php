<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Kendaraan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white flex items-center justify-center min-h-screen">

    <div class="text-center space-y-6">
        <h1 class="text-4xl font-bold text-amber-400">🚗 Manajemen Kendaraan</h1>
        <p class="text-gray-300">Sistem pengelolaan kendaraan operasional berbasis web</p>
        
        <a href="{{ route('login') }}"
           class="inline-block bg-yellow-400 text-black font-semibold px-6 py-3 rounded hover:bg-amber-500 transition duration-200">
            Login
        </a>
    </div>

</body>
</html>
