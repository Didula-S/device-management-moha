@extends('layouts.app')

@section('title', 'Record New Repair')

@section('content')
<h1 class="text-3xl font-bold mb-4">Record New Repair</h1>
<form action="{{ route('repairs.store') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
    @csrf
    <div class="mb-4">
        <h2 class="text-xl font-bold mb-2">Device Details</h2>
        <label class="block text-gray-700 text-sm font-bold mb-2" for="device_id">
            Device ID
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="device_id" type="text" name="device_id" required>
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
        <label class="block text-gray-700 text-sm font-bold mb-2" for="agent_name">
            Agent Name
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="agent_name" type="text" name="agent_name" required>

        <label class="block text-gray-700 text-sm font-bold mb-2 mt-4" for="contact_number">
            Contact Number
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="contact_number" type="text" name="contact_number" required>

        <label class="block text-gray-700 text-sm font-bold mb-2 mt-4" for="agent_email">
            Email
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="agent_email" type="email" name="agent_email" required>
    </div>

    <div class="flex items-center justify-between">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
            Record Repair
        </button>
    </div>
</form>
@endsection
