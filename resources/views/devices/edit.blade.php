<!-- resources/views/devices/edit.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Device</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #e9ecef;
            margin: 0;
            padding: 0;
            color: #495057;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        h2 {
            color: #343a40;
            text-align: center;
            margin-bottom: 30px;
            font-size: 2em;
            font-weight: 600;
        }
        .form-group {
            margin-bottom: 20px;
            position: relative;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
        }
        input[type="text"],
        input[type="date"],
        select,
        .custom-file-input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ced4da;
            border-radius: 8px;
            box-sizing: border-box;
            background-color: #f8f9fa;
            font-size: 1em;
            color: #495057;
        }
        select {
            appearance: none;
            -webkit-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8' viewBox='0 0 8 8'%3E%3Cpath fill='%23333' d='M0 2l4 4 4-4z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
        }
        .custom-file {
            position: relative;
            overflow: hidden;
        }
        .custom-file-input {
            opacity: 0;
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }
        .custom-file-label {
            padding: 12px;
            border: 1px solid #ced4da;
            border-radius: 8px;
            background-color: #ffffff;
            display: inline-block;
            width: calc(100% - 100px);
            box-sizing: border-box;
            color: #495057;
            font-size: 1em;
        }
        .custom-file-label::after {
            content: 'Browse';
            background-color: #007bff;
            color: white;
            border: none;
            padding: 8px 16px;
            font-size: 0.875em;
            border-radius: 8px;
            cursor: pointer;
            position: absolute;
            right: 0;
            top: 0;
            height: 100%;
            width: 100px;
            text-align: center;
            line-height: 1.5;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 18px;
            border-radius: 8px;
            cursor: pointer;
            display: block;
            margin: 30px auto 0;
            transition: all 0.3s ease;
        }
        button:hover {
            background-color: #218838;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 123, 255, 0.3);
        }
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }
            button {
                padding: 12px 24px;
                font-size: 16px;
            }
            .custom-file-label::after {
                width: 80px;
                font-size: 0.75em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Device</h2>
        <form action="{{ route('devices.update', $device->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="device_id">Device ID</label>
                <input type="text" id="device_id" name="device_id" value="{{ $device->device_id }}" required>
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="{{ $device->name }}" required>
            </div>
            <div class="form-group">
                <label for="department_id">Department</label>
                <select id="department_id" name="department_id">
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}" {{ $device->department_id == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="purchase_date">Purchase Date</label>
                <input type="date" id="purchase_date" name="purchase_date" value="{{ $device->purchase_date }}" required>
            </div>
            <div class="form-group">
                <label for="warranty_expiration_date">Warranty Expiration Date</label>
                <input type="date" id="warranty_expiration_date" name="warranty_expiration_date" value="{{ $device->warranty_expiration_date }}" required>
            </div>
            <div class="form-group">
                <label for="working_status">Working Status</label>
                <select id="working_status" name="working_status" required>
                    <option value="Working" {{ $device->working_status == 'Working' ? 'selected' : '' }}>Working</option>
                    <option value="Not Working" {{ $device->working_status == 'Not Working' ? 'selected' : '' }}>Not Working</option>
                    <option value="Under Repair" {{ $device->working_status == 'Under Repair' ? 'selected' : '' }}>Under Repair</option>
                </select>
            </div>
            <div class="form-group">
                <label for="invoice_image">Invoice Image</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="invoice_image" name="invoice_image">
                    <label class="custom-file-label" for="invoice_image">Choose file</label>
                    @if($device->invoice_image)
                        <img src="{{ asset('storage/' . $device->invoice_image) }}" alt="Current Invoice Image" class="invoice-image">
                    @endif
                </div>
            </div>
            <button type="submit">Update Device</button>
        </form>
    </div>

    <script>
        // Custom file input label
        document.querySelector('.custom-file-input').addEventListener('change', function(e) {
            var fileName = e.target.files[0].name;
            var nextSibling = e.target.nextElementSibling;
            nextSibling.innerText = fileName;
        });
    </script>
</body>
</html>
