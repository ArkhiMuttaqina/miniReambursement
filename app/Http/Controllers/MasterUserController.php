<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use DB;
use Auth;
use DataTables;
use Illuminate\Support\Facades\Response;

class MasterUserController extends Controller
{
    public function index()
    {

        // $statusaja = DB::table('statusakun')->get();
        $hakakses = DB::table('role_users')->get();

        // $users = User::all();
        return view('employee.index', compact('hakakses'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'role_id' => 'required',
            'status' => 'required',
            'password' => 'required',
        ]);

        User::create($validatedData);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $user->id,
            'role_id' => 'required',
            'status' => 'required',
            'password' => 'required',
        ]);

        $user->update($validatedData);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }


    public function apiUsers(Request $request)
    {
        if($request->id != null){
            $users = DB::table('users')->select(
                'users.*',
                'role.name as role',
            )->leftjoin('role_users as role', 'role.id', '=', 'users.role_id')->where('users.id', '=', $request->id)->first();
            return Response::json($users);
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
            ->editColumn('role_users', function ($data) {
            $role = $data->role;
                if ($role == 'DIRECTOR') {
                    $var = '<div class="badge bg-primary text-white rounded-pill">DIRECTOR</div>';
                } else if ($role == 'FINANCE') {
                    $var = '<div class="badge bg-primary text-white rounded-pill">FINANCE</div>';
                } else if ($role == 'STAFF') {
                    $var = '<div class="badge bg-primary text-white rounded-pill">STAFF</div>';
                } else {
                    $var = '<div class="badge bg-warning text-white rounded-pill">-</div>';
                }
                return $var;
            })
            ->editColumn('action', function ($data) {
                $btn = '';
            $btn = $btn . '<button type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="ubah data karyawan" onclick="ubah(' . $data->id . ');" style="margin-left:3px; margin-right:3px;"class="btn btn-sm btn-info"><i class="fa-solid fa-pencil"></i></button>';
            $btn = $btn . '<button type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Hapus Pengguna" onclick="hapus(' . $data->id . ');" style="margin-left:3px; margin-right:3px;"class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>';
            if($data->status == 'ACTIVE'){
                $btn = $btn . '<button type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Matikan akses Karyawan" onclick="deactivated(' . $data->id . ');" style="margin-left:3px; margin-right:3px;"class="btn btn-sm btn-warning"><i class="fa-solid fa-toggle-off"></i></button>';
            }else{
                $btn = $btn . '<button type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Actifkan akses Karyawan" onclick="activated(' . $data->id . ');" style="margin-left:3px; margin-right:3px;"class="btn btn-sm btn-success"><i class="fa-solid fa-toggle-on"></i></button>';
            }
                return $btn;
            })
            ->rawColumns(['status', 'role_users', 'action'])
            ->make(true);
    }

}
