<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Device Management System')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-gradient-to-r from-blue-400 to-indigo-500 m-4 rounded-xl shadow-lg">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold text-white">Device Management System</h1>
                <ul class="flex space-x-2">
                    @php
                        $navItems = [
                            ['route' => 'home', 'label' => 'Home'],
                            ['route' => 'devices.index', 'label' => 'Devices'],
                            ['route' => 'repairs.index', 'label' => 'Repairs'],
                        ];
                    @endphp
                    @foreach($navItems as $item)
                        <li>
                            <a href="{{ route($item['route']) }}" class="px-4 py-2 rounded-lg transition duration-300 ease-in-out {{ request()->routeIs($item['route']) ? 'bg-white text-indigo-600 shadow-inner' : 'text-white hover:bg-white hover:bg-opacity-20' }}">
                                {{ $item['label'] }}
                            </a>
                        </li>
                    @endforeach
                    <li>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="px-4 py-2 rounded-lg transition duration-300 ease-in-out text-white hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />
                                </svg>
                                <span class="ml-2">Logout</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mx-auto mt-8 p-4">
        @yield('content')
    </div>
</body>
</html>