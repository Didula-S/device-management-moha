@extends('layouts.app')

@section('title', 'Devices List')

@section('content')
    <h1 class="text-3xl font-bold mb-4">Devices List</h1>
    <a href="{{ route('devices.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Add New Device</a>
    <table class="w-full bg-white shadow-md rounded mb-4">
        <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">Device ID</th>
                <th class="py-3 px-6 text-left">Name</th>
                <th class="py-3 px-6 text-left">Department</th>
                <th class="py-3 px-6 text-left">Status</th>
                <th class="py-3 px-6 text-left">Purchase Date</th>
                <th class="py-3 px-6 text-left">Warranty Expiration Date</th>
                <th class="py-3 px-6 text-left">Invoice Image</th>
                <th class="py-3 px-6 text-left">Actions</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            @foreach($devices as $device)
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-6 text-left whitespace-nowrap">{{ $device->device_id }}</td>
                <td class="py-3 px-6 text-left">{{ $device->name }}</td>
                <td class="py-3 px-6 text-left">{{ $device->department->name }}</td>
                <td class="py-3 px-6 text-left">{{ $device->working_status }}</td>
                <td class="py-3 px-6 text-left">{{ $device->purchase_date }}</td>
                <td class="py-3 px-6 text-left">{{ $device->warranty_expiration_date }}</td>
                <td class="py-3 px-6 text-left">
                    @if($device->invoice_image)
                        <img src="{{ asset('storage/' . $device->invoice_image) }}" alt="Invoice Image" class="w-20 h-20 object-cover">
                    @else
                        <span class="text-gray-400 italic">No Image</span>
                    @endif
                </td>
                <td class="py-3 px-6 text-left">
                    <a href="{{ route('devices.edit', $device->id) }}" class="text-blue-600 hover:text-blue-900 mr-2">Edit</a>
                    <form action="{{ route('devices.destroy', $device->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this device?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
