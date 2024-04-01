<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
use DataTables;

class FaqController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Faq::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="/admin/faqs/'.$row['id'].'/edit" class="edit btn btn-success btn-sm">
                        <i class="fa fa-edit"></i>
                        </a>
                        <button onclick="del('.$row['id'].',\''.csrf_token().'\')" class="btn btn-danger btn-sm">
                        <i class="fa fa-trash"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('Admin.Faqs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        return view('Admin.Faqs.create',['data'=>$data]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'link_code' => 'required',
            'question' => 'required',
            'lineup' => 'required',
            'status' => 'required',
            'answer' => 'required'
        ]);

        $data = [
            'question' => $request->input('question'),
            'answer' => $request->input('answer'),
            'lineup' => $request->input('lineup'),
            'status' => $request->input('status'),
            'link_code' => $request->input('link_code')
        ];

        Faq::create($data);
        return redirect('/admin/faqs');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = Faq::where('id', $id)->first();
        return view('Admin.Faqs.create',['data'=>$data]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'link_code' => 'required',
            'question' => 'required',
            'lineup' => 'required',
            'status' => 'required',
            'answer' => 'required'
        ]);

        $data = [
            'question' => $request->input('question'),
            'answer' => $request->input('answer'),
            'lineup' => $request->input('lineup'),
            'status' => $request->input('status'),
            'link_code' => $request->input('link_code')
        ];

        Faq::where('id',$id)->update($data);
        return redirect('/admin/faqs');
    }

    public function destroy($id)
    {
        $data = Faq::where('id',$id)->first();
        $data->delete();
    }
}
