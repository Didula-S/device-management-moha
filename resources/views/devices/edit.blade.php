@extends('layouts.app')

@section('title', 'Edit Device')

@section('content')
    <div class="container mx-auto mt-8">
        <h2 class="text-3xl font-bold mb-4">Edit Device</h2>
        <form action="{{ route('devices.update', $device->id) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="device_id">
                    Device ID
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="device_id" type="text" name="device_id" value="{{ $device->device_id }}" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                    Name
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" name="name" value="{{ $device->name }}" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="department_id">
                    Department
                </label>
                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="department_id" name="department_id">
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}" {{ $device->department_id == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="purchase_date">
                    Purchase Date
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="purchase_date" type="date" name="purchase_date" value="{{ $device->purchase_date }}" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="warranty_expiration_date">
                    Warranty Expiration Date
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="warranty_expiration_date" type="date" name="warranty_expiration_date" value="{{ $device->warranty_expiration_date }}" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="working_status">
                    Working Status
                </label>
                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="working_status" name="working_status" required>
                    <option value="Working" {{ $device->working_status == 'Working' ? 'selected' : '' }}>Working</option>
                    <option value="Not Working" {{ $device->working_status == 'Not Working' ? 'selected' : '' }}>Not Working</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="invoice_image">
                    Invoice Image
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="invoice_image" type="file" name="invoice_image">
                @if($device->invoice_image)
                    <p class="text-sm text-gray-600 mt-2">Current image: {{ basename($device->invoice_image) }}</p>
                @endif
            </div>
            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Update Device
                </button>
            </div>
        </form>
    </div>
@endsection
