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

        $device = $repair->device;
        $device->working_status = $repair->status === 'In Progress' ? 'Under Repair' : 'Working';
        $device->save();

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
        $device->working_status = $repair->status === 'In Progress' ? 'Under Repair' : 'Working';
        $device->save();

        return redirect()->route('repairs.index')->with('success', 'Repair record created successfully.');
    }

    public function destroy(Repair $repair)
    {
        $repair->delete();
        $repair->device->updateWorkingStatus();
        return redirect()->route('repairs.index')->with('success', 'Repair record deleted successfully.');
    }

    public function viewAllRepairHistory()
    {
        $repairs = Repair::with(['device', 'repairAgent'])->get();
        return view('repairs.all_history', compact('repairs'));
    }

    public function trackRepairs()
    {
        return view('repairs.track');
    }

    public function searchRepairs(Request $request)
    {
        $request->validate([
            'device_id' => 'required|exists:devices,device_id',
        ]);

        $device = Device::where('device_id', $request->device_id)->first();
        $repairs = $device->repairs()->with('repairAgent')->get();
        $totalCost = $repairs->sum('price');

        return view('repairs.track_results', compact('device', 'repairs', 'totalCost'));
    }
}