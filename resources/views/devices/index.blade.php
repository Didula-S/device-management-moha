<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devices List</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #e9ecef;
            margin: 0;
            padding: 0;
            color: #495057;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        h1 {
            color: #343a40;
            text-align: center;
            margin-bottom: 20px;
            font-size: 2em;
            font-weight: 600;
        }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 1em;
            font-weight: 500;
            transition: background-color 0.3s ease;
            margin-bottom: 20px;
        }
        .btn:hover {
            background-color: #218838;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }
        th {
            background-color: #f8f9fa;
            color: #343a40;
            font-weight: 600;
        }
        td {
            background-color: #ffffff;
        }
        tr:nth-child(even) td {
            background-color: #f1f3f5;
        }
        .invoice-image {
            max-width: 120px;
            border-radius: 8px;
        }
        .no-image {
            color: #6c757d;
            font-style: italic;
        }
        .edit-icon {
            color: #007bff;
            cursor: pointer;
            font-size: 18px;
            text-decoration: none;
        }
        .edit-icon:hover {
            color: #0056b3;
        }
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }
            .btn {
                padding: 10px 20px;
            }
            table {
                font-size: 0.9em;
            }
            .invoice-image {
                max-width: 100px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Devices List</h1>
        <a href="{{ route('devices.create') }}" class="btn">Add New Device</a>
        <table>
            <thead>
                <tr>
                    <th>Device ID</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Status</th>
                    <th>Purchase Date</th>
                    <th>Warranty Expiration Date</th>
                    <th>Invoice Image</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                @foreach($devices as $device)
                <tr>
                    <td>{{ $device->device_id }}</td>
                    <td>{{ $device->name }}</td>
                    <td>{{ $device->department->name }}</td>
                    <td>{{ $device->working_status }}</td>
                    <td>{{ $device->purchase_date }}</td>
                    <td>{{ $device->warranty_expiration_date }}</td>
                    <td>
                        @if($device->invoice_image)
                            <img src="{{ asset('storage/' . $device->invoice_image) }}" alt="Invoice Image" class="invoice-image">
                        @else
                            <span class="no-image">No Image</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('devices.edit', $device->id) }}" class="edit-icon">
                            &#9998; <!-- Pencil icon for edit -->
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
