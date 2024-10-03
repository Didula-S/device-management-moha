<?php

namespace App\Http\Controllers;

use App\Models\RepairAgent;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RepairAgentController extends Controller
{
    public function index()
    {
        $repairAgents = RepairAgent::all();
        return response()->json($repairAgents);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'email' => 'required|email|unique:repair_agents,email',
        ]);

        $repairAgent = RepairAgent::create($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Repair agent created successfully',
            'repairAgent' => $repairAgent
        ]);
    }

    public function update(Request $request, RepairAgent $repairAgent)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'email' => [
                'required',
                'email',
                Rule::unique('repair_agents')->ignore($repairAgent->id),
            ],
        ]);

        $repairAgent->update($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Repair agent updated successfully',
            'repairAgent' => $repairAgent
        ]);
    }

    public function destroy(RepairAgent $repairAgent)
    {
        $repairAgent->delete();

        return response()->json([
            'success' => true,
            'message' => 'Repair agent deleted successfully'
        ]);
    }
}
