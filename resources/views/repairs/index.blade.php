@extends('layouts.app')

@section('title', 'Devices Under Repair')

@section('content')
<h1 class="text-3xl font-bold mb-4">Devices Under Repair</h1>
<a href="{{ route('repairs.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Record New Repair</a>
    @if(isset($error))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Error:</strong>
            <span class="block sm:inline">{{ $error }}</span>
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
                <th class="py-3 px-6 text-left">Start Date</th>
                <th class="py-3 px-6 text-left">End Date</th>
                <th class="py-3 px-6 text-left">Price</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            @foreach($repairs as $repair)
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
                <td class="py-3 px-6 text-left">{{ $repair->start_date }}</td>
                <td class="py-3 px-6 text-left">{{ $repair->end_date }}</td>
                <td class="py-3 px-6 text-left">{{ $repair->price }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection

