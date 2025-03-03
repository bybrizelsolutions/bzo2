<?php

namespace App\Http\Controllers;

use Yajra\DataTables\Facades\DataTables;
use App\Models\products;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Products::query()->addSelect(['id', 'name', 'short_name', 'category', 'base_price_one', 'size', 'vehicle_type', 'instructions', 'service_type', 'prd_ewc_code', 'prd_component', 'pence_flag', 'full_weight', 'empty_weight', 'h2o', 'cl', 's', 'solid', 'fp', 'ash', 'vehicle_and_man_hire', 'per_tonne_disposal', 'service_check', 'prd_default_consignment_note_type', 'prd_hazard_codes_id', 'consignment_category_id', 'prd_physical_form_id', 'status']);

            return DataTables::eloquent($data)
                ->addIndexColumn()
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
                    return '<a href="' . route('products.edit', $row->id) . '" class="btn btn-sm btn-primary">Edit</a>
                        <a href="' . route('products.delete', $row->id) . '" class="btn btn-sm btn-danger delete-product" data-id="' . $row->id . '">Delete</a>';
                })
                ->rawColumns(['status_label', 'actions'])
                ->make(true);
        }
        return view('admin.product.list');
    }

    public function create()
    {
        return view('admin.product.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|max:1000',
            'status' => 'required',
        ]);

        $product = new products();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->status = $request->status;
        $product->save();

        return redirect()->route('products.index')->with('success', 'Product added successfully!');
    }

    public function edit(products $product)
    {
        // dd($product->name);
        return view('admin.product.edit', compact('product'));
    }

    public function update(Request $request, products $product)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|max:1000',
            'status' => 'required',
        ]);

        $product->name = $request->name;
        $product->description = $request->description;
        $product->status = $request->status;

        $product->save();

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy(products $product)
    {
        // dd($user);
        $product->delete();
        return response()->json(['success' => 'Product deleted successfully!']);
    }
}
