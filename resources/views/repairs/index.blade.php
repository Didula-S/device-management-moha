@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Devices Under Repair</h1>
    <a href="{{ route('repairs.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Record a Repair</a>
    
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <table class="w-full bg-white shadow-md rounded mb-4">
        <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">Device Name</th>
                <th class="py-3 px-6 text-left">Department</th>
                <th class="py-3 px-6 text-left">Repair Agent</th>
                <th class="py-3 px-6 text-left">Repair Date</th>
                <th class="py-3 px-6 text-left">Repair Type</th>
                <th class="py-3 px-6 text-left">Description</th>
                <th class="py-3 px-6 text-left">Status</th>
                <th class="py-3 px-6 text-left">Actions</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            @forelse($repairs as $repair)
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-6 text-left whitespace-nowrap">{{ $repair->device->name }}</td>
                <td class="py-3 px-6 text-left">{{ $repair->device->department->name }}</td>
                <td class="py-3 px-6 text-left">
                    {{ $repair->repairAgent->name }}<br>
                    {{ $repair->repairAgent->contact_number }}<br>
                    {{ $repair->repairAgent->email }}
                </td>
                <td class="py-3 px-6 text-left">{{ $repair->repair_date }}</td>
                <td class="py-3 px-6 text-left">{{ $repair->repair_type }}</td>
                <td class="py-3 px-6 text-left">{{ $repair->description }}</td>
                <td class="py-3 px-6 text-left">{{ $repair->status }}</td>
                <td class="py-3 px-6 text-left">
                    <a href="{{ route('repairs.edit', $repair->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-xs">Edit</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="py-3 px-6 text-center">No repairs in progress found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

