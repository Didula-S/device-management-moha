<?php

namespace App\Http\Controllers;

use App\Models\Repair;
use App\Models\Device;
use App\Models\RepairAgent;
use Illuminate\Http\Request;

class RepairController extends Controller
{
    public function index()
    {
        try {
            $repairs = Repair::with(['device.department', 'repairAgent'])->get();
            return view('devices.repairs', compact('repairs'));
        } catch (\Exception $e) {
            \Log::error('Error in RepairController@index: ' . $e->getMessage());
            return view('devices.repairs', ['repairs' => collect(), 'error' => $e->getMessage()]);
        }
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
            'status' => 'required|in:Completed,In Progress',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'price' => 'required|numeric|min:0',
        ]);

        Repair::create($validatedData);

        return redirect()->route('repairs.index')->with('success', 'Repair record created successfully');
    }

    public function show(Repair $repair)
    {
        return view('repairs.show', compact('repair'));
    }

    public function edit(Repair $repair)
    {
        $devices = Device::all();
        $repairAgents = RepairAgent::all();
        return view('repairs.edit', compact('repair', 'devices', 'repairAgents'));
    }

    public function update(Request $request, Repair $repair)
    {
        $validatedData = $request->validate([
            'device_id' => 'required|exists:devices,id',
            'repair_agent_id' => 'required|exists:repair_agents,id',
            'repair_date' => 'required|date',
            'repair_type' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'required|in:Completed,In Progress',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'price' => 'required|numeric|min:0',
        ]);

        $repair->update($validatedData);

        return redirect()->route('repairs.index')->with('success', 'Repair record updated successfully');
    }

    public function destroy(Repair $repair)
    {
        $repair->delete();

        return redirect()->route('repairs.index')->with('success', 'Repair record deleted successfully');
    }
}