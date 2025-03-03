<?php

namespace App\Http\Controllers;

use Yajra\DataTables\Facades\DataTables;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::with('role')
            ->whereNull('deleted_at')
            ->select(['id', 'name', 'username', 'email', 'role_id', 'mobile', 'status'])
            ->where('status', '=', '0')
            ->orderBy('id', 'desc');

            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return '<a href="' . route('users.edit', $row->id) . '" class="text-primary">' . e($row->name) . '</a>';
                })
                ->addColumn('role_name', function ($row) {
                    return $row->role ? $row->role->name : 'N/A';
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
                    $buttons = '<button class="btn btn-sm btn-danger delete-user" data-id="' . $row->id . '">Delete</button>';

                    if ($row->deleted_at) {
                        $buttons .= ' <button class="btn btn-sm btn-success restore-user" data-id="' . $row->id . '">Restore</button>';
                        $buttons .= ' <button class="btn btn-sm btn-dark force-delete-user" data-id="' . $row->id . '">Permanently Delete</button>';
                    }

                    return $buttons;
                })
                ->rawColumns(['name', 'status_label', 'actions'])
                ->make(true);
        }
        return view('admin.users.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        // dd($roles);

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role_id' => 'required|exists:roles,id',
            'mobile' => 'nullable|numeric',
            'phone' => 'nullable|numeric',
            'signature' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|in:0,1,2,3',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role_id;
        $user->mobile = $request->mobile;
        $user->phone = $request->phone;
        $user->status = $request->status;

        if ($request->hasFile('signature')) {
            $randomNumber = rand(100000, 999999);
            $ext = $request->file('signature')->getClientOriginalExtension();
            $filename = $randomNumber . '.' . $ext;
            $request->file('signature')->storeAs('signatures', $filename, 'public');
            $user->signature = $filename;
        }
        $user->save();

        return redirect()->route('users.index')->with('success', 'User added successfully!');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        // dd($roles);
        return view('admin.users.edit', compact('user', 'roles'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role_id' => 'required|exists:roles,id',
            'mobile' => 'nullable|numeric',
            'phone' => 'nullable|numeric',
            'signature' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|in:0,1,2,3',
        ]);

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->mobile = $request->mobile;
        $user->phone = $request->phone;
        $user->status = $request->status;

        if ($request->hasFile('signature')) {
            // Delete old image if exists
            if ($user->signature) {
                Storage::disk('public')->delete('signatures/' . $user->signature);
            }

            $randomNumber = rand(100000, 999999);
            $ext = $request->file('signature')->getClientOriginalExtension();
            $filename = $randomNumber . '.' . $ext;
            $request->file('signature')->storeAs('signatures', $filename, 'public');
            $user->signature = $filename;
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }

    public function trashed(Request $request)
    {
        if ($request->ajax()) {
            $data = User::onlyTrashed()->with('role')
                ->select(['id', 'name', 'username', 'email', 'role_id', 'mobile', 'status', 'deleted_at']);

            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return '<span class="text-muted">' . e($row->name) . '</span>';
                })
                ->addColumn('role_name', function ($row) {
                    return $row->role ? $row->role->name : 'N/A';
                })
                ->addColumn('status_label', function ($row) {
                    return '<span class="badge bg-danger">Deleted</span>';
                })
                ->addColumn('deleted_at', function ($row) {
                    return $row->deleted_at->format('d M Y, h:i A');
                })
                ->addColumn('actions', function ($row) {
                    return '
                        <button class="btn btn-sm btn-success restore-user" data-id="' . $row->id . '">Restore</button>
                        <button class="btn btn-sm btn-dark force-delete-user" data-id="' . $row->id . '">Permanently Delete</button>
                    ';
                })
                ->rawColumns(['name', 'status_label', 'actions'])
                ->make(true);
        }
        return view('admin.users.trashed');
    }

    public function restore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();

        return response()->json(['success' => 'User restored successfully!']);
    }

    public function forceDelete($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->forceDelete();

        return response()->json(['success' => 'User permanently deleted!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // dd($user);
        $user->delete();
        return response()->json(['success' => 'User soft deleted successfully!']);
    }
}
