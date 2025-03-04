<?php

namespace App\Http\Controllers;

use Yajra\DataTables\Facades\DataTables;
use App\Models\addresses;
use App\Models\area;
use App\Models\countries;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = addresses::with(['area', 'country'])->select('id', 'area_id', 'country_id', 'address_line_one', 'address_line_two', 'address_line_three', 'address_line_four', 'postcode')
            ->orderBy('id', 'desc');

            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('full_address', function ($row) {
                    return implode(', ', array_filter([
                        $row->address_line_one,
                        $row->address_line_two,
                        $row->address_line_three,
                        $row->address_line_four,
                        $row->postcode
                    ]));
                })
                ->addColumn('actions', function ($row) {
                    return '<a href="' . route('addresses.edit', $row->id) . '" class="btn btn-sm btn-primary">Edit</a>
                            <button class="btn btn-sm btn-danger delete-address" data-id="' . $row->id . '">Delete</button>';
                })
                ->rawColumns(['full_address', 'actions'])
                ->make(true);
        }
        return view('admin.address.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $areas = area::all();
        $countries = countries::all();

        return view('admin.address.create', compact('areas', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'area_id'           => 'required|exists:areas,id',
            'country_id'        => 'required|exists:countries,id',
            'address_line_one'  => 'required|string|max:255',
            'address_line_two'  => 'nullable|string|max:255',
            'address_line_three'=> 'nullable|string|max:255',
            'address_line_four' => 'nullable|string|max:255',
            'postcode'          => 'required|string|max:10',
        ]);

        $address = new addresses();
        $address->area_id = $request->area_id;
        $address->country_id = $request->country_id;
        $address->address_line_one = $request->address_line_one;
        $address->address_line_two = $request->address_line_two;
        $address->address_line_three = $request->address_line_three;
        $address->address_line_four = $request->address_line_four;
        $address->postcode = $request->postcode;
        $address->save();

        return redirect()->route('addresses.index')->with('success', 'Address added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(addresses $address)
    {
        $areas = area::all();
        $countries = countries::all();

        return view('admin.address.edit', compact('address', 'areas', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, addresses $address)
    {
        // dd($request->all());
        $request->validate([
            'area_id'           => 'required|exists:areas,id',
            'country_id'        => 'required|exists:countries,id',
            'address_line_one'  => 'required|string|max:255',
            'address_line_two'  => 'nullable|string|max:255',
            'address_line_three'=> 'nullable|string|max:255',
            'address_line_four' => 'nullable|string|max:255',
            'postcode'          => 'required|string|max:10',
        ]);

        $address->area_id = $request->area_id;
        $address->country_id = $request->country_id;
        $address->address_line_one = $request->address_line_one;
        $address->address_line_two = $request->address_line_two;
        $address->address_line_three = $request->address_line_three;
        $address->address_line_four = $request->address_line_four;
        $address->postcode = $request->postcode;
        $address->save();

        return redirect()->route('addresses.index')->with('success', 'Address updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(addresses $address)
    {
        // dd($address);
        $address->delete();
        return response()->json(['success' => 'Address deleted successfully!']);
    }
}
