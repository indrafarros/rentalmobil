<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $users = User::all();
            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group"><a href="javascript:void(0)" class="btn btn-primary btn-sm edit" data-id="' . $row->id . '">Edit</a><a href="javascript:void(0)" class="btn btn-danger btn-sm delete" data-id="' . $row->id . '">Delete</a></div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.user');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'username' => 'required|min:5|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['status' => true, 'message' => 'User has been created']);
    }
}
