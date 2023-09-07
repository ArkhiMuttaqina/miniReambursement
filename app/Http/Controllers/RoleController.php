<?php

namespace App\Http\Controllers;

use App\Models\RoleUsers;
use App\Models\User;
use Illuminate\Http\Request;
use DB;
use Auth;
use DataTables;
use Illuminate\Support\Facades\Response;

class RoleController extends Controller
{
    public function index()
    {

        // $statusaja = DB::table('statusakun')->get();
        $hakakses = DB::table('role_users')->get();

        // $users = User::all();
        return view('role.index', compact('hakakses'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        User::create($validatedData);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function show(RoleUsers $role)
    {
        return view('role.show', compact('role'));
    }

    public function edit(RoleUsers $role)
    {
        return view('role.edit', compact('role'));
    }

    public function update(Request $request, RoleUsers $RoleUsers)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        $RoleUsers->update($validatedData);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(RoleUsers $role)
    {
       $role->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }


    public function apiRole(Request $request)
    {
        if($request->id != null){
            $role = DB::table('role')->select(
                'role.*'
            )->first();
            return Response::json($role);
        }
        $users = DB::table('users')->select(
            'users.*',
            'role.name as role',
        )->leftjoin('role_users as role', 'role.id', '=', 'users.role_id')->get();

        return Datatables::of($users)
            ->addIndexColumn()
            ->editColumn('status', function ($data) {
                $statusUsers = $data->status;

                if ($statusUsers == 'ACTIVE') {
                    $var = '<div class="badge bg-success text-white rounded-pill">ACTIVE</div>';
                } else if ($statusUsers == 'INACTIVE') {
                    $var = '<div class="badge bg-danger- text-white rounded-pill">INACTIVE</div>';
                } else {
                    $var = '<div class="badge bg-warning text-white rounded-pill">UNKNOWN</div>';
                }
                return $var;
            })
            ->editColumn('action', function ($data) {
                $btn = '';
                $btn = $btn . '<a href="javascript:void(0)" onclick="ubah('.$data->id.');" class="btn-sm btn-info">Edit</a>';
                $btn = $btn . '<a href="javascript:void(0)" onclick="hapus('.$data->id.');" class="btn-sm btn-trash">hapus</a>';
                return $btn;
            })

            ->rawColumns(['status', 'role_users', 'action'])
            ->make(true);
    }

}
