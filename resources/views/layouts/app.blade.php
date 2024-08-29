<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Device Management System')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-600 p-4 text-white">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">Device Management System</h1>
            <ul class="flex space-x-4">
                <li><a href="{{ route('home') }}" class="hover:text-gray-300">Home</a></li>
                <li><a href="{{ route('devices.index') }}" class="hover:text-gray-300">Devices</a></li>
                <li><a href="{{ route('devices.repair') }}" class="hover:text-gray-300">Repairs</a></li>
                <li><a href="{{ route('repairs.index') }}" class="hover:text-gray-300">Repairs</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mx-auto mt-8 p-4">
        @yield('content')
    </div>
</body>
</html>