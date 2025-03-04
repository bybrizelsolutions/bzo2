<?php

namespace App\Http\Controllers;

use App\Models\addresses;
use App\Models\area;
use App\Models\countries;
use App\Models\locations;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = locations::with(['area', 'address', 'country'])->select('id', 'name', 'email', 'telephone', 'consignment_note_required', 'permit_number', 'website', 'area_id', 'address_id', 'country_id')
            ->orderBy('id', 'desc');

            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('full_address', function ($row) {
                    return $row->address ? $row->address->address_line_one . ', ' . $row->address->address_line_two . ', ' . $row->address->address_line_three . ', ' . $row->address->address_line_four . ', ' . $row->address->postcode : 'N/A';
                })
                ->addColumn('area', function ($row) {
                    return $row->area ? $row->area->name : 'N/A';
                })
                ->addColumn('country', function ($row) {
                    return $row->country ? $row->country->name : 'N/A';
                })
                ->addColumn('actions', function ($row) {
                    return '<a href="' . route('locations.edit', $row->id) . '" class="btn btn-sm btn-primary">Edit</a>
                            <button class="btn btn-sm btn-danger delete-location" data-id="' . $row->id . '">Delete</button>';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('admin.location.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $areas = area::all();
        $countries = countries::all();
        $addresses = addresses::all();
        // dd($addresses);

        return view('admin.location.create', compact('areas', 'countries', 'addresses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'required|string|max:20',
            'permit_number' => 'nullable|string|max:50',
            'website' => 'nullable|url',
            'area_id' => 'required|exists:areas,id',
            'address_id' => 'required|exists:addresses,id',
            'country_id' => 'required|exists:countries,id',
            'consignment_note_required' => 'required|integer|in:0,1',
        ]);

        $location = new locations();
        $location->name = $request->name;
        $location->email = $request->email;
        $location->telephone = $request->telephone;
        $location->permit_number = $request->permit_number;
        $location->website = $request->website;
        $location->area_id = $request->area_id;
        $location->country_id = $request->country_id;
        $location->address_id = $request->address_id;
        $location->consignment_note_required = $request->consignment_note_required;
        $location->save();

        return redirect()->route('locations.index')->with('success', 'Location added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(locations $location)
    {
        $areas = area::all();
        $countries = countries::all();
        $addresses = addresses::all();
        // dd($addresses);

        return view('admin.location.edit', compact('location', 'areas', 'countries', 'addresses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, locations $location)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'required|string|max:20',
            'permit_number' => 'nullable|string|max:50',
            'website' => 'nullable|url',
            'area_id' => 'required|exists:areas,id',
            'address_id' => 'required|exists:addresses,id',
            'country_id' => 'required|exists:countries,id',
            'consignment_note_required' => 'required|integer|in:0,1',
        ]);

        $location->name = $request->name;
        $location->email = $request->email;
        $location->telephone = $request->telephone;
        $location->permit_number = $request->permit_number;
        $location->website = $request->website;
        $location->area_id = $request->area_id;
        $location->country_id = $request->country_id;
        $location->address_id = $request->address_id;
        $location->consignment_note_required = $request->consignment_note_required;
        $location->save();

        return redirect()->route('locations.index')->with('success', 'Location updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(locations $location)
    {
        // dd($location);
        $location->delete();
        return response()->json(['success' => 'Location deleted successfully!']);
    }
}
