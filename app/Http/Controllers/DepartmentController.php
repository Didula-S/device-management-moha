<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:departments,name',
        ]);

        $department = Department::create([
            'name' => $request->name,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Department created successfully',
            'department' => $department,
        ]);
    }

    public function update(Request $request, Department $department)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:departments,name,' . $department->id,
            ]);

            $department->update([
                'name' => $request->name,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Department updated successfully',
                'department' => $department,
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation error: ' . json_encode($e->errors()));
            return response()->json([
                'success' => false,
                'message' => $e->errors()['name'][0],
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Error updating department: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating the department.',
            ], 500);
        }
    }

    public function destroy(Department $department)
    {
        try {
            $department->delete();
            return response()->json([
                'success' => true,
                'message' => 'Department deleted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting department: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function index()
    {
        $departments = Department::all();
        return response()->json($departments);
    }
}
