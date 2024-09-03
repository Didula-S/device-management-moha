@extends('layouts.app')

@section('title', 'Home')

@section('content')
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
            <a href="{{ route('repairs.index') }}" class="mt-4 inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                View Repairs
            </a>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold mb-2">Track Device Repairs</h3>
            <p>Track device repairs and maintenance.</p>
            <a href="{{ route('repairs.track') }}" class="mt-4 inline-block bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                Track Repairs
            </a>
        </div>
    </div>
@endsection