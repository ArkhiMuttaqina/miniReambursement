<?php

namespace App\Http\Controllers;

use App\Models\Reimbursement;
use Illuminate\Http\Request;
use DB;
use DataTables;
use DateTime;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use IntlDateFormatter;

class ReimbursementController extends Controller
{
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    // /**
    //  * Show the application dashboard.
    //  *
    //  * @return \Illuminate\Contracts\Support\Renderable
    //  */

    public function index()
    {
        // dd(Hash::make("123456"));

        return view('reimbursement.index');
    }
    public function indexAll()
    {

        return view('reimbursement.all_special_access.index');
    }


    public function create()
    {
        return view('reimbursement.create');
    }


    public function post(Request $request)
    {


        $validator = Validator::make($request->all(), [

            'nama_pengajuan' => 'required|string',
            'nominal' => 'nullable|string',
            'desc' => 'nullable|string',

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
            DB::beginTransaction();
            $store = new Reimbursement;
            $store->name = $request->nama_pengajuan;
            $store->creator_id = auth()->user()->id;
            $store->approver_id = null;
            $store->nominal = $request->nominal;
            $store->approved_at = null;
            if ($request->file('unggah') != null) {
                $originName1 = $request->file('unggah')->getClientOriginalName();
                $fileName1 = pathinfo($originName1, PATHINFO_FILENAME);
                $extension1 = $request->file('unggah')->getClientOriginalExtension();
                $fileName1 = $store->id . '_' . strtoupper(bin2hex(openssl_random_pseudo_bytes(4))) . '_' . $fileName1 . '.' . $extension1;
                $request->file('unggah')->move(public_path('files_upload'), $fileName1);
                $store->files = $fileName1;
            } else {
                $store->files = '';
            }
            $store->desc = $request->desc;
            $store->status = 'IN PROCESS';
            $store->save();
            DB::commit();
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

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'nama_pengajuan' => 'required|string',
            'nominal' => 'nullable|string',
            'desc' => 'nullable|string',

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
            $store = Reimbursement::find($request->id);
            $store->name = $request->nama_pengajuan;

            $store->nominal = $request->nominal;

            if ($request->file('unggah') != null) {
                $originName1 = $request->file('unggah')->getClientOriginalName();
                $fileName1 = pathinfo($originName1, PATHINFO_FILENAME);
                $extension1 = $request->file('unggah')->getClientOriginalExtension();
                $fileName1 = $store->id . '_' . strtoupper(bin2hex(openssl_random_pseudo_bytes(4))) . '_' . $fileName1 . '.' . $extension1;
                $request->file('unggah')->move(public_path('files_upload'), $fileName1);
                $store->files = $fileName1;
            } else {
                $store->files = '';
            }
            $store->desc = $request->desc;
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

    public function show($id,Reimbursement $reimbursement)
    {
        $reimbursement = Reimbursement::find($id)->first();
        $state = 'true';

        return view('reimbursement.show', compact('reimbursement', 'state'));
    }

    public function edit($id, Reimbursement $reimbursement)
    {
        $reimbursement = Reimbursement::find($id)->first();
        $state = 'true';

        return view('reimbursement.edit', compact('reimbursement', 'state'));
    }

    public function destroy($id, Reimbursement $reimbursement)
    {
        try{
        $reimbursement = Reimbursement::find($id)->first();
        $reimbursement->delete();    } catch (\Exception $e) {
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
    public function approval(Request $req, Reimbursement $reimbursement)
    {
        $msg = '';
        try{
            $reimbursement = Reimbursement::find($req->id);
            $reimbursement->status = 'IN APPROVAL';
            $reimbursement->save();
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

    public function approved(Request $req,  Reimbursement $reimbursement)
    {
        $now = new DateTime();


        try {
            $reimbursement = Reimbursement::find($req->id);
            $reimbursement->status = 'APPROVED';
            $reimbursement->approved_at =  $now->format('Y-m-d H:i:s');
            $reimbursement->approver_id = auth()->user()->id;
            $reimbursement->save();
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
    public function rejected(Request $req, Reimbursement $reimbursement)
    {
        $now = new DateTime();

        try {
            $reimbursement = Reimbursement::find($req->id);
            $reimbursement->status = 'REJECTED';
            $reimbursement->approved_at =  $now->format('Y-m-d H:i:s');
            $reimbursement->approver_id = auth()->user()->id;
            $reimbursement->save();
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

    public function api(Request $request)
    {
        if ($request->id != null) {
            $users = DB::table('reimbursement')->select(
                'reimbursement.*',
                'users_creator.name as creator',
                'users_approver.name as approver'
            )
            ->leftjoin('users as users_creator', 'users_creator.id', '=', 'reimbursement.creator_id')
            ->leftjoin('users as users_approver', 'users_approver.id', '=', 'reimbursement.approver_id')
            ->where('reimbursement.id', '=', $request->id)->first();
            return Response::json($users);
        }
        $data = DB::table('reimbursement')->select(
            'reimbursement.*',
            'users_creator.name as creator',
            'users_approver.name as approver'
        )
            ->leftjoin('users as users_creator', 'users_creator.id', '=', 'reimbursement.creator_id')
            ->leftjoin('users as users_approver', 'users_approver.id', '=', 'reimbursement.approver_id')->where('reimbursement.creator_id', '=' ,auth()->user()->id)->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('status', function ($data) {
                $status = $data->status;

                if ($status == 'IN PROCESS') {
                    $var = '<span class="badge rounded-pill text-white" style="background-color:#87AFC7;">IN PROCESS</span>';
                } else if ($status == 'IN APPROVAL') {
                    $var = '<span class="badge rounded-pill text-white" style="background-color:#FFA500;">IN APPROVAL</span>';
                } else if ($status == 'REJECTED') {
                    $var = '<span class="badge rounded-pill text-white" style="background-color:#FF0000;">REJECTED</span>';
                } else if ($status == 'APPROVED') {
                    $var = '<span class="badge rounded-pill text-white" style="background-color:#008000;">APPROVED</span>';
                } else if ($status == 'POST') {
                    $var = '<span class="badge rounded-pill text-white" style="background-color:#008000;">POST</span>';
                } else if ($status == 'CLOSED') {
                    $var = '<span class="badge rounded-pill text-white" style="background-color:#0000A0;">CLOSED</span>';
                } else if ($status == 'DELETED') {
                    $var = '<span class="badge rounded-pill text-white" style="background-color:black;">DELETED</span>';
                } else if ($status == 'CANCELED') {
                    $var = '<span class="badge rounded-pill text-white" style="background-color:#C11B17;">CANCELED</span>';
                } else if ($status == 'PENDING') {
                    $var = '<span class="badge rounded-pill text-white" style="background-color:#FFA500;">PENDING !</span>';
                } else {
                    $var = '<span class="badge rounded-pill text-white">NULL</span>';
                }

                return $var;
            })
            ->editColumn('creator', function ($data) {
                $creator = $data->creator;
                if ($creator == '' || $creator == null) {
                    $var = '-';
                } else {
                    $var = $creator;
                }
                return $var;
            })
            ->editColumn('approver', function ($data) {
                $approver = $data->approver;
                if ($approver == '' || $approver == null) {
                    $var = '-';
                } else {
                    $var = $approver;
                }
                return $var;
            })
            ->editColumn('nominal', function ($data) {
                $grand_total = 'Rp. ' . number_format($data->nominal, 2, ',', '.');
                return '<div style="float: right; display: block">' . $grand_total . ',-</div>';
            })
            ->editColumn('created_at', function ($data) {
                $tanggal = $data->created_at;
                $date = new DateTime($tanggal);
                $formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::FULL, IntlDateFormatter::LONG);
                $result = $formatter->format($date);
                return '<div style="float: right; display: block">' . $result . '</div>';
            })
            ->editColumn('action', function ($data) {
                $btn = '';


                if($data->status == 'IN PROCESS' || $data->status == 'REJECTED'){
                $btn = $btn . '<a href="' . url('reimbursement/edit/' . $data->id) . '"  style="margin-left:3px;  margin-right:3px;"class="btn btn-sm btn-info">Edit</a>';
                $btn = $btn . '<a href="javascript:void(0)" onclick="hapus(' . $data->id . ', `' . $data->name . '`);" style="margin-left:3px;  margin-right:3px;"class="btn btn-sm btn-danger">hapus</a>';
                    $btn = $btn . '<a href="javascript:void(0)" onclick="approval(' . $data->id . ', `' . $data->name . '`);" style="margin-left:3px;  margin-right:3px;"class="btn btn-sm btn-secondary">Ajukan</a>';
                }else if($data->status == 'APPROVED'){
                $btn = $btn . '<a href="' . url('reimbursement/show/' . $data->id) . '"  style="margin-left:3px;  margin-right:3px;"class="btn btn-sm btn-info">Lihat</a>';
                 }else if($data->status == 'PENDING'){
                $btn = $btn . '<a href="' . url('reimbursement/show/' . $data->id) . '"  style="margin-left:3px;  margin-right:3px;"class="btn btn-sm btn-info">Lihat</a>';
                }else if ($data->status == 'IN APPROVAL') {
                $btn = $btn . '<a href="javascript:void(0)" onclick="rejected(' . $data->id . ', `' . $data->name . '`);" style="margin-left:3px;  margin-right:3px;"class="btn btn-sm btn-danger">Batalkan</a>';
            }

                return $btn;
            })

            ->rawColumns(['status', 'creator', 'approver', 'nominal', 'created_at', 'action'])
            ->make(true);
    }

    public function apiAllReimbursement(Request $request)
    {
        // if ($request->id != null) {
        //     $users = DB::table('reimbursement')->select(
        //         'reimbursement.*',
        //         'users.name as creator',
        //         'users.name as approver'
        //     )
        //     ->leftjoin('users as users_creator', 'users_creator.id', '=', 'reimbursement.creator_id')
        //     ->leftjoin('users as users_approver', 'users_approver.id', '=', 'reimbursement.approver_id')
        //     ->where('users.id', '=', $request->id)->first();
        //     return Response::json($users);
        // }
        $data = DB::table('reimbursement')->select(
            'reimbursement.*',
            'users_creator.name as creator',
            'users_approver.name as approver'
        )
        ->leftjoin('users as users_creator', 'users_creator.id', '=', 'reimbursement.creator_id')
        ->leftjoin('users as users_approver', 'users_approver.id', '=', 'reimbursement.approver_id');
        if ($request->state == 'update') {
            $data->where('reimbursement.status', '=', 'IN APPROVAL')->get();

        }else{
            $data->where('reimbursement.status', '=', 'APPROVED')->get();
        }

        return Datatables::of($data)
        ->addIndexColumn()
        ->editColumn('status', function ($data) {
            $status = $data->status;

            if ($status == 'IN PROCESS') {
                $var = '<span class="badge rounded-pill text-white" style="background-color:#87AFC7;">IN PROCESS</span>';
            } else if ($status == 'IN APPROVAL') {
                $var = '<span class="badge rounded-pill text-white" style="background-color:#FFA500;">IN APPROVAL</span>';
            } else if ($status == 'REJECTED') {
                $var = '<span class="badge rounded-pill text-white" style="background-color:#FF0000;">REJECTED</span>';
            } else if ($status == 'APPROVED') {
                $var = '<span class="badge rounded-pill text-white" style="background-color:#008000;">APPROVED</span>';
            } else if ($status == 'POST') {
                $var = '<span class="badge rounded-pill text-white" style="background-color:#008000;">POST</span>';
            } else if ($status == 'CLOSED') {
                $var = '<span class="badge rounded-pill text-white" style="background-color:#0000A0;">CLOSED</span>';
            } else if ($status == 'DELETED') {
                $var = '<span class="badge rounded-pill text-white" style="background-color:black;">DELETED</span>';
            } else if ($status == 'CANCELED'
            ) {
                $var = '<span class="badge rounded-pill text-white" style="background-color:#C11B17;">CANCELED</span>';
            } else if ($status == 'PENDING'
            ) {
                $var = '<span class="badge rounded-pill text-white" style="background-color:#FFA500;">PENDING !</span>';
            } else {
                $var = '<span class="badge rounded-pill text-white">NULL</span>';
            }

            return $var;
        })
        ->editColumn('creator', function ($data) {
            $creator = $data->creator;
            if ($creator == '' || $creator == null) {
                $var = '-';
            } else {
                $var = $creator;
            }
            return $var;
        })
            ->editColumn('approver', function ($data) {
                $approver = $data->approver;
                if ($approver == '' || $approver == null) {
                    $var = '-';
                } else {
                    $var = $approver;
                }
                return $var;
            })
            ->editColumn('nominal', function ($data) {
                $grand_total = 'Rp. ' . number_format($data->nominal, 2, ',', '.');
                return '<div style="float: right; display: block">' . $grand_total . ',-</div>';
            })
            ->editColumn('created_at', function ($data) {
                $tanggal = $data->created_at;
                $date = new DateTime($tanggal);
                $formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::FULL, IntlDateFormatter::LONG);
                $result = $formatter->format($date);
                return '<div style="float: right; display: block">' . $result . '</div>';
            })
            ->editColumn('action', function ($data) {
            $btn = '';


            if ($data->status == 'IN PROCESS') {

                $btn = $btn . '<a href="javascript:void(0)" onclick="hapus(' . $data->id . ', `' . $data->name . '`);" style="margin-left:3px;  margin-right:3px;"class="btn btn-sm btn-danger">hapus</a>';
                $btn = $btn . '<a href="javascript:void(0)" onclick="approval(' . $data->id . ', `' . $data->name . '`);" style="margin-left:3px;  margin-right:3px;"class="btn btn-sm btn-secondary">Ajukan</a>';
            } else if ($data->status == 'APPROVED') {
                $btn = $btn . '<a href="' . url('reimbursement/show/' . $data->id) . '"  style="margin-left:3px;  margin-right:3px;"class="btn btn-sm btn-info">Lihat</a>';
            } else if ($data->status == 'PENDING') {
                $btn = $btn . '<a href="' . url('reimbursement/show/' . $data->id) . '"  style="margin-left:3px;  margin-right:3px;"class="btn btn-sm btn-info">Lihat</a>';
            }else if ($data->status == 'IN APPROVAL') {
                $btn = $btn . '<a href="javascript:void(0)" onclick="showDetail(' . $data->id . ', `' . $data->name . '`);" style="margin-left:3px;  margin-right:3px;"class="btn btn-sm btn-secondary">Setujui</a>';
            }

            return $btn;
            })

            ->rawColumns(['status', 'creator', 'approver', 'nominal', 'created_at', 'action'])
            ->make(true);
    }
}
