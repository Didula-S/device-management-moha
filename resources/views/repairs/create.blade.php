@extends('layouts.app')

@section('title', 'Record New Repair')

@section('content')
<div class="min-h-screen bg-gradient-to-r from-cyan-500 to-blue-500 py-6 flex flex-col justify-center sm:py-12">
    <div class="relative py-3 sm:max-w-xl sm:mx-auto">
        <div class="absolute inset-0 bg-gradient-to-r from-cyan-400 to-light-blue-500 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl"></div>
        <div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-20">
            <div class="max-w-md mx-auto">
                <h1 class="text-2xl font-semibold mb-6">Record New Repair</h1>
                <form action="{{ route('repairs.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="mb-4">
                        <h2 class="text-xl font-bold mb-2">Device Details</h2>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="device_id">
                            Device
                        </label>
                        <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="device_id" name="device_id" required>
                            @foreach($devices as $device)
                                <option value="{{ $device->id }}">{{ $device->name }} ({{ $device->device_id }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <h2 class="text-xl font-bold mb-2">Repair Details</h2>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="repair_type">
                            Repair Type
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="repair_type" type="text" name="repair_type" required>

                        <label class="block text-gray-700 text-sm font-bold mb-2 mt-4" for="repair_date">
                            Repair Date
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="repair_date" type="date" name="repair_date" required>

                        <label class="block text-gray-700 text-sm font-bold mb-2 mt-4" for="description">
                            Description
                        </label>
                        <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" name="description" rows="3"></textarea>

                        <label class="block text-gray-700 text-sm font-bold mb-2 mt-4" for="status">
                            Status
                        </label>
                        <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="status" name="status" required>
                            <option value="In Progress">In Progress</option>
                            <option value="Completed">Completed</option>
                        </select>

                        <label class="block text-gray-700 text-sm font-bold mb-2 mt-4" for="start_date">
                            Start Date
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="start_date" type="date" name="start_date" required>

                        <label class="block text-gray-700 text-sm font-bold mb-2 mt-4" for="end_date">
                            End Date
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="end_date" type="date" name="end_date">

                        <label class="block text-gray-700 text-sm font-bold mb-2 mt-4" for="price">
                            Price
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="price" type="number" step="0.01" name="price" required>
                    </div>

                    <div class="mb-4">
                        <h2 class="text-xl font-bold mb-2">Repair Agent Details</h2>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="repair_agent_id">
                            Repair Agent
                        </label>
                        <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="repair_agent_id" name="repair_agent_id" required>
                            @foreach($repairAgents as $agent)
                                <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                            Record Repair
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
