<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DeviceController extends Controller
{
    public function index()
    {
        $devices = Device::with('department')->get();
        return view('devices.index', compact('devices'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('devices.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'device_id' => 'required|unique:devices',
            'department_id' => 'required|exists:departments,id',
            'purchase_date' => 'required|date',
            'warranty_expiration_date' => 'required|date',
            'working_status' => 'required|in:Working,Not Working,Under Repair',
            'invoice_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('invoice_image')) {
            $path = $request->file('invoice_image')->store('invoices', 'public');
            $validatedData['invoice_image'] = $path;
        }

        Device::create($validatedData);

        return redirect()->route('devices.index')->with('success', 'Device added successfully');
    }

    public function edit(Device $device)
    {
        $departments = Department::all();
        return view('devices.edit', compact('device', 'departments'));
    }

    public function update(Request $request, Device $device)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'device_id' => 'required|unique:devices,device_id,' . $device->id,
            'department_id' => 'required|exists:departments,id',
            'purchase_date' => 'required|date',
            'warranty_expiration_date' => 'required|date',
            'working_status' => 'required|in:Working,Not Working,Under Repair',
            'invoice_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('invoice_image')) {
            Storage::disk('public')->delete($device->invoice_image);
            $path = $request->file('invoice_image')->store('invoices', 'public');
            $validatedData['invoice_image'] = $path;
        }

        $device->update($validatedData);

        return redirect()->route('devices.index')->with('success', 'Device updated successfully');
    }

    public function destroy(Device $device)
    {
        Storage::disk('public')->delete($device->invoice_image);
        $device->delete();

        return redirect()->route('devices.index')->with('success', 'Device removed successfully');
    }
}