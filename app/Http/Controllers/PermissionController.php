<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PermissionController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $permission = Permission::all();
            return DataTables::of($permission)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group"><a href="javascript:void(0)" class="btn btn-primary btn-sm edit" data-id="' . $row->id . '">Edit</a><a href="javascript:void(0)" class="btn btn-danger btn-sm delete" data-id="' . $row->id . '">Delete</a></div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        };
        return view('admin.permission');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles'
        ]);

        $save = Permission::create([
            'name' => $request->name,
            'guard_name' => 'web'
        ]);
        return response()->json(['status' => true, 'message' => 'Your data has been created', 'data' => $save]);
    }

    public function edit($id)
    {
        $role = Permission::where('id', $id)->first(['id', 'name']);
        return response()->json(['status' => true, 'message' => 'Data has been found', 'data' => $role]);
    }

    public function update(Request $request, $id)
    {
        $role = Permission::where('id', $id)->update([
            'name' => $request->name
        ]);
        return response()->json(['status' => true, 'message' => 'Data has been updated', $role]);
    }

    public function destroy($id)
    {
        $roles = Permission::findOrFail($id);
        $roles->delete();
        return response()->json(['status' => true, 'message' => 'Your data has been deleted']);
    }
}
