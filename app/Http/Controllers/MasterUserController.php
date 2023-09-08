<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use DB;
use Auth;
use DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class MasterUserController extends Controller
{
    public function index()
    {

        if(auth()->user()->role_id == 3){

            // $statusaja = DB::table('statusakun')->get();
            $hakakses = DB::table('role_users')->get();

            // $users = User::all();
            return view('employee.index', compact('hakakses'));

        }else{
            return to_route('reimbursement');

        }

    }
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'input_nama' => 'required',
            'nip' => 'required',
            'input_Email' => 'required',
            'input_hak_akses' => 'required',
            'ubah_status' => 'required',
            'password_input' => 'required',

        ]);

        if ($validator->fails()) {
            $data = [
                'isSuccess' => 'no',
                'msg' => 'periksa kembali isian kamu, Ada yang kurang sepertinya'
            ];

            return response()->json($data);
        }

        $msg = '';
        try {

            $store = new User();
            $store->name = $request->input_nama;
            $store->nip = $request->input_nama;
            $store->email =  $request->input_Email;
            $store->role_id =  $request->input_hak_akses;
            $store->status =  $request->ubah_status;
            $store->password =  Hash::make($request->password_input);
            $store->save();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            // dd($e);
        }


        if ($msg == null) {
            $data = [
                'isSuccess' => 'yes',
                'msg' => ''
            ];
        } else {
            $data = [
                'isSuccess' => 'no',
                'msg' => $msg
            ];
        }
        return response()->json($data);
    }
    public function destroy(Request $req, User $User)
    {
        $msg = '';

        $User = User::find($req->id);


        try {
            // $reimbursement = Reimbursement::find($id);
            $User->delete();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            // dd($e);
        }


        if ($msg == null) {
            $data = [
                'isSuccess' => 'yes',
                'msg' => ''
            ];
        } else {
            $data = [
                'isSuccess' => 'no',
                'msg' => $msg
            ];
        }
        return response()->json($data);
    }
    public function Activate(Request $req, User $User)
    {
        $msg = '';
        try {
            $User = User::find($req->id);
            $User->status = 'ACTIVE';
            $User->save();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            // dd($e);
        }


        if ($msg == null) {
            $data = [
                'isSuccess' => 'yes',
                'msg' => ''
            ];
        } else {
            $data = [
                'isSuccess' => 'no',
                'msg' => $msg
            ];
        }
        return response()->json($data);
    }
    public function Deactivate(Request $req, User $User)
    {
        $msg = '';
        try {
            $User = User::find($req->id);
            $User->status = 'DEACTIVATE';
            $User->save();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            // dd($e);
        }


        if ($msg == null) {
            $data = [
                'isSuccess' => 'yes',
                'msg' => ''
            ];
        } else {
            $data = [
                'isSuccess' => 'no',
                'msg' => $msg
            ];
        }
        return response()->json($data);
    }

    public function Update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'ubah_id' => 'required',
            'ubah_email' => 'required',
            'ubah_nip' => 'required',
            'ubah_nama' => 'required',
            'ubah_hak_akses' => 'required',
            'ubah_status' => 'required',
            'ubah_password' => 'required',
            'ubah_confirm_password' => 'required',

        ]);

        if ($validator->fails()) {
            $data = [
                'isSuccess' => 'no',
                'msg' => 'periksa kembali isian kamu, Ada yang kurang sepertinya'
            ];

            return response()->json($data);
        }

        $msg = '';
        try {

            $store = user::find($request->ubah_id);
            $store->name = $request->ubah_nama;
            $store->nip = $request->ubah_nip;
            $store->email =  $request->ubah_email;
            $store->role_id =  $request->ubah_hak_akses;
            $store->status =  $request->ubah_status;
            $store->password =  Hash::make($request->password_input);
            $store->save();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            // dd($e);
        }


        if ($msg == null) {
            $data = [
                'isSuccess' => 'yes',
                'msg' => ''
            ];
        } else {
            $data = [
                'isSuccess' => 'no',
                'msg' => $msg
            ];
        }
        return response()->json($data);
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
            $btn = $btn . '<button type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="ubah data karyawan" onclick="change(' . $data->id . ');" style="margin-left:3px; margin-right:3px;"class="btn btn-sm btn-info"><i class="fa-solid fa-pencil"></i></button>';
            $btn = $btn . '<button type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Hapus Pengguna" onclick="hapus(' . $data->id . ', "'.$data->name.'");" style="margin-left:3px; margin-right:3px;"class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>';
            if($data->status == 'ACTIVE'){
                $btn = $btn . '<button type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Matikan akses Karyawan" onclick="deactivate(' . $data->id . ', `' . $data->name . '`)" style="margin-left:3px; margin-right:3px;"class="btn btn-sm btn-warning"><i class="fa-solid fa-toggle-off"></i></button>';
            }else{
                $btn = $btn . '<button type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Actifkan akses Karyawan" onclick="activate(' . $data->id . ', `' . $data->name . '`)"  style="margin-left:3px; margin-right:3px;"class="btn btn-sm btn-success"><i class="fa-solid fa-toggle-on"></i></button>';
            }
                return $btn;
            })
            ->rawColumns(['status', 'role_users', 'action'])
            ->make(true);
    }

}
