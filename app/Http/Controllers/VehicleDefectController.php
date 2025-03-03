<?php

namespace App\Http\Controllers;
use Yajra\DataTables\Facades\DataTables;
use App\Models\vehicle_parts_checklists;
use App\Models\vehicle_types;
use Illuminate\Http\Request;

class VehicleDefectController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = vehicle_parts_checklists::with('vehicleType')
            ->select(['id', 'checklist_name', 'vehicle_type_id', 'notes', 'status'])
            ->where('status', '=', '0')
            ->orderBy('id', 'desc');

            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('vehicle_type', function ($row) {
                    return $row->vehicleType ? $row->vehicleType->type : '-';
                })
                ->addColumn('status_label', function ($row) {
                    $statusLabels = [
                        '0' => '<span class="badge bg-success">Active</span>',
                        '1' => '<span class="badge bg-warning">Deactivated</span>',
                        '2' => '<span class="badge bg-secondary">Suspended</span>',
                        '3' => '<span class="badge bg-danger">Deleted</span>',
                    ];
                    return $statusLabels[$row->status] ?? '<span class="badge bg-dark">Unknown</span>';
                })
                ->addColumn('actions', function ($row) {
                    return '<a href="' . route('vehicle-defects.edit', $row->id) . '" class="btn btn-sm btn-primary">Edit</a>
                        <a href="' . route('vehicle-defects.delete', $row->id) . '" class="btn btn-sm btn-danger delete-vehicle-defect" data-id="' . $row->id . '">Delete</a>';
                })
                ->rawColumns(['status_label', 'actions'])
                ->make(true);
        }
        return view('admin.vehicle_defects.list');
    }

    public function create()
    {
        $vehicle_types = vehicle_types::all();
        // dd($vehicle_types);

        return view('admin.vehicle_defects.create', compact('vehicle_types'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'checklist_name' => 'required|string|max:255',
            'vehicle_type_id' => 'required|exists:vehicle_types,id',
            'notes' => 'nullable|string',
            'status' => 'required|in:0,1,2,3',
        ]);

        $vehicle_defects = new vehicle_parts_checklists();
        $vehicle_defects->checklist_name = $request->checklist_name;
        $vehicle_defects->vehicle_type_id = $request->vehicle_type_id;
        $vehicle_defects->notes = $request->notes;
        $vehicle_defects->status = $request->status;
        $vehicle_defects->save();

        return redirect()->route('vehicle-defects.index')->with('success', 'Vehicle Defect added successfully!');
    }

    public function edit(vehicle_parts_checklists $vehicleDefect)
    {
        // dd($vehicle->name);
        $vehicle_types = vehicle_types::all();

        return view('admin.vehicle_defects.edit', compact('vehicle_types', 'vehicleDefect'));
    }

    public function update(Request $request, vehicle_parts_checklists $vehicleDefect)
    {
        // dd($request->all());
        $request->validate([
            'checklist_name' => 'required|string|max:255',
            'vehicle_type_id' => 'required|exists:vehicle_types,id',
            'notes' => 'nullable|string',
            'status' => 'required|in:0,1,2,3',
        ]);

        $vehicleDefect->checklist_name = $request->checklist_name;
        $vehicleDefect->vehicle_type_id = $request->vehicle_type_id;
        $vehicleDefect->notes = $request->notes;
        $vehicleDefect->status = $request->status;
        $vehicleDefect->save();

        return redirect()->route('vehicle-defects.index')->with('success', 'Vehicle Defect updated successfully!');
    }

    public function destroy(vehicle_parts_checklists $vehicleDefect)
    {
        // dd($vehicleDefect);
        $vehicleDefect->delete();
        return response()->json(['success' => 'Vehicle Defect deleted successfully!']);
    }
}
