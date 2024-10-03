@extends('layouts.app')

@section('title', 'Edit Repair Status')

@section('content')
<div class="min-h-screen bg-gradient-to-r from-cyan-500 to-blue-500 py-6 flex flex-col justify-center sm:py-12">
    <div class="relative py-3 sm:max-w-xl sm:mx-auto">
        <div class="absolute inset-0 bg-gradient-to-r from-cyan-400 to-light-blue-500 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl"></div>
        <div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-20">
            <div class="max-w-md mx-auto">
                <h1 class="text-2xl font-semibold mb-6">Edit Repair Status</h1>
                <form action="{{ route('repairs.update', $repair->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status:</label>
                        <select name="status" id="status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="In Progress" {{ $repair->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="Completed" {{ $repair->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>
                    <div class="flex items-center justify-between mt-6">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Update Status
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
