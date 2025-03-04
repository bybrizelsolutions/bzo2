<?php

namespace App\Http\Controllers;

use Yajra\DataTables\Facades\DataTables;
use App\Models\countries;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = countries::query()->addSelect(['id', 'name'])
            ->orderBy('id', 'desc');

            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('actions', function ($row) {
                    return '<a href="' . route('countries.edit', $row->id) . '" class="btn btn-sm btn-primary">Edit</a>
                            <button class="btn btn-sm btn-danger delete-country" data-id="' . $row->id . '">Delete</button>';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('admin.countries.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.countries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|unique:countries,name',
        ]);

        $country = new countries();
        $country->name = $request->name;
        $country->save();

        return redirect()->route('countries.index')->with('success', 'Country added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(countries $country)
    {
        return view('admin.countries.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, countries $country)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|unique:countries,name,'.$country->id
        ]);

        $country->name = $request->name;
        $country->save();

        return redirect()->route('countries.index')->with('success', 'Country updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(countries $country)
    {
        // dd($country);
        $country->delete();
        return response()->json(['success' => 'Country deleted successfully!']);
    }
}
