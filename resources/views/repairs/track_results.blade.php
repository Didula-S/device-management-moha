@extends('layouts.app')

@section('title', 'Repair History for ' . $device->name)

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Repair History for {{ $device->name }}</h1>
    <p><strong>Total Repair Cost:</strong> LKR {{ number_format($totalCost, 2) }}</p>
    <table class="w-full bg-white shadow-md rounded mb-4">
        <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">Repair Number</th>
                <th class="py-3 px-6 text-left">Repair Date</th>
                <th class="py-3 px-6 text-left">Repair Type</th>
                <th class="py-3 px-6 text-left">Repair Agent</th>
                <th class="py-3 px-6 text-left">Status</th>
                <th class="py-3 px-6 text-left">Price</th>
                <th class="py-3 px-6 text-left">Description</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            @foreach($repairs as $index => $repair)
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-6 text-left">{{ $index + 1 }}</td>
                <td class="py-3 px-6 text-left">{{ $repair->repair_date->format('Y-m-d') }}</td>
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

    <h2 class="text-xl font-bold mb-2">Repair Frequency</h2>
    <table class="w-full bg-white shadow-md rounded mb-4">
        <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">Repair Interval</th>
                <th class="py-3 px-6 text-left">Time Gap</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            @foreach($repairFrequencies as $frequency)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left">{{ $frequency['interval'] }}</td>
                    <td class="py-3 px-6 text-left">{{ $frequency['timeGap'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('repairs.track') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Back to Track Repairs</a>
</div>
@endsection
