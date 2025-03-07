<?php

namespace App\Http\Controllers;

use Yajra\DataTables\Facades\DataTables;
use App\Models\area;

use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = area::query()->addSelect(['id', 'name'])
            ->orderBy('id', 'desc');

            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('actions', function ($row) {
                    return '<a href="' . route('areas.edit', $row->id) . '" class="btn btn-sm btn-primary">Edit</a>
                            <button class="btn btn-sm btn-danger delete-area" data-id="' . $row->id . '">Delete</button>';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('admin.area.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.area.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|unique:areas,name',
        ]);

        $area = new area();
        $area->name = $request->name;
        $area->save();

        return redirect()->route('areas.index')->with('success', 'Area added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(area $area)
    {
        return view('admin.area.edit', compact('area'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, area $area)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|unique:areas,name,'.$area->id
        ]);

        $area->name = $request->name;
        $area->save();

        return redirect()->route('areas.index')->with('success', 'Area updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(area $area)
    {
        // dd($area);
        $area->delete();
        return response()->json(['success' => 'Area deleted successfully!']);
    }
}
