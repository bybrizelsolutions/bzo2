<?php

namespace App\Http\Controllers;

use Yajra\DataTables\Facades\DataTables;
use App\Models\vehicle_types;

use Illuminate\Http\Request;

class VehicleTypeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = vehicle_types::query()->addSelect(['id', 'type'])
            ->orderBy('id', 'desc');

            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('actions', function ($row) {
                    return '<a href="' . route('vehicle_types.edit', $row->id) . '" class="btn btn-sm btn-primary">Edit</a>
                        <a href="' . route('vehicle_types.delete', $row->id) . '" class="btn btn-sm btn-danger delete-vehicle-type" data-id="' . $row->id . '">Delete</a>';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('admin.vehicle_types.list');
    }

    public function create()
    {
        return view('admin.vehicle_types.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'type' => 'required',
        ]);

        $vehicle_types = new vehicle_types();
        $vehicle_types->type = $request->type;
        $vehicle_types->save();

        return redirect()->route('vehicle_types.index')->with('success', 'Vehicle Type added successfully!');
    }

    public function edit(vehicle_types $vehicle_types)
    {
        // dd($vehicle->name);
        return view('admin.vehicle_types.edit', compact('vehicle_types'));
    }

    public function update(Request $request, vehicle_types $vehicle_types)
    {
        // dd($request->all());
        $request->validate([
            'type' => 'required',
        ]);

        $vehicle_types->type = $request->type;
        $vehicle_types->save();

        return redirect()->route('vehicle_types.index')->with('success', 'Vehicle Type updated successfully!');
    }

    public function destroy(vehicle_types $vehicle_types)
    {
        // dd($vehicle_types);
        $vehicle_types->delete();
        return response()->json(['success' => 'Vehicle Type deleted successfully!']);
    }
}
