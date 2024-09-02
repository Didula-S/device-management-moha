@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Edit Repair Status</h1>
    <form action="{{ route('repairs.update', $repair->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status:</label>
            <select name="status" id="status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="In Progress" {{ $repair->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                <option value="Completed" {{ $repair->status == 'Completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Update Status
        </button>
    </form>
</div>
@endsection
