<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Sistem Kendaraan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-black text-white flex items-center justify-center min-h-screen">

    <div class="bg-gray-900 shadow-xl rounded-lg px-8 pt-6 pb-8 w-full max-w-md">
        <h2 class="text-3xl font-bold text-center mb-6 text-white">Login</h2>

        @if ($errors->any())
            <div class="bg-red-600 text-white text-sm p-3 rounded mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-300 mb-2">Email</label>
                <input
                    type="email"
                    name="email"
                    class="w-full px-4 py-2 rounded bg-gray-800 border border-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-amber-500"
                    required autofocus
                >
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-300 mb-2">Password</label>
                <input
                    type="password"
                    name="password"
                    class="w-full px-4 py-2 rounded bg-gray-800 border border-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-amber-500"
                    required
                >
            </div>

            <div class="flex items-center justify-between">
                <button
                    type="submit"
                    class="bg-yellow-500 hover:bg-amber-600 text-black font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-amber-400"
                >
                    Login
                </button>
            </div>
        </form>
    </div>

</body>
</html>
