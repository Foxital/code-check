<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use DataTables;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="/admin/candidates/'.$row['id'].'/edit" class="edit btn btn-success btn-sm">
                        <i class="fa fa-edit"></i>
                        </a>
                        <button onclick="del('.$row['id'].',\''.csrf_token().'\')" class="btn btn-danger btn-sm">
                        <i class="fa fa-trash"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('Admin.Candidate.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        return view('Admin.Candidate.create',['data'=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'signup_type' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'mobile' => 'required|min:10|unique:users',
            'password' => 'required|confirmed|min:8',
            'anniversary_date' => 'required',
            'dob_date' => 'required',
            'status' => 'required'
        ]);

        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'mobile' => $request->input('mobile'),
            'password' => Hash::make($request->input('password')),
            'anniversary_date' => $request->input('anniversary_date'),
            'dob_date' => $request->input('dob_date'),
            'status' => $request->input('status'),
            'signup_type' => $request->input('signup_type')
        ];

        User::create($data);
        return redirect('/admin/candidates');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::where('id', $id)->first();
        return view('Admin.Candidate.create',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'signup_type' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'mobile' => 'required|min:10|unique:users,mobile,'.$id,
            'password' => 'required|confirmed|min:8',
            'anniversary_date' => 'required',
            'dob_date' => 'required',
            'status' => 'required'
        ]);

        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'mobile' => $request->input('mobile'),
            'password' => Hash::make($request->input('password')),
            'anniversary_date' => $request->input('anniversary_date'),
            'dob_date' => $request->input('dob_date'),
            'status' => $request->input('status'),
            'signup_type' => $request->input('signup_type')
        ];

        $cand = User::where('id',$id)->update($data);
        return redirect('/admin/candidates');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Candidate = User::where('id',$id)->first();
        $Candidate->delete();
    }
}

