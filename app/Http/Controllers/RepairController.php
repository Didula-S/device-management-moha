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
            $repairs = Repair::whereHas('device', function ($query) {
                $query->where('working_status', 'Under Repair');
            })->with(['device.department', 'repairAgent'])->get();

            return view('repairs.index', compact('repairs'));
        } catch (\Exception $e) {
            \Log::error('Error in RepairController@index: ' . $e->getMessage());
            return view('repairs.index', ['repairs' => collect(), 'error' => $e->getMessage()]);
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
            'device_id' => 'required|exists:devices,device_id',
            'repair_type' => 'required|string',
            'repair_date' => 'required|date',
            'description' => 'nullable|string',
            'status' => 'required|in:In Progress,Completed',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'price' => 'required|numeric|min:0',
            'agent_name' => 'required|string',
            'contact_number' => 'required|string',
            'agent_email' => 'required|email',
        ]);

        // Update device status
        $device = Device::where('device_id', $validatedData['device_id'])->firstOrFail();
        $device->working_status = 'Under Repair';
        $device->save();

        // Create or update repair agent
        $repairAgent = RepairAgent::updateOrCreate(
            ['email' => $validatedData['agent_email']],
            [
                'name' => $validatedData['agent_name'],
                'contact_number' => $validatedData['contact_number'],
            ]
        );

        // Create repair record
        $repair = new Repair([
            'device_id' => $device->id,
            'repair_agent_id' => $repairAgent->id,
            'repair_date' => $validatedData['repair_date'],
            'repair_type' => $validatedData['repair_type'],
            'description' => $validatedData['description'],
            'status' => $validatedData['status'],
            'start_date' => $validatedData['start_date'],
            'end_date' => $validatedData['end_date'],
            'price' => $validatedData['price'],
        ]);
        $repair->save();

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