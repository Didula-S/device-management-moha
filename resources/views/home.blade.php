<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Device Management System - Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-600 p-4 text-white">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">Device Management System</h1>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    Logout
                </button>
            </form>
        </div>
    </nav>

    <div class="container mx-auto mt-8 p-4">
        <h2 class="text-3xl font-bold mb-4">Welcome, {{ Auth::user()->name }}!</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-2">Devices</h3>
                <p>Manage your devices here.</p>
                <a href="{{ route('devices.index') }}" class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    View Devices
                </a>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-2">Repairs</h3>
                <p>Track device repairs and maintenance.</p>
                <a href="{{ route('devices.repair') }}" class="mt-4 inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    View Repairs
                </a>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-2">Reports</h3>
                <p>Generate and view reports.</p>
                <a href="#" class="mt-4 inline-block bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                    View Reports
                </a>
            </div>
        </div>
    </div>

    <script>
        @if(session('success'))
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        @endif
    </script>
</body>
</html>