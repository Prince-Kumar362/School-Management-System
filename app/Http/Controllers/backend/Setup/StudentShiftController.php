<?php

namespace App\Http\Controllers\backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentShift;

class StudentShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas=StudentShift::all();
        return view('backend.Setup.Student_shift.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.Setup.Student_shift.add');
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
            'name'=>'required|min:1|unique:student_shifts,name',
        ]);
        $student=new StudentShift();
        $student->name=$request->name;
        $student->save();

        $notification=array(
            'message'=>'Student Shift Save Successfully!!',
            'alert-type'=>'success'
        );
        return redirect()->route('student.shift.view')->with($notification);
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
        $data=StudentShift::find($id);
        return view('backend.Setup.Student_shift.edit',compact('data'));
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
            'name'=>'required|min:1|unique:student_shifts,name',
        ]);
        $class=StudentShift::find($id);
        $class->name=$request->name;
        $class->save();

        $notification=array(
            'message'=>'Student Shift Update Successfully!!',
            'alert-type'=>'success'
        );
        return redirect()->route('student.shift.view')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $class=StudentShift::find($id);
        $class->delete();
        $notification=array(
            'message'=>'Student Shift Delete Successfully!!',
            'alert-type'=>'success'
        );
        return redirect()->route('student.shift.view')->with($notification);
    }
}
