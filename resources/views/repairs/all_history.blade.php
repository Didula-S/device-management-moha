@extends('layouts.app')

@section('title', 'Repair History')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Repair History</h1>
    <table class="w-full bg-white shadow-md rounded mb-4">
        <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">Device Name</th>
                <th class="py-3 px-6 text-left">Repair Date</th>
                <th class="py-3 px-6 text-left">Repair Type</th>
                <th class="py-3 px-6 text-left">Repair Agent</th>
                <th class="py-3 px-6 text-left">Status</th>
                <th class="py-3 px-6 text-left">Price</th>
                <th class="py-3 px-6 text-left">Description</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            @foreach($repairs as $repair)
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-6 text-left">{{ $repair->device->name }}</td>
                <td class="py-3 px-6 text-left">{{ $repair->repair_date }}</td>
                <td class="py-3 px-6 text-left">{{ $repair->repair_type }}</td>
                <td class="py-3 px-6 text-left">
                    {{ $repair->repairAgent->name }}<br>
                    {{ $repair->repairAgent->contact_number }}<br>
                    {{ $repair->repairAgent->email }}
                </td>
                <td class="py-3 px-6 text-left">{{ $repair->status }}</td>
                <td class="py-3 px-6 text-left">{{ $repair->price }}</td>
                <td class="py-3 px-6 text-left">{{ $repair->description }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('repairs.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Back to Repairs</a>
</div>
@endsection
