@extends('layouts.app')

@section('title', 'Devices Under Repair')

@section('content')
    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-bold mb-4">Devices Under Repair</h1>
        
        @if($repairs->isEmpty())
            <p>No devices under repair found.</p>
        @else
            <table class="w-full bg-white shadow-md rounded mb-4">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Device ID</th>
                        <th class="py-3 px-6 text-left">Device Name</th>
                        <th class="py-3 px-6 text-left">Department</th>
                        <th class="py-3 px-6 text-left">Purchase Date</th>
                        <th class="py-3 px-6 text-left">Warranty Expiration</th>
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
                            <td class="py-3 px-6 text-left whitespace-nowrap">{{ $repair->device->device_id }}</td>
                            <td class="py-3 px-6 text-left">{{ $repair->device->name }}</td>
                            <td class="py-3 px-6 text-left">{{ $repair->device->department->name }}</td>
                            <td class="py-3 px-6 text-left">{{ $repair->device->purchase_date }}</td>
                            <td class="py-3 px-6 text-left">{{ $repair->device->warranty_expiration_date }}</td>
                            <td class="py-3 px-6 text-left">{{ $repair->repairAgent->name ?? 'N/A' }}</td>
                            <td class="py-3 px-6 text-left">{{ $repair->repair_date ?? 'N/A' }}</td>
                            <td class="py-3 px-6 text-left">{{ $repair->repair_type ?? 'N/A' }}</td>
                            <td class="py-3 px-6 text-left">{{ $repair->description ?? 'N/A' }}</td>
                            <td class="py-3 px-6 text-left">{{ $repair->status ?? 'N/A' }}</td>
                            <td class="py-3 px-6 text-left">{{ $repair->start_date ?? 'N/A' }}</td>
                            <td class="py-3 px-6 text-left">{{ $repair->end_date ?? 'N/A' }}</td>
                            <td class="py-3 px-6 text-left">{{ $repair->price ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
