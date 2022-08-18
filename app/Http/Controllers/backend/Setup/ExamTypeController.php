<?php

namespace App\Http\Controllers\backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExamType;

class ExamTypeController extends Controller
{
    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas=ExamType::all();
        return view('backend.Setup.Exam_type.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.Setup.Exam_type.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData=$request->validate([
            'name'=>'required|min:1|unique:exam_types,name',
        ]);
        $student=new ExamType();
        $student->name=$request->name;
        $student->save();

        $notification=array(
            'message'=>'Exam type Save Successfully!!',
            'alert-type'=>'success'
        );
        return redirect()->route('exam.type.view')->with($notification);
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
        $data=ExamType::find($id);
        return view('backend.Setup.Exam_type.edit',compact('data'));
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
        $validateData=$request->validate([
            'name'=>'required|min:1|unique:exam_types,name',
        ]);
        $class=ExamType::find($id);
        $class->name=$request->name;
        $class->save();

        $notification=array(
            'message'=>'Exam Type Update Successfully!!',
            'alert-type'=>'success'
        );
        return redirect()->route('exam.type.view')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $class=ExamType::find($id);
        $class->delete();
        $notification=array(
            'message'=>'Exam type Delete Successfully!!',
            'alert-type'=>'success'
        );
        return redirect()->route('exam.type.view')->with($notification);
    }
}
