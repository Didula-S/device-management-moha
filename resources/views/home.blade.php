@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <h2 class="text-3xl font-bold mb-4">Welcome, {{ Auth::user()->name }}!</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold mb-2">Devices</h3>
            <p>Manage your devices here.</p>
            <a href="{{ route('devices.index') }}" class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                View Devices
            </a>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold mb-2">Repairs</h3>
            <p>Track device repairs and maintenance.</p>
            <a href="{{ route('repairs.index') }}" class="mt-4 inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                View Repairs
            </a>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold mb-2">Track Device Repairs</h3>
            <p>Track device repairs and maintenance.</p>
            <a href="{{ route('repairs.track') }}" class="mt-4 inline-block bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                Track Repairs
            </a>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold mb-2">Departments</h3>
            <p>Manage departments here.</p>
            <button onclick="openDepartmentModal()" class="mt-4 inline-block bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                Add Department
            </button>
            <div id="departmentsList" class="mt-4"></div>
        </div>
    </div>

    <!-- Department Modal -->
    <div id="departmentModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Add New Department</h3>
                <div class="mt-2 px-7 py-3">
                    <form id="departmentForm">
                        @csrf
                        <input type="text" name="name" id="departmentName" placeholder="Department Name" class="w-full px-3 py-2 border rounded-md" required>
                        <button type="submit" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Submit
                        </button>
                    </form>
                </div>
                <div class="items-center px-4 py-3">
                    <button id="closeModal" class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-300">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openDepartmentModal(department = null) {
            const modal = document.getElementById('departmentModal');
            const form = document.getElementById('departmentForm');
            const titleElement = modal.querySelector('h3');

            if (department) {
                titleElement.textContent = 'Edit Department';
                document.getElementById('departmentName').value = department.name;
                form.setAttribute('data-department-id', department.id);
            } else {
                titleElement.textContent = 'Add New Department';
                document.getElementById('departmentName').value = '';
                form.removeAttribute('data-department-id');
            }

            modal.classList.remove('hidden');
        }

        document.getElementById('closeModal').addEventListener('click', function() {
            document.getElementById('departmentModal').classList.add('hidden');
        });

        document.getElementById('departmentForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const departmentId = this.getAttribute('data-department-id');
            const url = departmentId ? `{{ url('departments') }}/${departmentId}` : '{{ route("departments.store") }}';
            const method = departmentId ? 'PUT' : 'POST';

            fetch(url, {
                method: method,
                body: JSON.stringify({
                    name: formData.get('name'),
                    _token: '{{ csrf_token() }}'
                }),
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    document.getElementById('departmentModal').classList.add('hidden');
                    document.getElementById('departmentName').value = '';
                    fetchDepartments();
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            });
        });

        function fetchDepartments() {
            fetch('{{ route("departments.index") }}')
                .then(response => response.json())
                .then(data => {
                    const departmentsList = document.getElementById('departmentsList');
                    departmentsList.innerHTML = '';
                    data.forEach(department => {
                        const departmentElement = document.createElement('div');
                        departmentElement.className = 'flex justify-between items-center mt-2';
                        departmentElement.innerHTML = `
                            <span>${department.name}</span>
                            <div>
                                <button onclick='openDepartmentModal(${JSON.stringify(department)})' class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-xs mr-2">
                                    Edit
                                </button>
                                <button onclick="deleteDepartment(${department.id})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded text-xs">
                                    Delete
                                </button>
                            </div>
                        `;
                        departmentsList.appendChild(departmentElement);
                    });
                })
                .catch(error => console.error('Error:', error));
        }

        function deleteDepartment(id) {
            if (confirm('Are you sure you want to delete this department?')) {
                fetch(`{{ url('departments') }}/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        fetchDepartments();
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                });
            }
        }

        // Fetch departments when the page loads
        fetchDepartments();
    </script>
@endsection