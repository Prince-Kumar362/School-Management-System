<?php

namespace App\Http\Controllers\backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\StudentClass;

class StudentClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas=StudentClass::all();
        return view('backend.Setup.Student_class.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.Setup.Student_class.add');
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
            'name'=>'required|min:1|unique:student_classes,name',
        ]);
        $student=new StudentClass();
        $student->name=$request->name;
        $student->save();

        $notification=array(
            'message'=>'Student Class Save Successfully!!',
            'alert-type'=>'success'
        );
        return redirect()->route('student.class.view')->with($notification);
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
        $data=StudentClass::find($id);
        return view('backend.Setup.Student_class.edit',compact('data'));
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
            'name'=>'required|min:1|unique:student_classes,name',
        ]);
        $class=StudentClass::find($id);
        $class->name=$request->name;
        $class->save();

        $notification=array(
            'message'=>'Student Class Update Successfully!!',
            'alert-type'=>'success'
        );
        return redirect()->route('student.class.view')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $class=StudentClass::find($id);
        $class->delete();
        $notification=array(
            'message'=>'Student Class Delete Successfully!!',
            'alert-type'=>'success'
        );
        return redirect()->route('student.class.view')->with($notification);
    }
}
