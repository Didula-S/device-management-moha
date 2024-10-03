<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Department;
use App\Models\Repair;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DeviceController extends Controller
{
    public function index(Request $request)
    {
        $query = Device::with('department');

        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                  ->orWhere('device_id', 'like', "%{$searchTerm}%")
                  ->orWhereHas('department', function ($subQ) use ($searchTerm) {
                      $subQ->where('name', 'like', "%{$searchTerm}%");
                  });
            });
        }

        $devices = $query->get();
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
        ]);

        try {
            $device = Device::create($validatedData);

            if (!$device) {
                throw new \Exception('Failed to create device');
            }

            return redirect()->route('devices.index')->with('success', 'Device added successfully');
        } catch (\Exception $e) {
            \Log::error('Error adding device: ' . $e->getMessage());
            return back()->withInput()->with('error', 'An error occurred while adding the device: ' . $e->getMessage());
        }
    }

    public function edit(Device $device)
    {
        $departments = Department::all();
        return view('devices.edit', compact('device', 'departments'));
    }

    // Handle the update request
    public function update(Request $request, Device $device)
    {
        $request->validate([
            'device_id' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'purchase_date' => 'required|date',
            'warranty_expiration_date' => 'required|date',
            'working_status' => 'required|in:Working,Not Working',
        ]);

        $device->device_id = $request->input('device_id');
        $device->name = $request->input('name');
        $device->department_id = $request->input('department_id');
        $device->purchase_date = $request->input('purchase_date');
        $device->warranty_expiration_date = $request->input('warranty_expiration_date');
        
        // Preserve "Under Repair" status if it was previously set
        if ($device->working_status !== 'Under Repair') {
            $device->working_status = $request->input('working_status');
        }

        if ($request->hasFile('invoice_image')) {
            // Delete old image if it exists
            if ($device->invoice_image) {
                Storage::delete('public/' . $device->invoice_image);
            }
            // Store the new image
            $path = $request->file('invoice_image')->store('invoice_images', 'public');
            $device->invoice_image = $path;
        }

        $device->save();

        return redirect()->route('devices.index')->with('success', 'Device updated successfully.');
    }

    public function destroy(Device $device)
    {
        $device->delete();

        return redirect()->route('devices.index')->with('success', 'Device removed successfully');
    }

    public function showRepairs()
    {
        $repairs = Repair::with(['device.department', 'repairAgent'])->whereHas('device', function ($query) {
            $query->where('working_status', 'Under Repair');
        })->get();
        return view('devices.repairs', compact('repairs'));
    }

    public function viewRepairHistory(Device $device)
    {
        $repairs = $device->repairs()->with('repairAgent')->get();
        $repairFrequency = $device->repairFrequency();
        $totalRepairCost = $device->totalRepairCost();
        return view('devices.repairs_history', compact('device', 'repairs', 'repairFrequency', 'totalRepairCost'));
    }
}