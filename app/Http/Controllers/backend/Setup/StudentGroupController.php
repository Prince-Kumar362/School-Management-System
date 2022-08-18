<?php

namespace App\Http\Controllers\backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentGroup;

class StudentGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas=StudentGroup::all();
        return view('backend.Setup.Student_group.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.Setup.Student_group.add');
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
            'name'=>'required|min:1|unique:student_groups,name',
        ]);
        $student=new StudentGroup();
        $student->name=$request->name;
        $student->save();

        $notification=array(
            'message'=>'Student Group Save Successfully!!',
            'alert-type'=>'success'
        );
        return redirect()->route('student.group.view')->with($notification);
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
        $data=StudentGroup::find($id);
        return view('backend.Setup.Student_group.edit',compact('data'));
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
            'name'=>'required|min:1|unique:student_groups,name',
        ]);
        $class=StudentGroup::find($id);
        $class->name=$request->name;
        $class->save();

        $notification=array(
            'message'=>'Student Group Update Successfully!!',
            'alert-type'=>'success'
        );
        return redirect()->route('student.group.view')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $class=StudentGroup::find($id);
        $class->delete();
        $notification=array(
            'message'=>'Student Group Delete Successfully!!',
            'alert-type'=>'success'
        );
        return redirect()->route('student.group.view')->with($notification);
    }
}
