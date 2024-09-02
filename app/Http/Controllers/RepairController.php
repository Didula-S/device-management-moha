<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Repair;
use App\Models\RepairAgent;
use Illuminate\Http\Request;

class RepairController extends Controller
{
    public function index()
    {
        $repairs = Repair::where('status', 'In Progress')
                         ->with(['device.department', 'repairAgent'])
                         ->get();

        return view('repairs.index', compact('repairs'));
    }

    public function edit(Repair $repair)
    {
        return view('repairs.edit', compact('repair'));
    }

    public function update(Request $request, Repair $repair)
    {
        $request->validate([
            'status' => 'required|in:In Progress,Completed',
        ]);

        $repair->status = $request->status;
        $repair->save();

        if ($repair->status === 'Completed') {
            $device = $repair->device;
            $device->working_status = 'Working';
            $device->save();
        }

        return redirect()->route('repairs.index')->with('success', 'Repair status updated successfully.');
    }

    public function create()
    {
        $devices = Device::all();
        $repairAgents = RepairAgent::all();
        return view('repairs.create', compact('devices', 'repairAgents'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'device_id' => 'required|exists:devices,id',
            'repair_agent_id' => 'required|exists:repair_agents,id',
            'repair_date' => 'required|date',
            'repair_type' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'required|in:In Progress,Completed',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'price' => 'required|numeric|min:0',
        ]);

        $repair = Repair::create($validatedData);

        $device = Device::find($validatedData['device_id']);
        $device->working_status = 'Under Repair';
        $device->save();

        return redirect()->route('repairs.index')->with('success', 'Repair record created successfully.');
    }
}