<?php

namespace App\Http\Controllers;

use App\Models\vehicle_types;
use Yajra\DataTables\Facades\DataTables;
use App\Models\vehicles;

use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = vehicles::with('vehicleType')->select(['id', 'vehicle_type_id', 'registration', 'make', 'model', 'purchase_date', 'purchase_from', 'service_by', 'notes', 'mileage'])
            ->orderBy('id', 'desc');

            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('vehicle_type', function ($row) {
                    return $row->vehicleType ? $row->vehicleType->type : '-';
                })
                ->addColumn('actions', function ($row) {
                    return '<a href="' . route('vehicles.edit', $row->id) . '" class="btn btn-sm btn-primary">Edit</a>
                        <a href="' . route('vehicles.delete', $row->id) . '" class="btn btn-sm btn-danger delete-vehicle" data-id="' . $row->id . '">Delete</a>';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('admin.vehicle.list');
    }

    public function create()
    {
        $vehicle_types = vehicle_types::all();
        // dd($vehicle_types);

        return view('admin.vehicle.create', compact('vehicle_types'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'vehicle_type_id' => 'required',
            'registration' => 'required',
            'make' => 'required',
            'model' => 'required',
            'purchase_date' => 'required',
            'purchase_from' => 'required',
            'service_by' => 'required',
            'notes' => 'required',
            'mileage' => 'required',
        ]);

        $vehicle = new vehicles();
        $vehicle->vehicle_type_id = $request->vehicle_type_id;
        $vehicle->registration = $request->registration;
        $vehicle->make = $request->make;
        $vehicle->model = $request->model;
        $vehicle->purchase_date = $request->purchase_date;
        $vehicle->purchase_from = $request->purchase_from;
        $vehicle->service_by = $request->service_by;
        $vehicle->notes = $request->notes;
        $vehicle->mileage = $request->mileage;
        $vehicle->save();

        return redirect()->route('vehicles.index')->with('success', 'Vehicle added successfully!');
    }

    public function edit(vehicles $vehicle)
    {
        $vehicle_types = vehicle_types::all();
        // dd($vehicle_types);

        return view('admin.vehicle.edit', compact('vehicle', 'vehicle_types'));
    }

    public function update(Request $request, vehicles $vehicle)
    {
        // dd($request->all());
        $request->validate([
            'vehicle_type_id' => 'required',
            'registration' => 'required',
            'make' => 'required',
            'model' => 'required',
            'purchase_date' => 'required',
            'purchase_from' => 'required',
            'service_by' => 'required',
            'notes' => 'required',
            'mileage' => 'required',
        ]);

        $vehicle->vehicle_type_id = $request->vehicle_type_id;
        $vehicle->registration = $request->registration;
        $vehicle->make = $request->make;
        $vehicle->model = $request->model;
        $vehicle->purchase_date = $request->purchase_date;
        $vehicle->purchase_from = $request->purchase_from;
        $vehicle->service_by = $request->service_by;
        $vehicle->notes = $request->notes;
        $vehicle->mileage = $request->mileage;
        $vehicle->save();

        return redirect()->route('vehicles.index')->with('success', 'Vehicle updated successfully!');
    }

    public function destroy(vehicles $vehicle)
    {
        // dd($vehicle);
        $vehicle->delete();
        return response()->json(['success' => 'Vehicle deleted successfully!']);
    }
}
