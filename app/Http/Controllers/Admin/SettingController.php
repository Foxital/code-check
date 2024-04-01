<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Setting, userSubscribe, ContactUser};
use DataTables;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Setting::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="/admin/settings/'.$row['id'].'/edit" class="edit btn btn-success btn-sm">Manage</a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('Admin.Setting.index');
    }
    
    
    public function newsletterindex(Request $request)
    {
        if ($request->ajax()) {
            $data = userSubscribe::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '#';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('Admin.Setting.nindex');
    }
    
    public function contactusindex(Request $request)
    {
        if ($request->ajax()) {
            $data = ContactUser::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '#';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('Admin.Setting.cindex');
    }


    public function edit($id)
    {
        $data = Setting::where('id', $id)->first();
        return view('Admin.Setting.create',['data'=>$data]);
    }

    public function update(Request $request, $id)
    {
        if($request->input('status')=='1'){
            $request->validate([
                'page' => 'required',
                'status' => 'required|integer',
                'val' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $data = [
                'page' => $request->input('page')
            ];
            if(isset($request->valpv)&&$request->valpv!=''){
                $data['val'] = $request->input('imagepv');
            }else if(isset($request->val)){
                $newImaegname = time() .'-'. str_replace(' ','_',$request->page) .'.'. $request->val->extension();
                $dd = $request->val->move(public_path('uploads/Setting'), $newImaegname);
                $data['val'] = $newImaegname;
            }
        }else{
            $request->validate([
                'page' => 'required',
                'status' => 'required|integer',
                'val' => 'required'
            ]);
            $data = [
                'page' => $request->input('page'),
                'val' => $request->input('val')
            ];
        }

        Setting::where('id',$id)->update($data);
        return redirect('/admin/settings');
    }
}
