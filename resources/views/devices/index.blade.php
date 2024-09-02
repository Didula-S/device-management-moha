@extends('layouts.app')

@section('title', 'Devices List')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-4">Devices</h1>
        <a href="{{ route('devices.create') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mb-4 inline-block transition duration-300 ease-in-out">Add New Device</a>
        
        <table class="w-full bg-white shadow-md rounded mb-4">
            <thead>
                <tr class="bg-gray-200 text-gray-700 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Name</th>
                    <th class="py-3 px-6 text-left">Device ID</th>
                    <th class="py-3 px-6 text-left">Department</th>
                    <th class="py-3 px-6 text-left">Purchase Date</th>
                    <th class="py-3 px-6 text-left">Warranty Expiration</th>
                    <th class="py-3 px-6 text-left">Working Status</th>
                    <th class="py-3 px-6 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach($devices as $device)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left whitespace-nowrap">{{ $device->name }}</td>
                    <td class="py-3 px-6 text-left">{{ $device->device_id }}</td>
                    <td class="py-3 px-6 text-left">{{ $device->department->name }}</td>
                    <td class="py-3 px-6 text-left">{{ $device->purchase_date }}</td>
                    <td class="py-3 px-6 text-left">{{ $device->warranty_expiration_date }}</td>
                    <td class="py-3 px-6 text-left">{{ $device->working_status }}</td>
                    <td class="py-3 px-6 text-left">
                        <div class="flex space-x-2">
                            <a href="{{ route('devices.edit', $device->id) }}" class="bg-teal-500 hover:bg-teal-600 text-white font-bold py-1 px-3 rounded text-xs transition duration-300 ease-in-out">Edit</a>
                            <form action="{{ route('devices.destroy', $device->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-rose-400 hover:bg-rose-500 text-white font-bold py-1 px-3 rounded text-xs transition duration-300 ease-in-out" onclick="return confirm('Are you sure you want to delete this device?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
