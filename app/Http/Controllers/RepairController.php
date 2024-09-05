<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Device;
use App\Models\Repair;
use App\Models\RepairAgent;
use Illuminate\Http\Request;

class RepairController extends Controller
{
    public function index(Request $request)
    {
        $query = Repair::where('status', 'In Progress')
                       ->with(['device.department', 'repairAgent']);

        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->whereHas('device', function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                  ->orWhere('device_id', 'like', "%{$searchTerm}%")
                  ->orWhereHas('department', function ($subQ) use ($searchTerm) {
                      $subQ->where('name', 'like', "%{$searchTerm}%");
                  });
            });
        }

        $repairs = $query->get();
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
        $repairs = $device->repairs()->with('repairAgent')->orderBy('repair_date')->get();
        $totalCost = $repairs->sum('price');

        $repairFrequencies = [];
        for ($i = 0; $i < $repairs->count() - 1; $i++) {
            $currentRepair = $repairs[$i];
            $nextRepair = $repairs[$i + 1];
            
            $currentDate = Carbon::parse($currentRepair->repair_date);
            $nextDate = Carbon::parse($nextRepair->repair_date);

            $interval = $nextDate->diff($currentDate);

            $timeGap = [];
            if ($interval->y > 0) $timeGap[] = $interval->y . ' year' . ($interval->y > 1 ? 's' : '');
            if ($interval->m > 0) $timeGap[] = $interval->m . ' month' . ($interval->m > 1 ? 's' : '');
            if ($interval->d > 0) $timeGap[] = $interval->d . ' day' . ($interval->d > 1 ? 's' : '');
            
            $repairFrequencies[] = [
                'interval' => "Between repair #" . ($i + 1) . " and #" . ($i + 2),
                'timeGap' => !empty($timeGap) ? implode(', ', $timeGap) : 'Same day'
            ];
        }

        return view('repairs.track_results', compact('device', 'repairs', 'totalCost', 'repairFrequencies'));
    }
}